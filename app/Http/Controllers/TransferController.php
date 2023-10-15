<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\TransferRequest;
use App\Http\Requests\VideoRequest;
use App\Models\Article;
use App\Models\Auction;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class TransferController extends Controller
{
    public function index()
    {
        return Inertia::render('Transfer/Index', [
            'categories' => Article::categories(),
        ]);

    }

    public function show(Request $request)
    {

        $transfer = Transfer::whereId($request->id)->with('auction')->with('owner:id,fullname,phone,is_active,is_block')->first();

        $owner = $transfer->owner;

        if (!$transfer)
            return response()->json(['message' => __('transfer_not_found')], Variable::ERROR_STATUS);

        if ($transfer->expires_at && Carbon::now()->diffInMicroseconds(Carbon::createFromDate($transfer->expires_at), false) < 0)
            return response()->json(['message' => __('transfer_expired')], Variable::ERROR_STATUS);

        if ($transfer->status != 'active')
            return response()->json(['message' => __('transfer_not_active_or_done')], Variable::ERROR_STATUS);

        if (!$owner || !$owner->is_active || $owner->is_block)
            return response()->json(['message' => __('user_inactive_or_blocked')], Variable::ERROR_STATUS);


        return response()->json(['data' => $transfer], Variable::SUCCESS_STATUS);


    }

    public function transfer(Request $request)
    {
        $user = auth()->user();
        $suggestionId = $request->suggestion_id;
        $password = $request->password;
        $price = $request->price;
        $id = $request->id;

        if (!$id && !$suggestionId)
            return response()->json(['message' => __('response_error')], Variable::ERROR_STATUS);


        //owner want to sell to this auction suggestion
        if ($suggestionId) {
            $auctionSuggestion = Auction::find($suggestionId);

            if (!$auctionSuggestion)
                return response()->json(['message' => __('item_not_found')], Variable::ERROR_STATUS);

            $buyPrice = $auctionSuggestion->price;
            $transfer = Transfer::find($auctionSuggestion->transfer_id);

            if ($user->isAdmin() || $user->id != $transfer->owner_id)
                $user = User::find($transfer->owner_id);

            if (!$transfer)
                return response()->json(['message' => __('transfer_not_found')], Variable::ERROR_STATUS);

            if ($user->role == 'us' && $transfer->owner_id != $user->id)
                return response()->json(['message' => __('item_not_yours')], Variable::ERROR_STATUS);


            if ($transfer->expires_at && Carbon::now()->diffInMicroseconds(Carbon::createFromDate($transfer->expires_at), false) < 0)
                return response()->json(['message' => __('transfer_expired')], Variable::ERROR_STATUS);

            if ($transfer->status != 'active')
                return response()->json(['message' => __('transfer_not_active_or_done')], Variable::ERROR_STATUS);

            $item = array_flip(Variable::DATA_TYPES)[$transfer->item_type]::find($transfer->item_id);

            if (!$item)
                return response()->json(['message' => __('item_not_found')], Variable::ERROR_STATUS);

            if ($item->owner_id != $transfer->owner_id)
                return response()->json(['message' => __('item_not_for_transfer_owner')], Variable::ERROR_STATUS);


            if (!in_array($item->status, ['active', 'need_charge']))
                return response()->json(['message' => __('item_is_inactive_or_blocked')], Variable::ERROR_STATUS);

            if ($transfer->item_type == 'article') {
                $notAllowedArticleItems = [];
                foreach (json_decode($item->content) as $itm) {
                    if ($itm->type == 'text') continue;
                    $notAllowedItem = DB::table(str_plural($itm->type))->where('id', $itm->id)->whereIn('status', [null, 'reject', 'block', 'review'])->first();
                    if ($notAllowedItem)
                        $notAllowedArticleItems[] = ['id' => $notAllowedItem->id, 'type' => $itm->type, 'data' => "( " . __($itm->type) . " | $itm->value" . " )"];
                }
                if (count($notAllowedArticleItems) > 0) {
                    return response()->json(['message' => __('article_items_cant_be_block_reject_review') . ":  " . join("\n\r", array_map(function ($e) {
                            return $e['data'];
                        }, $notAllowedArticleItems))]);
                }
            }
            $newOwner = User::find($auctionSuggestion->owner_id);

            if (!$newOwner)
                return response()->json(['message' => __('user_not_found')], Variable::ERROR_STATUS);


            if ($newOwner->id == $transfer->owner_id)
                return response()->json(['message' => __('owner_and_buyer_cant_be_same')], Variable::ERROR_STATUS);


            if (!$newOwner->is_active || $newOwner->is_block)
                return response()->json(['message' => __('user_inactive_or_blocked')], Variable::ERROR_STATUS);

            if ($newOwner->wallet < $buyPrice)
                return response()->json(['message' => __('user_wallet_insufficient')], Variable::ERROR_STATUS);
        } //user want to buy or suggest auction
        elseif ($id) {

            $transfer = Transfer::find($id);

            if (!$user || !$user->is_active || $user->is_block)
                return response()->json(['message' => __('your_account_inactive_or_blocked')], Variable::ERROR_STATUS);


            if (!$transfer)
                return response()->json(['message' => __('transfer_not_found')], Variable::ERROR_STATUS);

            if ($transfer->expires_at && Carbon::now()->diffInMicroseconds(Carbon::createFromDate($transfer->expires_at), false) < 0)
                return response()->json(['message' => __('transfer_expired')], Variable::ERROR_STATUS);

            if ($transfer->status != 'active')
                return response()->json(['message' => __('transfer_not_active_or_done')], Variable::ERROR_STATUS);


            if ($transfer->owner_id == $user->id)
                return response()->json(['message' => __('item_is_yours')], Variable::ERROR_STATUS);

            $owner = User::find($transfer->owner_id);

            if (!$owner || !$owner->is_active || $owner->is_block)
                return response()->json(['message' => __('owner_inactive_or_blocked')], Variable::ERROR_STATUS);


            $item = array_flip(Variable::DATA_TYPES)[$transfer->item_type]::find($transfer->item_id);

            if (!$item)
                return response()->json(['message' => __('item_not_found')], Variable::ERROR_STATUS);

            if ($item->owner_id != $transfer->owner_id)
                return response()->json(['message' => __('item_not_for_transfer_owner')], Variable::ERROR_STATUS);


            if (!in_array($item->status, ['active', 'need_charge']))
                return response()->json(['message' => __('item_is_inactive_or_blocked')], Variable::ERROR_STATUS);

            if ($transfer->item_type == 'article') {
                foreach (json_decode($item->content) as $itm) {
                    if ($itm->type == 'text') continue;
                    $notAllowedItem = DB::table(str_plural($itm->type))->where('id', $itm->id)->whereIn('status', [null, 'reject', 'block', 'review'])->first();
                    if ($notAllowedItem)
                        return response()->json(['message' => __('article_items_cant_be_block_reject_review')], Variable::ERROR_STATUS);
                }

            }

            if ($transfer->type == 'auction') {
                $priceStep = Setting::getValue('auction_price_step') ?? 0;
                $bestAuction = Auction::where('transfer_id', $transfer->id)->orderBy('price', 'DESC')->first();

                if ($bestAuction && $bestAuction->price)
                    $minAllowedPrice = $bestAuction->price + $priceStep;
                else
                    $minAllowedPrice = $transfer->price;


                if (!$price || !is_numeric($price) || $price < 0)
                    return response()->json(['message' => sprintf(__('validator.invalid'), __('suggestion_price'))], Variable::ERROR_STATUS);

                if ($price < $minAllowedPrice)
                    return response()->json(['message' => sprintf(__('validator.min'), __('suggestion_price'), "$minAllowedPrice " . __('currency'))], Variable::ERROR_STATUS);

                if ($user->wallet < $price)
                    return response()->json(['message' => sprintf(__('wallet_insufficient'), "$price " . __('currency'))], Variable::ERROR_STATUS);

                $auction = Auction::create([
                    'owner_id' => $user->id,
                    'transfer_id' => $transfer->id,
                    'price' => $price,
                ]);
                if ($auction)
                    return response()->json(['message' => __('your_suggestion_registered_successfully')], Variable::SUCCESS_STATUS);

                return response()->json(['message' => __('response_error')], Variable::ERROR_STATUS);

            } elseif ($transfer->type == 'private' || $transfer->type == 'regular') {
                $buyPrice = $transfer->price;
                $newOwner = $user;
                if ($transfer->type == 'private' && !password_verify($password, $transfer->password))
                    return response()->json(['message' => sprintf(__('validator.invalid'), __('transfer_password'))], Variable::ERROR_STATUS);


                if (!$buyPrice || !is_int($buyPrice) || $buyPrice < 0)
                    return response()->json(['message' => sprintf(__('validator.invalid'), __('suggestion_price'))], Variable::ERROR_STATUS);

                if ($user->wallet < $buyPrice)
                    return response()->json(['message' => sprintf(__('wallet_insufficient'), "$buyPrice " . __('currency'))], Variable::ERROR_STATUS);


            }


        }
        $commissionPercent = Setting::getValue('sell_cp') ?? 0;

        // start transfer
        $commission = intVal($buyPrice * $commissionPercent / 100);
        $sellerBenefit = $buyPrice - $commission;

//            DB::table(str_plural($transfer->item_type))->whereId($transfer->item_id)->update(['owner_id' => $newOwner->id]);
        $item->owner_id = $newOwner->id;
        $item->save();
        $transfer->new_owner_id = $newOwner->id;
        $transfer->price = $buyPrice;
        $transfer->done_at = Carbon::now();
        $transfer->status = 'done';
        $transfer->save();

        $user->wallet += $sellerBenefit;
        $user->save();
        $newOwner->wallet -= $buyPrice;
        $newOwner->save();
        //transfer all article items
        if ($transfer->item_type == 'article')
            foreach (json_decode($item->content) as $itm) {
                if ($itm->type == 'text') continue;
                DB::table(str_plural($itm->type))->where('id', $itm->id)->update(['owner_id' => $newOwner->id]);
                DB::table("data_transactions")->where('data_id', $itm->id)->where('data_type', $itm->type)->update(['owner_id' => $newOwner->id]);
                DB::table("{$itm->type}_transactions")->where('data_id', $itm->id)->update(['owner_id' => $newOwner->id]);

            }

        DB::table("data_transactions")->where('data_id', $transfer->item_id)->where('data_type', $transfer->item_type)->update(['owner_id' => $newOwner->id]);
        DB::table("{$transfer->item_type}_transactions")->where('data_id', $transfer->item_id)->update(['owner_id' => $newOwner->id]);
        Transaction::create([
            'owner_id' => $transfer->new_owner_id,
            'type' => "buy{$transfer->item_type}_{$transfer->item_id}",
            'title' => __("buy_{$transfer->item_type}"),
            'source_id' => $transfer->id,
            'amount' => -$buyPrice,
            'coupon' => null,

        ]);
        Transaction::create([
            'owner_id' => $transfer->owner_id,
            'type' => "sell{$transfer->item_type}_{$transfer->item_id}",
            'title' => __("sell_{$transfer->item_type}"),
            'source_id' => $transfer->id,
            'amount' => $sellerBenefit,
            'coupon' => null,

        ]);
        Transaction::create([
            'owner_id' => null,
            'type' => "transfer_commission_$transfer->id",
            'title' => __("transfer_commission") . " $transfer->id",
            'source_id' => $transfer->id,
            'amount' => $commission,
            'coupon' => null,

        ]);

        Setting::setWallet($commission);

        return response()->json(['message' => __('transferred_successfully')], Variable::SUCCESS_STATUS);


    }

    public function delete(Request $request, $id)
    {
        $data = Transfer::where('id', $id)->where('status', '!=', 'done')->first();
        $this->authorize('edit', [User::class, $data]);


        if ($data->delete()) {
            Auction::where('transfer_id', $id)->delete();
            return response()->json(['message' => __('done_successfully')], Variable::SUCCESS_STATUS);
        }
        return response()->json(['message' => __('item_not_found')], Variable::ERROR_STATUS);
    }

    public function update(TransferRequest $request)
    {
        $user = auth()->user();
        $expiresAt = $request->expires_at;

//        $response = ['message' => __('done_successfully')];
        $response = ['message' => __('response_error')];
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;
        $id = $request->id;
        $itemId = $request->item_id;
        $itemType = $request->item_type;
        $cmnd = $request->cmnd;
        $data = Transfer::find($id);

        if (!starts_with($cmnd, 'bulk'))
            $this->authorize('update', [User::class, $data]);

        $owner = User::find($data->owner_id);

        if ($data->status == 'done')
            return back()->withErrors(['errors' => __('cannot_edit_this'),]);

        if (!$owner)
            return back()->withErrors(['errors' => __('owner_not_found'),]);

        if (!$owner->wallet_active)
            return back()->withErrors(['errors' => __('help_activate_wallet')]);

        $item = DB::table(str_plural($itemType))->where('id', $itemId)->whereIn('status', ['active', 'need_charge']);

        if ($user->role == 'us') //user=owner
            $item = $item->where('owner_id', $user->id)->first();
        else
            $item = $item->first();
        if (!$item) {
            $data->status = 'inactive';
            $data->save();
            return back()->withErrors(['item' => __('item_not_found_or_inactive')]);
        }

        //if article items are not valid
        $beforeInTransfer = [];
        $notAllowedArticleItems = [];
        if ($itemType == 'article') {
            foreach (json_decode($item->content) as $itm) {
                if ($itm->type == 'text') continue;
                $notAllowedItem = DB::table(str_plural($itm->type))->where('id', $itm->id)->whereIn('status', [null, 'reject', 'block', 'review'])->first();
                if ($notAllowedItem)
                    $notAllowedArticleItems[] = ['id' => $notAllowedItem->id, 'type' => $itm->type, 'data' => "( " . __($itm->type) . " | $itm->value" . " )"];
            }
            if (count($notAllowedArticleItems) > 0) {
                $data->status = 'inactive';
                $data->save();
                return back()->with(['flash_status' => 'danger', 'flash_message' => __('article_items_cant_be_block_reject_review') . ":  " . join("\n\r", array_map(function ($e) {
                        return "<br>" . "<a class='text-danger hover:text-danger-400 cursor-pointer' target='_blank' href='" . route('panel.' . $e['type'] . '.index') . "'>" . $e['data'] . "</a>";
                    }, $notAllowedArticleItems))]);
            }

        } //if item is in an article sell
        else {
//            $usedItemArticles = Article::whereIntegerInRaw('id', Transfer::where('owner_id', $item->owner_id)->where('item_type', 'article')->where('status', '!=', 'done')->pluck('item_id'))->get();
            $ownerArticles = Article::where('owner_id', $item->owner_id)->get();
            foreach ($ownerArticles as $article) {
                foreach (json_decode($article->content) ?? [] as $articleItem) {
                    if ($articleItem->type == $itemType && $articleItem->id == $itemId) {
                        $beforeInTransfer[] = ['id' => $article->id, 'data' => "( " . __('article') . " | $article->title )"];
                        break;
                    }
                }
            }
            if (count($beforeInTransfer) > 0) {
                $data->status = 'inactive';
                $data->save();
                return back()->with(['flash_status' => 'danger', 'flash_message' => __('item_is_in_an_article') . ":<br>  " . join("<br>", array_map(function ($e) {
                        return "<br>" . "<a class='text-danger hover:text-danger-400 cursor-pointer' target='_blank' href='" . route('panel.article.edit', $e['id']) . "'>" . $e['data'] . "</a>";
                    }, $beforeInTransfer))]);
            }
        }

        if ($cmnd) {
            switch ($cmnd) {
                case 'inactive':

                    $data->status = 'inactive';
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);

                case 'active':
                    if ($data->status == 'expire' || ($data->expires_at != null && $data->expires_at < Carbon::now()))
                        return response()->json(['message' => __('first_renew_expire_time'), 'status' => $data->status,], $errorStatus);
                    $data->status = 'active';
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);


            }
        } elseif ($data) {

            $request->merge([
                'expires_at' => !$expiresAt || $expiresAt == 0 ? null : Carbon::now()->addHours($expiresAt),
                'password' => $request->password ? Hash::make($request->password) : $data->password,
                'item_name' => $item->name ?? $item->title,
            ]);

            if ($request->type == 'private' && !$data->password && !$request->password)
                return back()->withErrors(['password' => sprintf(__("validator.required"), __('transfer_password')),]);

            $oldType = $data->type;

            if ($data->update($request->all())) {

                if ($oldType == 'auction' && $data->type != 'auction')
                    Auction::where('transfer_id', $data->id)->delete();

                $res = ['flash_status' => 'success', 'flash_message' => __('updated_successfully')];
//                dd($request->all());
                Telegram::log(null, 'transfer_edited', $data);
                return back()->with($res);
            } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
            return back()->withErrors($res);
        }

        return response()->json($response, $errorStatus);
    }

    public function edit(Request $request, $id)
    {

        $data = Transfer::find($id);

        $this->authorize('edit', [User::class, $data]);

        $data->remained_hours = Carbon::now()->diffInHours(Carbon::createFromDate($data->expires_at), false);

        if ($data->type == 'auction')
            $data->auction = Auction::where('transfer_id', $data->id)->orderBy('price', 'DESC')->with('owner:id,fullname,phone')->get();

        if ($data->new_owner_id) {
            $buyer = User::find($data->new_owner_id);
            if ($buyer)
                $data->buyer = "$buyer->fullname - $buyer->phone";
        }
        return Inertia::render('Panel/Transfer/Edit', [
            'statuses' => Variable::TRANSFER_STATUSES,
            'types' => Variable::TRANSFER_TYPES,
            'data' => $data,
        ]);
    }

    public function searchPanel(Request $request)
    {
        $user = $request->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = $request->order_by ?: 'id';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;

        $query = Transfer::query();
//        $query = $query->select('id', 'name', 'designer', 'view_fee', 'meta', 'status', 'view', 'category_id');

        if ($user->role == 'us')
            $query = $query->where('owner_id', $user->id);

        if ($search)
            $query = $query->where('name', 'like', "%$search%");

        return $query->orderBy($orderBy, $dir)->paginate($paginate, ['*'], 'page', $page);
    }

    public function search(Request $request)
    {
//        $user = auth()->user();
        $id = $request->id;
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = 'created_at';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;
        $query = Transfer::query();
//        $seen = session()->get('site_views', []);
//        $query = $query->select('id', 'name', 'designer', 'view', 'view_fee', 'status', 'category_id', 'created_at',);
        //        $query = $query->select('charge', 'status', 'view_fee');
        $query = $query
//            ->where('type', '!=', 'private')
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNotNull('expires_at')->where('expires_at', '>=', Carbon::now());
                $query->orWhere('expires_at', null);
            });


        if ($id)
            $query = $query->where('id', $id)->with('auction');

        if ($search)
            $query = $query->where('name', 'like', "%$search%");

        $query = $query
            ->orderBy($orderBy, $dir);
        return $query->paginate($paginate, ['*'], 'page', $page);
    }

    public function create(TransferRequest $request)
    {
        $user = auth()->user();
        $ownerId = $request->owner_id;
        $price = $request->price;
        $type = $request->type;
        $itemId = $request->item_id;
        $itemType = $request->item_type;
        $expiresAt = $request->expires_at;
        $password = $request->password;


        if (!$user->wallet_active)
            return back()->withErrors(['errors' => __('help_activate_wallet')]);

        $item = DB::table(str_plural($itemType))->where('id', $itemId)->whereIn('status', ['active', 'need_charge']);


        if ($user->role == 'us')
            $item = $item->where('owner_id', $user->id)->first();
        else
            $item = $item->first();
        if (!$item)
            return back()->withErrors(['errors' => __('item_not_found')]);


        if (Transfer::where('owner_id', $item->owner_id)->where('item_id', $itemId)->where('item_type', $itemType)->where('status', '!=', 'done')->exists())
            return back()->withErrors(['errors' => __('item_is_in_sell_before')]);

        //if article items are in sell before
        $notAllowedArticleItems = [];
        $beforeInTransfer = [];
        if ($itemType == 'article') {
            foreach (json_decode($item->content) as $itm) {
                if ($itm->type == 'text') continue;
                $notAllowedItem = DB::table(str_plural($itm->type))->where('id', $itm->id)->whereIn('status', [null, 'reject', 'block', 'review'])->first();
                if ($notAllowedItem)
                    $notAllowedArticleItems[] = ['id' => $notAllowedItem->id, 'type' => $itm->type, 'data' => "( " . __($itm->type) . " | $itm->value" . " )"];

                $t = Transfer::where('owner_id', $item->owner_id)->where('item_id', $itm->id)->where('item_type', $itm->type)->where('status', '!=', 'done')->first();
                if ($t)
                    $beforeInTransfer[] = ['id' => $t->id, 'type' => $itm->type, 'data' => "( " . __($itm->type) . " | $itm->value" . " )"];

            }
            if (count($notAllowedArticleItems) > 0)
                return back()->with(['flash_status' => 'danger', 'flash_message' => __('article_items_cant_be_block_reject_review') . ":  " . join("\n\r", array_map(function ($e) {
                        return "<br>" . "<a class='text-danger hover:text-danger-400 cursor-pointer' target='_blank' href='" . route('panel.' . $e['type'] . '.index') . "'>" . $e['data'] . "</a>";
                    }, $notAllowedArticleItems))]);
            if (count($beforeInTransfer) > 0)
                return back()->with(['flash_status' => 'danger', 'flash_message' => __('article_items_cant_sell_separately') . ":  " . join("\n\r", array_map(function ($e) {
                        return "<br>" . "<a class='text-danger hover:text-danger-400 cursor-pointer' target='_blank' href='" . route('panel.transfer.edit', $e['id']) . "'>" . $e['data'] . "</a>";
                    }, $beforeInTransfer))]);


        } //if item is in an article sell
        else {
//            $usedItemArticles = Article::whereIntegerInRaw('id', Transfer::where('owner_id', $item->owner_id)->where('item_type', 'article')->where('status', '!=', 'done')->pluck('item_id'))->get();
            $ownerArticles = Article::where('owner_id', $item->owner_id)->get();
            foreach ($ownerArticles as $article) {
                foreach (json_decode($article->content) ?? [] as $articleItem) {
                    if ($articleItem->type == $itemType && $articleItem->id == $itemId) {
                        $beforeInTransfer[] = ['id' => $article->id, 'data' => "( " . __('article') . " | $article->title )"];
                        break;
                    }
                }
            }
            if (count($beforeInTransfer) > 0)
                return back()->with(['flash_status' => 'danger', 'flash_message' => __('item_is_in_an_article') . ":<br>  " . join("<br>", array_map(function ($e) {
                        return "<br>" . "<a class='text-danger hover:text-danger-400 cursor-pointer' target='_blank' href='" . route('panel.article.edit', $e['id']) . "'>" . $e['data'] . "</a>";
                    }, $beforeInTransfer))]);
        }

        $transfer = Transfer::create([
            'status' => 'active',
            'item_name' => $item->name ?? $item->title,
            'type' => $type,
            'price' => $price,
            'item_id' => $itemId,
            'item_type' => $itemType,
            'owner_id' => $item->owner_id,
            'expires_at' => !$expiresAt || $expiresAt == 0 ? null : Carbon::now()->addHours($expiresAt),
            'password' => $password ? Hash::make($password) : null,
        ]);
        if ($transfer) {
            $res = ['flash_status' => 'success', 'flash_message' => __('created_successfully')];
            Telegram::log(null, 'transfer_created', $transfer);
            return to_route('panel.transfer.index')->with($res);
        } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
        return back()->with($res);

    }
}

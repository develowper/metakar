<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Variable;
use App\Models\County;
use App\Models\DataTransaction;
use App\Models\Setting;
use App\Models\Site;
use App\Models\SiteTransaction;
use App\Models\SiteView;
use App\Models\UserTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{


    public function storeSite(Request $request)
    {
        $user = auth()->user();
        $userId = optional($user)->id;
        $autoView = $request->auto_view;
        $siteId = $request->id;
        $data = Site::find($siteId);
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;
        $meta_view_fee = Variable::SITE_VIEW_META_FEE();
        $meta_view_reward = Variable::SITE_VIEW_META_REWARD();
        $ip = $request->ip();
        session()->put('auto_view', $autoView);
        if (!session()->get('site_views', null))
            session()->put('site_views', []);
        if ($siteId)
            session()->push('site_views', $siteId);

        $loop = 0;
        while ($loop < 2) {
            $loop++;
            $seen = session()->get('site_views', []);
            $next = $user ? Site::where('id', '!=', $siteId)->whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', Site::where('owner_id', $user->id)->pluck('id'))->whereIntegerNotInRaw('id', $seen/* SiteTransaction::where('owner_id', $user->id)->pluck('data_id')*/)->orderBy('view_fee', 'DESC')->where(function ($query) use ($user, $meta_view_fee) {
                if ($user->wallet_active)
                    $query->whereColumn('charge', '>=', 'view_fee');
                else $query->where('meta', '>=', $meta_view_fee);
            })->firstOrNew()->id
                : Site::where('id', '!=', $siteId)->whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', $seen /*SiteView::where('ip', $ip)->pluck('data_id')*/)->where(function ($query) use ($user, $meta_view_fee) {
                    $query->where('meta', '>=', $meta_view_fee);
                })->firstOrNew()->id;
            if (!$next && count($seen) > 0)
                session()->forget('site_views');
            else break;
        }
        if (!$data || $data->status == 'inactive' || $data->status == 'block' || (!optional($user)->wallet_active) && $data->meta < $meta_view_fee) {
            return response()->json(['message' => "$siteId" . __('item_is_inactive'), 'next' => $next,], $errorStatus);
        }

        $date = Carbon::now(/*'Asia/Tehran'*/)->setTime(0, 0);
        $storeData = DataTransaction::firstOrCreate([
            'data_type' => 'site',
            'data_id' => $data->id,
            'date' => $date,
        ]);
        if (!$storeData->owner_id && $data->owner_id)
            $storeData->owner_id = $data->owner_id;
        $storeUser = UserTransaction::firstOrCreate($ip, $userId);


        if (!$user) {
            if ($ip && !SiteTransaction::where('ip', $ip)->where('data_id', $data->id)->where('type', 'view')->exists()) {
                SiteTransaction::create(['title' => __('site_view_payment'), 'ip' => $ip, 'data_id' => $data->id, 'type' => 'view', 'is_meta' => true, 'amount' => $data->meta >= $meta_view_fee ? $meta_view_fee : 0]);
                $data->viewer++;
                $storeData->viewer++;
            }
            if ($data->meta >= $meta_view_fee) {
                $data->meta -= $meta_view_fee;
//                if ($data->meta < $meta_view_fee)
//                    $data->status = 'need_charge';
                $storeData->sum_meta += $meta_view_fee;
                $storeUser->sum_meta += $meta_view_fee;
            }


            $storeData->view++;
            $storeUser->view++;
            $data->view++;
            $data->save();
            $storeData->save();
            $storeUser->save();
            return response()->json(['message' => __('login_or_register_for_get_reward'), 'next' => $next,], $errorStatus);
        }
        if ($user->is_block || !$user->is_active) {
            return response()->json(['message' => __('your_account_inactive_or_blocked'),], $errorStatus);
        }
        if ($user->id == $data->owner_id) {
            return response()->json(['message' => __('item_is_yours'), 'next' => $next,], $errorStatus);
        }
//        if (SiteTransaction::where('owner_id', $user->id)->where('data_id', $data->id)->first()) {
//            return response()->json(['message' => __('you_viewed_this_site_before'), 'next' => $next,], $errorStatus);
//        }
        if ($data->status != 'view' || ($user->wallet_active && $data->charge < $data->view_fee) || (!$user->wallet_active && $data->meta < $meta_view_fee)) {
            if ($data->status == 'view') {
                $data->status = 'need_charge';
                $data->save();
            }
            return response()->json(['message' => __('item_view_time_ended'), 'next' => $next,], $errorStatus);
        }

        $is_meta = null;


        if ($user->wallet_active && $data->charge >= $data->view_fee) {
            $commissionPercent = Setting::getValue('site_view_cp') ?? 0;
            $commission = intVal($data->view_fee * $commissionPercent / 100);
            $amount = $data->view_fee - $commission;
            Setting::setWallet($commission);
            $data->charge -= $data->view_fee;
            $user->wallet += $amount;
            if ($data->charge < $data->view_fee)
                $data->status = 'need_charge';
            $storeData->sum += $amount;
            $storeUser->sum += $amount;

            $is_meta = false;
            $title = __('site_view_payment') . " (" . __('currency') . ")";
            $message = sprintf(__('added_to_your_wallet'), $amount, __('currency'));
            $user->save();
        } elseif (!$user->wallet_active && $data->meta >= $meta_view_fee) {
            $data->meta -= $meta_view_fee;
            $storeData->sum_meta += $meta_view_fee;
            $storeUser->sum_meta += $meta_view_fee;

            if ($data->meta < $meta_view_fee)
                $data->status = 'need_charge';

            //check if user have site for view? add wallet meta to that
            $userSite = Site::where('owner_id', $user->id)->where('status', 'need_charge')->orWhere('status', 'view')->orderBy('meta', 'ASC')->first();
            if ($userSite) {
                $userSite->meta += $meta_view_reward;
                if ($userSite->status == 'need_charge')
                    $userSite->status = 'view';
                $userSite->save();
            } else {
                $user->meta_wallet += $meta_view_reward;
                $user->save();
            }

            $amount = $meta_view_reward;
            $is_meta = true;
            $title = __('site_view_payment') . " (" . __('meta') . ")";
            $message = sprintf(__('added_to_your_wallet'), $amount, __('meta'));
        }

        if ($is_meta !== null) {

            $query = SiteTransaction::query();
            $query->where(function ($query) use ($ip, $userId) {
                if ($ip)
                    $query->orWhere('ip', $ip);
                if ($userId)
                    $query->orWhere('owner_id', $userId);
            });

            //add unique viewers
            if (!$query->where('data_id', $data->id)->where('type', 'view')->exists()) {
                $data->viewer++;
                $storeData->viewer++;

            }

            $transaction = SiteTransaction::create([
                'ip' => $ip,
                'title' => $title,
                'amount' => $amount,
                'is_meta' => $is_meta,
                'owner_id' => $user->id,
                'data_id' => $siteId,

            ]);

            $data->view++;
            $storeData->view++;
            $storeUser->view++;

            $data->save();
            $storeData->save();
            $storeUser->save();
            return response()->json(['message' => $message, 'next' => $next,], $successStatus);
        }
        return response()->json(['message' => __('response_error'), 'next' => $next,], $errorStatus);


    }

    public function storeItem(Request $request)
    {
        $user = auth()->user();
        $userId = optional($user)->id;
        $autoView = $request->auto_view;
        $id = $request->id;
        $type = $request->type;
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;
        $meta_view_fee = Variable::SITE_VIEW_META_FEE();
        $meta_view_reward = Variable::SITE_VIEW_META_REWARD();
        $ip = $request->ip();
        session()->put('auto_view', $autoView);
        $data = null;
        if ($type && $id)
            $data = array_flip(Variable::DATA_TYPES)[$type]::where('id', $id)->with('owner:id,fullname,phone')->first();


        $next = ItemController::getNowOwnedNotViewed('first', $type && $id ? ['type' => $type, 'id' => $id] : null);
        if ($next)
            $next = ['id' => optional($next)->id ?? 0, 'type' => optional($next)->type ?? 0];

        if (!$data || $data->status != 'active') {
            return response()->json(['message' => __('item_is_inactive'), 'next' => $next,], $errorStatus);
        }


        $date = Carbon::now(/*'Asia/Tehran'*/)->setTime(0, 0);
        $storeData = DataTransaction::firstOrCreate([
            'data_type' => 'site',
            'data_id' => $data->id,
            'date' => $date,
        ]);
        if (!$storeData->owner_id && $data->owner_id)
            $storeData->owner_id = $data->owner_id;
        $storeUser = UserTransaction::firstOrCreate($ip, $userId);


        if (!$user) {

            return response()->json(['message' => __('login_or_register_for_get_reward'), 'next' => $next,], $errorStatus);
        }
        if ($user->is_block || !$user->is_active) {
            return response()->json(['message' => __('your_account_inactive_or_blocked'),], $errorStatus);
        }
        if (!$user->wallet_active) {
            return response()->json(['message' => __('activate_your_wallet_from_panel'),], $errorStatus);
        }
        if ($user->id == $data->owner_id) {
            return response()->json(['message' => __('item_is_yours'), 'next' => $next,], $errorStatus);
        }
//        if (SiteTransaction::where('owner_id', $user->id)->where('data_id', $data->id)->first()) {
//            return response()->json(['message' => __('you_viewed_this_site_before'), 'next' => $next,], $errorStatus);
//        }
        if ($data->charge < $data->view_fee) {
            if ($data->status == 'active') {
                $data->status = 'need_charge';
                $data->save();
            }
            return response()->json(['message' => __('item_view_time_ended'), 'next' => $next,], $errorStatus);
        }

        $is_meta = null;


        if ($data->charge >= $data->view_fee) {

            $commissionPercent = Setting::getValue('site_view_cp') ?? 0;
            $commission = intVal($data->view_fee * $commissionPercent / 100);
            $amount = $data->view_fee - $commission;
            Setting::setWallet($commission);

            $data->charge -= $data->view_fee;
            $user->wallet += $amount;
            if ($data->charge < $data->view_fee)
                $data->status = 'need_charge';
            $storeData->sum += $amount;
            $storeUser->sum += $amount;

            $is_meta = false;
            $title = __("view_{$type}") . " (" . __('currency') . ")";
            $message = sprintf(__('added_to_your_wallet'), $amount, __('currency'));
            $user->save();
        }

        if ($is_meta !== null) {

            $query = array_flip(Variable::TRANSACTION_TYPES)[$type]::query();

            $query->where(function ($query) use ($ip, $userId) {
                if ($ip)
                    $query->orWhere('ip', $ip);
                if ($userId)
                    $query->orWhere('owner_id', $userId);
            });


            //add unique viewers
            if (!$query->where('data_id', $data->id)->where('type', 'view')->exists()) {
                $data->viewer++;
                $storeData->viewer++;

            }

            $transaction = array_flip(Variable::TRANSACTION_TYPES)[$type]::create([
                'ip' => $ip,
                'title' => $title,
                'amount' => $amount,
                'is_meta' => $is_meta,
                'owner_id' => $user->id,
                'data_id' => $id,

            ]);

            $data->view++;
            $storeData->view++;
            $storeUser->view++;

            $data->save();
            $storeData->save();
            $storeUser->save();
            return response()->json(['message' => $message, 'next' => $next,], $successStatus);
        }
        return response()->json(['message' => __('response_error'), 'next' => $next,], $errorStatus);


    }
}

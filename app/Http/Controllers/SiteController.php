<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SMSHelper;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\SiteRequest;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Notification;
use App\Models\Podcast;
use App\Models\Setting;
use App\Models\Site;
use App\Models\SiteTransaction;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use Spatie\Browsershot\Browsershot;
use Termwind\Components\Dd;

class SiteController extends Controller
{
    public function new()
    {
        return Inertia::render('Site/Create', [
            'heroText' => __('hero_sites_page'),
            'site_view_meta_reward' => Variable::SITE_VIEW_META_REWARD(),
            'categories' => Site::categories('parents'),
        ]);
    }

    public function index(Request $request)
    {
        $type = $request->type;

        $message = null;
        $link = null;
        $auto_view = session()->get('auto_view', true);
        $meta_view_fee = Variable::SITE_VIEW_META_FEE();
        $user = auth()->user();


        $data = $user ? Site::whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', Site::where('owner_id', $user->id)->pluck('id'))->whereIntegerNotInRaw('id', SiteTransaction::where('owner_id', $user->id)->pluck('data_id'))->where(function ($query) use ($user, $meta_view_fee) {
            if ($user->wallet_active)
                $query->whereColumn('charge', '>=', 'view_fee');
            else $query->where('meta', '>=', $meta_view_fee);
        })->first()
            : Site::whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', SiteTransaction::where('ip', $request->ip())->pluck('data_id'))->where(function ($query) use ($user, $meta_view_fee) {
                $query->where('meta', '>=', $meta_view_fee);
            })->first();
        if ($data)
            return redirect()->route('site', ['site' => optional($data)->id]);
//        if ($data) {
//            if (str_starts_with($data->link, 'http:'))
//                $data->link = str_replace('http://', 'https://', $data->link);
//            $data->name = __('site') . ' ' . $data->name;
//        }
//
//        return Inertia::render('Site/View', [
//            'auto_view' => $auto_view,
//            'available_sites' => $user ? Site::whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', Site::where('owner_id', $user->id)->pluck('id'))->whereIntegerNotInRaw('id', SiteTransaction::where('owner_id', $user->id)->pluck('data_id'))->where(function ($query) use ($user, $meta_view_fee) {
//                if ($user->wallet_active)
//                    $query->whereColumn('charge', '>=', 'view_fee');
//                else $query->where('meta', '>=', $meta_view_fee);
//            })->count()
//                : Site::whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', SiteTransaction::where('ip', $request->ip())->pluck('data_id'))->where(function ($query) use ($user, $meta_view_fee) {
//                    $query->where('meta', '>=', $meta_view_fee);
//                })->count(),
//            'error_message' => $message,
//            'error_link' => $link,
//            'data' => $data,
//            'site_view_meta_reward' => Variable::SITE_VIEW_META_REWARD(),
//            'reward_second' => Variable::SITE_VIEW_REWARD_SECOND(),
//        ]);


        return Inertia::render('Site/Index', [
            'heroText' => __('hero_sites_page'),
            'site_view_meta_reward' => Variable::SITE_VIEW_META_REWARD(),
            'categories' => Site::categories('parents'),
        ]);

    }

    public function view(Request $request, $site)
    {


        $message = null;
        $link = null;
        $user = auth()->user();
        $data = Site::where('id', $site)->with('owner:id,fullname,phone')->first();
        $auto_view = session()->get('auto_view', true);
        $meta_view_fee = Variable::SITE_VIEW_META_FEE();
//        $seen = session()->forget('site_views');
        $seen = session()->get('site_views', []);
//        if (!$user) {
//            $data = ['name' => __('first_login_or_register'),];
////            $message = __('first_login_or_register');
//            $link = route('login');
//        } else
        if (!$data || $data->status == 'inactive' || $data->status == 'block') {
//            $message = __('no_results');
            $link = route('site.index');
            $data = ['name' => __('no_results'),];
        } elseif ($user && ($data->status != 'view' || ($user->wallet_active && $data->charge < $data->view_fee) || (!$user->wallet_active && $data->meta < $meta_view_fee))) {
//            $message = __('item_view_time_ended');
            $link = route('site.index');
            $data = ['name' => __('item_view_time_ended'),];
        } elseif (isset($data) && isset($data->link)) {
            if (str_starts_with($data->link, 'http:'))
                $data->link = str_replace('http://', 'https://', $data->link);
            $data->name = __('site') . ' ' . $data->name;
        }
        $commissionPercent = Setting::getValue('site_view_cp') ?? 0;
        $commission = intVal($data->view_fee * $commissionPercent / 100);
        $data->view_reward = $data->view_fee - $commission;

        return Inertia::render('Site/View', [
            'auto_view' => $auto_view,
            'available_sites' => $user ? Site::whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', Site::where('owner_id', $user->id)->pluck('id'))->whereIntegerNotInRaw('id', $seen/*SiteTransaction::where('owner_id', $user->id)->pluck('data_id')*/)->where(function ($query) use ($user, $meta_view_fee) {
                if ($user->wallet_active)
                    $query->whereColumn('charge', '>=', 'view_fee');
                else $query->where('meta', '>=', $meta_view_fee);
            })->count()
                : Site::whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', $seen /*SiteTransaction::where('ip', $request->ip())->pluck('data_id')*/)->where('meta', '>=', $meta_view_fee)->count(),
            'error_message' => $message,
            'error_link' => $link,
            'data' => $data,
            'site_view_meta_reward' => Variable::SITE_VIEW_META_REWARD(),
            'reward_second' => Variable::SITE_VIEW_REWARD_SECOND(),
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

        $query = Site::query();

        if ($user->role == 'us')
            $query = $query->where('owner_id', $user->id);

        if ($search)
            $query = $query->where('name', 'like', "%$search%")->orWhere('link', 'like', "%$search%");


        return $query->orderBy($orderBy, $dir)->paginate($paginate, ['*'], 'page', $page);
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = 'view_fee';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;
        $meta_view_fee = Variable::SITE_VIEW_META_FEE();
        $query = Site::query();
//        $seen = session()->get('site_views', []);
        $query = $query->select('id', 'name', 'status', 'category_id', 'created_at', 'view_fee', 'view', 'viewer');
        $query = $query->whereStatus('view')->whereLang(app()->getLocale());
        if ($search)
            $query = $query->where('name', 'like', "%$search%")->orWhere('link', 'like', "%$search%");

        if ($user)
            $query = $query->whereIntegerNotInRaw('id', SiteTransaction::where('owner_id', $user->id)->pluck('data_id'))->where(function ($query) use ($user, $meta_view_fee) {
                if ($user->wallet_active)
                    $query->whereColumn('charge', '>=', 'view_fee');
                else $query->where('meta', '>=', $meta_view_fee);
            });
        else
            $query = $query->whereIntegerNotInRaw('id', SiteTransaction::where('ip', $request->ip())->pluck('data_id'))->where('meta', '>=', $meta_view_fee);
        return $query->orderBy($orderBy, $dir)->paginate($paginate, ['*'], 'page', $page);
    }

    public function create(SiteRequest $request)
    {

        $user = auth()->user()/* ?? auth('api')->user()*/
        ;
        $phone = $request->phone;
        $fullname = $request->fullname;
        if (!$user) {
            //find user or create new user
            $user = User::where('phone', $phone)->first();
            if (!$user)
                $user = User::create(['fullname' => $fullname, 'phone' => $phone, 'password' => Hash::make($request->password), 'ref_id' => User::makeRefCode()]);

        }
        if (!$user) {
            $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
            return back()->with($res);
        }
        if ($user->is_block) {
            $res = ['flash_status' => 'danger', 'flash_message' => __('user_is_blocked')];
            return back()->with($res);
        }
        if (!auth()->user())
            auth()->login($user);
        $request->merge([
            'owner_id' => $user->id,
            'slug' => str_slug($request->name),
            'status' => 'review',
        ]);
        $ip = $request->ip();
        if ($ip && $user)
            Transaction::fillAllOwnerIds($ip, $user->id);
        $site = Site::create($request->all());
        if ($site) {
            $res = ['flash_status' => 'success', 'flash_message' => __('created_successfully_and_activete_after_review')];
            Util::createImage($request->img, Variable::IMAGE_FOLDERS[Site::class], $site->id);
            SMSHelper::deleteCode($phone);
            Telegram::log(null, 'site_created', $site);
        } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
        return to_route('panel.site.index')->with($res);
    }

    public function edit(Request $request, $site)
    {

        $data = Site::with('category')->find($site);
        $this->authorize('edit', [User::class, $data]);
        $data->message = optional(Notification::firstWhere([
                'data_id' => $data->id, 'type' => 'site_reject',]
        ))->description;
        if ($data->message)
            $data->message = json_decode($data->message);
        return Inertia::render('Panel/Site/Edit', [
            'categories' => Site::categories('parents'),
            'statuses' => Variable::SITE_STATUSES,
            'data' => $data,
        ]);
    }

    public function update(SiteRequest $request)
    {
        $user = auth()->user();
//        $response = ['message' => __('done_successfully')];
        $response = ['message' => __('response_error')];
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;

        $id = $request->id;
        $cmnd = $request->cmnd;
        $charge = $request->charge;
        $meta = $request->meta;
        $data = Site::find($id);
        if (!starts_with($cmnd, 'bulk'))
            $this->authorize('update', [User::class, $data]);

        if ($cmnd) {

            switch ($cmnd) {
                case 'meta':
                    if ($user->meta_wallet + $data->meta < $meta)
                        return response()->json(['message' => __('low_meta'), 'charge' => $data->charge], $errorStatus);
                    else {
                        $user->meta_wallet -= ($meta - $data->meta);
                        $data->meta = $meta;
                        $data->status = $data->status == "need_charge" ? "ready" : $data->status;
                        $data->save();
                        $user->save();
                        return response()->json(['message' => __('charged_successfully'), 'meta' => $data->meta, 'status' => $data->status, 'meta_wallet' => $user->meta_wallet,], $successStatus);
                    }
                case 'charge':

                    if (!$user->wallet_active)
                        return response()->json(['message' => __('wallet_is_inactive_use_meta'), 'charge' => $data->charge], $errorStatus);

                    if ($user->wallet + $data->charge < $charge)
                        return response()->json(['message' => __('low_wallet'), 'charge' => $data->charge], $errorStatus);
                    else {
                        $user->wallet -= ($charge - $data->charge);
                        $data->charge = $charge;
                        $data->status = $data->status == "need_charge" ? "ready" : $data->status;
                        $data->save();
                        $user->save();
                        return response()->json(['message' => __('charged_successfully'), 'charge' => $data->charge, 'status' => $data->status, 'wallet' => $user->wallet], $successStatus);

                    }
                case 'stop-view':
                    if ($data->status == 'view') {
                        $data->status = 'ready';
                        $data->save();
                        return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);
                    }
                case 'start-view':
                    $meta_view_fee = Variable::SITE_VIEW_META_FEE();

                    if (in_array($data->status, ['need_charge', 'ready']) && $data->meta < $meta_view_fee)
                        return response()->json(['message' => __('low_meta_charge'),], $errorStatus);
                    if (in_array($data->status, ['need_charge', 'ready']) && ($data->charge <= 0 || $data->charge < $data->view_fee))
                        return response()->json(['message' => __('low_wallet'),], $errorStatus);
                    if ($data->status != 'ready')
                        return response()->json(['message' => __('site_must_be_ready'),], $errorStatus);
                    $data->status = 'view';
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);

                case 'activate':
                    if ($data->status == 'review')
                        return response()->json(['message' => __('active_after_review'),], $errorStatus);

                    if ($data->status != 'inactive') break;
                    if ($data->charge <= $data->view_fee)
                        $data->status = 'need_charge';
                    else
                        $data->status = 'ready';

//                    $data->is_active = true;
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);
                    break;

                case 'view-fee':
                    $fee = $request->view_fee;
                    $min = Variable::MIN_VIEW_FEE('site');
                    if (!is_int($fee) || $fee < $min)
                        return response()->json(['message' => sprintf(__('validator.min'), __('view_fee'), $min), 'view_fee' => $data->view_fee,], $errorStatus);
                    if ($fee % 50 != 0)
                        return response()->json(['message' => sprintf(__('validator.dividable'), 50), 'view_fee' => $data->view_fee,], $errorStatus);
                    if ($data->charge < $fee)
                        $data->status = 'need_charge';
                    elseif ($data->status == 'need_charge')
                        $data->status = 'ready';
                    $data->view_fee = $fee;

                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status, 'view_fee' => $data->view_fee,], $successStatus);
                    break;

                case 'bulk.start-view':
                    $min = Variable::SITE_MIN_VIEW_FEE();
                    $res = [];
                    foreach (Site::whereIntegerInRaw('id', ($request->data ?: []))->get() as $data) {
                        if (
                            $data->view_fee >= $min
                            && $data->charge >= $data->view_fee
                            && in_array($data->status, ['need_charge', 'ready'])) {

                            $data->status = 'view';
                            $res[] = ['id' => $data->id, 'status' => $data->status];
                            $data->save();
                        }
                    }
                    return response()->json(['message' => count($res) . ' ' . __('item') . ' ' . __('updated_successfully'), 'results' => $res,], $successStatus);

                case 'bulk.stop-view':
                    $min = Variable::SITE_MIN_VIEW_FEE();
                    $res = [];
                    foreach (Site::whereIntegerInRaw('id', ($request->data ?: []))->get() as $data) {
                        if ($data->status == 'view') {
                            if ($data->charge < $data->view_fee)
                                $data->status = 'need_charge';
                            else $data->status = 'ready';
                            $res[] = ['id' => $data->id, 'status' => $data->status];
                            $data->save();
                        }
                    }
                    return response()->json(['message' => count($res) . ' ' . __('item') . ' ' . __('updated_successfully'), 'results' => $res,], $successStatus);

            }
        } elseif ($data) {
            $request->merge([
                'status' => $user->isAdmin() ? $request->status : 'review',
//                'is_active' => false,
                'slug' => str_slug($request->name),
            ]);

            if ($user->isAdmin()) {
                $newStatus = $request->status;
                $oldStatus = $data->status;
                switch ($newStatus) {
                    case 'reject':
                        Notification::updateOrCreate([
                            'data_id' => $data->id,],
                            ['type' => 'site_reject', 'subject' => __('site_need_change'), 'description' => json_encode($request->message), 'owner_id' => $data->owner_id]
                        );
                        break;
                    case 'active':
                        Notification::updateOrCreate([
                            'data_id' => $data->id,],
                            ['type' => 'site_approve', 'subject' => __('site_approved'), 'description' => null, 'owner_id' => $data->owner_id]
                        );
                        if ($data->view_fee > $data->charge) {
                            $request->status = 'need_charge';
                            $request->merge([
                                'status' => 'need_charge',
                            ]);
                        }

                        break;
                    case 'review':
                        Notification::where('data_id', $data->id)->delete();
                        break;
                }
                if ($oldStatus != $newStatus && in_array($newStatus, ['active', 'reject'])) {
                    $owner = User::find($data->owner_id);
                    if ($owner) {
                        $owner->notifications++;
                        $owner->save();
                    }
                }
            }


            if ($data->update($request->all())) {
                $res = ['flash_status' => 'success', 'flash_message' => __($user->isAdmin() ? 'updated_successfully' : 'updated_successfully_and_active_after_review')];
                Util::createImage($request->img, Variable::IMAGE_FOLDERS[Site::class], $id);
                Telegram::log(null, 'site_edited', $data);
            } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
            return back()->with($res);
        }

        return response()->json($response, $errorStatus);
    }


}

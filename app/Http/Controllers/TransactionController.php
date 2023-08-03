<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Variable;
use App\Models\Site;
use App\Models\SiteTransaction;
use App\Models\SiteView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function storeSite(Request $request)
    {
        $user = auth()->user();
        $autoView = $request->auto_view;
        $siteId = $request->id;
        $data = Site::find($siteId);
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;
        $meta_view_fee = Variable::SITE_VIEW_META_FEE();
        $meta_view_reward = Variable::SITE_VIEW_META_REWARD();
        $ip = $request->ip();
        session()->put('auto_view', $autoView);
        $next = $user ? Site::where('id', '!=', $siteId)->whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', Site::where('owner_id', $user->id)->pluck('id'))->whereIntegerNotInRaw('id', SiteTransaction::where('owner_id', $user->id)->pluck('site_id'))->orderBy('view_fee', 'DESC')->where(function ($query) use ($user, $meta_view_fee) {
            if ($user->wallet_active)
                $query->whereColumn('charge', '>=', 'view_fee');
            else $query->where('meta', '>=', $meta_view_fee);
        })->firstOrNew()->id
            : Site::where('id', '!=', $siteId)->whereStatus('view')->whereLang(app()->getLocale())->whereIntegerNotInRaw('id', SiteView::where('ip', $ip)->pluck('site_id'))->where(function ($query) use ($user, $meta_view_fee) {
                $query->where('meta', '>=', $meta_view_fee);
            })->firstOrNew()->id;
        if (!$data || $data->status == 'inactive' || $data->status == 'block') {
            return response()->json(['message' => "$siteId" . __('item_is_inactive'), 'next' => $next,], $errorStatus);
        }
        if (!$user) {
            if ($ip && !SiteView::where('ip', $ip)->where('site_id', $data->id)->exists()) {
                SiteView::create(['ip' => $ip, 'site_id' => $data->id]);
                if ($data->meta >= $meta_view_fee)
                    $data->meta -= $meta_view_fee;
                else
                    $data->status = 'need_charge';
                $data->views++;
                $data->save();
            }
            return response()->json(['message' => __('login_or_register_for_get_reward'), 'next' => $next,], $errorStatus);
        }
        if ($user->is_blocked || !$user->is_active) {
            return response()->json(['message' => __('user_is_inactive'),], $errorStatus);
        }
        if ($user->id == $data->owner_id) {
            return response()->json(['message' => __('item_is_yours'), 'next' => $next,], $errorStatus);
        }
        if (SiteTransaction::where('owner_id', $user->id)->where('site_id', $data->id)->first()) {
            return response()->json(['message' => __('you_viewed_this_site_before'), 'next' => $next,], $errorStatus);
        }
        if ($data->status != 'view' || ($user->wallet_active && $data->charge < $data->view_fee) || (!$user->wallet_active && $data->meta < $meta_view_fee)) {
            if ($data->status == 'view') {
                $data->status = 'need_charge';
                $data->save();
            }
            return response()->json(['message' => __('item_view_time_ended'), 'next' => $next,], $errorStatus);
        }

        $is_meta = null;

        if ($user->wallet_active && $data->charge >= $data->view_fee) {
            $data->charge -= $data->view_fee;
            $user->wallet += $data->view_fee;
            if ($data->charge < $data->view_fee)
                $data->status = 'need_charge';
            $amount = $data->view_fee;
            $is_meta = false;
            $title = 'کارمزد بازدید سایت (تومان)';
            $message = sprintf(__('added_to_your_wallet'), $amount, __('currency'));
            $user->save();
        } elseif (!$user->wallet_active && $data->meta >= $meta_view_fee) {
            $data->meta -= $meta_view_fee;

            if ($data->meta < $meta_view_fee)
                $data->status = 'need_charge';

            //check if user have site for view? add wallet meta to that
            $userSite = Site::where('owner_id', $user->id)->where('status', 'need_charge')->orWhere('status', 'view')->first();
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
            $title = 'کارمزد بازدید سایت (متا)';
            $message = sprintf(__('added_to_your_wallet'), $amount, __('meta'));
        }

        if ($is_meta !== null) {
            $transaction = SiteTransaction::create([
                'title' => $title,
                'amount' => $amount,
                'is_meta' => $is_meta,
                'owner_id' => $user->id,
                'site_id' => $siteId,

            ]);
            $data->views++;
            $data->save();
            return response()->json(['message' => $message, 'next' => $next,], $successStatus);
        }
        return response()->json(['message' => __('response_error'), 'next' => $next,], $errorStatus);


    }
}

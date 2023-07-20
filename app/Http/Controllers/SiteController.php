<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\SiteRequest;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Termwind\Components\Dd;

class SiteController extends Controller
{
    public function index()
    {
        return Inertia::render('Site/Index', [
        ]);

    }

    public function search(Request $request)
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

    public function create(SiteRequest $request)
    {

        $request->merge([
            'owner_id' => $request->user()->id,
            'slug' => str_slug($request->name),
        ]);

        $site = Site::create($request->all());
        if ($site) {
            $res = ['flash_status' => 'success', 'flash_message' => __('created_successfully')];
            Util::createImage($request->img, Variable::IMAGE_FOLDERS[Site::class], $site->id);
            Telegram::log(null, 'site_created', $site);
        } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
        return to_route('panel.site.index')->with($res);
    }

    public function edit(Request $request, $site)
    {

        $tmp = Site::with('category')->find($site);
        $this->authorize('edit', [User::class, $tmp]);
        return Inertia::render('Panel/Site/Edit', [
            'categories' => Site::categories('parents'),
            'site_statuses' => Variable::SITE_STATUSES,
            'site' => $tmp,
        ]);
    }

    public function update(SiteRequest $request)
    {
        $user = auth()->user();
//        $response = ['message' => __('done_successfully')];
        $response = ['message' => __('response_error')];
        $successStatus = 200;
        $errorStatus = 422;

        $id = $request->id;
        $cmnd = $request->cmnd;
        $charge = $request->charge;
        $data = Site::find($id);
        if ($id && $data)
            $this->authorize('edit', [User::class, $data]);

        if ($cmnd) {

            switch ($cmnd) {
                case 'charge':

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
                    if ($data->status == 'viewing') {
                        $data->status = 'ready';
                        $data->save();
                        return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);
                    }
                case 'start-view':

                    if (in_array($data->status, ['need_charge', 'ready']) && $data->charge < $data->view_fee)
                        return response()->json(['message' => __('low_wallet'),], $errorStatus);
                    if ($data->status != 'ready')
                        return response()->json(['message' => __('site_must_be_ready'),], $errorStatus);
                    $data->status = 'viewing';
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);

                case 'activate':
                    if ($data->status != 'inactive') break;
                    if ($data->charge <= $data->view_fee)
                        $data->status = 'need_charge';
                    else
                        $data->status = 'ready';

                    $data->is_active = true;
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);
                    break;

                case 'view-fee':
                    $fee = $request->view_fee;
                    $min = Variable::SITE_MIN_VIEW_FEE();
                    if (!is_int($fee) || $fee < $min)
                        return response()->json(['message' => sprintf(__('validator.min'), $min), 'view_fee' => $data->view_fee,], $errorStatus);
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
                        if ($data->is_active
                            && !$data->is_blocked
                            && $data->view_fee >= $min
                            && $data->charge >= $data->view_fee
                            && in_array($data->status, ['need_charge', 'ready'])) {

                            $data->status = 'viewing';
                            $res[] = ['id' => $data->id, 'status' => $data->status];
                            $data->save();
                        }
                    }
                    return response()->json(['message' => count($res) . ' ' . __('item') . ' ' . __('updated_successfully'), 'results' => $res,], $successStatus);

                case 'bulk.stop-view':
                    $min = Variable::SITE_MIN_VIEW_FEE();
                    $res = [];
                    foreach (Site::whereIntegerInRaw('id', ($request->data ?: []))->get() as $data) {
                        if ($data->status == 'viewing') {
                            if ($data->charge < $data->view_fee)
                                $data->status = 'need_charge';
                            else $data->status = 'ready';
                            $res[] = ['id' => $data->id, 'status' => $data->status];
                            $data->save();
                        }
                    }
                    return response()->json(['message' => count($res) . ' ' . __('item') . ' ' . __('updated_successfully'), 'results' => $res,], $successStatus);

            }
        }

        return response()->json($response, $errorStatus);
    }
}

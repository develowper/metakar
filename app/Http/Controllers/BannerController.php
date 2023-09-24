<?php

namespace App\Http\Controllers;

use App\Events\Viewed;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\BannerRequest;
use App\Models\ArticleTransaction;
use App\Models\BannerTransaction;
use App\Models\County;
use App\Models\Banner;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BannerController extends Controller
{
    public function edit(Request $request, $site)
    {

        $data = Banner::with('category')->find($site);

        $this->authorize('edit', [User::class, $data]);
        $data->file_link = Banner:: getFileLink($data->id);
        return Inertia::render('Panel/Banner/Edit', [
            'categories' => Banner::categories(),
            'statuses' => Variable::STATUSES,
            'data' => $data,
            'max_images_limit' => 1,
        ]);
    }

    public function update(BannerRequest $request)
    {
        $user = auth()->user();
//        $response = ['message' => __('done_successfully')];
        $response = ['message' => __('response_error')];
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;
        $charge = $request->charge;
        $id = $request->id;
        $cmnd = $request->cmnd;
        $data = Banner::find($id);
        if (!starts_with($cmnd, 'bulk'))
            $this->authorize('update', [User::class, $data]);

        if ($cmnd) {
            switch ($cmnd) {
                case 'inactive':
                    $data->status = 'inactive';
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);

                case 'activate':
                    if ($data->status == 'review')
                        return response()->json(['message' => __('active_after_review'),], $errorStatus);
                    $data->status = 'active';
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);

                case 'view-fee':
                    $fee = $request->view_fee;
                    $min = Variable::MIN_VIEW_FEE('banner');
                    if (!is_int($fee) || $fee < $min)
                        return response()->json(['message' => sprintf(__('validator.min'), __('view_fee'), $min), 'view_fee' => $data->view_fee,], $errorStatus);
                    if ($fee % 50 != 0)
                        return response()->json(['message' => sprintf(__('validator.dividable'), 50), 'view_fee' => $data->view_fee,], $errorStatus);
                    if ($data->charge < $fee)
                        $data->status = 'need_charge';
                    elseif ($data->status == 'need_charge')
                        $data->status = 'active';
                    $data->view_fee = $fee;

                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status, 'view_fee' => $data->view_fee,], $successStatus);
                    break;
                case 'charge':

                    if (!$user->wallet_active)
                        return response()->json(['message' => __('help_activate_wallet'), 'charge' => $data->charge], $errorStatus);

                    if ($user->wallet + $data->charge < $charge)
                        return response()->json(['message' => __('low_wallet'), 'charge' => $data->charge], $errorStatus);
                    else {
                        $user->wallet -= ($charge - $data->charge);
                        $data->charge = $charge;
                        $data->status = $data->status == "need_charge" ? "active" : $data->status;
                        $data->save();
                        $user->save();
                        return response()->json(['message' => __('charged_successfully'), 'charge' => $data->charge, 'status' => $data->status, 'wallet' => $user->wallet], $successStatus);

                    }
                case  'upload-img' :

                    if (!$request->img) //  add extra image
                        return response()->json(['errors' => [__('file_not_exists')],], $errorStatus);

                    Util::createImage($request->img, Variable::IMAGE_FOLDERS[Banner::class], "$id");
                    if ($data) {
                        $data->status = 'review';
                        $data->save();
                    }
                    return response()->json(['message' => __('updated_successfully_and_active_after_review')], $successStatus);

                case  'upload-banner' :
                    if (!$request->file('banner')) //  add extra image
                        return response()->json(['errors' => [__('file_not_exists')],], $errorStatus);

                    Util::createFile($request->file('banner'), Variable::IMAGE_FOLDERS[Banner::class], "$id-file");
                    if ($data) {
                        $data->status = 'review';
                        $data->save();
                    }
                    return response()->json(['message' => __('updated_successfully_and_active_after_review')], $successStatus);

            }
        } elseif ($data) {


            $request->merge([
                'status' => 'review',
//                'is_active' => false,
                'slug' => str_slug($request->name),
            ]);
//            $data->name = $request->tags;
//            $data->tags = $request->tags;
//            dd($request->tags);
            if ($data->update($request->all())) {

                $res = ['flash_status' => 'success', 'flash_message' => __('updated_successfully_and_active_after_review')];
//                dd($request->all());
                Telegram::log(null, 'banner_edited', $data);
            } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
            return back()->with($res);
        }

        return response()->json($response, $errorStatus);
    }

    public function index()
    {
        return Inertia::render('Banner/Index', [
            'categories' => Banner::categories(),
        ]);

    }

    public function create(BannerRequest $request)
    {


        $user = auth()->user()/* ?? auth('api')->user()*/
        ;

//        $phone = $request->phone;
//        $fullname = $request->fullname;
//        if (!$user) {
//            //find user or create new user
//            $user = User::where('phone', $phone)->first();
//            if (!$user)
//                $user = User::create(['fullname' => $fullname, 'phone' => $phone, 'password' => Hash::make($request->password), 'ref_id' => User::makeRefCode()]);
//
//        }
        if (!$user) {
            $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
            return back()->with($res);
        }
        if ($user->is_block) {
            $res = ['flash_status' => 'danger', 'flash_message' => __('user_is_blocked')];
            return back()->with($res);
        }
        if (!$request->uploading) { //send again for uploading images

            return back()->with(['resume' => true]);
        }

        if (!auth()->user())
            auth()->login($user);
        $request->merge([
            'owner_id' => $user->id,
            'slug' => str_slug($request->name),
            'status' => 'review',
        ]);

        $banner = Banner::create($request->all());

        if ($banner) {
            $res = ['flash_status' => 'success', 'flash_message' => __('created_successfully_and_activete_after_review')];

            Util::createImage($request->img, Variable::IMAGE_FOLDERS[Banner::class], "$banner->id");
            Util::createFile($request->file('banner'), Variable::IMAGE_FOLDERS[Banner::class], "$banner->id-file");

//            SMSHelper::deleteCode($phone);
            Telegram::log(null, 'banner_created', $banner);
        } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
        return to_route('panel.banner.index')->with($res);
    }

    public function searchPanel(Request $request)
    {
        $user = $request->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = $request->order_by ?: 'id';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;

        $query = Banner::query();
        $query = $query->select('id', 'name', 'designer', 'view_fee', 'meta', 'status', 'view', 'category_id');

        if ($user->role == 'us')
            $query = $query->where('owner_id', $user->id);

        if ($search)
            $query = $query->where('name', 'like', "%$search%");

        return $query->orderBy($orderBy, $dir)->paginate($paginate, ['*'], 'page', $page);
    }

    public function search(Request $request)
    {
//        $user = auth()->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = 'created_at';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;
        $query = Banner::query();
//        $seen = session()->get('site_views', []);
        $query = $query->select('id', 'name', 'designer', 'view', 'view_fee', 'status', 'category_id', 'created_at',);
        //        $query = $query->select('charge', 'status', 'view_fee');
        $query = $query
            ->whereIn('status', ['active', 'need_charge'])
            ->whereLang(app()->getLocale());

        if ($search)
            $query = $query->where('name', 'like', "%$search%");

        $query = $query
            ->orderBy('status', 'ASC')
            ->orderByRaw("IF(charge >= view_fee, view_fee, id) DESC");
        return $query->paginate($paginate, ['*'], 'page', $page);
    }

    public function view(Request $request, $banner)
    {
        $message = null;
        $link = null;

        $data = Banner::where('id', $banner)->with('owner:id,fullname,phone')->first();

        if (!$data || !in_array($data->status, ['active', 'need_charge'])) {
            $message = __('no_results');
            $link = route('banner.index');
            $data = ['name' => __('no_results'),];
        } else {
            event(new Viewed($data, BannerTransaction::class, __('view_banner')));
        }

        return Inertia::render('Banner/View', [
            'error_message' => $message,
            'error_link' => $link,
            'data' => $data,
            'categories' => Banner::categories(),
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SMSHelper;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\BusinessRequest;
use App\Http\Requests\SiteRequest;
use App\Models\Business;
use App\Models\Category;
use App\Models\County;
use App\Models\Province;
use App\Models\Site;
use App\Models\SiteTransaction;
use App\Models\SiteView;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BusinessController extends Controller
{
    public function edit(Request $request, $business)
    {

        $data = Business::with('category')->find($business);
        if ($data)
            $data->images = Business::getImages($data->id);
        $this->authorize('edit', [User::class, $data]);
        return Inertia::render('Panel/Business/Edit', [
            'provinces' => Province::all(),
            'counties' => County::all(),
            'categories' => Business::categories(),
            'statuses' => Variable::STATUSES,
            'data' => $data,
            'max_images_limit' => Variable::BUSINESS_IMAGE_LIMIT,
        ]);
    }

    public function update(BusinessRequest $request)
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
        $data = Business::find($id);
        if (!starts_with($cmnd, 'bulk'))
            $this->authorize('update', [User::class, $data]);

        if ($cmnd) {
            switch ($cmnd) {
                case 'inactive':
                    $data->status = 'inactive';
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);
                case 'delete-img'   :
                    $type = Variable::IMAGE_FOLDERS[Business::class];
                    $path = Storage::path("public/$type/$id/" . basename($request->path));
                    $allFiles = Storage::allFiles("public/$type/$id");
                    if (count($allFiles) == 1)
                        return response()->json(['errors' => [sprintf(__('validator.min_images'), 1)]], 422);
                    if (!File::exists($path))
                        return response()->json(['errors' => [__('file_not_exists')], 422]);
                    File::delete($path);
                    return response()->json(['message' => __('updated_successfully')], $successStatus);

                case  'upload-img' :
                    $limit = Variable::BUSINESS_IMAGE_LIMIT;
                    $type = Variable::IMAGE_FOLDERS[Business::class];
                    $allFiles = Storage::allFiles("public/$type/$id");
                    if (!$request->path && count($allFiles) >= $limit) //  add extra image
                        return response()->json(['errors' => [sprintf(__('validator.max_images'), $limit)], 422]);
                    if (!$request->img) //  add extra image
                        return response()->json(['errors' => [__('file_not_exists')], 422]);

                    $path = Storage::path("public/$type/$id/" . basename($request->path));
                    if (File::exists($path)) File::delete($path);
                    Util::createImage($request->img, Variable::IMAGE_FOLDERS[Business::class], null, $id);
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
                Telegram::log(null, 'business_edited', $data);
            } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
            return back()->with($res);
        }

        return response()->json($response, $errorStatus);
    }

    public function index()
    {
        return Inertia::render('Business/Index', [
            'provinces' => Province::all(),
            'counties' => County::all(),
            'categories' => Business::categories(),
        ]);

    }

    public function create(BusinessRequest $request)
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
        if ($user->is_blocked) {
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

        $business = Business::create($request->all());

        if ($business) {
            $res = ['flash_status' => 'success', 'flash_message' => __('created_successfully_and_activete_after_review')];
            foreach ($request->images as $image) {
                Util::createImage($image, Variable::IMAGE_FOLDERS[Business::class], null, $business->id);
            }
//            SMSHelper::deleteCode($phone);
            Telegram::log(null, 'business_created', $business);
        } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
        return to_route('panel.business.index')->with($res);
    }

    public function searchPanel(Request $request)
    {
        $user = $request->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = $request->order_by ?: 'id';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;

        $query = Business::query();
        $query = $query->select('id', 'name', 'status', 'view', 'category_id');

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
        $query = Business::query();
//        $seen = session()->get('site_views', []);
        $query = $query->select('id', 'name', 'view', 'status', 'category_id', 'province_id', 'created_at',);
        $query = $query->whereStatus('active')->whereLang(app()->getLocale());
        if ($search)
            $query = $query->where('name', 'like', "%$search%");

        return $query->orderBy($orderBy, $dir)->paginate($paginate, ['*'], 'page', $page);
    }

    public function view(Request $request, $site)
    {


        $message = null;
        $link = null;
        $user = auth()->user();
        $data = Business::where('id', $site)->with('owner:id,fullname,phone')->first();
        if ($data)
            $data->images = array_filter(Business::getImages($data->id), fn($e) => $e != null);

        if (!$data || $data->status != 'active') {
            $message = __('no_results');
            $link = route('business.index');
            $data = ['name' => __('no_results'),];
        }
        return Inertia::render('Business/View', [
            'error_message' => $message,
            'error_link' => $link,
            'data' => $data,
            'provinces' => Province::all(),
            'counties' => County::all(),
            'categories' => Business::categories(),
        ]);

    }
}

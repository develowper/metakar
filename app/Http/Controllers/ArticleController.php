<?php

namespace App\Http\Controllers;

use App\Events\Viewed;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\ArticleRequest;
use App\Models\ArticleTransaction;
use App\Models\County;
use App\Models\Article;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Termwind\Components\Dd;

class ArticleController extends Controller
{
    public function edit(Request $request, $site)
    {

        $data = Article::with('category')->find($site);

        $this->authorize('edit', [User::class, $data]);
        return Inertia::render('Panel/Article/Edit', [
            'categories' => Article::categories(),
            'statuses' => Variable::STATUSES,
            'data' => $data,
            'max_images_limit' => 1,
        ]);
    }

    public function update(ArticleRequest $request)
    {
        $user = auth()->user();
//        $response = ['message' => __('done_successfully')];
        $response = ['message' => __('response_error')];
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;
        $charge = $request->charge;
        $id = $request->id;
        $cmnd = $request->cmnd;
        $data = Article::find($id);
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
                    $min = Variable::MIN_VIEW_FEE('article');
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
                        return response()->json(['errors' => [__('file_not_exists')], 422]);

                    Util::createImage($request->img, Variable::IMAGE_FOLDERS[Article::class], $id);
                    if ($data) {
                        $data->status = 'review';
                        $data->save();
                    }
                    return response()->json(['message' => __('updated_successfully_and_active_after_review')], $successStatus);

                case  'upload-article' :

                    if (!$request->article) //  add extra image
                        return response()->json(['errors' => [__('file_not_exists')], 422]);

                    Util::createFile($request->file('article'), Variable::IMAGE_FOLDERS[Article::class], $id);
                    if ($data) {
                        $data->status = 'review';
                        $data->duration = $request->duration ?? 0;
                        $data->save();
                    }
                    return response()->json(['message' => __('updated_successfully_and_active_after_review')], $successStatus);

            }
        } elseif ($data) {

            $content = $request->get('content') ?? [];
            $duration = 0;
            foreach ($content as $idx => $item) {
                $item = (object)$item;
                if ($item->type && $item->type != 'text') {
                    $tmp = DB::table("{$item->type}s")->find($item->id);
                    if ($tmp) {
                        $content[$idx]['value'] = $tmp->name;
                        $duration += $tmp->duration ?? 0;
                    } else
                        unset($content[$idx]);
                } elseif ($item->type == 'text') {
                    $duration += Util::estimateReadingTime($item->value);
                }
            }

            $content = count($content) == 0 ? null : json_encode($content);
            $request->merge([
                'status' => 'review',
//                'is_active' => false,
                'duration' => $duration,
                'content' => $content,
                'slug' => str_slug($request->title),
            ]);
//            $data->name = $request->tags;
//            $data->tags = $request->tags;
//            dd($request->tags);
            if ($data->update($request->all())) {

                $res = ['flash_status' => 'success', 'flash_message' => __('updated_successfully_and_active_after_review')];
//                dd($request->all());
                Telegram::log(null, 'article_edited', $data);
            } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
            return back()->with($res);
        }

        return response()->json($response, $errorStatus);
    }

    public function index()
    {
        return Inertia::render('Article/Index', [
            'categories' => Article::categories(),
        ]);

    }

    public function create(ArticleRequest $request)
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
        $content = $request->get('content') ?? [];
        $duration = 0;
        foreach ($content as $idx => $item) {
            $item = (object)$item;
            if ($item->type && $item->type != 'text') {
                $tmp = DB::table("{$item->type}s")->find($item->id);
                if ($tmp) {
                    $item->value = $tmp->name;
                    $duration += $tmp->duration ?? 0;
                } else
                    unset($content[$idx]);
            } elseif ($item->type == 'text') {
                $duration += Util::estimateReadingTime($item->value);
            }
        }
        $content = count($content) == 0 ? null : json_encode($content);

        $request->merge([
            'owner_id' => $user->id,
            'slug' => str_slug($request->title),
            'content' => $content,
            'duration' => $duration,
            'status' => 'review',
        ]);

        $article = Article::create($request->all());

        if ($article) {
            $res = ['flash_status' => 'success', 'flash_message' => __('created_successfully_and_activete_after_review')];

            Util::createImage($request->img, Variable::IMAGE_FOLDERS[Article::class], $article->id);

//            SMSHelper::deleteCode($phone);
            Telegram::log(null, 'article_created', $article);
        } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
        return to_route('panel.article.index')->with($res);
    }

    public function searchPanel(Request $request)
    {
        $user = $request->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = $request->order_by ?: 'id';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;

        $query = Article::query();
        $query = $query->select('id', 'title', 'charge', 'view_fee', 'author', 'status', 'view', 'category_id');
        if ($user->role == 'us')
            $query = $query->where('owner_id', $user->id);

        if ($search)
            $query = $query->where('title', 'like', "%$search%");

        return $query->orderBy($orderBy, $dir)->paginate($paginate, ['*'], 'page', $page);
    }

    public function search(Request $request)
    {
//        $user = auth()->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = 'id';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;
        $query = Article::query();
//        $seen = session()->get('site_views', []);
        $query = $query->select('id', 'title', 'duration', 'author', 'view', 'view_fee', 'status', 'category_id', 'created_at',);
//        $query = $query->select('charge', 'status', 'view_fee');
        $query = $query
            ->whereIn('status', ['active', 'need_charge'])
            ->whereLang(app()->getLocale());

        if ($search)
            $query = $query->where('title', 'like', "%$search%");

        $query = $query
            ->orderBy('status', 'ASC')
            ->orderByRaw("IF(charge >= view_fee, view_fee, id) DESC");
        return $query->paginate($paginate, ['*'], 'page', $page);
    }

    public function view(Request $request, $article)
    {
        $message = null;
        $link = null;

        $data = Article::where('id', $article)->with('owner:id,fullname,phone')->first();

        if (!$data || !in_array($data->status, ['active', 'need_charge'])) {
            $message = __('no_results');
            $link = route('article.index');
            $data = ['name' => __('no_results'),];
        } else {
            event(new Viewed($data, ArticleTransaction::class, __('view_article')));
        }

        return Inertia::render('Article/View', [
            'error_message' => $message,
            'error_link' => $link,
            'data' => $data,
            'categories' => Article::categories(),
        ]);

    }
}

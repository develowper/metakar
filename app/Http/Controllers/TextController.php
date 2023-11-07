<?php

namespace App\Http\Controllers;

use App\Events\Viewed;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\TextRequest;
use App\Models\Article;
use App\Models\ArticleTransaction;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Text;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TextController extends Controller
{
    public function edit(Request $request, $id)
    {

        $data = Text::with('category')->with('projectItem')->with('owner:id,fullname,phone')->find($id);
        if ($data && optional($data->projectItem)->operator_id)
            $data->projectItem->operator = User::select('id', 'fullname', 'phone')->find($data->projectItem->operator_id);

        $this->authorize('edit', [User::class, $data]);
        $data->message = optional(Notification::firstWhere([
                'data_id' => $data->id, 'type' => 'text_reject',]
        ))->description;
        if ($data->message)
            $data->message = json_decode($data->message);
        $data->content = $data->content ? json_decode($data->content) : null;
        return Inertia::render('Panel/Text/Edit', [
            'categories' => Text::categories(),
            'statuses' => Variable::STATUSES,
            'project_statuses' => Variable::PROJECT_STATUSES,
            'data' => $data,
        ]);
    }

    public function update(TextRequest $request)
    {
        $user = auth()->user();
        $isAdmin = $user->isAdmin();
//        $response = ['message' => __('done_successfully')];
        $response = ['message' => __('response_error')];
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;
        $charge = $request->charge;
        $id = $request->id;
        $cmnd = $request->cmnd;
        $data = Text::with('projectItem:id,item_id,item_type,project_id,status,operator_id')->find($id);
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
                    $min = Variable::MIN_VIEW_FEE('text');
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

                case 'operator-finish':
                    return Project::operatorFinish($data->projectItem);

                    return back()->with(['flash_status' => 'danger', 'flash_message' => __('response_error')]);


            }
        } elseif ($data) {

            $content = $request->get('content') ? json_encode($request->get('content')) : null;

            $request->merge([
                'status' => $user->isAdmin() ? $request->status : 'review',
//                'is_active' => false,
                'duration' => Util::estimateReadingTime($request->get('content')),
                'content' => $content,
                'slug' => str_slug($request->title),
            ]);

            if ($user->isAdmin()) {
                $data->owner_id = $request->owner_id;
                $newStatus = $request->status;
                $oldStatus = $data->status;
                switch ($newStatus) {
                    case 'reject':
                        Notification::updateOrCreate([
                            'data_id' => $data->id,],
                            ['type' => 'text_reject', 'subject' => __('text_need_change'), 'description' => json_encode($request->message), 'owner_id' => $data->owner_id]
                        );
                        break;
                    case 'active':
                        Notification::updateOrCreate([
                            'data_id' => $data->id,],
                            ['type' => 'text_approve', 'subject' => __('text_approved'), 'description' => null, 'owner_id' => $data->owner_id]
                        );
//                        if ($data->view_fee > $data->charge) {
//                            $request->status = 'need_charge';
//                            $request->merge([
//                                'status' => 'need_charge',
//                            ]);
//                        }

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
            } else {
                unset($request->owner_id);
            }


            $oldName = $data->title;
//            $data->name = $request->tags;
//            $data->tags = $request->tags;
//            dd($request->tags);
            if ($data->update($request->all())) {

                if ($oldName != $request->title)
                    Transfer::where('item_type', 'text')->where('item_id', $data->id)->where('status', '!=', 'done')->update(['name' => $data->title]);

                $res = ['flash_status' => 'success', 'flash_message' => __($user->isAdmin() ? 'updated_successfully' : 'updated_successfully_and_active_after_review')];
//                dd($request->all());
                Telegram::log(null, 'text_edited', $data);
            } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
            return back()->with($res);
        }

        return response()->json($response, $errorStatus);
    }

    public
    function index()
    {
        return Inertia::render('Article/Index', [
            'categories' => Article::categories(),
        ]);

    }

    public
    function create(TextRequest $request)
    {


        $user = auth()->user()/* ?? auth('api')->user()*/
        ;
        $isAdmin = $user->isAdmin();
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


        $content = $request->get('content') ? json_encode($request->get('content')) : null;


        $request->merge([
            'owner_id' => $user->id,
            'duration' => Util::estimateReadingTime($request->get('content')),
            'content' => $content,
            'status' => $user->isAdmin() && $request->status ? $request->status : 'review',
        ]);

        $text = Text::create($request->all());

        if ($text) {
            $res = ['flash_status' => 'success', 'flash_message' => __('created_successfully_and_activete_after_review')];


//            SMSHelper::deleteCode($phone);
            Telegram::log(null, 'text_created', $text);
        } else    $res = ['flash_status' => 'danger', 'flash_message' => __('response_error')];
        return to_route('panel.text.index')->with($res);
    }

    public
    function searchPanel(Request $request)
    {
        $user = $request->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = $request->order_by ?: 'id';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;

        $query = Text::query();
        $query = $query->select('id', 'title', 'charge', 'view_fee', 'author', 'status', 'view', 'category_id');
        if ($user->role == 'us')
            $query = $query->where('owner_id', $user->id);

        if ($search)
            $query = $query->where('title', 'like', "%$search%");

        return $query->orderBy($orderBy, $dir)->paginate($paginate, ['*'], 'page', $page);
    }


}

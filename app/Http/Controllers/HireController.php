<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Telegram;
use App\Http\Helpers\Variable;
use App\Http\Requests\HireRequest;
use App\Models\Hire;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class HireController extends Controller
{
    public function update(HireRequest $request)
    {
        $user = auth()->user();
//        $response = ['message' => __('done_successfully')];
        $response = ['message' => __('response_error')];
        $errorStatus = Variable::ERROR_STATUS;
        $successStatus = Variable::SUCCESS_STATUS;
        $id = $request->id;
        $cmnd = $request->cmnd;
        $data = Hire::find($id);

        if ($cmnd) {
            switch ($cmnd) {
                case 'review':
                case 'done':
                    $data->status = $cmnd;
                    $data->save();
                    return response()->json(['message' => __('updated_successfully'), 'status' => $data->status,], $successStatus);


            }
        } elseif ($data) {

            $u = User::find($data->owner_id);
            if (!$data->owner_id || !$u)
                return response()->json(['message' => __('user_not_found'),], $errorStatus);
            $data->access_result = join(',', $request->accesses ?? []) ?: null;

            if ($request->close)
                $data->status = 'done';
            $data->save();

            if (Hire::isEdited($u->access, $request->accesses)) {
                $u->access = join(',', $request->accesses ?? []) ?: null;
                $n = Notification::create(
                    [
                        'type' => 'access_change',
                        'subject' => __('your_roles_changed'),
                        'description' => null,
                        'owner_id' => $data->owner_id
                    ],
                );
                if ($n)
                    $u->notifications++;
                $u->save();
                Telegram::log(null, 'access_edited', $data);


            }
            return response()->json(['message' => __('updated_successfully'), 'status' => $data->status, 'access_result' => $data->access_result,], $successStatus);


        }

        return response()->json($response, $errorStatus);
    }

    public function searchPanel(Request $request)
    {
        $user = $request->user();
        $search = $request->search;
        $page = $request->page ?: 1;
        $orderBy = $request->order_by ?: 'id';
        $dir = $request->dir ?: 'DESC';
        $paginate = $request->paginate ?: 24;

        $query = Hire::query();

        if ($search)
            $query = $query->where('fullname', 'like', "%$search%")->orWhere('phone', 'like', "%$search%");

        return $query->orderBy($orderBy, $dir)->paginate($paginate, ['*'], 'page', $page);
    }
}

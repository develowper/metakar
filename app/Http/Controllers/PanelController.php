<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Variable;
use App\Models\Banner;
use App\Models\Podcast;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PanelController extends Controller
{
    public function __construct()
    {

    }

    public static function makeInertiaRoute(string $method, string $route, string $name, string $component, array $params = [], $middleware = [])
    {
        return Route::match([$method], $route, function () use ($component, $params) {

            return Inertia::render($component, $params);
        })->name($name)->middleware($middleware);
    }

    protected function index(Request $request)
    {
        $params = [];
        $user = auth()->user();
        $role = optional($user)->role;
        if ($role == 'go') {
            $component = 'Panel/God';
            $params = [
                'users' => User::select('role', DB::raw('COUNT(*) AS count'))->groupBy('role')->get(),
                'transactions' => Transaction::select('type', DB::raw('COUNT(*) AS count'))->groupBy('type')->get(),
                'tickets' => Ticket::select('status', DB::raw('COUNT(*) AS count'))->groupBy('status')->get(),

            ];

        } elseif ($role == 'ad') {
            $component = 'Panel/Admin';
            $params = [
                'users' => User::select('role', DB::raw('COUNT(*) AS count'))->groupBy('role')->get(),
                'transactions' => Transaction::select('type', DB::raw('COUNT(*) AS count'))->groupBy('type')->get(),
                'tickets' => Ticket::select('status', DB::raw('COUNT(*) AS count'))->groupBy('status')->get(),

            ];
        } else {

            $component = 'Panel/User';
            $tickets = Ticket::select('status', DB::raw('COUNT(*) AS count'))->where('user_id', optional($user)->id)->groupBy('status')->get();
            $params = [
                'transactions' => Transaction::select('type', DB::raw('COUNT(*) AS count'))->where('user_id', optional($user)->id)->groupBy('type')->get(),
                'tickets' => array_map(function ($el) {
                    return ['title' => $el, 'value' => $tickets[$el] ?? 0];
                }, Variable::TICKET_STATUSES),

            ];
        }

        return Inertia::render($component, $params);
    }

    public function searchMergedItems(Request $request)
    {
        $paginate = $request->paginate ?? 24;
        $order = $request->order ?? 'id';
        $dir = $request->dir ?? 'DESC';
        $search = $request->search;
        $type = $request->type;
        $banners = null;
        $podcasts = null;
        $videos = null;

        if (!$request->type || $type == 'banner')
            $banners = Banner::select(array_merge(['id', 'name',], [DB::raw(" 'banner'" . ' as type '), DB::raw(' 0 as duration '), DB::raw('"" as extra')]))
                ->where('status', 'active')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });

        if (!$request->type || $type == 'podcast')
            $podcasts = Podcast::select(array_merge(['id', 'name',], [DB::raw("'podcast'" . ' as type'), DB::raw('duration as duration'), DB::raw('"" as extra')]))
                ->where('status', 'active')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });

        if (!$request->type || $type == 'video')
            $videos = Video::select(array_merge(['id', 'name'], [DB::raw("'video'" . ' as type'), DB::raw('duration as duration'), DB::raw('"" as extra')]))
                ->where('status', 'active')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });

        $res = null;
        if ($banners)
            $res = $banners;
        if ($podcasts)
            if ($res) $res->union($podcasts); else $res = $podcasts;
        if ($videos)
            if ($res) $res->union($videos); else $res = $videos;

        if ($res)
            return $res->orderBy($order, $dir)->paginate($paginate);
    }
}

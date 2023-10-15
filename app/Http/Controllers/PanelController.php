<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Variable;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Business;
use App\Models\DataTransaction;
use App\Models\Notification;
use App\Models\Podcast;
use App\Models\Setting;
use App\Models\Site;
use App\Models\SiteTransaction;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserTransaction;
use App\Models\Video;
use Carbon\Carbon;
use DrClubs\Base\Activate;
use DrClubs\Base\BusinessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;
use Tightenco\Collect\Support\Collection;

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


        $tickets = Ticket::select('status', DB::raw('COUNT(*) AS count'))->where('owner_id', optional($user)->id)->groupBy('status')->get();

        $params = [
            'transactions' => Transaction::select('type', DB::raw('COUNT(*) AS count'))->where('owner_id', optional($user)->id)->groupBy('type')->get(),
            'tickets' => array_map(function ($el) use ($tickets) {
                return ['title' => $el['name'], 'value' => optional($tickets->where('status', $el['name'])->first())->count ?? 0];
            }, Variable::TICKET_STATUSES),
            'items' => $this->ownedItemsCount($user->id),
            'hasAdvertise' => DataTransaction::where('owner_id', $user->id)->exists(),
        ];


        return Inertia::render('Panel', $params);
    }

    protected function admin(Request $request)
    {
        $params = [];
        $user = auth()->user();
        $role = optional($user)->role;

        $tickets = Ticket::select('status', DB::raw('COUNT(*) AS count'))->groupBy('status')->get();
        $users = User::select('id', 'is_active', 'is_block', 'role')->get();
        $params = [
            'transactions' => Transaction::select('type', DB::raw('COUNT(*) AS count'))->groupBy('type')->get(),
            'users' => [
                ['color' => 'primary', 'title' => __('admin'), 'count' => $users->whereIn('role', ['ad', 'go'])->count(),],
                ['color' => 'teal', 'title' => __('sum'), 'count' => $users->count()],
                ['color' => 'orange', 'title' => __('inactive'), 'count' => $users->where('is_active', false)->count()],
                ['color' => 'danger', 'title' => __('blocked'), 'count' => $users->where('is_block', true)->count()],
            ],
            'tickets' => array_map(function ($el) use ($tickets) {
                return ['title' => $el['name'], 'value' => optional($tickets->where('status', $el['name'])->first())->count ?? 0];
            }, Variable::TICKET_STATUSES),
            'items' => $this->ownedItemsCount(null),
            'hasAdvertise' => true,
            'adminBalance' => Setting::getValue('iran_wallet'),
            'notifications' => ['count' => Notification::count()],
            'queue' => ['count' => $this->queueItemsCount()],
        ];


        return Inertia::render('Panel/Admin/Index', $params);
    }

    public function searchReviewItems(Request $request)
    {
        $paginate = $request->paginate ?? 24;
        $order = $request->order ?? 'updated_at';
        $dir = $request->dir ?? 'ASC';
        $search = $request->search;
        $type = $request->type;
        $owner_id = $request->owner_id;
        $businesses = null;
        $articles = null;
        $banners = null;
        $podcasts = null;
        $videos = null;
        $sites = null;

        if (!$request->type || $type == 'banner')
            $banners = Banner::select(array_merge(['id', 'name', 'owner_id', 'updated_at'], [DB::raw(" 'banner'" . ' as type '), DB::raw(' 0 as duration '), DB::raw("'banners' as storage")]))
                ->where('status', 'review')
                ->where(function ($query) use ($search, $owner_id) {
                    if ($search)
                        $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });
        if (!$request->type || $type == 'article')
            $articles = Article::select(array_merge(['id', DB::raw("title AS name"), 'owner_id', 'updated_at'], [DB::raw(" 'article'" . ' as type '), DB::raw(' 0 as duration '), DB::raw("'articles' as storage")]))
                ->where('status', 'review')
                ->where(function ($query) use ($search, $owner_id) {
                    if ($search)
                        $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });
        if (!$request->type || $type == 'business')
            $businesses = Business::select(array_merge(['id', 'name', 'owner_id', 'updated_at'], [DB::raw(" 'business'" . ' as type '), DB::raw(' 0 as duration '), DB::raw("'businesses' as storage")]))
                ->where('status', 'review')
                ->where(function ($query) use ($search, $owner_id) {
                    if ($search)
                        $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });

        if (!$request->type || $type == 'podcast')
            $podcasts = Podcast::select(array_merge(['id', 'name', 'owner_id', 'updated_at'], [DB::raw("'podcast'" . ' as type'), DB::raw('duration as duration'), DB::raw("'podcasts' as storage")]))
                ->where('status', 'review')
                ->where(function ($query) use ($search, $owner_id) {
                    if ($search)
                        $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });

        if (!$request->type || $type == 'video')
            $videos = Video::select(array_merge(['id', 'name', 'owner_id', 'updated_at'], [DB::raw("'video'" . ' as type'), DB::raw('duration as duration'), DB::raw("'videos' as storage")]))
                ->where('status', 'review')
                ->where(function ($query) use ($search, $owner_id) {
                    if ($search)
                        $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });
        if (!$request->type || $type == 'site')
            $sites = Site::select(array_merge(['id', 'name', 'owner_id', 'updated_at'], [DB::raw("'site'" . ' as type'), DB::raw('0 as duration'), DB::raw("'sites' as storage")]))
                ->where('status', 'review')
                ->where(function ($query) use ($search, $owner_id) {
                    if ($search)
                        $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });

        $res = null;
        if ($banners)
            $res = $banners;
        if ($podcasts)
            if ($res) $res->union($podcasts);
            else $res = $podcasts;
        if ($videos)
            if ($res) $res->union($videos);
            else $res = $videos;
        if ($articles)
            if ($res) $res->union($articles);
            else $res = $articles;
        if ($businesses)
            if ($res) $res->union($businesses);
            else $res = $businesses;
        if ($sites)
            if ($res) $res->union($sites);
            else $res = $sites;

        if ($res)
            return $res->orderBy($order, $dir)->paginate($paginate);
    }

    public
    function searchMergedItems(Request $request)
    {
        $paginate = $request->paginate ?? 24;
        $order = $request->order ?? 'id';
        $dir = $request->dir ?? 'DESC';
        $search = $request->search;
        $type = $request->type;
        $owner_id = $request->owner_id;
        $banners = null;
        $podcasts = null;
        $videos = null;
        $articles = null;

        if (!$type || $type == 'transfer' || $type == 'banner')
            $banners = Banner::select(array_merge(['id', 'name', 'owner_id'], [DB::raw(" 'banner'" . ' as type '), DB::raw(' 0 as duration '), DB::raw('"" as extra')]))
                ->whereIn('status', ['active', 'need_charge',])
                ->where(function ($query) use ($search, $owner_id) {
                    $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });

        if (!$type || $type == 'transfer' || $type == 'podcast')
            $podcasts = Podcast::select(array_merge(['id', 'name', 'owner_id'], [DB::raw("'podcast'" . ' as type'), DB::raw('duration as duration'), DB::raw('"" as extra')]))
                ->whereIn('status', ['active', 'need_charge',])
                ->where(function ($query) use ($search, $owner_id) {
                    $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });

        if (!$type || $type == 'transfer' || $type == 'video')
            $videos = Video::select(array_merge(['id', 'name', 'owner_id'], [DB::raw("'video'" . ' as type'), DB::raw('duration as duration'), DB::raw('"" as extra')]))
                ->whereIn('status', ['active', 'need_charge',])
                ->where(function ($query) use ($search, $owner_id) {
                    $query->where('name', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });
        if ($type == 'transfer' || $type == 'article')
            $articles = Article::select(array_merge(['id', DB::raw("title AS name"), 'owner_id'], [DB::raw(" 'article'" . ' as type '), DB::raw(' 0 as duration '), DB::raw('"" as extra')]))
                ->whereIn('status', ['active', 'need_charge',])
                ->where(function ($query) use ($search, $owner_id) {
                    if ($search)
                        $query->where('title', 'like', "%$search%");
                    if ($owner_id)
                        $query->where('owner_id', $owner_id);
                });

        $res = null;
        if ($banners)
            $res = $banners;
        if ($podcasts)
            if ($res) $res->union($podcasts); else $res = $podcasts;
        if ($videos)
            if ($res) $res->union($videos); else $res = $videos;
        if ($articles)
            if ($res) $res->union($articles); else $res = $articles;

        if ($res)
            return $res->orderBy($order, $dir)->paginate($paginate);
    }

    public
    function ownedItemsCount($ownerId, $type = null)
    {

        if (!$type || $type == 'business')
            $businesses = Business::select([DB::raw(" 'business'" . ' as type '), DB::raw(' COUNT(*) as count ')])
                ->where('status', 'active')
                ->when($ownerId, function ($query) use ($ownerId) {
                    $query->where('owner_id', $ownerId);
                });
        if (!$type || $type == 'banner')
            $banners = Banner::select([DB::raw(" 'banner'" . ' as type '), DB::raw(' COUNT(*) as count ')])
                ->where('status', 'active')
                ->when($ownerId, function ($query) use ($ownerId) {
                    $query->where('owner_id', $ownerId);
                });

        if (!$type || $type == 'podcast')
            $podcasts = Podcast::select([DB::raw(" 'podcast'" . ' as type '), DB::raw(' COUNT(*) as count ')])
                ->where('status', 'active')
                ->when($ownerId, function ($query) use ($ownerId) {
                    $query->where('owner_id', $ownerId);
                });

        if (!$type || $type == 'video')
            $videos = Video::select([DB::raw(" 'video'" . ' as type '), DB::raw(' COUNT(*) as count ')])
                ->where('status', 'active')
                ->when($ownerId, function ($query) use ($ownerId) {
                    $query->where('owner_id', $ownerId);
                });

        if (!$type || $type == 'article')
            $articles = Article::select([DB::raw(" 'article'" . ' as type '), DB::raw(' COUNT(*) as count ')])
                ->where('status', 'active')
                ->when($ownerId, function ($query) use ($ownerId) {
                    $query->where('owner_id', $ownerId);
                });

        $res = null;
        if ($businesses)
            $res = $businesses;
        if ($banners)
            if ($res) $res->union($banners); else $res = $banners;
        if ($podcasts)
            if ($res) $res->union($podcasts); else $res = $podcasts;
        if ($videos)
            if ($res) $res->union($videos); else $res = $videos;
        if ($articles)
            if ($res) $res->union($articles); else $res = $articles;

        if ($res)
            return $res->groupBy('type')->get();
    }

    public
    function queueItemsCount()
    {
        $countAll = 0;
        $countAll += Business::where('status', 'review')->count();
        $countAll += Banner::where('status', 'review')->count();
        $countAll += Podcast::where('status', 'review')->count();
        $countAll += Video::where('status', 'review')->count();
        $countAll += Article::where('status', 'review')->count();
        return $countAll;
    }

    public
    function chartLogs(Request $request)
    {
        $user = auth()->user();
        $user_id = $request->user_id;
        $this->authorize('viewAny', [User::class, 'log', (object)['user_id' => $user_id]]);

        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $per = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];


        $period = $request->period;//[today,yesterday,last_7_days,last_30_days]
        $type = $request->type;
        $unit = $request->unit;
        $types = $request->types;
        $dir = $request->dir ?? 'DESC';
        $orderBy = $request->order_by ?? 'id';
        $page = $request->page;
        $paginate = $request->paginate ?? 24;
        $timestamp = $request->timestamp;
        $from = $request->dateFrom ? Jalalian::fromFormat('Y/m/d', str_replace($per, $eng, $request->dateFrom)) : null;
        $to = $request->dateTo ? Jalalian::fromFormat('Y/m/d', str_replace($per, $eng, $request->dateTo)) : null;
        $X_labels = [];

        if ($timestamp == 'd' || !$timestamp) {

        } elseif ($timestamp == 'm') { //from day 1 : to day 30 or 31
            if ($c = $from->getDay() - 1 > 0)
                $from = $from->subDays($c);
            if ($c = $to->getMonthDays() - $to->getDay() > 0)
                $to = $to->addDays($c);
        } elseif ($timestamp == 'y') { //from day 1 : to day 30 or 31
            if ($c = $from->getDay() - 1 > 0)
                $from = $from->subDays($c);
            if ($c = $from->getMonth() - 1 > 0)
                $from = $from->subMonths($c);
            if ($c = $to->getMonthDays() - $to->getDay() > 0)
                $to = $to->addDays($c);
            if ($c = 12 - $to->getMonth() > 0)
                $to = $to->addMonths($c);
        }
        $tmp = $from;

        //fill all times
        while ($tmp->lessThanOrEqualsTo($to)) {

            if ($timestamp == 'd' || !$timestamp) {
                $X_labels[] = $tmp->format('Y/m/d');
                $tmp = $tmp->addDays(1);
            } elseif ($timestamp == 'm') {
                $X_labels[] = $tmp->format('Y/m');
                $tmp = $tmp->addMonths(1);
            } elseif ($timestamp == 'y') {
                $X_labels[] = $tmp->format('Y');
                $tmp = $tmp->addYears(1);
            }
        }

        if ($from)
            $from = $from->toCarbon()->startOfDay()/*->setTimezone(new \DateTimeZone('Asia/Tehran'))*/
            ;
        if ($to)
            $to = $to->toCarbon()->endOfDay()/*->setTimezone(new \DateTimeZone('Asia/Tehran'))*/
            ;
        $query = DataTransaction::query();


        if ($user_id)
            $query = $query->where('owner_id', $user_id);


        if ($type == 'user') {
            $query = UserTransaction::query();

        } //  meta transactions
        if ($type == ('data')) {
            $query = DataTransaction::query();


        } //  money transactions

        if ($user_id)
            $query = $query->where('owner_id', $user_id);
        if ($from)
            $query = $query->where('date', '>=', $from);
        if ($to)
            $query = $query->where('date', '<=', $to);

        $result = $query->get()->groupBy(function ($data) use ($timestamp) {
            if ($timestamp == 'm')
                return Jalalian::forge($data->date)->format('Y/m');
            elseif ($timestamp == 'y')
                return Jalalian::forge($data->date)->format('Y');
            else
                return Jalalian::forge($data->date)->format('Y/m/d');
        });
        return response()->json(['datas' => [$result], 'dates' => $X_labels]);

        if ($type == __('meta')) {

            $query = SiteTransaction::query()->where('is_meta', true);
        } else {
            $query1 = SiteTransaction::query()->select(['id', 'owner_id', DB::raw("'view_site' AS type"), 'created_at', 'amount'])->where('is_meta', false);
            $query2 = Transaction::query()->select(['id', 'owner_id', 'type', 'created_at', 'amount']);
            $temp = $query1->union($query2);
            $query = DB::table(DB::raw("({$temp->toSql()}) as data"))->select('*')->mergeBindings($temp->getQuery());
        }

        if ($from)
            $from = $from->toCarbon()->startOfDay()/*->setTimezone(new \DateTimeZone('Asia/Tehran'))*/
            ;
        if ($to)
            $to = $to->toCarbon()->endOfDay()/*->setTimezone(new \DateTimeZone('Asia/Tehran'))*/
            ;
//        dd($from . " } " . $to);

        if ($user_id)
            $query = $query->where('owner_id', $user_id);
//        if ($from && $to)
//            $query = $query->whereBetween('created_at', [$from, $to]); elseif ($from)
        if ($from)
            $query = $query->where('created_at', '>=', $from);
        if ($to)
            $query = $query->where('created_at', '<=', $to);

        if ($orderBy)
            $query = $query->orderBy($orderBy, $dir);

//        if ($page)
//            $query = $query->paginate();

//        if ($group_by)
        $res = $query->get();
//        dd($from . " | " . $to);

        $result = $res/*->groupBy('type')->map(function ($type) use ($timestamp) {

            return $type*/ ->groupBy(function ($data) use ($timestamp) {
            if ($timestamp == 'm')
                return Jalalian::forge($data->created_at)->format('Y/m');
            elseif ($timestamp == 'y')
                return Jalalian::forge($data->created_at)->format('Y');
            else
                return Jalalian::forge($data->created_at)->format('Y/m/d');
        });
        /*  });*/


        return response()->json(['datas' => [$result], 'dates' => $X_labels]);

    }

}

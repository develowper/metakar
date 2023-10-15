<?php

namespace App\Http\Controllers;

use App\Http\Helpers\SMSHelper;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Http\Requests\SiteRequest;
use App\Models\Article;
use App\Models\ArticleTransaction;
use App\Models\Banner;
use App\Models\BannerTransaction;
use App\Models\Notification;
use App\Models\Podcast;
use App\Models\PodcastTransaction;
use App\Models\Setting;
use App\Models\Site;
use App\Models\SiteTransaction;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use Spatie\Browsershot\Browsershot;
use Termwind\Components\Dd;

class ItemController extends Controller
{


    public function index(Request $request)
    {
        $type = $request->type;

        $message = null;
        $link = null;
        $auto_view = session()->get('auto_view', true);
        $meta_view_fee = Variable::SITE_VIEW_META_FEE();
        $user = auth()->user();

        $data = $this->getNowOwnedNotViewed();
//        if ($data)
        return redirect()->route('item', ['id' => optional($data)->id ?? 0, 'type' => optional($data)->type ?? 0]);
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


        return Inertia::render('Item/Index', [
            'heroText' => __('hero_sites_page'),
            'site_view_meta_reward' => Variable::SITE_VIEW_META_REWARD(),
            'categories' => Site::categories('parents'),
        ]);

    }

    public function view(Request $request, $type, $id)
    {


        $message = null;
        $link = null;
        $user = auth()->user();
        $site = new Site();
        if ($id && $type) {
            $data = array_flip(Variable::DATA_TYPES)[$type]::where('id', $id)->with('owner:id,fullname,phone')->first();
            $site->id = $data->id;
            $site->type = $type;

            $site->name = "$data->type $data->name";
            $site->owner_id = $data->owner_id;
            $site->category_id = $data->category_id;
            $site->view = $data->view;
            $site->charge = $data->charge;
            $site->view_fee = $data->view_fee;
            $site->tags = $data->tags;
            $site->status = $data->status;
            $site->viewer = $data->viewer;
            $site->description = $data->description;
            $site->link = route("$type", ["$type" => $id]) . "?iframe=true"; //iframe not count views twice

            $site->owner = User::select('id', 'fullname', 'phone')->where('id', $data->owner_id)->first();

            $commissionPercent = Setting::getValue('site_view_cp') ?? 0;
            $commission = intVal($site->view_fee * $commissionPercent / 100);
            $site->view_reward = $site->view_fee - $commission;

            if ($data->status == 'active' && $data->charge < $data->view_fee)
                $data->update(['status' => 'need_charge']);

        }
        $auto_view = session()->get('auto_view', true);
//        $meta_view_fee = Variable::SITE_VIEW_META_FEE();
//        $seen = session()->forget('site_views');
        $seen = session()->get('site_views', []);
//        if (!$user) {
//            $data = ['name' => __('first_login_or_register'),];
////            $message = __('first_login_or_register');
//            $link = route('login');
//        } else
        if (!$site->id || $site->status == 'inactive' || $site->status == 'block') {
//            $message = __('no_results');
            $link = route('item.index');
            $site = ['name' => __('no_results'),];
        } elseif ($user && ($site->status != 'active' || ($site->charge < $site->view_fee))) {
//            $message = __('item_view_time_ended');
            $link = route('item.index');
            $site = ['name' => __('item_view_time_ended'),];
        }
//        elseif ($site && $site->id) {
////            if (str_starts_with($data->link, 'http:'))
////                $data->link = str_replace('http://', 'https://', $data->link);
//        }

        return Inertia::render('Item/View', [
            'auto_view' => $auto_view,
            'available_sites' => $this->getNowOwnedNotViewed('count'),
            'error_message' => $message,
            'error_link' => $link,
            'data' => $site,
            'site_view_meta_reward' => Variable::SITE_VIEW_META_REWARD(),
            'reward_second' => Variable::SITE_VIEW_REWARD_SECOND(),
            'commission' => Setting::getValue('site_view_cp'),
            'categories' => Site::categories(),
        ]);

    }


    static function getNowOwnedNotViewed($type = 'first', $exclude = null)
    {
        $banners = null;
        $podcasts = null;
        $videos = null;
        $articles = null;
        $user = auth()->user();
        $excludeType = null;
        $excludeId = null;
        if ($exclude) {
            $excludeType = $exclude['type'];
            $excludeId = $excludeId;
        }
        $banners = Banner::select(array_merge(['id', 'name', 'owner_id', 'charge', 'view_fee', 'category_id', 'view', 'tags', 'viewer',], [DB::raw(" 'banner'" . ' as type '),]))
            ->where('status', 'active')
            ->where('view_fee', '>', 0)
            ->whereColumn('charge', '>=', 'view_fee');
        if ($user)
            $banners->where('owner_id', '!=', $user->id)
                ->whereIntegerNotInRaw('id', BannerTransaction::where('owner_id', $user->id)->orWhere('ip', request()->ip())->pluck('data_id'));
        if ($excludeType == 'banner')
            $banners->where('id', '!=', $excludeId);
//                ->with('owner:id,fullname');


        $podcasts = Podcast::select(array_merge(['id', 'name', 'owner_id', 'charge', 'view_fee', 'category_id', 'view', 'tags', 'viewer',], [DB::raw("'podcast'" . ' as type')]))
            ->where('status', 'active')
            ->where('view_fee', '>', 0)
            ->whereColumn('charge', '>=', 'view_fee');
//                ->with('owner:id,fullname');
        if ($user)
            $podcasts->where('owner_id', '!=', $user->id)
                ->whereIntegerNotInRaw('id', PodcastTransaction::where('owner_id', $user->id)->orWhere('ip', request()->ip())->pluck('data_id'));
        if ($excludeType == 'podcast')
            $podcasts->where('id', '!=', $excludeId);

        $videos = Video::select(array_merge(['id', 'name', 'owner_id', 'charge', 'view_fee', 'category_id', 'view', 'tags', 'viewer',], [DB::raw("'video'" . ' as type'),]))
            ->where('status', 'active')
            ->where('view_fee', '>', 0)
            ->whereColumn('charge', '>=', 'view_fee');
//                ->with('owner:id,fullname');
        if ($user)
            $videos->where('owner_id', '!=', $user->id)
                ->whereIntegerNotInRaw('id', VideoTransaction::where('owner_id', $user->id)->orWhere('ip', request()->ip())->pluck('data_id'));
        if ($excludeType == 'video')
            $videos->where('id', '!=', $excludeId);

        $articles = Article::select(array_merge(['id', DB::raw("title AS name"), 'owner_id', 'charge', 'view_fee', 'category_id', 'view', 'tags', 'viewer',], [DB::raw(" 'article'" . ' as type '),]))
            ->where('status', 'active')
            ->where('view_fee', '>', 0)
            ->whereColumn('charge', '>=', 'view_fee');
//                ->with('owner:id,fullname');
        if ($user)
            $articles->where('owner_id', '!=', $user->id)
                ->whereIntegerNotInRaw('id', ArticleTransaction::where('owner_id', $user->id)->orWhere('ip', request()->ip())->pluck('data_id'));
        if ($excludeType == 'article')
            $articles->where('id', '!=', $excludeId);


        $res = null;
        if ($banners)
            $res = $banners;
        if ($podcasts)
            if ($res) $res->union($podcasts); else $res = $podcasts;
        if ($videos)
            if ($res) $res->union($videos); else $res = $videos;
        if ($articles)
            if ($res) $res->union($articles); else $res = $articles;

//        $data = $res->orderBy('view_fee', 'DESC')->paginate(1);
//        $total = $data->total();
//        if ($total > 0)
//            $data = $data->items()[0];
        if ($type == 'count')
            return $res->count();

        $data = $res->orderBy('view_fee', 'DESC')->first();
        if (!$data)
            return null;

        $site = new Site();
        $site->id = $data->id;
        $site->type = $data->type;

        return $site;
        $site->remainded = $total - 1;
        $site->name = $data->name;
        $site->owner_id = $data->owner_id;
        $site->category_id = $data->category_id;
        $site->view = $data->view;
        $site->view_fee = $data->view_fee;
        $site->tags = $data->tags;
        $site->viewer = $data->viewer;
        $site->description = $data->description;
        $site->link = route($data->type, ["$data->type" => $data->id]);

        $site->owner = User::select('id', 'fullname', 'phone')->where('id', $data->owner_id)->first();
        return $site;
    }

    public function search(Request $request)
    {
//        $user = auth()->user();
        $id = $request->id;
        $search = $request->search;
        $page = $request->page ?? 1;
        $orderBy = $request->order_by ?? 'created_at';
        $dir = $request->dir ?? 'DESC';
        $paginate = $request->paginate ?: 24;


        $user = auth()->user();

        $banners = Banner::select(array_merge(['id', 'name', 'owner_id', 'charge', 'view_fee', 'category_id', 'view', 'status', 'viewer', 'created_at',], [DB::raw(" 'banner'" . ' as type '),]))
            ->where('status', 'active');


        $podcasts = Podcast::select(array_merge(['id', 'name', 'owner_id', 'charge', 'view_fee', 'category_id', 'view', 'status', 'viewer', 'created_at',], [DB::raw("'podcast'" . ' as type')]))
            ->where('status', 'active');
//                ->with('owner:id,fullname');


        $videos = Video::select(array_merge(['id', 'name', 'owner_id', 'charge', 'view_fee', 'category_id', 'view', 'status', 'viewer', 'created_at',], [DB::raw("'video'" . ' as type'),]))
            ->where('status', 'active');

        $articles = Article::select(array_merge(['id', DB::raw("title AS name"), 'owner_id', 'charge', 'view_fee', 'category_id', 'view', 'status', 'viewer', 'created_at',], [DB::raw(" 'article'" . ' as type '),]))
            ->where('status', 'active');

        $res = null;
        if ($banners)
            $res = $banners;
        if ($podcasts)
            if ($res) $res->union($podcasts); else $res = $podcasts;
        if ($videos)
            if ($res) $res->union($videos); else $res = $videos;
        if ($articles)
            if ($res) $res->union($articles); else $res = $articles;


        return $res->orderBy($orderBy, $dir)->paginate($paginate);
    }
}

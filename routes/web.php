<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\VideoController;
use App\Http\Helpers\SMSHelper;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Business;
use App\Models\Category;
use App\Models\County;
use App\Models\Podcast;
use App\Models\Province;
use App\Models\Setting;
use App\Models\Site;
use App\Models\Video;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test', function () {


//    File::makeDirectory(Storage::path("public/sites"), $mode = 0755,);
//    return Telegram::log(null, 'site_created', Site::find(2));

});

Route::get('storage')->name('storage');
Route::get('storage/sites')->name('storage.sites');
Route::get('storage/users')->name('storage.users');
Route::get('storage/businesses')->name('storage.businesses');
Route::get('storage/podcasts')->name('storage.podcasts');
Route::get('storage/videos')->name('storage.videos');
Route::get('storage/banners')->name('storage.banners');
Route::get('storage/articles')->name('storage.articles');

Route::get('/', function () {
    return Inertia::render('Main', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'heroText' => \App\Models\Setting::getValue('hero_main_page'),

    ]);
})->name('/');

Route::middleware(['auth', 'verified'])->prefix('panel')->group(function ($route) {


    Route::get('', [PanelController::class, 'index'])->name('panel.index');


//    PanelController::makeInertiaRoute('get', 'site/edit/{site}', 'panel.site.edit', 'Panel/Site/Edit', ['categories' => Site::categories('parents'), 'site_statuses' => Variable::SITE_STATUSES, 'site' => $tmp = Site::with('category')->find(request()->segment(count(request()->segments())))], 'can:edit,App\Models\User,App\Models\Site,"","' . $tmp . '"');


    PanelController::makeInertiaRoute('get', 'business/create', 'panel.business.create', 'Panel/Business/Create', [
        'provinces' => Province::all(),
        'counties' => County::all(),
        'categories' => Business::categories(),
        'max_images_limit' => Variable::BUSINESS_IMAGE_LIMIT,
    ]);
    PanelController::makeInertiaRoute('get', 'business/index', 'panel.business.index', 'Panel/Business/Index',
        [
            'categories' => Business::categories('parents'),
            'statuses' => Variable::STATUSES
        ]
    );
    PanelController::makeInertiaRoute('get', 'article/index', 'panel.article.index', 'Panel/Article/Index',
        [
            'categories' => Article::categories('parents'),
            'statuses' => Variable::STATUSES
        ]
    );
    PanelController::makeInertiaRoute('get', 'article/create', 'panel.article.create', 'Panel/Article/Create',
        [
            'categories' => Banner::categories('parents'),
            'statuses' => Variable::STATUSES
        ]
    );
    PanelController::makeInertiaRoute('get', 'site/index', 'panel.site.index', 'Panel/Site/Index', [
        'categories' => Site::categories('parents'),
        'statuses' => Variable::SITE_STATUSES]);
    PanelController::makeInertiaRoute('get', 'site/create', 'panel.site.create', 'Panel/Site/Create', [
        'categories' => Site::categories('parents'),]);
    PanelController::makeInertiaRoute('get', 'text/index', 'panel.text.index', 'Panel/Text/Index');
    PanelController::makeInertiaRoute('get', 'text/create', 'panel.text.create', 'Panel/Text/Create');
    PanelController::makeInertiaRoute('get', 'banner/index', 'panel.banner.index', 'Panel/Banner/Index',
        [
            'categories' => Banner::categories('parents'),
            'statuses' => Variable::STATUSES
        ]
    );
    PanelController::makeInertiaRoute('get', 'banner/create', 'panel.banner.create', 'Panel/Banner/Create',
        [
            'categories' => Business::categories(),
        ]
    );
    PanelController::makeInertiaRoute('get', 'video/index', 'panel.video.index', 'Panel/Video/Index',
        [
            'categories' => Video::categories('parents'),
            'statuses' => Variable::STATUSES
        ]
    );
    PanelController::makeInertiaRoute('get', 'video/create', 'panel.video.create', 'Panel/Video/Create',
        [
            'categories' => Business::categories(),
        ]
    );

    PanelController::makeInertiaRoute('get', 'video/index', 'panel.video.index', 'Panel/Video/Index',
        [
            'categories' => Video::categories('parents'),
            'statuses' => Variable::STATUSES
        ]
    );
    PanelController::makeInertiaRoute('get', 'podcast/index', 'panel.podcast.index', 'Panel/Podcast/Index',
        [
            'categories' => Podcast::categories('parents'),
            'statuses' => Variable::STATUSES
        ]
    );
    PanelController::makeInertiaRoute('get', 'podcast/create', 'panel.podcast.create', 'Panel/Podcast/Create',
        [
            'categories' => Business::categories(),
        ]
    );
    PanelController::makeInertiaRoute('get', 'auction/index', 'panel.auction.index', 'Panel/Auction/Index');
    PanelController::makeInertiaRoute('get', 'auction/create', 'panel.auction.create', 'Panel/Auction/Create');
    PanelController::makeInertiaRoute('get', 'ticket/index', 'panel.ticket.index', 'Panel/Ticket/Index');
    PanelController::makeInertiaRoute('get', 'ticket/create', 'panel.ticket.create', 'Panel/Ticket/Create');
    PanelController::makeInertiaRoute('get', 'transaction/index', 'panel.financial.transaction.index', 'Panel/Financial/Transaction/Index');


});

Route::get('site/create', [SiteController::class, 'new'])->name('site.create');
Route::post('site/create', [SiteController::class, 'create'])->name('site.create')/*->middleware('can:create,App\Models\User,App\Models\Site,""')*/
;
Route::post('business/create', [BusinessController::class, 'create'])->name('business.create')->middleware('can:create,App\Models\User,App\Models\Business,""');

Route::post('podcast/create', [PodcastController::class, 'create'])->name('podcast.create')->middleware('can:create,App\Models\User,App\Models\Podcast,""');

Route::post('video/create', [VideoController::class, 'create'])->name('video.create')->middleware('can:create,App\Models\User,App\Models\Video,""');

Route::post('banner/create', [BannerController::class, 'create'])->name('banner.create')->middleware('can:create,App\Models\User,App\Models\Banner,""');

Route::post('article/create', [ArticleController::class, 'create'])->name('article.create')->middleware('can:create,App\Models\User,App\Models\Article,""');


Route::middleware('throttle:6,1')->group(function () {
    Route::post('sms/send', [MainController::class, 'sendSms'])->name('sms.send.verification');

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('panel/site/search', [SiteController::class, 'searchPanel'])->name('panel.site.search');
    Route::get('panel/business/search', [BusinessController::class, 'searchPanel'])->name('panel.business.search');
    Route::get('panel/podcast/search', [PodcastController::class, 'searchPanel'])->name('panel.podcast.search');
    Route::get('panel/video/search', [VideoController::class, 'searchPanel'])->name('panel.video.search');
    Route::get('panel/banner/search', [BannerController::class, 'searchPanel'])->name('panel.banner.search');
    Route::get('panel/article/search', [ArticleController::class, 'searchPanel'])->name('panel.article.search');
    Route::get('panel/merged/search', [PanelController::class, 'searchMergedItems'])->name('panel.merged.search');


    Route::get('site/edit/{site}', [SiteController::class, 'edit'])->name('panel.site.edit');
    Route::patch('site/update', [SiteController::class, 'update'])->name('site.update');

    Route::get('business/edit/{business}', [BusinessController::class, 'edit'])->name('panel.business.edit');
    Route::patch('business/update', [BusinessController::class, 'update'])->name('business.update');

    Route::get('podcast/edit/{podcast}', [PodcastController::class, 'edit'])->name('panel.podcast.edit');
    Route::patch('podcast/update', [PodcastController::class, 'update'])->name('podcast.update');

    Route::get('video/edit/{video}', [VideoController::class, 'edit'])->name('panel.video.edit');
    Route::patch('video/update', [VideoController::class, 'update'])->name('video.update');

    Route::get('banner/edit/{banner}', [BannerController::class, 'edit'])->name('panel.banner.edit');
    Route::patch('banner/update', [BannerController::class, 'update'])->name('banner.update');

    Route::get('article/edit/{article}', [ArticleController::class, 'edit'])->name('panel.article.edit');
    Route::patch('article/update', [ArticleController::class, 'update'])->name('article.update');

});
Route::post('transaction/storesite', [\App\Http\Controllers\TransactionController::class, 'storeSite'])->name('transaction.site.view');

Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/make_money', [MainController::class, 'makeMoneyPage'])->name('page.make_money');
Route::get('/prices', [MainController::class, 'pricesPage'])->name('page.prices');
Route::get('/help', [MainController::class, 'helpPage'])->name('page.help');
Route::get('/contact_us', [MainController::class, 'contactUsPage'])->name('page.contact_us');
Route::get('/exchange', [ExchangeController::class, 'index'])->name('exchange.index');

Route::get('/sites', [SiteController::class, 'index'])->name('site.index');
Route::get('/site/search', [SiteController::class, 'search'])->name('site.search');
Route::get('site/{site}', [SiteController::class, 'view'])->name('site');

Route::get('/businesses', [BusinessController::class, 'index'])->name('business.index');
Route::get('/business/search', [BusinessController::class, 'search'])->name('business.search');
Route::get('business/{business}', [BusinessController::class, 'view'])->name('business');

Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcast.index');
Route::get('/podcast/search', [PodcastController::class, 'search'])->name('podcast.search');
Route::get('podcast/{podcast}', [PodcastController::class, 'view'])->name('podcast');

Route::get('/videos', [VideoController::class, 'index'])->name('video.index');
Route::get('/video/search', [VideoController::class, 'search'])->name('video.search');
Route::get('video/{video}', [VideoController::class, 'view'])->name('video');

Route::get('/banners', [BannerController::class, 'index'])->name('banner.index');
Route::get('/banner/search', [BannerController::class, 'search'])->name('banner.search');
Route::get('banner/{banner}', [BannerController::class, 'view'])->name('banner');

Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/search', [ArticleController::class, 'search'])->name('article.search');
Route::get('article/{article}', [ArticleController::class, 'view'])->name('article');

Route::get('language/{language}', function ($language) {
    session()->put('locale', $language);
    return;
})->name('language');

require __DIR__ . '/auth.php';

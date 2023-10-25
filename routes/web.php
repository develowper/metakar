<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\HireController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Helpers\Pay;
use App\Http\Helpers\SMSHelper;
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Util;
use App\Http\Helpers\Variable;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Business;
use App\Models\Category;
use App\Models\County;
use App\Models\Notification;
use App\Models\Podcast;
use App\Models\Province;
use App\Models\Setting;
use App\Models\Site;
use App\Models\User;
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

    return;
    return \Illuminate\Support\Facades\Artisan::call('store:transactions');
    return (new ArticleController())->search(new Request([]));
    return;
    return (new PanelController())->chartLogs(new Request(['user_id' => 1, 'dateFrom' => '1401/06/01', 'dateTo' => '1402/06/24']));
//    File::makeDirectory(Storage::path("public/sites"), $mode = 0755,);
//    return Telegram::log(null, 'site_created', Site::find(2));

});
Route::get('panel')->name('panel');
Route::get('storage')->name('storage');
Route::get('storage/sites')->name('storage.sites');
Route::get('storage/users')->name('storage.users');
Route::get('storage/businesses')->name('storage.businesses');
Route::get('storage/podcasts')->name('storage.podcasts');
Route::get('storage/videos')->name('storage.videos');
Route::get('storage/banners')->name('storage.banners');
Route::get('storage/articles')->name('storage.articles');
Route::get('storage/tickets')->name('storage.tickets');

Route::get('/', function (Request $request) {
    if ($r = $request->ref) {
        session(['ref' => $r]);
    }
    return Inertia::render('Main', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'heroText' => \App\Models\Setting::getValue('hero_main_page'),
        'counts' => [
            'users' => ['icon' => 'UsersIcon', 'count' => User::count()],
            'businesses' => ['icon' => 'HomeModernIcon', 'count' => Business::count()],
            'articles' => ['icon' => 'PencilIcon', 'count' => Article::count()],
            'sites' => ['icon' => 'GlobeAltIcon', 'count' => Site::count()],
            'podcasts' => ['icon' => 'MicrophoneIcon', 'count' => Podcast::count()],
            'videos' => ['icon' => 'PlayIcon', 'count' => Video::count()],
            'banners' => ['icon' => 'PhotoIcon', 'count' => Banner::count()],
        ]
    ]);
})->name('/');

Route::middleware(['auth', 'verified'])->prefix('panel')->group(function ($route) {


    Route::get('', [PanelController::class, 'index'])->name('panel.index');

    Route::post('transaction/chart', [PanelController::class, 'chartLogs'])->name('transaction.chart');


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
            'statuses' => Variable::STATUSES,
            'pay_amount' => number_format(Setting::getValue('article_register_price') ?? 0) . " " . __('currency'),
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

    PanelController::makeInertiaRoute('get', 'notification/index', 'panel.notification.index', 'Panel/Notification/Index',
        [

        ]
    );

    PanelController::makeInertiaRoute('get', 'ticket/index', 'panel.ticket.index', 'Panel/Ticket/Index',
        [
            'statuses' => Variable::TICKET_STATUSES

        ]);
    PanelController::makeInertiaRoute('get', 'ticket/create', 'panel.ticket.create', 'Panel/Ticket/Create',
        [
            'attachment_allowed_mimes' => implode(',.', Variable::TICKET_ATTACHMENT_ALLOWED_MIMES),
        ]);

    PanelController::makeInertiaRoute('get', 'auction/index', 'panel.auction.index', 'Panel/Auction/Index');
    PanelController::makeInertiaRoute('get', 'auction/create', 'panel.auction.create', 'Panel/Auction/Create');

    PanelController::makeInertiaRoute('get', 'transaction/index', 'panel.financial.transaction.index', 'Panel/Financial/Transaction/Index');

    PanelController::makeInertiaRoute('get', 'profile/edit', 'panel.profile.edit', 'Panel/Profile/Edit',
        [
            'accesses' => Variable::ACCESS
        ]);
    PanelController::makeInertiaRoute('get', 'password/edit', 'panel.profile.password.edit', 'Panel/Profile/PasswordEdit',
        [
        ]);

    PanelController::makeInertiaRoute('get', 'transfer/index', 'panel.transfer.index', 'Panel/Transfer/Index', [
        'statuses' => Variable::TRANSFER_STATUSES

    ]);
    PanelController::makeInertiaRoute('get', 'transfer/create', 'panel.transfer.create', 'Panel/Transfer/Create',
        [
            'types' => Variable::TRANSFER_TYPES
        ]
    );


    /**  Admin Panel **/
    Route::middleware(['can:create,App\Models\User,App\Models\User,""',])->prefix('admin')->group(function ($route) {

        Route::get('', [PanelController::class, 'admin'])->name('panel.admin.index');
        PanelController::makeInertiaRoute('get', 'setting/index', 'panel.admin.setting.index', 'Panel/Admin/Setting/Index',
            [

            ]);
        PanelController::makeInertiaRoute('get', 'user/index', 'panel.admin.user.index', 'Panel/Admin/User/Index',
            [
                'accesses' => Variable::ACCESS,

            ]);
        PanelController::makeInertiaRoute('get', 'notification/index', 'panel.admin.notification.index', 'Panel/Admin/Notification/Index',
            [

            ]);
        PanelController::makeInertiaRoute('get', 'notification/create', 'panel.admin.notification.create', 'Panel/Admin/Notification/Create',
            [

            ]);
        PanelController::makeInertiaRoute('get', 'review/index', 'panel.admin.review.index', 'Panel/Admin/Review/Index',
            [

            ]);
        PanelController::makeInertiaRoute('get', 'ticket/index', 'panel.admin.ticket.index', 'Panel/Ticket/Index',
            [
                'statuses' => Variable::TICKET_STATUSES

            ]);
        PanelController::makeInertiaRoute('get', 'ticket/create', 'panel.admin.ticket.create', 'Panel/Ticket/Create',
            [
                'attachment_allowed_mimes' => implode(',.', Variable::TICKET_ATTACHMENT_ALLOWED_MIMES),
            ]);

        PanelController::makeInertiaRoute('get', 'hire/index', 'panel.admin.hire.index', 'Panel/Hire/Index',
            [
                'statuses' => Variable::HIRE_STATUSES,
                'accesses' => Variable::ACCESS,
            ]);


        Route::get('setting/search', [SettingController::class, 'searchPanel'])->name('panel.admin.setting.search');
        Route::patch('setting/update', [SettingController::class, 'update'])->name('panel.admin.setting.update');
        Route::delete('setting/delete/{setting}', [SettingController::class, 'delete'])->name('panel.admin.setting.delete');
        Route::get('user/search', [UserController::class, 'searchPanel'])->name('panel.admin.user.search');
        Route::get('user/create', [UserController::class, 'new'])->name('panel.admin.user.new');
        Route::post('user/create', [UserController::class, 'create'])->name('panel.admin.user.create');
        Route::get('user/edit/{site}', [UserController::class, 'edit'])->name('panel.admin.user.edit');
        Route::patch('user/update', [UserController::class, 'update'])->name('panel.admin.user.update');
        Route::get('review/search', [PanelController::class, 'searchReviewItems'])->name('panel.admin.review.search');
        Route::get('ticket/{ticket}', [TicketController::class, 'edit'])->name('panel.admin.ticket.edit');
        Route::patch('ticket/update', [TicketController::class, 'update'])->name('panel.admin.ticket.update');
        Route::post('ticket/create', [TicketController::class, 'create'])->name('panel.admin.ticket.create');
        Route::get('notification/{notification}', [NotificationController::class, 'edit'])->name('panel.admin.notification.edit');
        Route::patch('notification/update', [NotificationController::class, 'update'])->name('panel.admin.notification.update');
        Route::post('notification/create', [NotificationController::class, 'create'])->name('panel.admin.notification.create');
        Route::get('hire/search', [HireController::class, 'searchPanel'])->name('panel.admin.hire.search');
        Route::patch('hire/update', [HireController::class, 'update'])->name('panel.admin.hire.update');


    });
});

Route::get('site/create', [SiteController::class, 'new'])->name('site.new');
Route::post('site/create', [SiteController::class, 'create'])->name('site.create')/*->middleware('can:create,App\Models\User,App\Models\Site,""')*/
;
Route::post('business/create', [BusinessController::class, 'create'])->name('business.create')->middleware('can:create,App\Models\User,App\Models\Business,""');

Route::post('podcast/create', [PodcastController::class, 'create'])->name('podcast.create')->middleware('can:create,App\Models\User,App\Models\Podcast,""');

Route::post('video/create', [VideoController::class, 'create'])->name('video.create')->middleware('can:create,App\Models\User,App\Models\Video,""');

Route::post('banner/create', [BannerController::class, 'create'])->name('banner.create')->middleware('can:create,App\Models\User,App\Models\Banner,""');

Route::post('article/create', [ArticleController::class, 'create'])->name('article.create')->middleware('can:create,App\Models\User,App\Models\Article,""');

Route::post('ticket/create', [TicketController::class, 'create'])->name('ticket.create')->middleware('can:create,App\Models\User,App\Models\Ticket,""');

Route::post('transfer/create', [TransferController::class, 'create'])->name('transfer.create')->middleware('can:create,App\Models\User,App\Models\Transfer,""');


Route::middleware('throttle:6,1')->group(function () {
    Route::post('sms/send', [MainController::class, 'sendSms'])->name('sms.send.verification');

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/reset-password', [ProfileController::class, 'resetPassword'])->name('profile.password.reset');

    Route::get('panel/site/search', [SiteController::class, 'searchPanel'])->name('panel.site.search');
    Route::get('panel/business/search', [BusinessController::class, 'searchPanel'])->name('panel.business.search');
    Route::get('panel/podcast/search', [PodcastController::class, 'searchPanel'])->name('panel.podcast.search');
    Route::get('panel/video/search', [VideoController::class, 'searchPanel'])->name('panel.video.search');
    Route::get('panel/banner/search', [BannerController::class, 'searchPanel'])->name('panel.banner.search');
    Route::get('panel/article/search', [ArticleController::class, 'searchPanel'])->name('panel.article.search');
    Route::get('panel/notification/search', [NotificationController::class, 'searchPanel'])->name('panel.notification.search');
    Route::get('panel/ticket/search', [TicketController::class, 'searchPanel'])->name('panel.ticket.search');
    Route::get('panel/merged/search', [PanelController::class, 'searchMergedItems'])->name('panel.merged.search');
    Route::get('panel/transfer/search', [TransferController::class, 'searchPanel'])->name('panel.transfer.search');


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

    Route::get('notification/edit/{notification}', [NotificationController::class, 'edit'])->name('panel.notification.edit');
    Route::patch('notification/update', [NotificationController::class, 'update'])->name('notification.update');
    Route::delete('notification/delete/{notification}', [NotificationController::class, 'delete'])->name('panel.admin.notification.delete');

    Route::get('ticket/{ticket}', [TicketController::class, 'edit'])->name('panel.ticket.edit');
    Route::patch('ticket/update', [TicketController::class, 'update'])->name('ticket.update');

    Route::post('payment/url', [PaymentController::class, 'makeUrl'])->name('payment.url');

    Route::get('transfer/edit/{transfer}', [TransferController::class, 'edit'])->name('panel.transfer.edit');
    Route::patch('transfer/update', [TransferController::class, 'update'])->name('transfer.update');

    Route::delete('transfer/delete/{transfer}', [TransferController::class, 'delete'])->name('panel.transfer.delete');
    Route::get('transfer/edit/{transfer}', [TransferController::class, 'edit'])->name('panel.transfer.edit');
    Route::patch('transfer/update', [TransferController::class, 'update'])->name('transfer.update');
    Route::post('transfer/transfer', [TransferController::class, 'transfer'])->name('transfer.transfer');

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

Route::get('/transfers', [TransferController::class, 'index'])->name('transfer.index');
Route::get('/transfer/search', [TransferController::class, 'search'])->name('transfer.search');
Route::get('transfer/show', [TransferController::class, 'show'])->name('transfer.show');
Route::get('transfer/{transfer}', [TransferController::class, 'view'])->name('transfer');

Route::get('/items', [ItemController::class, 'index'])->name('item.index');
Route::get('/items/search', [ItemController::class, 'search'])->name('item.search');
Route::get('item/{type}/{id}', [ItemController::class, 'view'])->name('item');
Route::post('transaction/storeitem', [TransactionController::class, 'storeItem'])->name('transaction.item.view');

Route::get('/project/create', [ProjectController::class, 'new'])->name('page.project.create');


Route::get('language/{language}', function ($language) {
    session()->put('locale', $language);
    return;
})->name('language');

Route::get('payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');


require __DIR__ . '/auth.php';

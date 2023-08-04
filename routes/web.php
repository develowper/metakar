<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ArticleController;
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
use App\Http\Helpers\Telegram;
use App\Http\Helpers\Variable;
use App\Models\Business;
use App\Models\Category;
use App\Models\County;
use App\Models\Province;
use App\Models\Setting;
use App\Models\Site;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return storage_path(Storage::allFiles("public/faker/sites")[0]);
//    File::makeDirectory(Storage::path("public/sites"), $mode = 0755,);
//    return Telegram::log(null, 'site_created', Site::find(2));

});

Route::get('storage')->name('storage');
Route::get('storage/sites')->name('storage.sites');
Route::get('storage/users')->name('storage.users');

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
    PanelController::makeInertiaRoute('get', 'business/index', 'panel.business.index', 'Panel/Business/Index');
    PanelController::makeInertiaRoute('get', 'article/index', 'panel.article.index', 'Panel/Business/Index');
    PanelController::makeInertiaRoute('get', 'article/create', 'panel.article.create', 'Panel/Business/Create');
    PanelController::makeInertiaRoute('get', 'site/index', 'panel.site.index', 'Panel/Site/Index', ['categories' => Site::categories('parents'), 'site_statuses' => Variable::SITE_STATUSES]);
    PanelController::makeInertiaRoute('get', 'site/create', 'panel.site.create', 'Panel/Site/Create', ['categories' => Site::categories('parents'),]);
    PanelController::makeInertiaRoute('get', 'text/index', 'panel.text.index', 'Panel/Text/Index');
    PanelController::makeInertiaRoute('get', 'text/create', 'panel.text.create', 'Panel/Text/Create');
    PanelController::makeInertiaRoute('get', 'image/index', 'panel.image.index', 'Panel/Image/Index');
    PanelController::makeInertiaRoute('get', 'image/create', 'panel.image.create', 'Panel/Image/Create');
    PanelController::makeInertiaRoute('get', 'video/index', 'panel.video.index', 'Panel/Video/Index');
    PanelController::makeInertiaRoute('get', 'video/create', 'panel.video.create', 'Panel/Video/Create');
    PanelController::makeInertiaRoute('get', 'podcast/index', 'panel.podcast.index', 'Panel/Podcast/Index');
    PanelController::makeInertiaRoute('get', 'podcast/create', 'panel.podcast.create', 'Panel/Podcast/Create');
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


Route::middleware('throttle:6,1')->group(function () {
    Route::post('sms/send', [MainController::class, 'sendSms'])->name('sms.send.verification');

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('panel/site/search', [SiteController::class, 'searchPanel'])->name('panel.site.search');


    Route::get('site/edit/{site}', [SiteController::class, 'edit'])->name('panel.site.edit');
    Route::patch('site/update', [SiteController::class, 'update'])->name('site.update');

});
Route::post('transaction/storesite', [\App\Http\Controllers\TransactionController::class, 'storeSite'])->name('transaction.site.view');

Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcast.index');
Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/videos', [VideoController::class, 'index'])->name('video.index');
Route::get('/businesses', [BusinessController::class, 'index'])->name('business.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/make_money', [MainController::class, 'makeMoneyPage'])->name('page.make_money');
Route::get('/prices', [MainController::class, 'pricesPage'])->name('page.prices');
Route::get('/help', [MainController::class, 'helpPage'])->name('page.help');
Route::get('/contact_us', [MainController::class, 'contactUsPage'])->name('page.contact_us');
Route::get('/exchange', [ExchangeController::class, 'index'])->name('exchange.index');
Route::get('/sites', [SiteController::class, 'index'])->name('site.index');
Route::get('/site/search', [SiteController::class, 'search'])->name('site.search');
Route::get('site/{site}', [SiteController::class, 'view'])->name('site');


Route::get('language/{language}', function ($language) {
    session()->put('locale', $language);
    return;
})->name('language');

require __DIR__ . '/auth.php';

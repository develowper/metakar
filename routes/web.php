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
use App\Models\Category;
use App\Models\Site;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

    return Category::findOrNew(2)->name;
});

Route::get('storage')->name('storage');
Route::get('storage/sites')->name('storage.sites');
Route::get('test', function () {
    return Inertia::render('Main', [
        'data' => dd(Telegram::log(null, 'site_created', Site::find(1)))
    ]);
});
Route::get('/', function () {
    return Inertia::render('Main', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'heroText' => \App\Models\Setting::getValue('hero_text'),

    ]);
})->name('/');

Route::middleware(['auth', 'verified'])->prefix('panel')->group(function () {


    Route::get('', [PanelController::class, 'index'])->name('panel.index');


    PanelController::makeInertiaRoute('get', 'business/create', 'panel.business.new', 'Panel/Business/Create');
    PanelController::makeInertiaRoute('get', 'business/index', 'panel.business.index', 'Panel/Business/Index');
    PanelController::makeInertiaRoute('get', 'article/index', 'panel.article.index', 'Panel/Business/Index');
    PanelController::makeInertiaRoute('get', 'article/new', 'panel.article.new', 'Panel/Business/Create');
    PanelController::makeInertiaRoute('get', 'site/index', 'panel.site.index', 'Panel/Site/Index');
    PanelController::makeInertiaRoute('get', 'site/new', 'panel.site.new', 'Panel/Site/Create', [
        'categories' => Site::categories('parents'),
    ]);
    PanelController::makeInertiaRoute('get', 'text/index', 'panel.text.index', 'Panel/Text/Index');
    PanelController::makeInertiaRoute('get', 'text/new', 'panel.text.new', 'Panel/Text/Create');
    PanelController::makeInertiaRoute('get', 'image/index', 'panel.image.index', 'Panel/Image/Index');
    PanelController::makeInertiaRoute('get', 'image/new', 'panel.image.new', 'Panel/Image/Create');
    PanelController::makeInertiaRoute('get', 'video/index', 'panel.video.index', 'Panel/Video/Index');
    PanelController::makeInertiaRoute('get', 'video/new', 'panel.video.new', 'Panel/Video/Create');
    PanelController::makeInertiaRoute('get', 'podcast/index', 'panel.podcast.index', 'Panel/Podcast/Index');
    PanelController::makeInertiaRoute('get', 'podcast/new', 'panel.podcast.new', 'Panel/Podcast/Create');
    PanelController::makeInertiaRoute('get', 'auction/index', 'panel.auction.index', 'Panel/Auction/Index');
    PanelController::makeInertiaRoute('get', 'auction/new', 'panel.auction.new', 'Panel/Auction/Create');
    PanelController::makeInertiaRoute('get', 'ticket/index', 'panel.ticket.index', 'Panel/Ticket/Index');
    PanelController::makeInertiaRoute('get', 'ticket/new', 'panel.ticket.new', 'Panel/Ticket/Create');
    PanelController::makeInertiaRoute('get', 'transaction/index', 'panel.financial.transaction.index', 'Panel/Financial/Transaction/Index');


});


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('site/create', [SiteController::class, 'create'])->name('site.create')->middleware('can:create,App\Models\User,App\Models\Site,""');
    Route::get('site/search', [SiteController::class, 'search'])->name('site.search');
});

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


Route::get('language/{language}', function ($language) {
    session()->put('locale', $language);
    return;
})->name('language');

require __DIR__ . '/auth.php';

<?php

namespace App\Http\Helpers;

use App\Models\Article;
use App\Models\ArticleTransaction;
use App\Models\Banner;
use App\Models\BannerTransaction;
use App\Models\Business;
use App\Models\BusinessTransaction;
use App\Models\Podcast;
use App\Models\PodcastTransaction;
use App\Models\Setting;
use App\Models\Site;
use App\Models\SiteTransaction;
use App\Models\Text;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Hash;

class Variable
{
    const LANGS = ['fa', 'en', 'ar'];

    const MARKETS = ['bazaar', 'myket', 'playstore', 'site'];
    const GATEWAYS = ['bazaar', 'myket', 'nextpay'];
    const MODELS = [User::class => 1, Business::class => 2, Site::class => 3,];
    const ROLES = ['us', 'ad', 'go', 'op'];
    const  TICKET_STATUSES = [
        ["name" => 'review', "color" => 'danger'],
        ["name" => 'closed', "color" => 'gray'],
        ["name" => 'responded', "color" => 'success'],
    ];
    const CATEGORIES = [
        ['name' => 'industry_mining',],
        ['name' => 'estate',],
        ['name' => 'trading',],
        ['name' => 'business',],
        ['name' => 'it',],
        ['name' => 'tutorial',],
        ['name' => 'car',],
        ['name' => 'personal_stuff',],
        ['name' => 'home_stuff',],
        ['name' => 'employment',],
        ['name' => 'agriculture',],
        ['name' => 'wearing',],
        ['name' => 'travel_entertainment',],
        ['name' => 'legal',],

    ];

    const ACCESS = [
        ['name' => 'marketer', 'role' => 'm', 'access' => null],
        ['name' => 'video_editor', 'role' => 'v', 'access' => 'video'],
        ['name' => 'podcast_narrator', 'role' => 'p', 'access' => 'podcast'],
        ['name' => 'banner_designer', 'role' => 'b', 'access' => 'banner'],
        ['name' => 'article_creator', 'role' => 'a', 'access' => 'article'],
        ['name' => 'text_creator', 'role' => 't', 'access' => 'text'],
    ];
    const SUCCESS_STATUS = 200;
    const ERROR_STATUS = 422;

    const DATA_TRANSACTION_TYPES = ['view', 'transfer'];
    const REF_TYPES = ['register',];
    const BANK_GATEWAY = 'nextpay';
    const BANNER_IMAGE_LIMIT_MB = 10;
    const TICKET_ATTACHMENT_MAX_LEN = 5;
    const TICKET_ATTACHMENT_ALLOWED_MIMES = ['jpeg', 'jpg', 'png', 'txt', 'pdf'];
    const BANNER_ALLOWED_MIMES = ['jpeg', 'jpg', 'png'];
    const SITE_IMAGE_LIMIT_MB = 4;
    const BUSINESS_IMAGE_LIMIT = 4;

    const MIN_SELL_PRICE = 5000;
    const SITE_ALLOWED_MIMES = ['jpeg', 'jpg', 'png'];
    const PODCAST_ALLOWED_MIMES = ['mp3', 'mpga'];
    const VIDEO_ALLOWED_MIMES = ['mp4',];
    const LOGS = [72534783];
    const PAGINATE = [24, 50, 100];
    const IMAGE_FOLDERS = [
        Site::class => 'sites',
        Business::class => 'businesses',
        Podcast::class => 'podcasts',
        Video::class => 'videos',
        Banner::class => 'banners',
        Article::class => 'articles',
        Ticket::class => 'tickets',
        User::class => 'users',
    ];
    const NOTIFICATION_TYPES = [
        "business_approve",
        "business_reject",
        "site_approve",
        "site_reject",
        "text_approve",
        "text_reject",
        "article_approve",
        "article_reject",
        "banner_approve",
        "banner_reject",
        "video_approve",
        "video_reject",
        "podcast_approve",
        "podcast_reject",
        "pay",
        "access_change",
        "ticket_answer"
    ];
    const PROJECT_ITEMS = [
        ['name' => 'podcast', 'color' => 'sky',],
        ['name' => 'video', 'color' => 'purple',],
        ['name' => 'banner', 'color' => 'orange',],
        ['name' => 'text', 'color' => 'rose',]

    ];
    const DATA_TYPES = [
        Site::class => 'site',
        Business::class => 'business',
        Podcast::class => 'podcast',
        Video::class => 'video',
        Banner::class => 'banner',
        Article::class => 'article',
        Text::class => 'text',

    ];
    const TRANSACTION_TYPES = [
        SiteTransaction::class => 'site',
        BusinessTransaction::class => 'business',
        PodcastTransaction::class => 'podcast',
        VideoTransaction::class => 'video',
        BannerTransaction::class => 'banner',
        ArticleTransaction::class => 'article',

    ];

    const TRANSFER_TYPES = [
        'regular',
        'private',
        'auction',

    ];
    const HIRE_STATUSES = [
        ["name" => 'review', "color" => 'primary'],
        ["name" => 'done', "color" => 'gray'],

    ];
    const TRANSFER_STATUSES = [
        ["name" => 'active', "color" => 'success'],
        ["name" => 'inactive', "color" => 'danger'],
        ["name" => 'done', "color" => 'gray'],
        ["name" => 'expire', "color" => 'danger'],

    ];
    const PROJECT_STATUSES = [
        ["name" => 'order', "color" => 'success'],
        ["name" => 'review', "color" => 'danger'],
        ["name" => 'progress', "color" => 'primary'],
        ["name" => 'pay', "color" => 'danger'],
        ["name" => 'cancel', "color" => 'gray'],
        ["name" => 'done', "color" => 'gray'],

    ];
    const OPERATOR_STATUSES = [
        ["name" => 'done', "color" => 'success'],
        ["name" => 'progress', "color" => 'primary'],
        ["name" => 'review', "color" => 'danger'],
        ["name" => 'cancel', "color" => 'danger'],
        ["name" => 'pay', "color" => 'danger'],

    ];
    const SITE_STATUSES = [
        ["name" => 'inactive', "color" => 'danger'],
        ["name" => 'need_charge', "color" => 'orange'],
        ["name" => 'reject', "color" => 'danger'],
        ["name" => 'ready', "color" => 'primary'],
        ["name" => 'view', "color" => 'success'],
        ["name" => 'block', "color" => 'gray'],
        ["name" => 'review', "color" => 'gray'],
    ];
    const BUSINESS_STATUSES = [
        ["name" => 'active', "color" => 'success'],
        ["name" => 'inactive', "color" => 'danger'],
        ["name" => 'need_charge', "color" => 'orange'],
        ["name" => 'reject', "color" => 'danger'],
        ["name" => 'block', "color" => 'gray'],
        ["name" => 'review', "color" => 'gray'],
    ];
    const  STATUSES = [
        ["name" => 'active', "color" => 'success'],
        ["name" => 'inactive', "color" => 'danger'],
        ["name" => 'need_charge', "color" => 'orange'],
        ["name" => 'reject', "color" => 'danger'],
        ["name" => 'block', "color" => 'gray'],
        ["name" => 'review', "color" => 'gray'],
    ];
    const NOTIFICATION_LIMIT = 5;

    static function getAdmins()
    {
        return [
            ['id' => 1, 'fullname' => 'حسن نژاد', 'phone' => '09132258738', 'telegram_id' => '1021078930', 'wallet_active' => false,
                'role' => 'us', 'email' => 'jafar.hasannejhad@gmail.com', 'password' => Hash::make('o9132258738'), 'email_verified_at' => Carbon::now(), 'created_at' => Carbon::now(), 'phone_verified' => true, 'ref_id' => 'metakar'
            ],
            ['id' => 2, 'fullname' => 'رجبی', 'phone' => '09018945844', 'telegram_id' => '72534783', 'wallet_active' => false,
                'role' => 'ad', 'email' => 'moj2raj2@gmail.com', 'password' => Hash::make('o7615564351'), 'email_verified_at' => Carbon::now(), 'created_at' => Carbon::now(), 'phone_verified' => true, 'ref_id' => 'develowper'
            ],
        ];
    }

    static function getSettings()
    {
        return [
            ['key' => 'hero_main_page', 'value' => __('hero_main_page'), "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'site_view_seconds', 'value' => 60, "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'site_min_view_fee', 'value' => 100, "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'iran_wallet', 'value' => 0, "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'auction_price_step', 'value' => 50000, "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'site_view_cp', 'value' => 20, "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'sell_cp', 'value' => 20, "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'register_c', 'value' => 2000, "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'article_register_price', 'value' => 500000, "created_at" => \Carbon\Carbon::now(),],

        ];
    }

    static function MIN_VIEW_FEE($type)
    {
        if ($type)
            return Setting::firstOrNew(['key' => "{$type}_min_view_fee"])->value ?? 100;
    }

    static function SITE_VIEW_META_FEE()
    {
        return 1;
        return Setting::firstOrNew(['key' => 'site_view_meta_fee'])->value ?? 1;
    }

    static function SITE_VIEW_META_REWARD()
    {
        return 2;
        return Setting::firstOrNew(['key' => 'site_view_meta_reward'])->value ?? 2;
    }

    static function SITE_VIEW_REWARD_SECOND()
    {
//        return 5;
        return Setting::firstOrNew(['key' => 'site_view_seconds'])->value ?? 60;
    }


}

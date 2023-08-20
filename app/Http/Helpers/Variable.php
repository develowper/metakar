<?php

namespace App\Http\Helpers;

use App\Models\Banner;
use App\Models\Business;
use App\Models\Podcast;
use App\Models\Setting;
use App\Models\Site;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Hash;

class Variable
{
    const LANGS = ['fa', 'en', 'ar'];
    const MODELS = [User::class => 1, Business::class => 2, Site::class => 3,];
    const ROLES = ['us', 'ad', 'go',];
    const  TICKET_STATUSES = ['در حال بررسی', 'بسته شده', 'پاسخ داده شده'];
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

    const SUCCESS_STATUS = 200;
    const ERROR_STATUS = 422;


    const BANNER_IMAGE_LIMIT_MB = 10;
    const BANNER_ALLOWED_MIMES = ['jpeg', 'jpg', 'png'];
    const SITE_IMAGE_LIMIT_MB = 4;
    const BUSINESS_IMAGE_LIMIT = 4;
    const SITE_ALLOWED_MIMES = ['jpeg', 'jpg', 'png'];
    const PODCAST_ALLOWED_MIMES = ['mp3', 'mpga'];
    const VIDEO_ALLOWED_MIMES = ['mp4',];
    const LOGS = [72534783];
    const PAGINATE = [24, 50, 100];
    const IMAGE_FOLDERS = [Site::class => 'sites', Business::class => 'businesses', Podcast::class => 'podcasts', Video::class => 'videos', Banner::class => 'banners',];
    const SITE_STATUSES = [
        ["name" => 'inactive', "color" => 'danger'],
        ["name" => 'need_charge', "color" => 'orange'],
        ["name" => 'ready', "color" => 'primary'],
        ["name" => 'view', "color" => 'success'],
        ["name" => 'block', "color" => 'gray'],
        ["name" => 'review', "color" => 'gray'],
    ];
    const BUSINESS_STATUSES = [
        ["name" => 'active', "color" => 'success'],
        ["name" => 'inactive', "color" => 'danger'],
        ["name" => 'block', "color" => 'gray'],
        ["name" => 'review', "color" => 'gray'],
    ];
    const  STATUSES = [
        ["name" => 'active', "color" => 'success'],
        ["name" => 'inactive', "color" => 'danger'],
        ["name" => 'block', "color" => 'gray'],
        ["name" => 'review', "color" => 'gray'],
    ];

    static function getAdmins()
    {
        return [
            ['id' => 1, 'fullname' => 'رجبی', 'phone' => '09018945844', 'telegram_id' => '72534783', 'wallet_active' => false,
                'role' => 'us', 'email' => 'moj2raj2@gmail.com', 'password' => Hash::make('o7615564351'), 'email_verified_at' => Carbon::now(), 'phone_verified_at' => Carbon::now(), 'ref_id' => 'develowper'
            ],
            ['id' => 2, 'fullname' => 'حسن نژاد', 'phone' => '09132258738', 'telegram_id' => '1021078930', 'wallet_active' => false,
                'role' => 'us', 'email' => 'jafar.hasannejhad@gmail.com', 'password' => Hash::make('o9132258738'), 'email_verified_at' => Carbon::now(), 'phone_verified_at' => Carbon::now(), 'ref_id' => 'metakar'
            ],
        ];
    }

    static function SITE_MIN_VIEW_FEE()
    {
        return Setting::firstOrNew(['key' => 'site_min_view_fee'])->value ?? 100;
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
        return 5;
        return Setting::firstOrNew(['key' => 'site_view_reward_second'])->value ?? 30;
    }


}

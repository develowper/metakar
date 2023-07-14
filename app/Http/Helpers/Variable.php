<?php

namespace App\Http\Helpers;

use App\Models\Business;
use App\Models\Site;
use App\Models\User;
use Carbon\Carbon;
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

    ];
    const SITE_IMAGE_LIMIT_MB = 4;
    const SITE_ALLOWED_MIMES = ['jpeg', 'jpg', 'png'];
    const LOGS = [72534783];
    const IMAGE_FOLDERS = [Site::class => 'sites'];

    static function getAdmins()
    {
        return [
            ['id' => 1, 'fullname' => 'رجبی', 'phone' => '09018945844', 'telegram_id' => '72534783',
                'role' => 'us', 'email' => 'moj2raj2@gmail.com', 'password' => Hash::make('o7615564351'), 'email_verified_at' => Carbon::now(), 'phone_verified_at' => Carbon::now(), 'ref_id' => 'develowper'
            ],
            ['id' => 2, 'fullname' => 'حسن نژاد', 'phone' => '09132258738', 'telegram_id' => '1021078930',
                'role' => 'us', 'email' => 'jafar.hasannejhad@gmail.com', 'password' => Hash::make('o9132258738'), 'email_verified_at' => Carbon::now(), 'phone_verified_at' => Carbon::now(), 'ref_id' => 'metakar'
            ],
        ];
    }


}

<?php

namespace App\Http\Helpers;

use App\Models\Business;
use App\Models\User;

class Variable
{
    const LANGS = ['fa', 'en', 'ar'];
    const MODELS = [User::class => 1, Business::class => 2];
    const ROLES = ['us', 'ad', 'go',];

}

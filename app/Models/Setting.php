<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    public static function getValue(string $key)
    {

        $val = \App\Models\Setting::where(['key' => $key, 'lang' => app()->getLocale()])->firstOrNew()->value;
        if (!$val)
            $val = \App\Models\Setting::where(['key' => $key,])->firstOrNew()->value;
        return $val;
    }
}

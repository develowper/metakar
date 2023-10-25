<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fullname',
        'phone',
        'owner_id',
        'status',
        'access_request',
        'access_result',
        'created_at',
        'updated_at',
    ];

    public static function isEdited($access, $newAccess)
    {

        $access = is_array($access) ? $access : (explode(',', $access ?? '') ?: []);
        $newAccess = is_array($newAccess) ? $newAccess : (explode(',', $newAccess ?? '') ?: []);

        if (count($access) != count($newAccess)) return true;
        foreach ($newAccess as $item) {
            if (!in_array($item, $access))
                return true;
        }

        return false;
    }
}

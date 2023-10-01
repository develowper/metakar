<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Helpers\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use function App\Helpers\randomString;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'fullname',
        'email',
        'email_verified_at',
        'phone',
        'phone_verified',
        'ref_id',
        'push_id',
        'telegram_id',
        'eitaa_id',
        'bale_id',
        'soroush_id',
        'is_active',
        'is_block',
        'wallet_active',
        'password',
        'role',
        'card',
        'notifications',
        'wallet',
        'meta_wallet',
        'settings',
        'expires_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'is_block' => 'boolean',
        'wallet_active' => 'boolean',
    ];

    public static function makeRefCode()
    {
        $original = implode("", array_merge(range(0, 9), range('a', 'z')));


        $ref = Util::randomString(5, $original);
        for ($i = 5; $i <= 10; $i++) {
            for ($j = 0; $j < 100; $j++) {
                if (User::where('ref_id', $ref)->exists())
                    $ref = Util::randomString($i, $original);
                else
                    break;
            }
            if ($j < 100)
                break;
        }
        return $ref;
    }

    public function isAdmin()
    {
        return in_array($this->role, ['go', 'ad',]);
    }


}

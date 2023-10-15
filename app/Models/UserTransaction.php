<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'user_transactions';
    protected $fillable = [
        'owner_id',
        'ip',
        'view',
        'sum',
        'sum_meta',
        'date',
    ];
    protected $casts = [
        'is_meta' => 'boolean',
    ];

    public static function firstOrCreate($ip, $userId, $date = null)
    {
        if (!$date)
            $date = Carbon::now(/*'Asia/Tehran'*/)->setTime(0, 0);

        $q = UserTransaction::query()->where('date', $date);
        $q->where(function ($q) use ($ip, $userId) {
            if ($ip)
                $q->orWhere('ip', $ip);
            if ($userId)
                $q->orWhere('owner_id', $userId);
        });

        $storeUser = $q->first();

        if (!$storeUser)
            $storeUser = UserTransaction::create(['date' => $date, 'ip' => $ip, 'user_id' => $userId]);
        if ($ip && !$storeUser->ip)
            $storeUser->ip = $ip;
        if ($userId && !$storeUser->owner_id)
            $storeUser->owner_id = $userId;

        return $storeUser;
    }


}

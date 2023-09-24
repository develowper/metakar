<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;


    public $timestamps = true;
    protected $table = 'payments';
    protected $fillable = [
        'id',
        'owner_id',
        'title',
        'transaction_id',
        'order_id',
        'type',
        'market',
        'gateway',
        'coupon',
        'info',
        'amount',
        'is_success',

    ];
    protected $casts = [

    ];
}

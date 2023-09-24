<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'site_transactions';
    protected $fillable = [
        'ip',
        'title',
        'type',
        'is_meta',
        'owner_id',
        'ip',
        'data_id',
        'amount',
    ];
    protected $casts = [
        'is_meta' => 'boolean',
    ];


}

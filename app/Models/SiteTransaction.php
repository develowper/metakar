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
        'title',
        'is_meta',
        'owner_id',
        'site_id',
        'amount',
    ];
    protected $casts = [

    ];


}

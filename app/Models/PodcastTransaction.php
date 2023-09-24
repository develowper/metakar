<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'podcast_transactions';
    protected $fillable = [
        'ip',
        'title',
        'type',
        'is_meta',
        'owner_id',
        'data_id',
        'amount',
    ];
    protected $casts = [
        'is_meta' => 'boolean',
    ];
}

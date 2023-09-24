<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'data_transactions';
    protected $fillable = [
        'data_id',
        'data_type',
        'owner_id',
        'sum',
        'sum_meta',
        'view',
        'viewer',
        'date',
    ];
    protected $casts = [
        'is_meta' => 'boolean',
    ];
}

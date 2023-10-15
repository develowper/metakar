<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status',
        'type',
        'price',
        'item_id',
        'item_name',
        'item_type',
        'owner_id',
        'expires_at',
        'done_at',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function auction()
    {
        return $this->hasMany(Auction::class, 'transfer_id')->orderBy('price', 'DESC');
    }
}

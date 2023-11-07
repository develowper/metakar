<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project_id',
        'operator_id',
        'price',
        'status',
        'item_id',
        'item_type',
        'expires_at',
        'payed_at',
        'created_at',
        'updated_at',
        'chats',
    ];
}

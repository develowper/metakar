<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'id',
        'name',
        'description',
        'owner_id',
        'operators', // [id,role,status,commission,]
        'status',
        'price',
        'data_id',
        'data_type',
        'created_at',
        'updated_at',
    ];
}

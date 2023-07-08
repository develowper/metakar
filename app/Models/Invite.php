<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public $timestamps = false;
    protected $table = 'invites';
    protected $fillable = [
        'inviter_id', 'invited_id'
    ];
}

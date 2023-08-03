<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'slug',
        'tags',
        'link',
        'lang',
        'category_id',
        'description',
        'owner_id',
        'views',
        'status',
        'charge',
        'view_fee',
        'is_active',
        'is_blocked',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_blocked' => 'boolean',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public static function categories(string $type = 'parents')
    {
        switch ($type) {
            case    'parents':
                return Category::select('id', 'name')->where('parent_id', null)->get();
            default:
                return [];
        }
    }
}

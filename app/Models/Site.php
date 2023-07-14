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
    ];

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

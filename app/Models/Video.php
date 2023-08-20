<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'lang',
        'slug',
        'owner_id',
        'category_id',
        'name',
        'narrator',
        'duration',
        'description',
        'tags',
        'view',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
//        'province_id' => 'string',
//        'county_id' => 'string',
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

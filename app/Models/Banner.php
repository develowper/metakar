<?php

namespace App\Models;

use App\Http\Helpers\Variable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'lang',
        'slug',
        'owner_id',
        'category_id',
        'article_id',
        'name',
        'designer',
        'description',
        'tags',
        'view',
        'viewer',
        'charge',
        'view_fee',
        'meta',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function projectItem()
    {
        return $this->hasOne(ProjectItem::class, 'item_id')->where('item_type', 'banner');
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

    public static function getFileLink($id)
    {
        if (!$id) return null;
        $path = File::glob(Storage::path("public/" . Variable::IMAGE_FOLDERS[Banner::class]) . "/$id.*") ?? [];
        if (count($path) > 0)
            return route('storage.banners') . '/' . basename($path[0]);
        return null;


    }
}

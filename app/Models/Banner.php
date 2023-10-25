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
        return route('storage.banners') . '/' . basename((File::glob(Storage::path("public/" . Variable::IMAGE_FOLDERS[Banner::class]) . "/1.*") ?? [])[0]);


    }
}

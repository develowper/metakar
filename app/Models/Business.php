<?php

namespace App\Models;

use App\Http\Helpers\Variable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Business extends Model
{
    use HasFactory;

//    protected $appends = ['images'];
    protected $fillable = [
        'id',
        'lang',
        'slug',
        'owner_id',
        'category_id',
        'province_id',
        'county_id',
        'name',
        'description',
        'phone',
        'email',
        'email_verified_at',
        'tags',
        'socials',
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

    public static function getImages($id)
    {

        $images = array_fill(0, Variable::BUSINESS_IMAGE_LIMIT, null);
        if (!$id) return $images;
        $allFiles = Storage::allFiles("public/" . Variable::IMAGE_FOLDERS[Business::class] . "/$id");
        foreach ($allFiles as $idx => $path) {
            $images[$idx] = route('storage.businesses') . "/$id/" . basename($path, ""); //suffix=format
        }

        return $images;
    }

}

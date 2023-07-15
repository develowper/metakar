<?php

namespace App\Http\Helpers;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Util
{

    static function createImage($img, $type, $name)
    {

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        if (!Storage::exists("public/$type")) {
            File::makeDirectory(Storage::path("public/$type"), $mode = 0755,);
        }
        $source = imagecreatefromstring($image_base64);
//        imagetruecolortopalette($source, false, 16);
        $imageSave = imagejpeg($source, storage_path("app/public/$type/$name.jpg"), 80);
        imagedestroy($source);
        return $imageSave;
        return "/storage/$type/$name.jpg";
//        file_put_contents(storage_path("app/public/$type_id/$image->id.jpg"), $image_base64);


    }

    static function validate_base64($base64data, array $allowedMime)
    {


        // strip out data uri scheme information (see RFC 2397)
        if (strpos($base64data, ';base64') !== false) {
            list(, $base64data) = explode(';', $base64data);
            list(, $base64data) = explode(',', $base64data);
        }

        // strict mode filters for non-base64 alphabet characters
        if (base64_decode($base64data, true) === false) {
            return false;
        }

        // decoding and then reeconding should not change the data
        if (base64_encode(base64_decode($base64data)) !== $base64data) {
            return false;
        }

        $binaryData = base64_decode($base64data);

        // temporarily store the decoded data on the filesystem to be able to pass it to the fileAdder

        $tmpFile = tempnam(sys_get_temp_dir(), 'medialibrary');
//    $tmpFile = tmpfile();
//    $path = stream_get_meta_data($tmpFile)['uri'];
        file_put_contents($tmpFile, $binaryData);

        // guard Against Invalid MimeType
        $allowedMime = array_flatten($allowedMime);

        // no allowedMimeTypes, then any type would be ok
        if (empty($allowedMime)) {
            return true;
        }

        // Check the MimeTypes
        $validation = Validator::make(
            ['file' => new  File($tmpFile)],
            ['file' => 'mimes:' . implode(',', $allowedMime)]
        );

        $res = !$validation->fails();

        unlink($tmpFile);

        return $res;
    }

    static function e2f($str)
    {
        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $per = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return str_replace($eng, $per, $str);
    }

    static function f2e($str)
    {
        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $per = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return str_replace($per, $eng, $str);
    }

    static function array_flatten($array, $depth = INF): array
    {
        return Arr::flatten($array, $depth);
    }

    static function randomString($length = 5, $original)
    {
        return substr(str_shuffle($original), 0, $length);
    }

    static function wipeCaches()
    {
        $exitCode = Artisan::call('cache:clear');
        echo 'cache:clear ' . "$exitCode | " . PHP_EOL;
        $exitCode = Artisan::call('route:clear');
        echo 'route:clear ' . "$exitCode | " . PHP_EOL;
        $exitCode = Artisan::call('view:clear');
        echo 'view:clear ' . "$exitCode | " . PHP_EOL;
//    $exitCode = Artisan::call('view:cache');
//    echo 'view:cache' . "$exitCode | "  . PHP_EOL;
//    $exitCode = Artisan::call('route:cache');
//    echo 'route:cache' . "$exitCode | "  . PHP_EOL;
        $exitCode = Artisan::call('config:clear');
        echo 'config:clear ' . "$exitCode | " . PHP_EOL;
//    $exitCode = Artisan::call('config:cache');
//    echo 'config:cache' . "$exitCode | "  . PHP_EOL;
        $exitCode = Artisan::call('optimize');
        echo 'optimize ' . "$exitCode | " . PHP_EOL;

    }
}

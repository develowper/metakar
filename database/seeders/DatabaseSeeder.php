<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Business;
use App\Models\Category;
use App\Models\County;
use App\Models\Doc;
use App\Models\Podcast;
use App\Models\Site;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    private \Faker\Generator $faker;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create('fa_IR');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->createSites(50);
        $this->createBusinesses(50);
        $this->createPodcasts(50);
        $this->createVideos(50);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    private function createVideos($count = 30)
    {
        File::deleteDirectory("storage/app/public/videos");
        File::makeDirectory("storage/app/public/videos");
        DB::table('videos')->truncate();

        for ($i = 0; $i < $count; $i++) {

            $name = $this->faker->company;
            $data = Video::create([
                'name' => $name,
                'slug' => str_slug($name),
                'duration' => $this->faker->numberBetween(60, 250),
                'status' => $this->faker->randomElement(["active", "active", "active", "review"]),
                'owner_id' => $this->faker->numberBetween(1, 2),
                'category_id' => $this->faker->randomElement(Category::pluck('id')),
                'view' => 0,
                'lang' => 'fa',
                'description' => $this->faker->realText($this->faker->numberBetween(200, 1024)),
                'created_at' => Carbon::now(),
                'tags' => implode(",", $this->faker->randomElements(["ویدیو", "بازدید", "صدا", "تست", "تصویر", "ویدیو",], $this->faker->numberBetween(0, 5))),
            ]);
            $this->makeFile("videos", $data->id);
            $this->makeFile("videos", $data->id, '.mp4');
        }
    }

    private function createPodcasts($count = 30)
    {
        File::deleteDirectory("storage/app/public/podcasts");
        File::makeDirectory("storage/app/public/podcasts");
        DB::table('podcasts')->truncate();

        for ($i = 0; $i < $count; $i++) {

            $name = $this->faker->company;
            $data = Podcast::create([
                'name' => $name,
                'narrator' => $this->faker->name,
                'slug' => str_slug($name),
                'duration' => $this->faker->numberBetween(60, 250),

                'status' => $this->faker->randomElement(["active", "active", "active", "review"]),
                'owner_id' => $this->faker->numberBetween(1, 2),
                'category_id' => $this->faker->randomElement(Category::pluck('id')),
                'view' => 0,
                'lang' => 'fa',
                'description' => $this->faker->realText($this->faker->numberBetween(200, 1024)),
                'created_at' => Carbon::now(),
                'tags' => implode(",", $this->faker->randomElements(["پادکست", "بازدید", "صدا", "تست", "گوینده", "پادکست",], $this->faker->numberBetween(0, 5))),
            ]);
            $this->makeFile("podcasts", $data->id);
            $this->makeFile("podcasts", $data->id, '.mp3');
        }
    }

    private function createBusinesses($count = 30)
    {
        File::deleteDirectory("storage/app/public/businesses");
        File::makeDirectory("storage/app/public/businesses");

        DB::table('businesses')->truncate();
        $socials = [
            ['name' => 'تلگرام', 'value' => 't.me/develowper',],
            ['name' => 'ایتا', 'value' => 'eitaa.com/vartastudio',],
            ['name' => 'واتساپ', 'value' => 'wa.me/00989398793845',],
            ['name' => 'ایمیل', 'value' => 'moj2raj2@gmail.com',],
        ];
        for ($i = 0; $i < $count; $i++) {

            $name = $this->faker->company;
            $county = County::inRandomOrder()->first();

            $data = Business::create([
                'owner_id' => $this->faker->numberBetween(1, 2),
                'category_id' => $this->faker->randomElement(Category::pluck('id')),
                'province_id' => $county->province_id,
                'county_id' => $county->id,
                'name' => $name,
                'slug' => str_slug($name),
                'description' => $this->faker->realText($this->faker->numberBetween(200, 1024)),
                'phone' => $this->faker->numerify("09#########"),
                'tags' => implode(",", $this->faker->randomElements(["سایت", "بازدید", "تگ", "تست", "خدمات", "افزایش",], $this->faker->numberBetween(0, 5))),
                'status' => $this->faker->randomElement(["active", "active", "active", "review", "inactive"]),
                'lang' => 'fa',
                'view' => 0,
                'socials' => json_encode($this->faker->randomElements($socials, $this->faker->numberBetween(0, 4))),
                'created_at' => Carbon::now(),
            ]);
            $this->makeGallery("businesses", $data->id);
        }
    }

    private function createSites($count = 30)
    {
        File::deleteDirectory("storage/app/public/sites");
        File::makeDirectory("storage/app/public/sites");
        DB::table('sites')->truncate();

        for ($i = 0; $i < $count; $i++) {

            $name = $this->faker->company;
            $data = Site::create([
                'name' => $name,
                'slug' => str_slug($name),
                'link' => $this->faker->url(),

                'status' => $this->faker->randomElement(["view", "view", "view", "ready"]),
                'meta' => $this->faker->numberBetween(0, 5),
                'owner_id' => $this->faker->numberBetween(1, 2),
                'category_id' => $this->faker->randomElement(Category::pluck('id')),
                'view' => 0,
                'viewer' => 0,
                'charge' => $this->faker->numerify("####00"),
                'view_fee' => $this->faker->numerify("##0"),
                'lang' => 'fa',
                'description' => $this->faker->realText($this->faker->numberBetween(200, 1024)),
                'created_at' => Carbon::now(),
                'tags' => implode(",", $this->faker->randomElements(["سایت", "بازدید", "تگ", "تست", "خدمات", "افزایش",], $this->faker->numberBetween(0, 5))),
            ]);
            $this->makeFile("sites", $data->id);
        }
    }

    private function makeFile($type, $id, $extension = '.jpg')
    {
        $allFiles = array_filter(Storage::allFiles("public/faker/$type"), fn($e) => str_contains($e, $extension));

        $path = storage_path('app/' . $allFiles[array_rand($allFiles)]);
        //profile picture
        $file = new UploadedFile(
            $path,
            File::name($path) . "$extension"/* '.' . File::extension($path)*/,
            File::mimeType($path),
            null,
            true

        );

        if (!File::exists("storage/app/public/$type")) {
//            Storage::makeDirectory("public/$type", 766);
            File::makeDirectory(Storage::path("public/$type"), $mode = 0755,);
        }

        copy($file->path(), (storage_path("app/public/$type/") . "$id$extension" /*. $file->extension()*/));

    }

    private function makeGallery($type, $id)
    {
        $fakeFiles = Storage::allFiles("public/faker/$type");
        if (!File::exists("storage/app/public/$type/$id")) {
//            Storage::makeDirectory("public/$type", 766);
            File::makeDirectory(Storage::path("public/$type/$id"), $mode = 0755,);
        }
        $rand = [1, 2, 3, 4][array_rand([1, 2, 3, 4])];

        for ($i = 0; $i < $rand; $i++) {

            $path = storage_path('app/' . $fakeFiles[array_rand($fakeFiles)]);

            //profile picture
            $file = new UploadedFile(
                $path,
                File::name($path) . '.' . File::extension($path),
                File::mimeType($path),
                null,
                true

            );
            $name = 1;
            $allFiles = Storage::allFiles("public/businesses/$id");

            foreach ($allFiles as $path) {
                if (str_contains($path, "/$name.jpg")) {
                    $name++;
                }
            }
            copy($file->path(), (storage_path("app/public/$type/$id/$name.jpg")   /*. $file->extension()*/));
        }
    }
}

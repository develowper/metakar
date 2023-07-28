<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Doc;
use App\Models\Site;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    private function createSites($count = 30)
    {
        $allFiles = Storage::allFiles("public/sites");
        foreach ($allFiles as $item)
            File::delete($item);
        DB::table('sites')->truncate();

        for ($i = 0; $i < $count; $i++) {

            $name = $this->faker->company;
            $data = Site::create([
                'name' => $name,
                'slug' => str_slug($name),
                'link' => $this->faker->url(),

                'status' => $this->faker->randomElement(["viewing", "viewing", "viewing", "ready"]),
                'meta' => $this->faker->numberBetween(0, 5),
                'owner_id' => $this->faker->numberBetween(1, 2),
                'category_id' => $this->faker->randomElement(Category::pluck('id')),
                'views' => 0,
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

    private function makeFile($type, $id)
    {
        $allFiles = Storage::allFiles("public/faker/$type");

        $path = storage_path('app/' . $allFiles[array_rand($allFiles)]);
        //profile picture
        $file = new UploadedFile(
            $path,
            File::name($path) . '.jpg' /*. File::extension($path)*/,
            File::mimeType($path),
            null,
            true

        );

        if (!Storage::exists("app/public/$type")) {
            Storage::makeDirectory("public/$type", 766);
        }

        copy($file->path(), (storage_path("app/public/$type/") . "$id." . $file->extension()));

    }
}

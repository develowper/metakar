<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 30);
            $table->string('lang', 5)->nullable();
            $table->string('value', 1024)->nullable();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('settings')->insert([
            ['key' => 'hero_main_page', 'value' => __('hero_main_page'), 'lang' => app()->getLocale(), "created_at" => \Carbon\Carbon::now(),],
            ['key' => 'site_min_view_fee', 'value' => 100, "created_at" => \Carbon\Carbon::now(), 'lang' => null],
            ['key' => 'site_view_commission', 'value' => 70, "created_at" => \Carbon\Carbon::now(), 'lang' => null],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};

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
            ['key' => 'hero_text', 'value' => __('hero_text'), 'lang' => app()->getLocale(), "created_at" => \Carbon\Carbon::now(),],
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

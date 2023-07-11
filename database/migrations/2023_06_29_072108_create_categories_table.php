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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->boolean('is_active')->default(true);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->smallInteger('type')->unsigned()->nullable();
            $table->timestamps();
            $table->unique(array('slug', 'type'));
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('no action');
        });

        \Illuminate\Support\Facades\DB::table('categories')->insert([
            ['name' => 'industry_mining',],
            ['name' => 'estate',],
            ['name' => 'trading',],
            ['name' => 'business',],
            ['name' => 'it',],
            ['name' => 'tutorial',],
            ['name' => 'car',],
            ['name' => 'personal_stuff',],
            ['name' => 'home_stuff',],
            ['name' => 'employment',],
            ['name' => 'agriculture',],
            ['name' => 'wearing',],
            ['name' => 'travel_entertainment',],


        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};

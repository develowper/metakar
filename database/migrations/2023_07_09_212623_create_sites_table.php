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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->string('lang', 2)->nullable();
            $table->string('name', 100);
            $table->string('description', 2048)->nullable();
            $table->string('link', 1024);
            $table->string('slug', 200)->nullable();
            $table->string('tags', 200)->nullable();
            $table->boolean('is_active', 200)->default(true);
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
};

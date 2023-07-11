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

            $table->string('name', 100);
            $table->string('slug', 200)->nullable();
            $table->string('tags', 200)->nullable();
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

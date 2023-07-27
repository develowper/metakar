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
        Schema::create('site_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->boolean('is_meta')->default(true);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('site_id')->nullable();
            $table->unsignedInteger('amount')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_transactions');
    }
};

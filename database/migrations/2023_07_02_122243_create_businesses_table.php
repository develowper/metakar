<?php

use App\Http\Helpers\Variable;
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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');
            $table->string('name', 200);
            $table->string('description', 2048)->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamp('phone_verified_at')->nullable();
//            $table->string('email', 50)->nullable();
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('tags', 200)->nullable();
            $table->json('socials')->nullable();
//            $table->boolean('is_active', 200)->default(true);
//            $table->boolean('is_blocked', 200)->default(false);
            $table->enum('status', array_column(Variable::BUSINESS_STATUSES, 'name'))->nullable();
            $table->string('lang', 2)->nullable();

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
        Schema::dropIfExists('businesses');
    }
};

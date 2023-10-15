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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('type', 50)->nullable()->index();
            $table->bigInteger('owner_id')->unsigned()->nullable();
            $table->bigInteger('source_id')->unsigned()->nullable(); //transfer or payment
            $table->integer('amount');
            $table->string('coupon', 10)->nullable(); //null is for public

            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
//            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};

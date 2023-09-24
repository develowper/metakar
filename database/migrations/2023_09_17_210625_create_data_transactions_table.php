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
        Schema::create('data_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
            $table->unsignedInteger('viewer')->default(0);
            $table->unsignedInteger('view')->default(0);
            $table->unsignedInteger('sum')->default(0);
            $table->unsignedInteger('sum_meta')->default(0);
            $table->unsignedBigInteger('data_id')->nullable()->index();
            $table->enum('data_type', array_values(Variable::DATA_TYPES))->nullable();
            $table->dateTime('date')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_transactions');
    }
};

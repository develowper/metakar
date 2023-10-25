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

        Schema::create('refs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inviter_id')->nullable();
            $table->foreign('inviter_id')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('invited_id')->nullable();
            $table->foreign('invited_id')->references('id')->on('users')->onDelete('no action');

            $table->enum('type', Variable::REF_TYPES);
            $table->boolean('done')->default(false);
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
        Schema::dropIfExists('refs');
    }
};

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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 100);
            $table->unsignedBigInteger('data_id')->nullable();
            $table->enum('type', Variable::NOTIFICATION_TYPES)->nullable();
            $table->text('description')->nullable();
            $table->string('link', 512)->nullable();
            $table->bigInteger('owner_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};

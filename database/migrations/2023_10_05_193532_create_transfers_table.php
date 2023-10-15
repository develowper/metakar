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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 1024);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('new_owner_id')->nullable();
            $table->foreign('new_owner_id')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('item_id');
            $table->unsignedInteger('price');
            $table->enum('item_type', array_values(Variable::DATA_TYPES));
            $table->enum('type', Variable::TRANSFER_TYPES);
            $table->enum('status', array_column(Variable::TRANSFER_STATUSES, 'name'))->nullable();
            $table->string('password', 256)->nullable(); //password/last auction price
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('done_at')->nullable();
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
        Schema::dropIfExists('transfers');
    }
};

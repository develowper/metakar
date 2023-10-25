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

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
            $table->string('name', 200);
            $table->json('operators')->default(null);
            $table->string('description', 2048)->nullable();
            $table->unsignedBigInteger('data_id')->nullable();
            $table->enum('data_type', array_values(Variable::DATA_TYPES))->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->enum('status', array_column(Variable::PROJECT_STATUSES, 'name'))->nullable();

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
        Schema::dropIfExists('projects');
    }
};

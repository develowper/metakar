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
        Schema::create('project_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('no action');
            $table->unsignedBigInteger('operator_id')->nullable();
            $table->foreign('operator_id')->references('id')->on('users')->onDelete('no action');
            $table->unsignedInteger('price')->nullable();
            $table->enum('status', array_column(Variable::PROJECT_STATUSES, 'name'))->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->enum('item_type', array_values(Variable::DATA_TYPES))->nullable();
            $table->json('chats')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('payed_at')->nullable();

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
        Schema::dropIfExists('project_items');
    }
};

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
        Schema::create('article_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->enum('type', Variable::DATA_TRANSACTION_TYPES)->nullable();
            $table->ipAddress('ip')->index()->nullable();
            $table->boolean('is_meta')->default(false);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('source_id')->nullable(); //transfer or payment

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('data_id')->nullable();
            $table->unsignedInteger('amount')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('data_id')->references('id')->on('articles')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_transactions');
    }
};

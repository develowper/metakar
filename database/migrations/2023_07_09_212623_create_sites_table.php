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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->string('name', 100);
            $table->string('lang', 2)->nullable();
            $table->string('description', 2048)->nullable();
            $table->string('link', 1024);
            $table->enum('status', array_column(Variable::SITE_STATUSES, 'name'))->default(Variable::SITE_STATUSES[0]['name'])->nullable();
            $table->unsignedInteger('charge',)->default(0);
            $table->unsignedInteger('view_fee')->default(Variable::SITE_MIN_VIEW_FEE())->nullable();
            $table->string('slug', 200)->nullable();
            $table->unsignedInteger('meta')->default(0);
            $table->string('tags', 200)->nullable();
            $table->boolean('is_active', 200)->default(true);
            $table->boolean('is_blocked', 200)->default(false);
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');

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
        Schema::dropIfExists('sites');
    }
};

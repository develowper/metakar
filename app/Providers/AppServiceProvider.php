<?php

namespace App\Providers;

use App\Http\Helpers\Variable;
use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
//            Variable::MODELS[User::class] => User::class,
//            Variable::MODELS[Business::class] => Business::class,

        ]);
        Schema::defaultStringLength(191);
    }
}

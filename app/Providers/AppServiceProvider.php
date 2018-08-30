<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use Vanilo\Framework\Contracts\Requests\CreateProduct as CreateProductContract;
use App\Http\Requests\CreateProduct;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->concord->registerModel(\Konekt\User\Contracts\User::class, \App\User::class);
          // Replace the CreateProduct type with the app's one:
        $this->app->concord->registerRequest(
            CreateProductContract::class,
            CreateProduct::class
        );
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Classes\ApiWeather;
use App\Interfaces\IApiWeather;
use App\Repositories\Interfaces\IOrdersRepo;
use App\Repositories\Interfaces\IPartnersRepo;
use App\Repositories\Interfaces\IProductsRepo;
use App\Repositories\OrdersRepo;
use App\Repositories\PartnersRepo;
use App\Repositories\ProductsRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IApiWeather::class, ApiWeather::class);
        $this->app->singleton(IOrdersRepo::class, OrdersRepo::class);
        $this->app->singleton(IProductsRepo::class, ProductsRepo::class);
        $this->app->singleton(IPartnersRepo::class, PartnersRepo::class);
    }
}

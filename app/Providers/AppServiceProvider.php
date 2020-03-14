<?php

namespace App\Providers;

use App\Classes\ApiWeather;
use App\Interfaces\IApiWeather;
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
    }
}

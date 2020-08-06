<?php

namespace FPD\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class FPDServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->routes();
    }

    /**
     * Register Interface::Class with container.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * dang ký cac route
     */

    public function routes()
    {
        Route::get('fpd', 'FPD\Controllers\TestController@helloWorld')->name('fpd');
    }

    public function loadHelper()
    {
        # code...
    }

    public function migration()
    {
        # code...
    }

    public function setView()
    {
        # code...
    }

    public function publishAssets()
    {
        # code...
    }
}

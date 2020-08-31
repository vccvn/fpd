<?php

namespace FPD\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

define('FPD_PATH', dirname(dirname(dirname(__DIR__))));
define('FPD_SRC_PATH', FPD_PATH . '/src');

class FPDServiceProvider extends ServiceProvider
{
    public $namespace = 'FPD\Controllers';
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
        $this->loadViews();
        $this->publishAssets();
        $this->loadHelpers();
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
        Route::namespace($this->namespace)->group(FPD_SRC_PATH.'/routes/main.php');
    }

    public function loadHelpers()
    {
        require FPD_SRC_PATH . '/helpers/utils.php';
    }

    public function migrations()
    {
        # code...
    }

    public function loadViews()
    {
        $this->loadViewsFrom(FPD_SRC_PATH.'/views', 'fpd');
    }

    public function publishAssets()
    {
        $this->publishes([
            FPD_PATH.'/assets' => public_path('plugins/fpd'),
        ], 'public');
    }
}

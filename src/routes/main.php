<?php

use Illuminate\Support\Facades\Route;

Route::get('fpd.html', 'TestController@welcome')->name('fpd');


Route::prefix('fpd')->group(function () {
    $controller = 'ProductController@';
    
    $route = 'fpd.';
    /**
     * --------------------------------------------------------------------------------------------------------------------
     *    Method | URI                           | Controller @ Nethod                   | Route Name                     |
     * --------------------------------------------------------------------------------------------------------------------
     */

    Route::get('/custom.html',                    $controller.'customProduct'            )->name($route.'custom');

    Route::any('/products',                       $controller.'getProducts'              )->name($route.'products');
    
    Route::any('/design',                         $controller.'design'                   )->name($route.'design');

    
    
});
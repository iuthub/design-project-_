<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
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
        define('ITEM_PER_PAGE', 15);
        Paginator::defaultView('backend.pagination');
        Paginator::defaultSimpleView('frontend.pagination');
        Route::pattern('id', '[0-9]+');
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

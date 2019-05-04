<?php

namespace App\Providers;

use App\Repositories\SettingRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws \Exception
     */
    public function boot()
    {
        Paginator::defaultView('backend.pagination');
        Paginator::defaultSimpleView('frontend.pagination');
        Route::pattern('id', '[0-9]+');

        $settings = cache()->get('settings');
        if (empty($settings) && Schema::hasTable('settings')) {
            $settings = $this->app->make(SettingRepository::class)->getAll()->pluck('value', 'slug')->toArray();
            cache()->forever('settings', $settings);
        }
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

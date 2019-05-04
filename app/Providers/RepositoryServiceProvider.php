<?php

namespace App\Providers;

use App\Repositories\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\PostInterface;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostInterface::class, PostRepository::class);
    }
}

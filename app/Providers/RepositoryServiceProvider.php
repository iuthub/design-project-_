<?php

namespace App\Providers;

use App\Repositories\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\PostInterface;
use App\Repositories\PostRepository;
use App\Repositories\SubscriberInterface;
use App\Repositories\SubscriberRepository;
use App\Repositories\TagInterface;
use App\Repositories\TagRepository;
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
        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(SubscriberInterface::class, SubscriberRepository::class);
    }
}

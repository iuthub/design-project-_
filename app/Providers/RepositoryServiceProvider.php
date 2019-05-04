<?php

namespace App\Providers;

use App\Repositories\AuthorInterface;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentInterface;
use App\Repositories\CommentRepository;
use App\Repositories\ContactInterface;
use App\Repositories\ContactRepository;
use App\Repositories\MediaInterface;
use App\Repositories\MediaRepository;
use App\Repositories\PostInterface;
use App\Repositories\PostRepository;
use App\Repositories\SettingInterface;
use App\Repositories\SettingRepository;
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
        $this->app->bind(CommentInterface::class, CommentRepository::class);
        $this->app->bind(AuthorInterface::class, AuthorRepository::class);
        $this->app->bind(MediaInterface::class, MediaRepository::class);
        $this->app->bind(ContactInterface::class, ContactRepository::class);
        $this->app->bind(SettingInterface::class, SettingRepository::class);
    }
}

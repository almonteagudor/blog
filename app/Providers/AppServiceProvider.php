<?php

namespace App\Providers;

use Blog\Domain\AuthorRepositoryInterface;
use Blog\Domain\PostRepositoryInterface;
use Blog\Infrastructure\StaticAuthorRepository;
use Blog\Infrastructure\StaticPostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, StaticPostRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class, StaticAuthorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

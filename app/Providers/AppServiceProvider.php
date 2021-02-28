<?php

namespace App\Providers;

use App\Models\Author;
use App\Observers\AuthorObserver;
use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\AuthorRepository;
use App\Repositories\MessageRepository;
use App\Repositories\MessageRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Author::observe(AuthorObserver::class);
    }
}

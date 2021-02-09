<?php

namespace App\Providers;

use App\Http\Resources\AuthorCollectionResourceInterface;
use App\Http\Resources\AuthorResourceInterface;
use App\Http\Resources\MessageCollectionResourceInterface;
use App\Http\Resources\MessageResourceInterface;
use App\Http\Resources\v1\AuthorCollectionResource;
use App\Http\Resources\v1\MessageCollectionResource;
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
        $this->app->bind(AuthorCollectionResourceInterface::class, function ($app, $data) {
            return new AuthorCollectionResource(reset($data));
        });

        $this->app->bind(MessageCollectionResourceInterface::class, function ($app, $data) {
            return new MessageCollectionResource(reset($data));
        });

        $this->app->bind(AuthorResourceInterface::class, function ($app, $data) {
            //check which API version we are
            switch (request()->route()->getPrefix()){
                case 'api/v1/':
                    return new \App\Http\Resources\v1\AuthorResource(reset($data));
            }
        });

        $this->app->bind(MessageResourceInterface::class, function ($app, $data) {
            //check which API version we are
            switch (request()->route()->getPrefix()){
                case 'api/v1/':
                    return new \App\Http\Resources\v1\MessageResource(reset($data));
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

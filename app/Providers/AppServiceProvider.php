<?php

namespace App\Providers;

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
        $this->app->bind('AuthorCollectionResource', function ($app, $data) {
            switch (request()->route()->getPrefix()){
                case 'api/v1/':
                    return \App\Http\Resources\v1\AuthorResource::collection(reset($data));
                case 'api/v2/':
                    return \App\Http\Resources\v2\AuthorResource::collection(reset($data));
            }
        });

        $this->app->bind('MessageCollectionResource', function ($app, $data) {
            return \App\Http\Resources\v1\MessageResource::collection(reset($data));
        });

        $this->app->bind('AuthorResource', function ($app, $data) {
            //check which API version we are
            switch (request()->route()->getPrefix()){
                case 'api/v1/':
                    return new AuthorResource(reset($data));
            }
        });

        $this->app->bind('MessageResource', function ($app, $data) {
            //check which API version we are
            switch (request()->route()->getPrefix()){
                case 'api/v1/':
                    return new MessageResource(reset($data));
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

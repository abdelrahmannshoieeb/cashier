<?php

namespace App\Providers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('jsonUtf8', function ($data, $status = 200) {
            return Response::json($data, $status, [], JSON_UNESCAPED_UNICODE);
        });
    }
}

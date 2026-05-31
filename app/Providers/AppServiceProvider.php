<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('hash', function ($app) {
            return new \App\Services\PlainTextHasher($app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure helpers are loaded even if composer dump-autoload wasn't run on production
        $helpersPath = app_path('helpers.php');
        if (file_exists($helpersPath) && !function_exists('storage_url')) {
            require_once $helpersPath;
        }
    }
}

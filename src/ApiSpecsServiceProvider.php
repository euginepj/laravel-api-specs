<?php

namespace Euginepj\ApiSpecs;

use Illuminate\Support\ServiceProvider;

class ApiSpecsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/api-specs.php',
            'api-specs'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'api-specs');

        // Load Routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Publishing Assets & Configuration
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/api-specs.php' => config_path('api-specs.php'),
            ], 'api-specs-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/api-specs'),
            ], 'api-specs-views');
        }
    }
}


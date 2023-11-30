<?php

namespace Mansi\WebsiteAnalytics\Providers;

use Illuminate\Support\ServiceProvider;

class WebsiteAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->publishes([
            __DIR__.'/../views/index.blade.php' =>  resource_path('views/index.blade.php'),
        ], 'analysis_view');
        $this->publishes([
            __DIR__.'/../views/log-details.blade.php' =>  resource_path('views/log-details.blade.php'),
        ], 'analysis_view');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

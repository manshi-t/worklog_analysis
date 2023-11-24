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
        $this->loadViewsFrom(__DIR__.'/../views', 'analytics');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

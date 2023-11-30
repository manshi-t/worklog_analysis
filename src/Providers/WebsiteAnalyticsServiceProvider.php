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
        $this->publishes([
            __DIR__.'/../routes/web.php' =>  base_path('routes/web.php'),
        ], 'analysis_route');
        $this->publishes([
            __DIR__.'/../views/index.blade.php' =>  resource_path('views/index.blade.php'),
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

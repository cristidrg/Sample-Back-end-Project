<?php

namespace App\Providers;

use App\Services\SiteImproveService;
use Illuminate\Support\ServiceProvider;

class SiteImproveProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SiteImproveService::class, function($app) {
            return new SiteImproveService(env('SITE_IMPRV_USER'), env('SITE_IMPRV_KEY'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Services\Contracts\HubServiceInterface;
use App\Services\Contracts\MarketplaceServiceInterface;
use App\Services\Hub\HubMockService;
use App\Services\Marketplace\MarketplaceMockService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MarketplaceServiceInterface::class, MarketplaceMockService::class);
        $this->app->bind(HubServiceInterface::class, HubMockService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

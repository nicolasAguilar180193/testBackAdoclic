<?php

namespace App\Providers;

use App\Repository\Entity\EntityRepository;
use App\Repository\Entity\IEntityRepository;
use App\Services\EntriesApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EntriesApiService::class, function ($app) {
            return new EntriesApiService( $app->make(IEntityRepository::class) );
        });

        $this->app->bind(IEntityRepository::class, EntityRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

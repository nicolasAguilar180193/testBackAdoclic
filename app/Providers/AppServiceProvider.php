<?php

namespace App\Providers;

use App\Repository\Category\CategoryRepository;
use App\Repository\Category\ICategoryRepository;
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
            $client = new \GuzzleHttp\Client();
            return new EntriesApiService(
                $app->make(IEntityRepository::class),
                $app->make(ICategoryRepository::class),
                $client);
        });

        $this->app->bind(IEntityRepository::class, EntityRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

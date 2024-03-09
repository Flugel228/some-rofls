<?php

namespace App\Providers;

use App\Contracts\Repositories\HistoryRepositoryContract;
use App\Contracts\Repositories\ImageRepositoryContract;
use App\Contracts\Services\HistoryServiceContract;
use App\Contracts\Services\ImageServiceContract;
use App\Repositories\HistoryRepository;
use App\Repositories\ImageRepository;
use App\Services\HistoryService;
use App\Services\ImageService;
use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ImageRepositoryContract::class, ImageRepository::class);
        $this->app->bind(HistoryRepositoryContract::class, HistoryRepository::class);
        $this->app->bind(ImageServiceContract::class, ImageService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

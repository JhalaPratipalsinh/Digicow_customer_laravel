<?php

namespace App\Providers;

use App\Repositories\Interfaces\CalfRepositoryInterface;
use App\Repositories\Interfaces\CowBreedRepositoryinterface;
use App\Repositories\Interfaces\CowGroupRepositoryinterface;
use App\Repositories\Interfaces\CowRepositoryInterface;
use App\Repositories\Interfaces\MilkProductionRepositortInterface;
use App\Repositories\Repository\CalfRepository;
use App\Repositories\Repository\CowBreedRepository;
use App\Repositories\Repository\CowGroupRepository;
use App\Repositories\Repository\CowRepository;
use App\Repositories\Repository\MilkProductionRepositort;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            CowRepositoryInterface::class,
            CowRepository::class
        );

        $this->app->bind(
            CowBreedRepositoryinterface::class,
            CowBreedRepository::class
        );

        $this->app->bind(
            CowGroupRepositoryinterface::class,
            CowGroupRepository::class
        );

        $this->app->bind(
            CalfRepositoryInterface::class,
            CalfRepository::class
        );

        $this->app->bind(
            MilkProductionRepositortInterface::class,
            MilkProductionRepositort::class
        );

    }
}

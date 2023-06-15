<?php

namespace App\Providers;

use App\Repositories\Interfaces\BreedingRepositoryInterface;
use App\Repositories\Interfaces\CalfRepositoryInterface;
use App\Repositories\Interfaces\CowBreedRepositoryinterface;
use App\Repositories\Interfaces\CowGroupRepositoryinterface;
use App\Repositories\Interfaces\CowRepositoryInterface;
use App\Repositories\Interfaces\FarmerClientsRepositoryInterface;
use App\Repositories\Interfaces\FeedingRepositoryInterface;
use App\Repositories\Interfaces\HealthRepositoryInterface;
use App\Repositories\Interfaces\MilkpaymentsRepositoryInterface;
use App\Repositories\Interfaces\MilkProductionRepositortInterface;
use App\Repositories\Interfaces\MilksalesRepositoryInterface;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Repositories\Repository\BreedingRepository;
use App\Repositories\Repository\CalfRepository;
use App\Repositories\Repository\CowBreedRepository;
use App\Repositories\Repository\CowGroupRepository;
use App\Repositories\Repository\CowRepository;
use App\Repositories\Repository\FarmerClientsRepository;
use App\Repositories\Repository\FeedingRepository;
use App\Repositories\Repository\HealthRepository;
use App\Repositories\Repository\MilkpaymentsRepository;
use App\Repositories\Repository\MilkProductionRepositort;
use App\Repositories\Repository\MilksalesRepository;
use App\Repositories\Repository\StaffRepository;
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
        $this->app->bind(
            FeedingRepositoryInterface::class,
            FeedingRepository::class
        );

        $this->app->bind(
            MilksalesRepositoryInterface::class,
            MilksalesRepository::class
        );

        $this->app->bind(
            MilkpaymentsRepositoryInterface::class,
            MilkpaymentsRepository::class
        );

        $this->app->bind(
            FarmerClientsRepositoryInterface::class,
            FarmerClientsRepository::class
        );

        $this->app->bind(
            StaffRepositoryInterface::class,
            StaffRepository::class
        );

        $this->app->bind(
            BreedingRepositoryInterface::class,
            BreedingRepository::class
        );

        $this->app->bind(
            HealthRepositoryInterface::class,
            HealthRepository::class
        );

    }
}

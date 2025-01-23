<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AirportRepositoryInterface;
use App\Interfaces\AirlineRepositoryInterface;
use App\Interfaces\FlightRepositoryInterface;
use App\Interfaces\TransactionFlightRepositoryInterface;
use App\Repositories\AirportRepository;
use App\Repositories\AirlineRepository;
use App\Repositories\FlightRepository;
use App\Repositories\TransactionFlightRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AirportRepositoryInterface::class, AirportRepository::class);
        $this->app->bind(AirlineRepositoryInterface::class, AirlineRepository::class);
        $this->app->bind(FlightRepositoryInterface::class, FlightRepository::class);
        $this->app->bind(TransactionFlightRepositoryInterface::class, TransactionFlightRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

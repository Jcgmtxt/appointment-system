<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Services\Contracts\UserServiceInterface::class,
            \App\Services\UserService::class
        );

        $this->app->bind(
            \App\Services\Contracts\DoctorServiceInterface::class,
            \App\Services\DoctorService::class
        );

        $this->app->bind(
            \App\Services\Contracts\AppointmentServiceInterface::class,
            \App\Services\AppointmentService::class
        );

        $this->app->bind(
            \App\Services\Contracts\ScheduleServiceInterface::class,
            \App\Services\ScheduleService::class
        );


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

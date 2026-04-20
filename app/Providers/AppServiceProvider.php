<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\NotificationServiceInterface;
use App\Services\Notifications\EmailNotificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    $this->app->bind(NotificationServiceInterface::class,EmailNotificationService::class 
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

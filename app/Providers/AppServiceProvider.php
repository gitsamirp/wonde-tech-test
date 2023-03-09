<?php

namespace App\Providers;

use App\Clients\WondeClient;
use App\Clients\WondeClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WondeClientInterface::class, WondeClient::class);
    }
}

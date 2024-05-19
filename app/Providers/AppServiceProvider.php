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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom([
            database_path().'/migrations/status',
            database_path().'/migrations/finance',
            database_path().'/migrations/marketing',
            database_path().'/migrations/inventory',
            database_path().'/migrations/sales',
        ]);
    }
}

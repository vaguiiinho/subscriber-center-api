<?php

namespace App\Providers;

use App\Repositories\Eloquent\{
    ContractEloquentRepository,
    InvoiceEloquentRepository,
};
use Core\Domain\Repository\{
    ContractRepositoryInterface,
    InvoiceRepositoryInterface,
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            InvoiceRepositoryInterface::class,
            InvoiceEloquentRepository::class
        );

        $this->app->singleton(
            ContractRepositoryInterface::class,
            ContractEloquentRepository::class
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

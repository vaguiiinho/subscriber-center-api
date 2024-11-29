<?php

namespace App\Providers;

use App\Repositories\Eloquent\InvoiceEloquentRepository;
use Core\Domain\Repository\InvoiceRepositoryInterface;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

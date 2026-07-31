<?php

namespace App\Providers;

use App\Repositories\Implementations\AuthRepository;
use App\Repositories\Implementations\CategoryRepository;
use App\Repositories\Implementations\ProductRepository;
use App\Repositories\Implementations\SupplierRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\SupplierRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $repositories = [
            AuthRepositoryInterface::class => AuthRepository::class,
            CategoryRepositoryInterface::class => CategoryRepository::class,
            SupplierRepositoryInterface::class => SupplierRepository::class,
            ProductRepositoryInterface::class => ProductRepository::class,
        ];

        foreach ($repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

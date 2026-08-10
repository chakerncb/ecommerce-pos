<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Setting;
use TomatoPHP\FilamentEcommerce\Models\Product as TomatoProduct;

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
        Relation::morphMap([
            TomatoProduct::class => Product::class,
        ]);

        View::composer('*', function ($view) {
            try {
                $store = \App\Traits\StoreInfoTrait::getStoreInfo();
                $view->with('store', $store);
            } catch (\Throwable $e) {
                // Ignore during migrations or when database is not yet set up
            }
        });
    }
}


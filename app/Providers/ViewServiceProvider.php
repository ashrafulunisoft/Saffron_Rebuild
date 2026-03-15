<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share categories with all views
        view()->composer('*', function ($view) {
            $categories = \App\Models\Category::where('is_active', true)
                ->withCount('products')
                ->orderBy('name_en')
                ->get();

            $view->with('navCategories', $categories);
        });
    }
}

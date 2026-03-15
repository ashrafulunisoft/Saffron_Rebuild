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

            // Get cart count
            $cartCount = 0;
            if (auth()->check()) {
                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
            } else {
                $cartCount = \App\Models\Cart::where('session_id', session()->getId())->sum('quantity');
            }

            $view->with('navCategories', $categories)
                 ->with('cartCount', $cartCount);
        });
    }
}

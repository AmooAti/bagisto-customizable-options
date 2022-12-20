<?php

namespace AmooAti\CustomizableOptions\Providers;

use AmooAti\CustomizableOptions\Cart\Cart;
use AmooAti\CustomizableOptions\Models\CartItem;
use AmooAti\CustomizableOptions\Models\Product;
use Illuminate\Support\ServiceProvider;
use Webkul\Checkout\Contracts\CartItem as CartItemContract;
use Webkul\Product\Contracts\Product as ProductContract;

class CustomizableOptionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'amooati-co');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'amooati-co');

        $this->app->register(ModuleServiceProvider::class);

        $this->app->register(EventServiceProvider::class);

        $this->app->concord->registerModel(ProductContract::class, Product::class);

        $this->app->concord->registerModel(CartItemContract::class, CartItem::class);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/products/view.blade.php' => resource_path('themes/velocity/views/products/view.blade.php')
        ], 'public');
    }

    public function register()
    {
        // override bagisto cart facade
        $this->app->extend('cart', function ($cart) {
            return app(Cart::class);
        });
    }
}
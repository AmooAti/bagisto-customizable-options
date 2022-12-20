<?php

namespace AmooAti\CustomizableOptions\Providers;

use Illuminate\Support\ServiceProvider;

class CustomizableOptionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'amooati-co');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'amooati-co');

        $this->app->register(ModuleServiceProvider::class);

        $this->app->register(EventServiceProvider::class);
    }
}
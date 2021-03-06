<?php

namespace AmooAti\CustomizableOption\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CustomizableOptionServiceProvider extends ServiceProvider
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
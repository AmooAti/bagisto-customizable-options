<?php

namespace AmooAti\CustomizableOption\Providers;

use Illuminate\Support\ServiceProvider;

class CustomizableOptionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app->register(ModuleServiceProvider::class);
    }
}
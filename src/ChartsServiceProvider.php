<?php

namespace LaravelEnso\Charts;

use Illuminate\Support\ServiceProvider;

class ChartsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/charts.php', 'charts');

        $this->publishes([
            __DIR__.'/config' => config_path(),
        ], 'charts-config');

        $this->publishes([
            __DIR__.'/config' => config_path(),
        ], 'enso-config');

        $this->publishes([
            __DIR__.'/resources/assets/js/components' => resource_path('assets/js/vendor/laravel-enso/components'),
        ], 'charts-component');

        $this->publishes([
            __DIR__.'/resources/assets/js/components' => resource_path('assets/js/vendor/laravel-enso/components'),
        ], 'enso-update');
    }

    public function register()
    {
        //
    }
}

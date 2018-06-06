<?php

namespace LaravelEnso\Charts;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishesAll();
        $this->mergeConfigFrom(__DIR__.'/config/charts.php', 'enso.charts');
    }

    public function publishesAll()
    {
        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], 'charts-config');

        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], 'enso-config');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'charts-assets');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'enso-assets');
    }

    public function register()
    {
        //
    }
}

<?php

namespace LaravelEnso\Charts;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/charts.php', 'enso.charts');

        $this->publishDependencies();
    }

    public function publishDependencies()
    {
        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], 'charts-config');

        $this->publishes([
            __DIR__.'/config' => config_path('enso'),
        ], 'enso-config');

        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js'),
        ], 'charts-assets');

        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js'),
        ], 'enso-assets');
    }

    public function register()
    {
        //
    }
}

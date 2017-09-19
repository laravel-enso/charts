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
    }

    public function register()
    {
        //
    }
}

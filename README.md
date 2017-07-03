# Charts
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/aa6c0917f8c6425f87eb94c01d84b2f8)](https://www.codacy.com/app/laravel-enso/Charts?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/Charts&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85484767/shield?branch=master)](https://styleci.io/repos/85484767)
[![Total Downloads](https://poser.pugx.org/laravel-enso/charts/downloads)](https://packagist.org/packages/laravel-enso/charts)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/charts/version)](https://packagist.org/packages/laravel-enso/charts)

This package is a server-side data builder for [Chart.js](http://www.chartjs.org), with a VueJS component for the frontend. 
It works best with AdminLte.

[![Watch the demo](https://laravel-enso.github.io/charts/screenshots/Selection_002.png)](https://laravel-enso.github.io/charts/videos/chart_refresh.webm)

<sup>click on the photo to view a short demo in compatible browsers</sup>

### Details
- It supports Bar, Bubble, Line, Pie and Radar charts
- It creates properly formatted data structures, specific for each supported type of chart from a given data-set
- The colors used are configurable through the publishable config file

### Installation

1. Add `LaravelEnso\Chart\ChartServiceProvider::class` to your providers list in `config/app.php`.

2. Publish the config with `php artisan vendor:publish --tag=charts-config`

3. Publish the vue component with `php artisan vendor:publish --tag=charts-component`

4. Include Chart.vue in you app.js

    ```
    Vue.component('chart',
        require('./vendor/laravel-enso/components/Chart.vue')
    );
    ```

5. Run `gulp` / `npm run webpack`.

6. In your controller add a method that will return the data for you chart

    ```
    public function getPieChartData()
    {
        $labels = ['Green', 'Red', 'Azzure'];
        $datasets = [400, 50, 100];
        $chart = new PieChart($labels, $datasets);
    
        return $chart->getResponse();
    }
    ```

7. Use the VueJS component in your view

    ```
    <chart ref="chart"
        :type="pie"
        :source="charts/getPieChartData">
        <span slot="chart-title">Pie Chart</span>
    </chart>
    ```

### Options

	`type` - `bar`, `polarArea`, `pie`, `doughnut`, `radar`, `bubble` | (required)
	`source` - The route path that will go to the method above (getPieChartData()) | (required)
	`headerClass` - `primary`, `success`, `danger`, `info`, `warning` | (optional)
	`options` - ChartJs options Object | (optional)
	`draggable` - Boolean. It works with vuedraggable. You will find a working example in LarvelEnso Core's Dashboard. | (optional)

### Methods

	The following ChartJs methods are available on the component:
	`init()`
	`resize()`
	`destroy()`

	You can also use:
	`getData()` to reload the data from server.

	Call these methods with `vm.$refs.chart.method()`

### Notes

The Chart builder will use the colors from `app/config/charts.php` (in that order) for the given data-sets.

The [Laravel Enso Core](https://github.com/laravel-enso/Core) package comes with this package included.

### Publishes

- `php artisan vendor:publish --tag=charts-config` - the configuration file
- `php artisan vendor:publish --tag=charts-component` - the VueJS component
- `php artisan vendor:publish --tag=enso-update` - a common alias for when wanting to update the VueJS component, 
once a newer version is released
- `php artisan vendor:publish --tag=enso-config` - a common alias for when wanting to update the config, 
once a newer version is released


### Contributions

are welcome
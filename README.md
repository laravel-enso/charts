<!--h-->
# Charts
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/aa6c0917f8c6425f87eb94c01d84b2f8)](https://www.codacy.com/app/laravel-enso/Charts?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/Charts&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85484767/shield?branch=master)](https://styleci.io/repos/85484767)
[![License](https://poser.pugx.org/laravel-enso/charts/license)](https://https://packagist.org/packages/laravel-enso/charts)
[![Total Downloads](https://poser.pugx.org/laravel-enso/charts/downloads)](https://packagist.org/packages/laravel-enso/charts)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/charts/version)](https://packagist.org/packages/laravel-enso/charts)
<!--/h-->

Server-side data builder for [Chart.js](http://www.chartjs.org), with 2 [Bulma](https://bulma.io) styled, [VueJS](https://vuejs.org/) components for the frontend.


[![Watch the demo](https://laravel-enso.github.io/charts/screenshots/bulma_cap002_thumb.png)](https://laravel-enso.github.io/charts/videos/bulma_demo_01.webm)

<sup>click on the photo to view a short demo in compatible browsers</sup>


### Features

- it supports Bar, Bubble, Line, Pie and Radar charts
- it creates properly formatted data structures, specific for each supported type of chart from a given data-set
- the colors used are configurable through the publishable config file
- comes with a `Chart.vue` VueJS component meant to be included anywhere
- comes with a `ChartCard.vue` VueJS component meant to be used as card containing the chart
- uses the [VueComponents](https://github.com/laravel-enso/VueComponents) package in order to load its VueJS components

### Installation

1. Publish the config with `php artisan vendor:publish --tag=charts-config`

2. Publish the vue component with `php artisan vendor:publish --tag=charts-component`

3. Include `Chart.vue` in your `app.js`:

    ```
    Vue.component('chart',
        require('./vendor/laravel-enso/components/Chart.vue')
    );
    ```

5. Run `gulp` / `npm run webpack`.

6. In your controller add a method that will return the data for you chart:

    ```
    public function getPieChartData()
    {
        $labels = ['Green', 'Red', 'Azzure'];
        $datasets = [400, 50, 100];
        $chart = new PieChart($labels, $datasets);

        return $chart->getResponse();
    }
    ```

7. Use the VueJS component(s) in your components:

    ```
    <chart ref="chart"
        :type="pie"
        :data="chartDataObject"
        :options="chartOptionsObject">        
    </chart>
    
    <chart-card
        :source="charts/getMyChartData"
        :params="paramsObject">
    <chart-card>
    
    ```

### Options
The `Chart.vue` component can be used anywhere by integrating it into any other component or page, and takes the following parameters:
- `type` - `bar`, `polarArea`, `pie`, `doughnut`, `radar`, `bubble` | (required)
- `data` - object containing the properly formatted data for the given chart type | (required)
- `options` - ChartJs options object | (optional)

The `ChartCard.vue` component is a chart in a Bulma card, and is meant to be used to retrieve its own data, and take the following parameters:
- `source` - the route path that will fetch the data | (required)
- `params` - parameters object that gets passed to the backend, may be used for customization of the data-set | (optional)


### Methods
The following methods are available on the components

* Chart.vue
    - `init()`
    - `update()`
* ChartCard.vue
    - `get()`, to reload the data from server

Call these methods with `vm.$refs.chart.method()`

### Publishes

- `php artisan vendor:publish --tag=charts-config` - the configuration file
- `php artisan vendor:publish --tag=vue-components` - the VueJS components
- `php artisan vendor:publish --tag=enso-assets` - a common alias for when wanting to update the VueJS components,
once a newer version is released, can be used with the `--force` flag
- `php artisan vendor:publish --tag=enso-config` - a common alias for when wanting to update the config,
once a newer version is released, can be used with the `--force` flag

### Notes

The Chart builder will use the colors from `app/config/charts.php` (in that order) for the given data-sets.

The [Laravel Enso Core](https://github.com/laravel-enso/Core) package comes with this package included.

Depends on:
 - [VueComponents](https://github.com/laravel-enso/VueComponents) for the accompanying VueJS components

<!--h-->
### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
<!--/h-->
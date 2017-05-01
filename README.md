# Charts
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/aa6c0917f8c6425f87eb94c01d84b2f8)](https://www.codacy.com/app/laravel-enso/Charts?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/Charts&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85484767/shield?branch=master)](https://styleci.io/repos/85484767)
[![Total Downloads](https://poser.pugx.org/laravel-enso/charts/downloads)](https://packagist.org/packages/laravel-enso/charts)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/charts/version)](https://packagist.org/packages/laravel-enso/charts)

Charts is a server side data builder for [Chart.js](http://www.chartjs.org), with a vue component for the frontend. It works best with AdminLte.

### Installation

1. Add `'LaravelEnso\Chart\ChartServiceProvider::class'` to your providers list in config/app.php.

2. Publish the config with `php artisan vendor:publish --tag=charts-config`

3. Publish the vue component with `php artisan vendor:publish --tag=charts-component`

4. Include chart.vue in you app.js

```
Vue.component('chart',
	require('./vendor/laravel-enso/components/Chart.vue')
);
```

5. Run `gulp`.

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

7. Use the vue component in your view

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

### Note

The Chart builder will use the colors from `app/config/charts.php` (in that order) for the given datasets.

The laravel-enso/core package comes with this library included (required in package.json).

### Contributions

...are welcome
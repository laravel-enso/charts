# Charts
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/aa6c0917f8c6425f87eb94c01d84b2f8)](https://www.codacy.com/app/laravel-enso/Charts?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/Charts&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85484767/shield?branch=master)](https://styleci.io/repos/85484767)
[![License](https://poser.pugx.org/laravel-enso/charts/license)](https://packagist.org/packages/laravel-enso/charts)
[![Total Downloads](https://poser.pugx.org/laravel-enso/charts/downloads)](https://packagist.org/packages/laravel-enso/charts)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/charts/version)](https://packagist.org/packages/laravel-enso/charts)

Server-side data builder for charts.

This package can work independently of the [Enso](https://github.com/laravel-enso/Enso) ecosystem.

The front end implementation that utilizes this api is present in the [enso-ui/charts](https://github.com/enso-ui/charts) package.

For live examples and demos, you may visit [laravel-enso.com](https://www.laravel-enso.com)

[![Watch the demo](https://laravel-enso.github.io/charts/screenshots/bulma_cap002_thumb.png)](https://laravel-enso.github.io/charts/videos/bulma_demo_01.webm)

<sup>click on the photo to view a short demo in compatible browsers</sup>

## Installation

Comes pre-installed in Enso. 

To install outside of Enso:

1. `composer require laravel-enso/charts`

2. publish the config with `php artisan vendor:publish --tag=charts-config` and customize as needed

3. install the api implementation for the front end: `yarn add @enso-ui/charts`

## Features

- it supports Bar, Bubble, Line, Pie, Doughnut, Polar Area and Radar chart types
- it creates properly formatted data structures, specific for each supported type of chart from a given data-set
- the used colors are configurable through the publishable config file
- can translate labels, legends and data series
- can download the graphical representation of the graph, as a `PNG` file

### Configuration & Usage

Be sure to check out the full documentation for this package available at [docs.laravel-enso.com](https://docs.laravel-enso.com/backend/charts.html)

### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.

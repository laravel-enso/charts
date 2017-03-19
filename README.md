# Charts
Charts data builder for Chart.js

## Don't forget to

Add LaravelEnso\Chart\ChartServiceProvider::class to config/app.php.

Publish the vue components with php artisan vendor:publish --tag=chart-component.

After that include the component in your app.js and run gulp.

## Upgrade from laravel-enso v2

Correct all the includes for the helper classes included in this package (Classes/*)

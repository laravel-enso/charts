<?php

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class ChartsTestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $app = new Container();
        $app->instance('config', new Repository([
            'enso' => [
                'charts' => require __DIR__.'/../config/charts.php',
            ],
        ]));

        Container::setInstance($app);
        Facade::setFacadeApplication($app);
    }
}

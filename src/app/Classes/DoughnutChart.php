<?php

namespace LaravelEnso\Charts\app\Classes;

class DoughnutChart extends PiePolarOrDoughnutChart
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->setType('doughnut');
    }
}

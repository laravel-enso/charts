<?php

namespace LaravelEnso\Charts\app\Classes;

class DoughnutChart extends PiePolarOrDoughnutChart
{
    public function __construct()
    {
        parent::__construct();

        $this->type('doughnut')
            ->ratio(1);
    }
}

<?php

namespace LaravelEnso\Charts\app\Classes;

class PolarChart extends PiePolarOrDoughnutChart
{
    public function __construct()
    {
        parent::__construct();

        $this->type('polarArea')
            ->ratio(1);
    }
}

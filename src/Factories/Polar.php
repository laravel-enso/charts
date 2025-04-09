<?php

namespace LaravelEnso\Charts\Factories;

use LaravelEnso\Charts\Enums\Chart as ChartEnum;

class Polar extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(ChartEnum::PolarArea->value)
            ->ratio(1);
    }
}

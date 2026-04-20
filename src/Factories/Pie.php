<?php

namespace LaravelEnso\Charts\Factories;

use LaravelEnso\Charts\Enums\Chart as ChartEnum;

class Pie extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(ChartEnum::Pie->value)
            ->ratio(1);
    }
}

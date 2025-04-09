<?php

namespace LaravelEnso\Charts\Factories;

use LaravelEnso\Charts\Enums\Chart as  ChartEnum;

class Doughnut extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(ChartEnum::Doughnut->value)
            ->ratio(1);
    }
}

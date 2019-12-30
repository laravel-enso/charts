<?php

namespace LaravelEnso\Charts\App\Factories;

use LaravelEnso\Charts\App\Enums\Charts;

class Polar extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Charts::PolarArea)
            ->ratio(1);
    }
}

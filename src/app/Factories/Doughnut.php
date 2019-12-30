<?php

namespace LaravelEnso\Charts\App\Factories;

use LaravelEnso\Charts\App\Enums\Charts;

class Doughnut extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Charts::Doughnut)
            ->ratio(1);
    }
}

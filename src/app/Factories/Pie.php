<?php

namespace LaravelEnso\Charts\App\Factories;

use LaravelEnso\Charts\App\Enums\Charts;

class Pie extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Charts::Pie)
            ->ratio(1);
    }
}

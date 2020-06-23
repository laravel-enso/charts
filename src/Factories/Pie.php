<?php

namespace LaravelEnso\Charts\Factories;

use LaravelEnso\Charts\Enums\Charts;

class Pie extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Charts::Pie)
            ->ratio(1);
    }
}

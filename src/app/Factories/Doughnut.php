<?php

namespace LaravelEnso\Charts\app\Factories;

class Doughnut extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type('doughnut')
            ->ratio(1);
    }
}

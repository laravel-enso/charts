<?php

namespace LaravelEnso\Charts\app\Factories;

class Pie extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type('pie')
            ->ratio(1);
    }
}

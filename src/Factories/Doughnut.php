<?php

namespace LaravelEnso\Charts\Factories;

use LaravelEnso\Charts\Enums\Type;

class Doughnut extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Type::Doughnut)
            ->ratio(1);
    }
}

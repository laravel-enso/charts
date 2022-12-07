<?php

namespace LaravelEnso\Charts\Factories;

use LaravelEnso\Charts\Enums\Type;

class Polar extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Type::PolarArea)
            ->ratio(1);
    }
}

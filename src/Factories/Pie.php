<?php

namespace LaravelEnso\Charts\Factories;

use LaravelEnso\Charts\Enums\Type;

class Pie extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Type::Pie)
            ->ratio(1);
    }
}

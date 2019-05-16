<?php

namespace LaravelEnso\Charts\app\Factories;

class Polar extends Circles
{
    public function __construct()
    {
        parent::__construct();

        $this->type('polarArea')
            ->ratio(1);
    }
}

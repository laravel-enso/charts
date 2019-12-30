<?php

namespace LaravelEnso\Charts\App\Factories;

use Illuminate\Support\Collection;
use LaravelEnso\Charts\App\Enums\Charts;

class Radar extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Charts::Radar)
            ->ratio(1);
    }

    public function response()
    {
        return [
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->data,
            ],
            'options' => $this->options,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }

    protected function build()
    {
        (new Collection($this->datasets))
            ->each(fn ($dataset, $label) => $this->data[] = [
                'label' => $label,
                'borderColor' => $this->color(),
                'backgroundColor' => $this->hex2rgba($this->color()),
                'pointBorderColor' => '#fff',
                'data' => $dataset,
                'datalabels' => ['backgroundColor' => $this->color()],
            ]);
    }
}

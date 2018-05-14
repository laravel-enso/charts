<?php

namespace LaravelEnso\Charts\app\Classes;

class RadarChart extends Chart
{
    public $fill = false;

    public function __construct()
    {
        parent::__construct();

        $this->type('radar')
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
        collect($this->datasets)->each(function ($dataset, $label) {
            $color = $this->color();

            $this->data[] = [
                'label' => $label,
                'borderColor' => $color,
                'backgroundColor' => $this->hex2rgba($color),
                'pointBorderColor' => '#fff',
                'data' => $dataset,
                'datalabels' => [
                    'backgroundColor' => $color,
                ],
            ];
        });
    }
}

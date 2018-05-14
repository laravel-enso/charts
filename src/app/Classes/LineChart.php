<?php

namespace LaravelEnso\Charts\app\Classes;

class LineChart extends Chart
{
    private $fill = false;

    public function __construct()
    {
        parent::__construct();

        $this->type('line')
            ->ratio(1.6);
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

    public function fill()
    {
        $this->fill = true;

        return $this;
    }

    protected function build()
    {
        collect($this->datasets)->each(function ($dataset, $label) {
            $color = $this->color();

            $this->data[] = [
                'fill' => $this->fill,
                'lineTension' => 0.1,
                'pointHoverRadius' => 5,
                'pointHitRadius' => 5,
                'label' => $label,
                'borderColor' => $color,
                'backgroundColor' => $this->hex2rgba($color),
                'data' => $dataset,
                'datalabels' => [
                    'backgroundColor' => $color,
                ],
            ];
        });
    }
}

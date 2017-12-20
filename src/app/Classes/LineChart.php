<?php

namespace LaravelEnso\Charts\app\Classes;

class LineChart extends AbstractChart
{
    private $fill = false;

    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->setType('line');
    }

    public function getResponse()
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

    public function setFill()
    {
        $this->fill = true;
    }

    protected function buildChartData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $borderColor = $this->chartColors[$colorIndex];

            $this->data[] = [
                'fill' => $this->fill,
                'lineTension' => 0.1,
                'pointHoverRadius' => 5,
                'pointHitRadius' => 10,
                'label' => $label,
                'borderColor' => $borderColor,
                'backgroundColor' => $this->hex2rgba($borderColor),
                'data' => $dataset,
            ];

            $colorIndex++;
        }
    }
}

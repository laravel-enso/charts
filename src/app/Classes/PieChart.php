<?php

namespace LaravelEnso\Charts\app\Classes;

class PieChart extends AbstractChart
{
    private $backgroundColor = [];

    protected function buildChartData()
    {
        for ($colorIndex = 0; $colorIndex < count($this->labels); $colorIndex++) {
            $this->backgroundColor[] = $this->chartColors[$colorIndex];
        }
    }

    public function getResponse()
    {
        return [
            'labels'   => $this->labels,
            'datasets' => [
                [
                    'data'            => $this->datasets,
                    'backgroundColor' => $this->backgroundColor,
                ],
            ],
        ];
    }
}

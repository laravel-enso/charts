<?php

namespace LaravelEnso\Charts\Classes;

use LaravelEnso\Charts\Chart;

class PieChart extends Chart
{
    private $backgroundColor = [];

    protected function buildChartData()
    {
        for ($colorIndex = 0; $colorIndex < count($this->labels); $colorIndex++) {
            $this->backgroundColor[] = $this->chartColors->getValueByKey($colorIndex);
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

<?php

namespace LaravelEnso\Charts\Classes;

use LaravelEnso\Charts\Chart;

class PieChart extends Chart
{

    private $backgroundColor = [];

    protected function buildChartData()
    {
        for ($i = 0; $i < count($this->labels); $i++) {

            $this->backgroundColor[] = $this->chartColors->getValueByKey($i);
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

<?php

namespace LaravelEnso\Charts\Classes;

use LaravelEnso\Charts\Abstracts\Chart;

class LineChart extends Chart
{
    public $fill = false;

    protected function buildChartData()
    {
        $colorIndex = 0;
        $this->data = [];

        foreach ($this->datasets as $label => $dataset) {
            $color = $this->chartColors->getValueByKey($colorIndex);

            $backgroundColor = $this->hex2rgba($color);

            $this->data[] = [

                'fill'             => $this->fill,
                'lineTension'      => 0.1,
                'pointHoverRadius' => 5,
                'pointHitRadius'   => 10,
                'label'            => $label,
                'borderColor'      => $color,
                'backgroundColor'  => $backgroundColor,
                'data'             => $dataset,
            ];

            $colorIndex++;
        }
    }

    public function getResponse()
    {
        return [

            'labels'   => $this->labels,
            'datasets' => $this->data,
        ];
    }
}

<?php

namespace LaravelEnso\Charts\Classes;

use LaravelEnso\Charts\Chart;

class RadarChart extends Chart
{
    public $fill = false;

    protected function buildChartData()
    {
        $i = 0;

        foreach ($this->datasets as $label => $dataset) {
            $borderColor = $this->chartColors->getValueByKey($i);
            $backgroundColor = $this->hex2rgba($borderColor);

            $this->data[] = [

                'label'            => $label,
                'backgroundColor'  => $backgroundColor,
                'borderColor'      => $borderColor,
                'pointBorderColor' => '#fff',
                'data'             => $dataset,
            ];

            $i++;
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

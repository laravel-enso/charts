<?php

namespace LaravelEnso\Charts\App\Classes;

use LaravelEnso\Charts\App\Classes\AbstractChart;

class RadarChart extends AbstractChart
{
    public $fill = false;

    protected function buildChartData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $borderColor = $this->chartColors->getValueByKey($colorIndex);
            $backgroundColor = $this->hex2rgba($borderColor);

            $this->data[] = [

                'label'            => $label,
                'backgroundColor'  => $backgroundColor,
                'borderColor'      => $borderColor,
                'pointBorderColor' => '#fff',
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

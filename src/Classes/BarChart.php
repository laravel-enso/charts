<?php

namespace LaravelEnso\Charts\Classes;

use LaravelEnso\Charts\Abstracts\Chart;

class BarChart extends Chart
{
    protected function buildChartData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $color = $this->chartColors->getValueByKey($colorIndex);

            $this->data[] = [

                'label'           => $label,
                'backgroundColor' => $color,
                'data'            => $dataset,
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

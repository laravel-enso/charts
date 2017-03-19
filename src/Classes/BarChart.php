<?php

namespace LaravelEnso\Charts\Classes;

use LaravelEnso\Charts\Chart;

class BarChart extends Chart
{

    protected function buildChartData()
    {
        $i = 0;

        foreach ($this->datasets as $label => $dataset) {

            $color = $this->chartColors->getValueByKey($i);

            $this->data[] = [

                'label'           => $label,
                'backgroundColor' => $color,
                'data'            => $dataset,
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

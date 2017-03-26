<?php

namespace LaravelEnso\Charts\App\Classes;

class LineChart extends AbstractChart
{
    public $fill = false;

    protected function buildChartData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $this->data[] = [
                'fill'             => $this->fill,
                'lineTension'      => 0.1,
                'pointHoverRadius' => 5,
                'pointHitRadius'   => 10,
                'label'            => $label,
                'borderColor'      => $this->chartColors->getValueByKey($colorIndex),
                'backgroundColor'  => $this->hex2rgba($color),
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

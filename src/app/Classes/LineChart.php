<?php

namespace LaravelEnso\Charts\app\Classes;

class LineChart extends AbstractChart
{
    public $fill = false;

    protected function buildChartData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $borderColor = $this->chartColors->getValueByKey($colorIndex);

            $this->data[] = [
                'fill'             => $this->fill,
                'lineTension'      => 0.1,
                'pointHoverRadius' => 5,
                'pointHitRadius'   => 10,
                'label'            => $label,
                'borderColor'      => $borderColor,
                'backgroundColor'  => $this->hex2rgba($borderColor),
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

<?php

namespace LaravelEnso\Charts\App\Classes;

class RadarChart extends AbstractChart
{
    public $fill = false;

    protected function buildChartData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $this->data[] = [
                'label'            => $label,
                'backgroundColor'  => $this->hex2rgba($borderColor),
                'borderColor'      => $this->chartColors->getValueByKey($colorIndex),
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

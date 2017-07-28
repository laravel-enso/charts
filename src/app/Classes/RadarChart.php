<?php

namespace LaravelEnso\Charts\app\Classes;

class RadarChart extends AbstractChart
{
    public $fill = false;

    public function getResponse()
    {
        return [
            'data' => [
                'labels'   => $this->labels,
                'datasets' => $this->data,
            ],
            'options' => $this->options,
            'title'   => $this->title,
        ];
    }

    protected function buildChartData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $borderColor = $this->chartColors[$colorIndex];

            $this->data[] = [
                'label'            => $label,
                'borderColor'      => $borderColor,
                'backgroundColor'  => $this->hex2rgba($borderColor),
                'pointBorderColor' => '#fff',
                'data'             => $dataset,
            ];

            $colorIndex++;
        }
    }
}

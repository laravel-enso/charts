<?php

namespace LaravelEnso\Charts\app\Classes;

class BarChart extends AbstractChart
{
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

    public function setStackedScales()
    {
        $this->options['scales'] = [
            'xAxes' => [
                ['stacked' => true],
            ],
            'yAxes' => [
                ['stacked' => true],
            ],
        ];

        return $this;
    }

    protected function buildChartData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $this->data[] = [
                'label'           => $label,
                'backgroundColor' => $this->chartColors[$colorIndex],
                'data'            => $dataset,
            ];

            $colorIndex++;
        }
    }
}

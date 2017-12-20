<?php

namespace LaravelEnso\Charts\app\Classes;

abstract class PiePolarOrDoughnutChart extends AbstractChart
{
    private $backgroundColor = [];

    public function getResponse()
    {
        return [
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->getDatasets(),
            ],
            'options' => $this->options,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }

    protected function buildChartData()
    {
        for ($colorIndex = 0; $colorIndex < count($this->labels); $colorIndex++) {
            $this->backgroundColor[] = $this->chartColors[$colorIndex];
        }
    }

    private function getDatasets()
    {
        return is_array($this->datasets[0])
            ? $this->getStackedDatasets()
            : [
                [
                    'data' => $this->datasets,
                    'backgroundColor' => $this->backgroundColor,
                ],
            ];
    }

    private function getStackedDatasets()
    {
        $datasets = [];

        foreach ($this->datasets as $dataset) {
            $datasets[] = [
                'data' => $dataset,
                'backgroundColor' => $this->backgroundColor,
            ];
        }

        return $datasets;
    }
}

<?php

namespace LaravelEnso\Charts\app\Classes;

abstract class PiePolarOrDoughnutChart extends Chart
{
    public function response()
    {
        return [
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->data,
            ],
            'options' => $this->options,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }

    protected function build()
    {
        $this->colors = collect($this->colors())
            ->slice(0, count($this->labels));

        $this->data = is_array($this->datasets[0])
            ? $this->stackedDatasets()
            : [
                [
                    'data' => $this->datasets,
                    'backgroundColor' => $this->colors,
                    'datalabels' => [
                        'backgroundColor' => $this->colors,
                    ],
                ],
            ];
    }

    private function stackedDatasets()
    {
        return collect($this->datasets)->map(function ($dataset) {
            return [
                'data' => $dataset,
                'backgroundColor' => $this->colors,
                'datalabels' => [
                    'backgroundColor' => $this->colors,
                ],
            ];
        });
    }
}

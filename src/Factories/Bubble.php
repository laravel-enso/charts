<?php

namespace LaravelEnso\Charts\Factories;

use Illuminate\Support\Collection;
use LaravelEnso\Charts\Enums\Charts;
use LaravelEnso\Helpers\Services\Decimals;

class Bubble extends Chart
{
    private int $radiusLimit;
    private int $maxRadius;

    public function __construct()
    {
        parent::__construct();

        $this->radiusLimit = 25;

        $this->type(Charts::Bubble)
            ->ratio(1.6)
            ->scales();
    }

    public function response()
    {
        return [
            'data' => ['datasets' => $this->data],
            'options' => $this->options,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }

    protected function build()
    {
        $this->maxRadius()
            ->computeRadius()
            ->mapDatasetsLabels()
            ->data();
    }

    private function maxRadius()
    {
        $this->maxRadius = (new Collection($this->datasets))
            ->map(fn ($dataset) => max(array_column($dataset, 2)))
            ->max();

        return $this;
    }

    private function computeRadius()
    {
        $this->datasets = (new Collection($this->datasets))
            ->map(fn ($dataset) => (new Collection($dataset))
                ->map(fn ($bubble) => $this->bubbleRadius($bubble))
            )->toArray();

        return $this;
    }

    private function bubbleRadius(array $bubble)
    {
        $bubble[2] = Decimals::ceil(
            Decimals::div($this->radiusLimit * $bubble[2], $this->maxRadius)
        );

        return $bubble;
    }

    private function mapDatasetsLabels()
    {
        $this->datasets = array_combine(
            array_values($this->labels),
            array_values($this->datasets)
        );

        return $this;
    }

    private function data()
    {
        (new Collection($this->datasets))
            ->each(fn ($dataset, $label) => $this->data[] = [
                'label' => $label,
                'borderColor' => $this->color(),
                'backgroundColor' => $this->hex2rgba($this->color()),
                'hoverBackgroundColor' => $this->hex2rgba($this->color(), 0.6),
                'data' => $this->dataset($dataset),
                'datalabels' => [
                    'backgroundColor' => $this->color(),
                ],
            ]);
    }

    private function dataset($dataset)
    {
        return (new Collection($dataset))
            ->map(fn ($values) => [
                'x' => $values[0],
                'y' => $values[1],
                'r' => $values[2],
            ]);
    }
}

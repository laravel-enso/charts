<?php

namespace LaravelEnso\Charts\Factories;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;
use LaravelEnso\Charts\Enums\Charts;
use LaravelEnso\Helpers\Services\Decimals;

class Bubble extends Chart
{
    use Conditionable;

    private bool $autoRadius;
    private int $radiusLimit;
    private int $maxRadius;

    public function __construct()
    {
        parent::__construct();

        $this->autoRadius = true;
        $this->radiusLimit = 25;

        $this->type(Charts::Bubble)
            ->ratio(1.6);
    }

    public function response(): array
    {
        return [
            'data' => ['datasets' => $this->data],
            'options' => $this->options,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }

    public function disableAutoRadius(): self
    {
        $this->autoRadius = false;

        return $this;
    }

    protected function build(): void
    {
        $this->when($this->autoRadius, fn ($chart) => $chart
            ->maxRadius()
            ->computeRadius())
            ->mapDatasetsLabels()
            ->data();
    }

    private function maxRadius(): self
    {
        $this->maxRadius = Collection::wrap($this->datasets)
            ->map(fn ($dataset) => max(array_column($dataset, 2)))
            ->max();

        return $this;
    }

    private function computeRadius(): self
    {
        $this->datasets = Collection::wrap($this->datasets)
            ->map(fn ($dataset) => Collection::wrap($dataset)
                ->map(fn ($bubble) => $this->bubbleRadius($bubble)))
            ->toArray();

        return $this;
    }

    private function bubbleRadius(array $bubble): array
    {
        $bubble[2] = Decimals::ceil(
            Decimals::div($this->radiusLimit * $bubble[2], $this->maxRadius)
        );

        return $bubble;
    }

    private function mapDatasetsLabels(): self
    {
        $this->datasets = array_combine(
            array_values($this->labels),
            array_values($this->datasets)
        );

        return $this;
    }

    private function data(): void
    {
        Collection::wrap($this->datasets)
            ->each(fn ($dataset, $label) => $this->data[] = [
                'label' => $label,
                'borderColor' => $this->color(),
                'backgroundColor' => $this->hex2rgba($this->color()),
                'hoverBackgroundColor' => $this->hex2rgba($this->color(), 0.6),
                'data' => $this->dataset($dataset),
                'datalabels' => empty($this->datalabels) ? [
                    'backgroundColor' => $this->color(),
                ] : $this->datalabels,
            ]);
    }

    private function dataset($dataset): Collection
    {
        return Collection::wrap($dataset)
            ->map(fn ($values) => [
                'x' => $values[0],
                'y' => $values[1],
                'r' => $values[2],
            ]);
    }
}

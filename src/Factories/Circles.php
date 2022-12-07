<?php

namespace LaravelEnso\Charts\Factories;

use Illuminate\Support\Collection;

abstract class Circles extends Chart
{
    public function response(): array
    {
        return [
            'data' => [
                'labels' => $this->labels,
                'datasets' => $this->data,
            ],
            'options' => $this->options,
            'title' => $this->title,
            'type' => $this->type->value,
        ];
    }

    protected function build(): void
    {
        $colors = Collection::wrap($this->colors())
            ->slice(0, count($this->labels));

        $this->data = is_array($this->datasets[0])
            ? $this->stackedDatasets($colors)
            : [[
                'data' => $this->datasets,
                'backgroundColor' => $colors,
                'datalabels' => ['backgroundColor' => $colors],
            ]];
    }

    private function stackedDatasets(Collection $colors): Collection
    {
        return Collection::wrap($this->datasets)
            ->map(fn ($dataset) => [
                'data' => $dataset,
                'backgroundColor' => $colors,
                'datalabels' => empty($this->datalabels) ? [
                    'backgroundColor' => $colors,
                ] : $this->datalabels,
            ]);
    }
}

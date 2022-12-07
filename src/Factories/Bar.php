<?php

namespace LaravelEnso\Charts\Factories;

use Illuminate\Support\Collection;
use LaravelEnso\Charts\Enums\Type;

class Bar extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Type::Bar)
            ->ratio(1.6);
    }

    public function horizontal(): self
    {
        $this->type('horizontalBar');

        return $this;
    }

    public function stackedScales(): self
    {
        $this->xAxisConfig(['stacked' => true])
            ->yAxisConfig(['stacked' => true]);

        return $this;
    }

    protected function response(): array
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
        Collection::wrap($this->datasets)
            ->each(fn ($dataset, $label) => $this->data[] = [
                'label' => $label,
                'backgroundColor' => $this->color(),
                'data' => $dataset,
                'datalabels' => empty($this->datalabels) ? [
                    'backgroundColor' => $this->color(),
                ] : $this->datalabels,
            ]);
    }
}

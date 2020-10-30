<?php

namespace LaravelEnso\Charts\Factories;

use Illuminate\Support\Collection;

class Bar extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type('bar')
            ->ratio(1.6);
    }

    public function horizontal(): self
    {
        $this->type('horizontalBar');

        return $this;
    }

    public function stackedScales(): self
    {
        $this->options['scales'] = [
            'xAxes' => [['stacked' => true]],
            'yAxes' => [['stacked' => true]],
        ];

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
            'type' => $this->type,
        ];
    }

    protected function build(): void
    {
        (new Collection($this->datasets))
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

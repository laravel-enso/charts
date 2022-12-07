<?php

namespace LaravelEnso\Charts\Factories;

use Illuminate\Support\Collection;
use LaravelEnso\Charts\Enums\Type;

class Radar extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->type(Type::Radar)
            ->ratio(1);
    }

    public function response(): array
    {
        return [
            'data' => [
                'labels'   => $this->labels,
                'datasets' => $this->data,
            ],
            'options' => $this->options,
            'title'   => $this->title,
            'type'    => $this->type->value,
        ];
    }

    protected function build(): void
    {
        Collection::wrap($this->datasets)
            ->each(fn ($dataset, $label) => $this->data[] = [
                'label' => $label,
                'borderColor' => $this->color(),
                'backgroundColor' => $this->hex2rgba($this->color()),
                'pointBorderColor' => '#fff',
                'data' => $dataset,
                'datalabels' => empty($this->datalabels) ? [
                    'backgroundColor' => $this->color(),
                ] : $this->datalabels,
            ]);
    }
}

<?php

namespace LaravelEnso\Charts\Factories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

abstract class Chart
{
    protected array $axes;
    protected array $data;
    protected array $datasetConfig;
    protected array $options;
    protected array $datasets;
    protected array $labels;
    protected array $colors;
    protected string $title;
    protected string $type;
    protected array $datalabels;
    private bool $gridlines;
    private bool $autoYMin;

    public function __construct()
    {
        $this->axes = ['xAxes' => ['x' => []], 'yAxes' => ['y' => []]];
        $this->data = [];
        $this->datasetConfig = [];
        $this->options = Config::get('enso.charts.options');
        $this->labels = [];
        $this->datalabels = [];
        $this->gridlines = false;
        $this->autoYMin = false;

        $this->colors();
    }

    public function get(): array
    {
        $this->scales()->build();

        $this->customize();

        return $this->response();
    }

    public function autoYMin(): self
    {
        $this->autoYMin = true;

        return $this;
    }

    public function gridlines(): self
    {
        $this->gridlines = true;

        return $this;
    }

    public function datalabels(array $config): self
    {
        $this->datalabels = $config;

        return $this;
    }

    public function colorsConfig(array $colors): self
    {
        $this->colors = $colors;

        return $this;
    }

    public function datasetConfig(string $dataset, array $config): self
    {
        $this->datasetConfig[$dataset] = $config;

        return $this;
    }

    public function xAxisConfig(array $config, ?string $dataset = 'x'): self
    {
        $this->axes['xAxes'][$dataset] = $config;

        return $this;
    }

    public function yAxisConfig(array $config, ?string $dataset = 'y'): self
    {
        $this->axes['yAxes'][$dataset] = $config;

        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function labels(array $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    public function datasets(array $datasets): self
    {
        $this->datasets = $datasets;

        return $this;
    }

    public function ratio(float $ratio): self
    {
        $this->options['aspectRatio'] = $ratio;

        return $this;
    }

    public function option(string $option, $value): self
    {
        $this->options[$option] = $value;

        return $this;
    }

    public function plugin(string $plugin, $config)
    {
        $this->options['plugins'][$plugin] = $config;

        return $this;
    }

    abstract protected function build(): void;

    abstract protected function response(): array;

    protected function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    protected function hex2rgba(string $color): string
    {
        $color = substr($color, 1);

        $hex = [
            "{$color[0]}{$color[1]}",
            "{$color[2]}{$color[3]}",
            "{$color[4]}{$color[5]}",
        ];

        $rgb = array_map('hexdec', $hex);
        $rgba = implode(',', $rgb);
        $opacity = Config::get('enso.charts.fillBackgroundOpacity');

        return "rgba({$rgba},{$opacity})";
    }

    protected function color(?string $index = null): string
    {
        $index ??= count($this->data);

        return $this->colors[$index];
    }

    protected function colors(): array
    {
        return $this->colors ??= array_values(Config::get('enso.charts.colors'));
    }

    protected function scales(): self
    {
        foreach ($this->axes['xAxes'] as $axis => $config) {
            $this->options['scales'][$axis] = array_merge_recursive(
                $config,
                $this->defaultXConfig()
            );
        }
        foreach ($this->axes['yAxes'] as $axis => $config) {
            $this->options['scales'][$axis] = array_merge_recursive(
                $config,
                $this->defaultYConfig()
            );
        }

        return $this;
    }

    private function defaultXConfig(): array
    {
        return  [
            'ticks' => [
                'autoSkip' => false,
                'maxRotation' => 90,
            ],
            'grid' => ['drawOnChartArea' => $this->gridlines],
        ];
    }

    private function defaultYConfig(): array
    {
        $config = ['grid' => ['drawOnChartArea' => $this->gridlines]];

        if (! $this->autoYMin) {
            $config['ticks']['min'] = 0;
        }

        return $config;
    }

    private function customize(): void
    {
        foreach ($this->datasetConfig as $label => $config) {
            $index = Collection::wrap($this->data)
                ->search(fn ($dataset) => $dataset['label'] === $label);
            $this->data[$index] = array_merge($this->data[$index], $config);
        }
    }
}

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

    public function __construct()
    {
        $this->axes = ['x' => [], 'y' => []];
        $this->data = [];
        $this->datasetConfig = [];
        $this->options = [];

        $this->colors();
    }

    public function get()
    {
        $this->scales()->build();

        $this->customize();

        return $this->response();
    }

    public function datasetConfig(string $dataset, array $config)
    {
        $this->datasetConfig[$dataset] = $config;

        return $this;
    }

    public function xAxisConfig(string $dataset, array $config)
    {
        $this->axes['x'][$dataset] = $config;

        return $this;
    }

    public function yAxisConfig(string $dataset, array $config)
    {
        $this->axes['y'][$dataset] = $config;

        return $this;
    }

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function labels(array $labels)
    {
        $this->labels = $labels;

        return $this;
    }

    public function datasets(array $datasets)
    {
        $this->datasets = $datasets;

        return $this;
    }

    public function ratio(float $ratio)
    {
        $this->options['aspectRatio'] = $ratio;

        return $this;
    }

    public function option(string $option, $value)
    {
        $this->options[$option] = $value;

        return $this;
    }

    abstract protected function build();

    abstract protected function response();

    protected function type(string $type)
    {
        $this->type = $type;

        return $this;
    }

    protected function hex2rgba(string $color)
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

    protected function color(?int $index = null)
    {
        $index ??= count($this->data);

        return $this->colors[$index];
    }

    protected function colors()
    {
        return $this->colors = array_values(Config::get('enso.charts.colors'));
    }

    protected function scales()
    {
        $this->options['scales'] = [
            'xAxes' => $this->xAxes(),
            'yAxes' => $this->yAxes(),
        ];

        foreach (array_keys($this->datasetConfig) as $label) {
            if (isset($this->axes['x'][$label]['id'])) {
                $this->datasetConfig[$label]['xAxisID'] = $this->axes['x'][$label]['id'];
            }
            if (isset($this->axes['y'][$label]['id'])) {
                $this->datasetConfig[$label]['yAxisID'] = $this->axes['y'][$label]['id'];
            }
        }

        return $this;
    }

    private function xAxes()
    {
        return $this->mergeAxisConfig('x', [
            'ticks' => [
                'autoSkip' => false,
                'maxRotation' => 90,
            ],
            'gridLines' => ['drawOnChartArea' => false],
        ]);
    }

    private function yAxes()
    {
        return $this->mergeAxisConfig('y', ['gridLines' => ['drawOnChartArea' => false]]);
    }

    private function mergeAxisConfig(string $axis, array $defaultConfig)
    {
        return empty($this->axes[$axis])
            ? [$defaultConfig]
            : Collection::wrap($this->axes[$axis])
            ->map(fn ($customConfig) => Collection::wrap($defaultConfig)
                ->merge($customConfig))
            ->values()->toArray();
    }

    private function customize()
    {
        foreach ($this->datasetConfig as $label => $config) {
            $index = Collection::wrap($this->data)
                ->search(fn ($dataset) => $dataset['label'] === $label);
            $this->data[$index] = array_merge($this->data[$index], $config);
        }
    }
}

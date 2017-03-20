<?php

namespace LaravelEnso\Charts\Abstracts;

use LaravelEnso\Charts\Enums\ChartColorsEnum;

abstract class Chart
{
    protected $datasets;
    protected $labels;
    protected $chartColors;
    protected $data;

    protected $opacity;

    public function __construct($lables, $datasets)
    {
        $this->opacity = 0.6;
        $this->labels = $lables;
        $this->datasets = $datasets;
        $this->chartColors = new ChartColorsEnum();
        $this->buildChartData();
    }

    abstract protected function buildChartData();

    abstract public function getResponse();

    protected function hex2rgba($color)
    {
        $color = substr($color, 1);
        $hex = [$color[0].$color[1], $color[2].$color[3], $color[4].$color[5]];
        $rgb = array_map('hexdec', $hex);
        $result = 'rgba('.implode(',', $rgb).','.$this->opacity.')';

        return $result;
    }
}

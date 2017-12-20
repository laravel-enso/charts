<?php

namespace LaravelEnso\Charts\app\Classes;

class BubbleChart extends AbstractChart
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->setType('bubble');
    }

    public $fill = false;
    public $radiusLimit = 25;
    private $maxRadius;

    public function getResponse()
    {
        return [
            'data' => ['datasets' => $this->data],
            'options' => $this->options,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }

    protected function buildChartData()
    {
        $this->setMaxRadius();
        $this->computeRadius();
        $this->mapDatasetsLabels();
        $this->setData();
    }

    private function setData()
    {
        $colorIndex = 0;

        foreach ($this->datasets as $label => $dataset) {
            $borderColor = $this->chartColors[$colorIndex];

            $this->data[] = [
                'label' => $label,
                'borderColor' => $borderColor,
                'backgroundColor' => $this->hex2rgba($borderColor),
                'hoverBackgroundColor' => $this->hex2rgba($borderColor, 0.6),
                'data' => $this->buildDatasetArray($dataset),
            ];

            $colorIndex++;
        }
    }

    private function computeRadius()
    {
        foreach ($this->datasets as &$dataset) {
            foreach ($dataset as &$bubble) {
                $bubble[2] = round($this->radiusLimit * $bubble[2] / $this->maxRadius, 2);
            }
        }
    }

    private function setMaxRadius()
    {
        $maxArray = [];

        foreach ($this->datasets as $dataset) {
            $maxArray[] = max(array_column($dataset, 2));
        }

        $this->maxRadius = max($maxArray);
    }

    private function mapDatasetsLabels()
    {
        $this->datasets = array_combine(
            array_values($this->labels),
            array_values($this->datasets)
        );
    }

    private function buildDatasetArray($dataset)
    {
        $datasetArray = [];

        foreach ($dataset as $values) {
            $datasetArray[] = [
                'x' => $values[0],
                'y' => $values[1],
                'r' => $values[2],
            ];
        }

        return $datasetArray;
    }
}

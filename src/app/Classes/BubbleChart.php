<?php

namespace LaravelEnso\Charts\App\Classes;

class BubbleChart extends AbstractChart
{
    public $fill = false;
    public $maxRadius = 25;
    private $maxDatasetsRadius;

    protected function buildChartData()
    {
        $colorIndex = 0;

        $this->getBubbleChartDatasetMaxRadius();
        $this->resizeBubbleChartDatasetRadius();
        $this->mapDatasetsWithLabels();

        foreach ($this->datasets as $label => $dataset) {
            $borderColor = $this->chartColors->getValueByKey($colorIndex);
            $backgroundColor = $this->hex2rgba($borderColor);
            $hoverBackgroundColor = $this->hex2rgba($borderColor, 0.6);

            $datasetArray = $this->buildDatasetArray($dataset);

            $this->data[] = [

                'label'                => $label,
                'backgroundColor'      => $backgroundColor,
                'borderColor'          => $borderColor,
                'hoverBackgroundColor' => $hoverBackgroundColor,
                'data'                 => $datasetArray,
            ];

            $colorIndex++;
        }
    }

    public function getResponse()
    {
        return [

            'datasets' => $this->data,
        ];
    }

    private function resizeBubbleChartDatasetRadius()
    {
        foreach ($this->datasets as &$dataset) {
            foreach ($dataset as &$bubble) {
                $bubble[2] = round($this->maxRadius * $bubble[2] / $this->maxDatasetsRadius, 2);
            }
        }
    }

    private function getBubbleChartDatasetMaxRadius()
    {
        $maxArray = [];

        foreach ($this->datasets as $dataset) {
            $maxArray[] = max(array_column($dataset, 2));
        }

        $this->maxDatasetsRadius = max($maxArray);
    }

    private function mapDatasetsWithLabels()
    {
        $this->datasets = array_combine(array_values($this->labels), array_values($this->datasets));
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

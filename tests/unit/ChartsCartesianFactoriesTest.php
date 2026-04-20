<?php

require_once __DIR__.'/../TestCase.php';

use LaravelEnso\Charts\Enums\Charts;
use LaravelEnso\Charts\Factories\Bar;
use LaravelEnso\Charts\Factories\Line;
use LaravelEnso\Charts\Factories\Radar;
use PHPUnit\Framework\Attributes\Test;

class ChartsCartesianFactoriesTest extends ChartsTestCase
{
    #[Test]
    public function bar_factory_builds_expected_payload_and_merges_dataset_options(): void
    {
        $chart = (new Bar())
            ->title('Quarterly revenue')
            ->labels(['Q1', 'Q2'])
            ->datasets([
                'Revenue'  => [12000, 18000],
                'Forecast' => [10000, 16000],
            ])
            ->horizontal()
            ->stackedScales()
            ->gridlines()
            ->shortNumbers(3)
            ->datasetConfig('Revenue', ['borderWidth' => 2])
            ->xAxisConfig(['stacked' => true, 'min' => 1])
            ->yAxisConfig(['stacked' => true, 'suggestedMax' => 20000])
            ->get();

        $this->assertSame('bar', $chart['type']);
        $this->assertSame('Quarterly revenue', $chart['title']);
        $this->assertSame(['Q1', 'Q2'], $chart['data']['labels']);
        $this->assertSame('Revenue', $chart['data']['datasets'][0]['label']);
        $this->assertSame([12000, 18000], $chart['data']['datasets'][0]['data']);
        $this->assertSame(2, $chart['data']['datasets'][0]['borderWidth']);
        $this->assertSame('#008000', $chart['data']['datasets'][0]['backgroundColor']);
        $this->assertSame('y', $chart['options']['indexAxis']);
        $this->assertTrue($chart['options']['shortNumbers']);
        $this->assertSame(3, $chart['options']['precision']);
        $this->assertTrue($chart['options']['scales']['x']['stacked']);
        $this->assertTrue($chart['options']['scales']['y']['stacked']);
        $this->assertTrue($chart['options']['scales']['x']['grid']['drawOnChartArea']);
        $this->assertTrue($chart['options']['scales']['y']['grid']['drawOnChartArea']);
        $this->assertSame(0, $chart['options']['scales']['y']['ticks']['min']);
        $this->assertSame(1, $chart['options']['scales']['x']['min']);
        $this->assertSame(20000, $chart['options']['scales']['y']['suggestedMax']);
    }

    #[Test]
    public function line_factory_supports_fill_custom_datalabels_and_auto_y_min(): void
    {
        $chart = (new Line())
            ->title('Users by month')
            ->labels(['Jan', 'Feb', 'Mar'])
            ->datasets([
                'Users' => [20, 40, 35],
            ])
            ->fill()
            ->autoYMin()
            ->datalabels(['anchor' => 'center'])
            ->get();

        $dataset = $chart['data']['datasets'][0];

        $this->assertSame(Charts::Line, $chart['type']);
        $this->assertTrue($dataset['fill']);
        $this->assertSame('Users', $dataset['label']);
        $this->assertSame('rgba(0,128,0,0.25)', $dataset['backgroundColor']);
        $this->assertSame(['anchor' => 'center'], $dataset['datalabels']);
        $this->assertArrayNotHasKey('min', $chart['options']['scales']['y']['ticks'] ?? []);
    }

    #[Test]
    public function radar_factory_builds_expected_dataset_shape(): void
    {
        $chart = (new Radar())
            ->title('Skills')
            ->labels(['PHP', 'Vue'])
            ->datasets([
                'Team A' => [9, 7],
            ])
            ->get();

        $dataset = $chart['data']['datasets'][0];

        $this->assertSame(Charts::Radar, $chart['type']);
        $this->assertSame(['PHP', 'Vue'], $chart['data']['labels']);
        $this->assertSame('Team A', $dataset['label']);
        $this->assertSame('#008000', $dataset['borderColor']);
        $this->assertSame('rgba(0,128,0,0.25)', $dataset['backgroundColor']);
        $this->assertSame('#fff', $dataset['pointBorderColor']);
    }
}

<?php

require_once __DIR__.'/../TestCase.php';

use LaravelEnso\Charts\Enums\Charts;
use LaravelEnso\Charts\Factories\Doughnut;
use LaravelEnso\Charts\Factories\Pie;
use LaravelEnso\Charts\Factories\Polar;
use PHPUnit\Framework\Attributes\Test;

class ChartsCircularFactoriesTest extends ChartsTestCase
{
    #[Test]
    public function pie_factory_builds_single_dataset_and_slices_default_colors(): void
    {
        $chart = (new Pie())
            ->title('Sales split')
            ->labels(['A', 'B', 'C'])
            ->datasets([10, 20, 30])
            ->get();

        $dataset = $chart['data']['datasets'][0];

        $this->assertSame(Charts::Pie, $chart['type']);
        $this->assertSame(['A', 'B', 'C'], $chart['data']['labels']);
        $this->assertCount(3, $dataset['backgroundColor']);
        $this->assertSame(['#008000', '#FF0000', '#1E90FF'], array_values($dataset['backgroundColor']->all()));
        $this->assertSame([10, 20, 30], $dataset['data']);
    }

    #[Test]
    public function doughnut_factory_supports_multiple_datasets_and_custom_datalabels(): void
    {
        $chart = (new Doughnut())
            ->labels(['A', 'B'])
            ->datasets([
                [10, 20],
                [30, 40],
            ])
            ->datalabels(['anchor' => 'center'])
            ->get();

        $this->assertSame(Charts::Doughnut, $chart['type']);
        $this->assertCount(2, $chart['data']['datasets']);
        $this->assertSame(['anchor' => 'center'], $chart['data']['datasets'][0]['datalabels']);
        $this->assertSame([30, 40], $chart['data']['datasets'][1]['data']);
    }

    #[Test]
    public function polar_factory_builds_expected_payload(): void
    {
        $chart = (new Polar())
            ->labels(['North', 'South'])
            ->datasets([5, 9])
            ->get();

        $this->assertSame(Charts::PolarArea, $chart['type']);
        $this->assertSame(['North', 'South'], $chart['data']['labels']);
        $this->assertSame([5, 9], $chart['data']['datasets'][0]['data']);
    }
}

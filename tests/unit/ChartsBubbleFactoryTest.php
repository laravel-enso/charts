<?php

require_once __DIR__.'/../TestCase.php';

use LaravelEnso\Charts\Enums\Charts;
use LaravelEnso\Charts\Factories\Bubble;
use PHPUnit\Framework\Attributes\Test;

class ChartsBubbleFactoryTest extends ChartsTestCase
{
    #[Test]
    public function bubble_factory_auto_scales_radius_and_uses_hover_opacity(): void
    {
        $chart = (new Bubble())
            ->title('Portfolio risk')
            ->labels(['Low risk', 'High risk'])
            ->datasets([
                [
                    [12, 4, 10],
                    [18, 8, 25],
                ],
                [
                    [9, 6, 15],
                    [15, 12, 20],
                ],
            ])
            ->get();

        $firstDataset = $chart['data']['datasets'][0];

        $this->assertSame(Charts::Bubble, $chart['type']);
        $this->assertSame('Low risk', $firstDataset['label']);
        $this->assertSame('rgba(0,128,0,0.25)', $firstDataset['backgroundColor']);
        $this->assertSame('rgba(0,128,0,0.6)', $firstDataset['hoverBackgroundColor']);
        $this->assertSame(['x' => 12, 'y' => 4, 'r' => '10.0000'], $firstDataset['data'][0]);
        $this->assertSame(['x' => 18, 'y' => 8, 'r' => '25.0000'], $firstDataset['data'][1]);
    }

    #[Test]
    public function bubble_factory_can_disable_auto_radius(): void
    {
        $chart = (new Bubble())
            ->labels(['Only'])
            ->datasets([
                [
                    [12, 4, 3],
                    [18, 8, 7],
                ],
            ])
            ->disableAutoRadius()
            ->get();

        $this->assertSame(3, $chart['data']['datasets'][0]['data'][0]['r']);
        $this->assertSame(7, $chart['data']['datasets'][0]['data'][1]['r']);
    }
}

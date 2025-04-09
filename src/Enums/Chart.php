<?php

namespace LaravelEnso\Charts\Enums;

enum Chart: string
{
    case Bubble = 'bubble';
    case Doughnut = 'doughnut';
    case Line = 'line';
    case Pie = 'pie';
    case PolarArea = 'polarArea';
    case Radar = 'radar';
}

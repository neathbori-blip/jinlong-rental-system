<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatsCard extends Component
{
    public $title;
    public $value;
    public $icon;
    public $trend;
    public $trendValue;
    public $color;

    public function __construct($title, $value, $icon, $trend = null, $trendValue = null, $color = 'primary')
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->trend = $trend;
        $this->trendValue = $trendValue;
        $this->color = $color;
    }

    public function render(): View
    {
        return view('components.stats-card');
    }
}
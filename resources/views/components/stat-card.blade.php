{{-- resources/views/components/stat-card.blade.php --}}
@props([
    'title' => 'Statistic',
    'value' => '0',
    'trend' => null,
    'trendValue' => null,
    'trendUp' => true,
    'icon' => 'fa-chart-line',
    'iconColor' => 'purple',
    'subtext' => null
])

<div class="stat-card">
    <div class="stat-info">
        <h4>
            <i class="fas {{ $icon }}"></i> 
            {{ $title }}
        </h4>
        <div class="stat-number">{{ $value }}</div>
        
        @if($trend)
            <small>
                <i class="fas fa-arrow-{{ $trendUp ? 'up' : 'down' }}"></i> 
                {{ $trend }}
                @if($trendValue)
                    <span style="color: {{ $trendUp ? : '#ef4444' }};">({{ $trendValue }})</span>
                @endif
            </small>
        @endif
        
        @if($subtext)
            <small class="subtext">{{ $subtext }}</small>
        @endif
    </div>
    <div class="stat-icon {{ $iconColor }}">
        <i class="fas {{ $icon }}"></i>
    </div>
</div>
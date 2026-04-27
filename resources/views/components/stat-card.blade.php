@props([
    'title' => 'Statistic',
    'value' => '0',
    'trend' => null,
    'trendValue' => null,
    'trendUp' => true,
    'icon' => 'chart-line',
    'iconColor' => 'purple',
    'subtext' => null
])

@php
    $colorClasses = [
        'purple' => 'bg-gradient-to-br from-purple-600 to-purple-800',
        'blue' => 'bg-gradient-to-br from-blue-500 to-blue-700',
        'green' => 'bg-gradient-to-br from-emerald-500 to-green-600',
        'orange' => 'bg-gradient-to-br from-amber-500 to-orange-600',
        'red' => 'bg-gradient-to-br from-red-500 to-red-700',
    ];
    $iconBgClass = $colorClasses[$iconColor] ?? $colorClasses['purple'];
    $trendColor = $trendUp ? 'text-emerald-500' : 'text-red-500';
@endphp

<div class="bg-white rounded-2xl p-5 flex justify-between items-center border border-slate-100 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
    <div class="flex-1">
        <h4 class="text-slate-500 text-sm font-semibold mb-2">
            <i class="fas fa-{{ $icon }} mr-1"></i> {{ $title }}
        </h4>
        <div class="text-3xl font-extrabold text-slate-800 mb-1">{{ $value }}</div>
        @if($trend)
            <small class="{{ $trendColor }} text-xs">
                <i class="fas fa-arrow-{{ $trendUp ? 'up' : 'down' }}"></i> {{ $trend }}
                @if($trendValue)<span>({{ $trendValue }})</span>@endif
            </small>
        @endif
        @if($subtext)<small class="block text-slate-400 text-xs mt-1">{{ $subtext }}</small>@endif
    </div>
    <div class="w-14 h-14 rounded-2xl {{ $iconBgClass }} flex items-center justify-center text-white text-2xl">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
</div>
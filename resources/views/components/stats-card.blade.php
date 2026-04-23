<div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-{{ $color }} hover:shadow-lg transition">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm font-medium">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $value }}</p>
            @if($trend)
                <p class="text-{{ $trend == 'up' ? 'green' : 'red' }}-600 text-sm mt-2">
                    {{ $trend == 'up' ? '↑' : '↓' }} {{ $trendValue }} from last month
                </p>
            @endif
        </div>
        <div class="w-12 h-12 bg-{{ $color }}/10 rounded-lg flex items-center justify-center">
            {!! $icon !!}
        </div>
    </div>
</div>
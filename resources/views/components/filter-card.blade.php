@props([
    'title' => 'Filter',
    'searchPlaceholder' => 'Search...',
    'searchField' => 'searchInput',
    'showStatus' => true,
    'showType' => false,
    'showPriority' => false,
    'showProperty' => true,
    'showMonth' => false,
    'showMinAmount' => false,
    'statusOptions' => [],
    'typeOptions' => [],
    'priorityOptions' => [],
    'propertyOptions' => [],
    'monthOptions' => [],
    'customFilters' => []
])

<div class="bg-white rounded-2xl p-6 mb-8 border border-slate-100">
    <div class="flex justify-between items-center mb-5 flex-wrap gap-3">
        <h3 class="text-slate-800 font-semibold"><i class="fas fa-filter mr-2"></i> {{ $title }}</h3>
        <button class="bg-slate-100 px-4 py-1.5 rounded-lg text-sm text-slate-600 hover:bg-slate-200 transition" id="clearFilters">
            <i class="fas fa-eraser"></i> Clear All
        </button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-slate-600"><i class="fas fa-search"></i> Search</label>
            <input type="text" id="{{ $searchField }}" placeholder="{{ $searchPlaceholder }}" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20">
        </div>
        @if($showStatus)
        <div class="flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-slate-600"><i class="fas fa-tag"></i> Status</label>
            <select id="statusFilter" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                <option value="all">All Statuses</option>
                @foreach($statusOptions as $value => $label)<option value="{{ $value }}">{!! $label !!}</option>@endforeach
            </select>
        </div>
        @endif
        @if($showType)
        <div class="flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-slate-600"><i class="fas fa-calendar"></i> Type</label>
            <select id="typeFilter" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                <option value="all">All Types</option>
                @foreach($typeOptions as $value => $label)<option value="{{ $value }}">{{ $label }}</option>@endforeach
            </select>
        </div>
        @endif
        @if($showPriority)
        <div class="flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-slate-600"><i class="fas fa-exclamation-triangle"></i> Priority</label>
            <select id="priorityFilter" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                <option value="all">All Priorities</option>
                @foreach($priorityOptions as $value => $label)<option value="{{ $value }}">{!! $label !!}</option>@endforeach
            </select>
        </div>
        @endif
        @if($showProperty)
        <div class="flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-slate-600"><i class="fas fa-building"></i> Property</label>
            <select id="propertyFilter" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                <option value="all">All Properties</option>
                @foreach($propertyOptions as $value => $label)<option value="{{ $value }}">{{ $label }}</option>@endforeach
            </select>
        </div>
        @endif
        @if($showMonth)
        <div class="flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-slate-600"><i class="fas fa-calendar"></i> Month</label>
            <select id="monthFilter" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                <option value="all">All Months</option>
                @foreach($monthOptions as $value => $label)<option value="{{ $value }}">{{ $label }}</option>@endforeach
            </select>
        </div>
        @endif
        @if($showMinAmount)
        <div class="flex flex-col gap-1.5">
            <label class="text-xs font-semibold text-slate-600"><i class="fas fa-dollar-sign"></i> Min Amount</label>
            <input type="number" id="minAmount" placeholder="$0" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
        </div>
        @endif
    </div>
</div>
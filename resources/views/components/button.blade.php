{{-- resources/views/components/button.blade.php --}}
@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left',
    'fullWidth' => false,
    'loading' => false,
    'disabled' => false,
    'href' => null,
    'id' => null,
    'class' => ''
])

@php
    $variants = [
        'primary' => 'bg-gradient-to-r from-purple-600 to-purple-800 text-white hover:shadow-lg hover:-translate-y-0.5',
        'secondary' => 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50',
        'success' => 'bg-gradient-to-r from-emerald-500 to-green-600 text-white hover:shadow-lg hover:-translate-y-0.5',
        'danger' => 'bg-gradient-to-r from-red-500 to-red-700 text-white hover:shadow-lg hover:-translate-y-0.5',
        'warning' => 'bg-gradient-to-r from-amber-500 to-orange-600 text-white hover:shadow-lg hover:-translate-y-0.5',
        'info' => 'bg-gradient-to-r from-blue-500 to-blue-700 text-white hover:shadow-lg hover:-translate-y-0.5',
        'outline' => 'border-2 border-purple-600 text-purple-600 hover:bg-purple-50',
        'ghost' => 'text-slate-600 hover:bg-slate-100',
    ];
    
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm rounded-lg',
        'md' => 'px-5 py-2.5 text-sm rounded-xl',
        'lg' => 'px-6 py-3 text-base rounded-xl',
        'xl' => 'px-8 py-4 text-lg rounded-2xl',
    ];
    
    // Get the variant class, fallback to primary if not found
    $variantClass = $variants[$variant] ?? $variants['primary'];
    
    // Get the size class, fallback to md if not found
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    
    // Start building the classes
    $buttonClasses = $sizeClass . ' ' . $variantClass . ' font-semibold cursor-pointer transition-all duration-300 flex items-center gap-2';
    
    if ($fullWidth) {
        $buttonClasses .= ' w-full justify-center';
    }
    
    if ($disabled || $loading) {
        $buttonClasses .= ' opacity-50 cursor-not-allowed hover:transform-none';
    }
    
    if ($class) {
        $buttonClasses .= ' ' . $class;
    }
@endphp

@if($href)
    <a href="{{ $href }}" id="{{ $id }}" class="{{ $buttonClasses }}" {{ $disabled ? 'disabled' : '' }}>
        @if($loading)
            <i class="fas fa-spinner fa-spin"></i>
        @elseif($icon && $iconPosition === 'left')
            <i class="fas fa-{{ $icon }}"></i>
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right' && !$loading)
            <i class="fas fa-{{ $icon }}"></i>
        @endif
    </a>
@else
    <button type="{{ $type }}" id="{{ $id }}" class="{{ $buttonClasses }}" {{ $disabled ? 'disabled' : '' }}>
        @if($loading)
            <i class="fas fa-spinner fa-spin"></i>
        @elseif($icon && $iconPosition === 'left')
            <i class="fas fa-{{ $icon }}"></i>
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right' && !$loading)
            <i class="fas fa-{{ $icon }}"></i>
        @endif
    </button>
@endif
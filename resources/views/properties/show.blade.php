
@extends('layouts.app')

@section('title', $property->title)

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Properties</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            <div class="card">
                <div class="card-body">
                    @if($property->image)
                        <img src="{{ asset('storage/' . $property->image) }}" class="img-fluid rounded" style="width: 100%;" alt="{{ $property->title }}">
                    @else
                        <img src="https://via.placeholder.com/800x400?text=Property+Image" class="img-fluid rounded" alt="No Image">
                    @endif
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="display-4 text-primary mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-4">
                        <div class="col-6">
                            <i class="fas fa-bed"></i> <strong>{{ $property->bedrooms }}</strong> Bedrooms
                        </div>
                        <div class="col-6">
                            <i class="fas fa-bath"></i> <strong>{{ $property->bathrooms }}</strong> Bathrooms
                        </div>
                        @if($property->size)
                        <div class="col-6 mt-2">
                            <i class="fas fa-arrows-alt"></i> <strong>{{ $property->size }}</strong> sqft
                        </div>
                        @endif
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-secondary" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="card mt-4">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $property->description }}</p>
        </div>
    </div>
    @endif
</div>
@endsection
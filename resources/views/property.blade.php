<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Property Listings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .property-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        .property-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        .filter-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            color: white;
        }
        .price-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
        }
        .property-type {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255,255,255,0.9);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            color: #333;
        }
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-close-white {
            filter: brightness(0) invert(1);
        }
        .feature-icon {
            margin-right: 5px;
            color: #667eea;
        }
        .pagination {
            justify-content: center;
            margin-top: 30px;
        }
        .alert {
            border-radius: 10px;
            animation: slideDown 0.5s ease;
        }
        @keyframes slideDown {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .sort-select {
            max-width: 200px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>
            <i class="fas fa-home text-primary"></i> 
            Property Listings
        </h1>
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addPropertyModal">
            <i class="fas fa-plus"></i> Add New Property
        </button>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <h3 class="mb-3"><i class="fas fa-filter"></i> Find Your Dream Property</h3>
        <form method="GET" action="{{ route('properties.index') }}" id="filterForm">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Search by title..." 
                           value="{{ request('keyword') }}">
                </div>
                <div class="col-md-2">
                    <select name="type" class="form-control">
                        <option value="">All Types</option>
                        <option value="Apartment" {{ request('type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="House" {{ request('type') == 'House' ? 'selected' : '' }}>House</option>
                        <option value="Villa" {{ request('type') == 'Villa' ? 'selected' : '' }}>Villa</option>
                        <option value="Condo" {{ request('type') == 'Condo' ? 'selected' : '' }}>Condo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" name="location" class="form-control" placeholder="Location..." 
                           value="{{ request('location') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="Min Price" 
                           value="{{ request('min_price') }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="Max Price" 
                           value="{{ request('max_price') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-light w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Sorting and Results Info -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <strong>{{ $properties->total() }}</strong> properties found
        </div>
        <div>
            <label class="me-2">Sort by:</label>
            <select class="form-control sort-select" onchange="window.location.href=this.value">
                <option value="{{ request()->fullUrlWithQuery(['sort' => '']) }}" 
                        {{ !request('sort') ? 'selected' : '' }}>Latest</option>
                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" 
                        {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" 
                        {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
        </div>
    </div>

    <!-- Properties Grid -->
    <div class="row">
        @forelse($properties as $property)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="property-card card h-100">
                    <div style="position: relative;">
                        @if($property->image)
                            <img src="{{ asset('storage/' . $property->image) }}" class="property-image" alt="{{ $property->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=No+Image" class="property-image" alt="No Image">
                        @endif
                        <div class="price-badge">
                            ${{ number_format($property->price, 0, ',', '.') }}
                        </div>
                        <div class="property-type">
                            <i class="fas fa-building"></i> {{ $property->type }}
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="card-text text-muted">
                            <i class="fas fa-map-marker-alt feature-icon"></i> {{ $property->location }}
                        </p>
                        
                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <i class="fas fa-bed feature-icon"></i>
                                <small>{{ $property->bedrooms }} Beds</small>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-bath feature-icon"></i>
                                <small>{{ $property->bathrooms }} Baths</small>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-arrows-alt feature-icon"></i>
                                <small>{{ $property->size ?? 'N/A' }} sqft</small>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mb-1">
                            <a href="{{ route('properties.show', $property->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                        <!-- Add Delete Button -->
    <form action="{{ route('properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger w-100">
            <i class="fas fa-trash"></i> Delete
        </button>
</form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> No properties found. Try adjusting your filters or add a new property!
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $properties->appends(request()->query())->links() }}
    </div>
</div>

<!-- Add Property Modal -->
<div class="modal fade" id="addPropertyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle"></i> Add New Property
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type *</label>
                            <select name="type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="Apartment">Apartment</option>
                                <option value="House">House</option>
                                <option value="Villa">Villa</option>
                                <option value="Condo">Condo</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price *</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location *</label>
                            <input type="text" name="location" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bedrooms *</label>
                            <input type="number" name="bedrooms" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bathrooms *</label>
                            <input type="number" name="bathrooms" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Size (sqft)</label>
                            <input type="number" name="size" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Property
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
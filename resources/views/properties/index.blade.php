
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                      
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Property Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        

        .property-detail-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .detail-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .price-large {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        .feature-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: scale(1.05);
            background: #e9ecef;
        }
        .feature-icon-large {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }
        .back-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        
    </style>
</head>
<body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('properties.index') }}">
            <i class="fas fa-home"></i> RealEstatePro
        </a>
    </div>
</nav>

<div class="container mt-4 mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Section -->
        <div class="col-md-7 mb-4">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" class="property-detail-image" alt="{{ $property->title }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=Property+Image" class="property-detail-image" alt="No Image">
            @endif
        </div>

        <!-- Info Section -->
        <div class="col-md-5">
            <div class="detail-card card">
                <div class="card-body">
                    <h1 class="card-title">{{ $property->title }}</h1>
                    <p class="text-muted">
                        <i class="fas fa-map-marker-alt"></i> {{ $property->location }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ $property->type }}</span>
                    </div>
                    
                    <div class="price-large mb-3">
                        ${{ number_format($property->price, 0, ',', '.') }}
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <i class="fas fa-calendar-alt"></i> Listed: 
                            {{ $property->created_at->format('M d, Y') }}
                        </div>
                        <div class="col-6">
                            <i class="fas fa-sync-alt"></i> Updated: 
                            {{ $property->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg">
<i class="fas fa-arrow-left"></i> Back to Listings
                        </a>
                        <button class="btn btn-outline-success" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bed"></i>
                </div>
                <h4>{{ $property->bedrooms }}</h4>
                <p class="text-muted mb-0">Bedrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-bath"></i>
                </div>
                <h4>{{ $property->bathrooms }}</h4>
                <p class="text-muted mb-0">Bathrooms</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-arrows-alt"></i>
                </div>
                <h4>{{ $property->size ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Square Feet</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="feature-box">
                <div class="feature-icon-large">
                    <i class="fas fa-tag"></i>
                </div>
                <h4>{{ $property->type }}</h4>
                <p class="text-muted mb-0">Property Type</p>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    @if($property->description)
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-info-circle"></i> Description</h4>
        </div>
        <div class="card-body">
            <p class="card-text lead">{{ $property->description }}</p>
        </div>
    </div>
    @endif

    <!-- Map Section -->
    <div class="detail-card card mt-3">
        <div class="card-header bg-white">
            <h4 class="mb-0"><i class="fas fa-map"></i> Location Map</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Address: {{ $property->location }}
            </div>
            <div class="text-center p-4 bg-light rounded">
                <i class="fas fa-map-marked-alt fa-3x text-muted"></i>
                <p class="mt-2">Map view available soon</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<div class="back-button">
    <a href="#" class="btn btn-primary rounded-circle" style="width: 50px; height: 50px; line-height: 50px; padding: 0;" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> h
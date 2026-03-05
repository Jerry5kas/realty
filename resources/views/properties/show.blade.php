@extends('layouts.admin')

@section('title', 'Property Details')
@section('page-title', 'Property Details')

@section('content')
<div class="container-fluid px-4 py-4">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Properties', 'url' => route('properties.index')],
        ['label' => $property->title, 'url' => null]
    ]" />

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ $property->title }}</h2>
        <div>
            <a href="{{ route('properties.edit', $property) }}" class="btn btn-primary me-2">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('properties.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="h4 mb-3">{{ $property->formatted_price }}</h3>
                    <p class="text-muted">{{ $property->description }}</p>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Type:</strong> <span class="badge bg-primary">{{ ucfirst($property->type) }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Category:</strong> <span class="badge bg-secondary">{{ ucfirst($property->category) }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Bedrooms:</strong> {{ $property->bedrooms ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Bathrooms:</strong> {{ $property->bathrooms ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Carpet Area:</strong> {{ $property->carpet_area ? $property->carpet_area . ' sqft' : 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Furnishing:</strong> {{ $property->furnishing_status ? ucfirst($property->furnishing_status) : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            @if($property->amenities->count() > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Amenities</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($property->amenities as $amenity)
                            <div class="col-md-4 mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>{{ $amenity->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Location</h5>
                </div>
                <div class="card-body">
                    <p><strong>City:</strong> {{ $property->city->name }}</p>
                    <p><strong>Locality:</strong> {{ $property->locality ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $property->address ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($property->status) }}</span></p>
                    <p><strong>Views:</strong> {{ $property->views }}</p>
                    <p><strong>RERA:</strong> {{ $property->rera_number ?? 'N/A' }}</p>
                    <p><strong>Posted:</strong> {{ $property->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

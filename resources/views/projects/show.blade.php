@extends('layouts.admin')

@section('title', 'Project Details')
@section('page-title', 'Project Details')

@section('content')
<div class="container-fluid px-4 py-4">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Projects', 'url' => route('projects.index')],
        ['label' => $project->name, 'url' => null]
    ]" />

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ $project->name }}</h2>
        <div>
            <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary me-2">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="h5 mb-3">By {{ $project->developer_name }}</h3>
                    <p class="text-muted">{{ $project->description }}</p>
                    
                    @if($project->highlights)
                    <div class="alert alert-info">
                        <strong>Highlights:</strong> {{ $project->highlights }}
                    </div>
                    @endif
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Type:</strong> <span class="badge bg-primary">{{ ucfirst($project->project_type) }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Status:</strong> <span class="badge bg-warning">{{ ucwords(str_replace('-', ' ', $project->status)) }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Total Units:</strong> {{ $project->total_units ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Available Units:</strong> {{ $project->available_units ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Completion:</strong> {{ $project->completion_percentage }}%
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Price Range:</strong> {{ $project->formatted_price_range }}
                        </div>
                    </div>
                </div>
            </div>

            @if($project->amenities->count() > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Amenities</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($project->amenities as $amenity)
                            <div class="col-md-4 mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>{{ $amenity->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if($project->properties->count() > 0)
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Properties in this Project ({{ $project->properties->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($project->properties as $property)
                            <a href="{{ route('properties.show', $property) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $property->title }}</h6>
                                        <small class="text-muted">{{ $property->formatted_price }}</small>
                                    </div>
                                    <span class="badge bg-primary">{{ ucfirst($property->type) }}</span>
                                </div>
                            </a>
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
                    <p><strong>City:</strong> {{ $project->city->name }}</p>
                    <p><strong>Locality:</strong> {{ $project->locality ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $project->address ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Timeline</h5>
                </div>
                <div class="card-body">
                    <p><strong>Launch Date:</strong> {{ $project->launch_date ? $project->launch_date->format('M Y') : 'N/A' }}</p>
                    <p><strong>Possession:</strong> {{ $project->possession_date ? $project->possession_date->format('M Y') : 'N/A' }}</p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Legal</h5>
                </div>
                <div class="card-body">
                    <p><strong>RERA:</strong> {{ $project->rera_number ?? 'N/A' }}</p>
                    <p><strong>Views:</strong> {{ $project->views }}</p>
                    <p><strong>Posted:</strong> {{ $project->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

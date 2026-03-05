@extends('layouts.admin')

@section('title', $builder->company_name)
@section('page-title', $builder->company_name)

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Builders', 'url' => route('builders.index')],
        ['label' => $builder->company_name, 'url' => '']
    ]" />

    <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center gap-3">
            @if($builder->logo_url)
                <img src="{{ $builder->logo_url }}" alt="{{ $builder->company_name }}" class="w-16 h-16 rounded-lg object-cover">
            @else
                <div class="w-16 h-16 rounded-lg flex items-center justify-center text-white font-bold text-xl" style="background: linear-gradient(to bottom right, {{ $theme['secondary_color'] }}, {{ $theme['primary_color'] }});">
                    {{ $builder->initials }}
                </div>
            @endif
            <div>
                <h1 class="text-2xl font-bold" style="color: {{ $theme['primary_color'] }};">{{ $builder->company_name }}</h1>
                <div class="flex gap-2 mt-1">
                    @if($builder->status === 'active')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                    @endif
                    @if($builder->is_featured)
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Featured</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('builders.edit', $builder) }}" class="px-4 py-2 text-white rounded-lg font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                Edit
            </a>
            <form action="{{ route('builders.destroy', $builder) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this builder?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg font-medium hover:bg-red-600 transition-all">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            @if($builder->description)
                <div class="bg-white rounded-2xl shadow-lg border-2 p-6" style="border-color: {{ $theme['primary_color'] }};">
                    <h2 class="text-lg font-semibold mb-3" style="color: {{ $theme['primary_color'] }};">About</h2>
                    <p class="text-gray-700 whitespace-pre-line">{{ $builder->description }}</p>
                </div>
            @endif

            <!-- Associated Properties -->
            <div class="bg-white rounded-2xl shadow-lg border-2 p-6" style="border-color: {{ $theme['primary_color'] }};">
                <h2 class="text-lg font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Associated Properties ({{ $builder->properties->count() }})</h2>
                @if($builder->properties->count() > 0)
                    <div class="space-y-3">
                        @foreach($builder->properties->take(5) as $property)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div>
                                    <a href="{{ route('properties.show', $property) }}" class="font-medium hover:underline" style="color: {{ $theme['primary_color'] }};">
                                        {{ $property->title }}
                                    </a>
                                    <p class="text-sm text-gray-600">{{ $property->city->name ?? '-' }} • {{ $property->formatted_price }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background-color: {{ $theme['secondary_color'] }}20; color: {{ $theme['secondary_color'] }};">
                                    {{ ucfirst($property->type) }}
                                </span>
                            </div>
                        @endforeach
                        @if($builder->properties->count() > 5)
                            <a href="{{ route('properties.index', ['builder_id' => $builder->id]) }}" class="block text-center text-sm font-medium mt-3" style="color: {{ $theme['secondary_color'] }};">
                                View all {{ $builder->properties->count() }} properties →
                            </a>
                        @endif
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No properties associated with this builder.</p>
                @endif
            </div>

            <!-- Associated Projects -->
            <div class="bg-white rounded-2xl shadow-lg border-2 p-6" style="border-color: {{ $theme['primary_color'] }};">
                <h2 class="text-lg font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Associated Projects ({{ $builder->projects->count() }})</h2>
                @if($builder->projects->count() > 0)
                    <div class="space-y-3">
                        @foreach($builder->projects->take(5) as $project)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div>
                                    <a href="{{ route('projects.show', $project) }}" class="font-medium hover:underline" style="color: {{ $theme['primary_color'] }};">
                                        {{ $project->name }}
                                    </a>
                                    <p class="text-sm text-gray-600">{{ $project->city->name ?? '-' }} • {{ $project->total_units ?? 0 }} units</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background-color: {{ $theme['secondary_color'] }}20; color: {{ $theme['secondary_color'] }};">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                        @endforeach
                        @if($builder->projects->count() > 5)
                            <a href="{{ route('projects.index', ['builder_id' => $builder->id]) }}" class="block text-center text-sm font-medium mt-3" style="color: {{ $theme['secondary_color'] }};">
                                View all {{ $builder->projects->count() }} projects →
                            </a>
                        @endif
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No projects associated with this builder.</p>
                @endif
            </div>
        </div>

        <!-- Sidebar Information -->
        <div class="space-y-6">
            <!-- Contact Information -->
            <div class="bg-white rounded-2xl shadow-lg border-2 p-6" style="border-color: {{ $theme['primary_color'] }};">
                <h2 class="text-lg font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Contact Information</h2>
                <div class="space-y-3">
                    @if($builder->contact_person_name)
                        <div>
                            <p class="text-sm text-gray-600">Contact Person</p>
                            <p class="font-medium">{{ $builder->contact_person_name }}</p>
                        </div>
                    @endif
                    @if($builder->phone)
                        <div>
                            <p class="text-sm text-gray-600">Phone</p>
                            <a href="tel:{{ $builder->phone }}" class="font-medium hover:underline" style="color: {{ $theme['secondary_color'] }};">{{ $builder->phone }}</a>
                        </div>
                    @endif
                    @if($builder->email)
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <a href="mailto:{{ $builder->email }}" class="font-medium hover:underline" style="color: {{ $theme['secondary_color'] }};">{{ $builder->email }}</a>
                        </div>
                    @endif
                    @if($builder->website)
                        <div>
                            <p class="text-sm text-gray-600">Website</p>
                            <a href="{{ $builder->website }}" target="_blank" class="font-medium hover:underline" style="color: {{ $theme['secondary_color'] }};">Visit Website →</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Business Information -->
            <div class="bg-white rounded-2xl shadow-lg border-2 p-6" style="border-color: {{ $theme['primary_color'] }};">
                <h2 class="text-lg font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Business Information</h2>
                <div class="space-y-3">
                    @if($builder->rera_registration_number)
                        <div>
                            <p class="text-sm text-gray-600">RERA Number</p>
                            <p class="font-medium">{{ $builder->rera_registration_number }}</p>
                        </div>
                    @endif
                    @if($builder->established_year)
                        <div>
                            <p class="text-sm text-gray-600">Established</p>
                            <p class="font-medium">{{ $builder->established_year }}</p>
                        </div>
                    @endif
                    @if($builder->total_projects_completed)
                        <div>
                            <p class="text-sm text-gray-600">Projects Completed</p>
                            <p class="font-medium">{{ $builder->total_projects_completed }}</p>
                        </div>
                    @endif
                    @if($builder->city)
                        <div>
                            <p class="text-sm text-gray-600">City</p>
                            <p class="font-medium">{{ $builder->city->name }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Social Media -->
            @if($builder->facebook_url || $builder->instagram_url || $builder->linkedin_url || $builder->twitter_url)
                <div class="bg-white rounded-2xl shadow-lg border-2 p-6" style="border-color: {{ $theme['primary_color'] }};">
                    <h2 class="text-lg font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Social Media</h2>
                    <div class="flex gap-3">
                        @if($builder->facebook_url)
                            <a href="{{ $builder->facebook_url }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if($builder->instagram_url)
                            <a href="{{ $builder->instagram_url }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-lg bg-pink-600 text-white hover:bg-pink-700 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        @endif
                        @if($builder->linkedin_url)
                            <a href="{{ $builder->linkedin_url }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-700 text-white hover:bg-blue-800 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        @endif
                        @if($builder->twitter_url)
                            <a href="{{ $builder->twitter_url }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-lg bg-black text-white hover:bg-gray-800 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Address -->
            @if($builder->office_address)
                <div class="bg-white rounded-2xl shadow-lg border-2 p-6" style="border-color: {{ $theme['primary_color'] }};">
                    <h2 class="text-lg font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Office Address</h2>
                    <p class="text-gray-700 whitespace-pre-line">{{ $builder->office_address }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

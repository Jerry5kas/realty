@extends('layouts.admin')

@section('title', 'Properties')
@section('page-title', 'Properties Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Properties', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <x-search-bar 
                placeholder="Search properties by title, locality, or RERA..." 
                :action="route('properties.index')"
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('property-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected properties?')" 
            class="hidden p-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all flex items-center gap-2"
            title="Delete Selected"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span class="hidden md:inline">Delete</span>
            <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs font-semibold" id="selectedCount">0</span>
        </button>
    </div>

    <!-- Filters -->
    <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <select name="type" onchange="window.location.href='{{ route('properties.index') }}?type=' + this.value + '&search={{ request('search') }}'" 
                class="px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 transition-all"
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
            <option value="">All Types</option>
            <option value="sale" {{ request('type') == 'sale' ? 'selected' : '' }}>For Sale</option>
            <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>For Rent</option>
            <option value="lease" {{ request('type') == 'lease' ? 'selected' : '' }}>For Lease</option>
            <option value="pg" {{ request('type') == 'pg' ? 'selected' : '' }}>PG</option>
        </select>

        <select name="category" onchange="window.location.href='{{ route('properties.index') }}?category=' + this.value + '&search={{ request('search') }}'" 
                class="px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 transition-all"
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
            <option value="">All Categories</option>
            <option value="residential" {{ request('category') == 'residential' ? 'selected' : '' }}>Residential</option>
            <option value="commercial" {{ request('category') == 'commercial' ? 'selected' : '' }}>Commercial</option>
            <option value="land" {{ request('category') == 'land' ? 'selected' : '' }}>Land</option>
        </select>

        <select name="status" onchange="window.location.href='{{ route('properties.index') }}?status=' + this.value + '&search={{ request('search') }}'" 
                class="px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 transition-all"
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
            <option value="">All Status</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
            <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
        </select>

        <select name="city_id" onchange="window.location.href='{{ route('properties.index') }}?city_id=' + this.value + '&search={{ request('search') }}'" 
                class="px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 transition-all"
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
            <option value="">All Cities</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>

    <form id="bulkDeleteForm" action="{{ route('properties.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table 
            title="Property Management"
            description="Manage all property listings"
            :createRoute="route('properties.create')"
            createLabel="Add Property"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'Property', 'field' => 'title'],
                ['label' => 'Type', 'field' => 'type'],
                ['label' => 'Price', 'field' => 'price'],
                ['label' => 'Location', 'field' => 'city'],
                ['label' => 'Status', 'field' => 'status'],
                ['label' => 'Views', 'field' => 'views']
            ]"
        >
            <tr style="background-color: {{ $theme['primary_color'] }}05;">
                <td class="px-4 md:px-6 py-3">
                    <input 
                        type="checkbox" 
                        id="selectAll"
                        class="w-4 h-4 rounded focus:ring-offset-0" 
                        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                        onchange="toggleSelectAll(this, 'property-checkbox')"
                    >
                </td>
                <td colspan="7" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($properties as $property)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $property->id }}" 
                            class="property-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('property-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($property->primary_image)
                                <img src="{{ $property->primary_image }}" alt="{{ $property->title }}" 
                                     class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: {{ $theme['primary_color'] }}20;">
                                    <svg class="w-6 h-6" style="color: {{ $theme['primary_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('properties.show', $property) }}" class="font-medium hover:opacity-70" style="color: {{ $theme['accent_color'] }};">
                                    {{ $property->title }}
                                </a>
                                <p class="text-xs text-gray-500">{{ $property->locality ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $property->type == 'sale' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $property->type == 'rent' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $property->type == 'lease' ? 'bg-purple-100 text-purple-800' : '' }}
                            {{ $property->type == 'pg' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                            {{ ucfirst($property->type) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap font-semibold" style="color: {{ $theme['accent_color'] }};">
                        {{ $property->formatted_price }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ $property->city->name }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $property->status == 'published' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $property->status == 'draft' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ $property->status == 'sold' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $property->status == 'rented' ? 'bg-orange-100 text-orange-800' : '' }}
                            {{ $property->status == 'inactive' ? 'bg-gray-100 text-gray-600' : '' }}">
                            {{ ucfirst($property->status) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ $property->views }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :editRoute="route('properties.edit', $property)"
                            :deleteRoute="route('properties.destroy', $property)"
                            deleteMessage="Delete {{ $property->title }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        No properties found. <a href="{{ route('properties.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Add your first property</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($properties->hasPages())
        <div class="mt-6">
            {{ $properties->links() }}
        </div>
    @endif
</div>


@endsection


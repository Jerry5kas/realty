@extends('layouts.admin')

@section('title', 'Edit Property')
@section('page-title', 'Edit Property')

@section('content')
<div class="max-w-6xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Properties', 'url' => route('properties.index')],
        ['label' => 'Edit Property', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Edit Property</h2>
        </div>

        <form action="{{ route('properties.update', $property) }}" method="POST" class="p-4 md:p-6">
            @csrf
            @method('PUT')
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-2 border-red-500 rounded-xl">
                    <h3 class="text-red-800 font-semibold mb-2">Please fix the following errors:</h3>
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <x-form-tabs :tabs="[
                ['id' => 'basic', 'label' => 'Basic Info', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'></path></svg>'],
                ['id' => 'details', 'label' => 'Property Details', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4\'></path></svg>'],
                ['id' => 'location', 'label' => 'Location', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z\'></path><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M15 11a3 3 0 11-6 0 3 3 0 016 0z\'></path></svg>'],
                ['id' => 'media', 'label' => 'Media', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'></path></svg>'],
                ['id' => 'amenities', 'label' => 'Amenities', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z\'></path></svg>'],
                ['id' => 'settings', 'label' => 'Settings', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z\'></path><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M15 12a3 3 0 11-6 0 3 3 0 016 0z\'></path></svg>']
            ]">
                <!-- Basic Info Tab -->
                <x-tab-content id="basic">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-form-input label="Property Title" name="title" :required="true" placeholder="Enter property title" :value="$property->title" />
                        </div>
                        <div class="md:col-span-2">
                            <x-form-textarea label="Description" name="description" rows="4" placeholder="Enter property description" :value="$property->description" />
                        </div>
                        
                        <x-form-select label="Listing Type" name="type" :required="true" :options="['buy' => 'Buy', 'sale' => 'For Sale', 'rent' => 'For Rent', 'lease' => 'For Lease', 'pg' => 'PG/Hostel']" :value="$property->type" />
                        <x-form-select label="Category" name="category" :required="true" :options="['residential' => 'Residential', 'commercial' => 'Commercial', 'land' => 'Land/Plot']" :value="$property->category" />
                        <x-form-select label="Property Type" name="property_type" :options="$propertyTypes->pluck('name', 'slug')->toArray()" placeholder="Select Property Type" :value="$property->property_type" />
                        <x-form-select label="Builder/Developer" name="builder_id" :options="$builders->pluck('company_name', 'id')->toArray()" placeholder="Select Builder (Optional)" :value="$property->builder_id" />
                        <x-form-select label="Link to Project" name="project_id" :options="$projects->pluck('name', 'id')->toArray()" placeholder="None (Optional)" :value="$property->project_id" />
                        
                        <div class="md:col-span-2">
                            <h4 class="font-semibold mb-3" style="color: {{ $theme['primary_color'] }};">Pricing</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-form-input label="Price (₹)" name="price" type="number" :required="true" placeholder="0.00" step="0.01" :value="$property->price" />
                                <x-form-input label="Price per Sq.Ft (₹)" name="price_per_sqft" type="number" placeholder="0.00" step="0.01" :value="$property->price_per_sqft" />
                                <x-form-input label="Maintenance Charges (₹)" name="maintenance_charges" type="number" placeholder="0.00" step="0.01" :value="$property->maintenance_charges" />
                                <x-form-input label="Security Deposit (₹)" name="security_deposit" type="number" placeholder="0.00" step="0.01" :value="$property->security_deposit" />
                            </div>
                        </div>
                    </div>
                </x-tab-content>

                <!-- Property Details Tab -->
                <x-tab-content id="details">
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-semibold mb-3" style="color: {{ $theme['primary_color'] }};">Area Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <x-form-input label="Carpet Area (Sq.Ft)" name="carpet_area" type="number" placeholder="0.00" step="0.01" :value="$property->carpet_area" />
                                <x-form-input label="Built-up Area (Sq.Ft)" name="built_up_area" type="number" placeholder="0.00" step="0.01" :value="$property->built_up_area" />
                                <x-form-input label="Super Built-up Area (Sq.Ft)" name="super_built_up_area" type="number" placeholder="0.00" step="0.01" :value="$property->super_built_up_area" />
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-semibold mb-3" style="color: {{ $theme['primary_color'] }};">Room Configuration</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <x-form-input label="Bedrooms" name="bedrooms" type="number" placeholder="0" min="0" :value="$property->bedrooms" />
                                <x-form-input label="Bathrooms" name="bathrooms" type="number" placeholder="0" min="0" :value="$property->bathrooms" />
                                <x-form-input label="Balconies" name="balconies" type="number" placeholder="0" min="0" :value="$property->balconies" />
                                <x-form-input label="Age (Years)" name="age_of_property" type="number" placeholder="0" min="0" :value="$property->age_of_property" />
                            </div>
                        </div>

                        <div>
                            <h4 class="font-semibold mb-3" style="color: {{ $theme['primary_color'] }};">Additional Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <x-form-input label="Floor Number" name="floor_number" type="number" placeholder="0" min="0" :value="$property->floor_number" />
                                <x-form-input label="Total Floors" name="total_floors" type="number" placeholder="0" min="0" :value="$property->total_floors" />
                                <x-form-select label="Furnishing" name="furnishing_status" :options="['furnished' => 'Furnished', 'semi-furnished' => 'Semi-Furnished', 'unfurnished' => 'Unfurnished']" :value="$property->furnishing_status" />
                                <x-form-select label="Facing" name="facing" :options="['north' => 'North', 'south' => 'South', 'east' => 'East', 'west' => 'West', 'north-east' => 'North-East', 'north-west' => 'North-West', 'south-east' => 'South-East', 'south-west' => 'South-West']" :value="$property->facing" />
                                <x-form-input label="Covered Parking" name="parking_covered" type="number" min="0" :value="$property->parking_covered ?? 0" />
                                <x-form-input label="Open Parking" name="parking_open" type="number" min="0" :value="$property->parking_open ?? 0" />
                            </div>
                        </div>
                    </div>
                </x-tab-content>

                <!-- Location Tab -->
                <x-tab-content id="location">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-form-select label="City" name="city_id" :required="true" :options="$cities->pluck('name', 'id')->toArray()" placeholder="Select City" :value="$property->city_id" />
                            <x-form-input label="Locality" name="locality" placeholder="Enter locality" :value="$property->locality" />
                        </div>
                        <x-form-textarea label="Full Address" name="address" rows="2" placeholder="Enter complete address" :value="$property->address" />
                        <x-form-input label="Pincode" name="pincode" placeholder="Enter pincode" :value="$property->pincode" />
                        
                        <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Map Location</h4>
                            <x-map-picker :latitude="$property->latitude ?? '12.9716'" :longitude="$property->longitude ?? '77.5946'" :skipInitialFetch="true" />
                        </div>
                    </div>
                </x-tab-content>

                <!-- Media Tab -->
                <x-tab-content id="media">
                    <div class="space-y-6">
                        <x-imagekit-uploader name="images" label="Property Images" :multiple="true" :maxFiles="10" :existingImages="$property->images ?? []" />
                        
                        <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Video & Virtual Tour</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-form-input label="Video URL" name="video_url" type="url" placeholder="https://youtube.com/..." :value="$property->video_url" />
                                <x-form-input label="Virtual Tour URL" name="virtual_tour_url" type="url" placeholder="https://..." :value="$property->virtual_tour_url" />
                            </div>
                        </div>
                    </div>
                </x-tab-content>

                <!-- Amenities Tab -->
                <x-tab-content id="amenities">
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Select Amenities</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach($amenities as $amenity)
                                    <x-form-checkbox :label="$amenity->name" name="amenities[]" :value="$amenity->id" :checked="$property->amenities->contains($amenity->id)" />
                                @endforeach
                            </div>
                        </div>

                        <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Select Features</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach($features as $feature)
                                    <x-form-checkbox :label="$feature->name" name="features[]" :value="$feature->id" :checked="$property->features->contains($feature->id)" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </x-tab-content>

                <!-- Settings Tab -->
                <x-tab-content id="settings">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Publishing</h4>
                            <div class="space-y-4">
                                <x-form-select label="Status" name="status" :required="true" :options="['draft' => 'Draft', 'published' => 'Published', 'inactive' => 'Inactive']" :value="$property->status" />
                                <x-form-checkbox label="Featured Property" name="is_featured" :checked="$property->is_featured" />
                                <x-form-checkbox label="Verified Property" name="is_verified" :checked="$property->is_verified" />
                            </div>
                        </div>

                        <div>
                            <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Legal & Compliance</h4>
                            <div class="space-y-4">
                                <x-form-input label="RERA Number" name="rera_number" placeholder="Enter RERA number" :value="$property->rera_number" />
                                <x-form-select label="Possession Status" name="possession_status" :options="['ready-to-move' => 'Ready to Move', 'under-construction' => 'Under Construction', 'upcoming' => 'Upcoming']" :value="$property->possession_status ?? 'ready-to-move'" />
                                <x-form-input label="Possession Date" name="possession_date" type="date" :value="$property->possession_date" />
                                <x-form-input label="Available From" name="available_from" type="date" :value="$property->available_from" />
                            </div>
                        </div>
                    </div>
                </x-tab-content>
            </x-form-tabs>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('properties.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Update Property
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

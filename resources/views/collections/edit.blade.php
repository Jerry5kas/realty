@extends('layouts.admin')

@section('title', 'Edit Collection')
@section('page-title', 'Edit Collection')

@section('content')
<div class="max-w-6xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Collections', 'url' => route('collections.index')],
        ['label' => 'Edit Collection', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Edit Collection</h2>
        </div>

        <form action="{{ route('collections.update', $collection) }}" method="POST" class="p-4 md:p-6">
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
                ['id' => 'filters', 'label' => 'Filters & Items', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z\'></path></svg>'],
                ['id' => 'display', 'label' => 'Display Settings', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z\'></path><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M15 12a3 3 0 11-6 0 3 3 0 016 0z\'></path></svg>']
            ]">
                <!-- Basic Info Tab -->
                <x-tab-content id="basic">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-form-input label="Collection Name" name="name" :required="true" :value="old('name', $collection->name)" placeholder="Enter collection name" />
                        </div>
                        <x-form-input label="Slug" name="slug" :value="old('slug', $collection->slug)" placeholder="Auto-generated if empty" />
                        <x-form-input label="Image URL" name="image" type="url" :value="old('image', $collection->image)" placeholder="https://example.com/image.jpg" />
                        <div class="md:col-span-2">
                            <x-form-textarea label="Description" name="description" rows="3" :value="old('description', $collection->description)" placeholder="Enter collection description" />
                        </div>
                        <x-form-select label="Collection Type" name="type" :required="true" :value="old('type', $collection->type)" :options="['mixed' => 'Mixed (Properties & Projects)', 'property' => 'Properties Only', 'project' => 'Projects Only']" />
                        <x-form-select label="Status" name="status" :required="true" :value="old('status', $collection->status)" :options="['active' => 'Active', 'inactive' => 'Inactive']" />
                        <x-form-input label="Display Order" name="display_order" type="number" :value="old('display_order', $collection->display_order)" />
                        <div>
                            <x-form-checkbox label="Featured Collection" name="is_featured" value="1" :checked="old('is_featured', $collection->is_featured)" />
                        </div>
                    </div>
                </x-tab-content>

                <!-- Filters & Items Tab -->
                <x-tab-content id="filters">
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-semibold mb-3" style="color: {{ $theme['primary_color'] }};">Collection Mode</h4>
                            <div class="flex gap-4 mb-4">
                                <label class="flex items-center">
                                    <input type="radio" name="filter_mode" value="automatic" {{ empty($collection->manual_items) ? 'checked' : '' }} class="w-4 h-4 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="toggleFilterMode()">
                                    <span class="ml-2" style="color: {{ $theme['accent_color'] }};">Automatic (Use Filters)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="filter_mode" value="manual" {{ !empty($collection->manual_items) ? 'checked' : '' }} class="w-4 h-4 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="toggleFilterMode()">
                                    <span class="ml-2" style="color: {{ $theme['accent_color'] }};">Manual Selection</span>
                                </label>
                            </div>
                        </div>

                        <!-- Automatic Filters -->
                        <div id="automaticFilters" class="{{ !empty($collection->manual_items) ? 'hidden' : '' }} border-2 rounded-xl p-4" style="border-color: {{ $theme['primary_color'] }}15;">
                            <h4 class="font-medium mb-4" style="color: {{ $theme['primary_color'] }};">Filter Criteria</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-form-select label="City" name="filter_city_id" :value="$collection->filters['city_id'] ?? ''" :options="$cities->pluck('name', 'id')->toArray()" placeholder="All Cities" />
                                <x-form-select label="Builder" name="filter_builder_id" :value="$collection->filters['builder_id'] ?? ''" :options="$builders->pluck('company_name', 'id')->toArray()" placeholder="All Builders" />
                                <x-form-select label="Property Type" name="filter_property_type" :value="$collection->filters['property_type'] ?? ''" :options="$propertyTypes->pluck('name', 'slug')->toArray()" placeholder="All Types" />
                                <x-form-select label="Transaction Type" name="filter_type" :value="$collection->filters['type'] ?? ''" :options="['sale' => 'For Sale', 'rent' => 'For Rent']" placeholder="All" />
                                <x-form-select label="Project Status" name="filter_project_status" :value="$collection->filters['project_status'] ?? ''" :options="['upcoming' => 'Upcoming', 'ongoing' => 'Ongoing', 'completed' => 'Completed']" placeholder="All" />
                                <x-form-select label="Bedrooms" name="filter_bedrooms" :value="$collection->filters['bedrooms'] ?? ''" :options="['1' => '1 BHK', '2' => '2 BHK', '3' => '3 BHK', '4' => '4 BHK', '5' => '5+ BHK']" placeholder="All" />
                                <x-form-input label="Min Price" name="filter_min_price" type="number" :value="$collection->filters['min_price'] ?? ''" placeholder="0" />
                                <x-form-input label="Max Price" name="filter_max_price" type="number" :value="$collection->filters['max_price'] ?? ''" placeholder="No limit" />
                                <x-form-select label="Possession Status" name="filter_possession_status" :value="$collection->filters['possession_status'] ?? ''" :options="['ready-to-move' => 'Ready to Move', 'under-construction' => 'Under Construction', 'pre-launch' => 'Pre-Launch']" placeholder="All" />
                                <x-form-select label="Furnishing Status" name="filter_furnishing_status" :value="$collection->filters['furnishing_status'] ?? ''" :options="['furnished' => 'Furnished', 'semi-furnished' => 'Semi-Furnished', 'unfurnished' => 'Unfurnished']" placeholder="All" />
                                <x-form-input label="Created After" name="filter_created_after" type="date" :value="$collection->filters['created_after'] ?? ''" />
                                <x-form-input label="Created Before" name="filter_created_before" type="date" :value="$collection->filters['created_before'] ?? ''" />
                            </div>
                            <div class="mt-4 flex gap-4">
                                <x-form-checkbox label="Featured Only" name="filter_is_featured" value="1" :checked="$collection->filters['is_featured'] ?? false" />
                                <x-form-checkbox label="Verified Only" name="filter_is_verified" value="1" :checked="$collection->filters['is_verified'] ?? false" />
                            </div>
                        </div>

                        <!-- Manual Selection -->
                        <div id="manualSelection" class="{{ empty($collection->manual_items) ? 'hidden' : '' }} border-2 rounded-xl p-4" style="border-color: {{ $theme['primary_color'] }}15;">
                            <h4 class="font-medium mb-4" style="color: {{ $theme['primary_color'] }};">Select Items Manually</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Properties</label>
                                    <select name="manual_properties[]" multiple size="10" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                                        @foreach($properties as $property)
                                        <option value="{{ $property->id }}" {{ !empty($collection->manual_items) && collect($collection->manual_items)->where('type', 'property')->pluck('id')->contains($property->id) ? 'selected' : '' }}>{{ $property->title }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Projects</label>
                                    <select name="manual_projects[]" multiple size="10" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ !empty($collection->manual_items) && collect($collection->manual_items)->where('type', 'project')->pluck('id')->contains($project->id) ? 'selected' : '' }}>{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-tab-content>

                <!-- Display Settings Tab -->
                <x-tab-content id="display">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <x-form-input label="Items Limit" name="items_limit" type="number" :required="true" :value="old('items_limit', $collection->items_limit)" min="1" max="100" />
                        <x-form-select label="Sort By" name="sort_by" :required="true" :value="old('sort_by', $collection->sort_by)" :options="['created_at' => 'Date Created', 'price' => 'Price', 'title' => 'Title', 'manual' => 'Manual Order']" />
                        <x-form-select label="Sort Order" name="sort_order" :required="true" :value="old('sort_order', $collection->sort_order)" :options="['desc' => 'Descending', 'asc' => 'Ascending']" />
                    </div>
                </x-tab-content>
            </x-form-tabs>

            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('collections.show', $collection) }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Update Collection
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleFilterMode() {
    const automatic = document.getElementById('automaticFilters');
    const manual = document.getElementById('manualSelection');
    const mode = document.querySelector('input[name="filter_mode"]:checked').value;
    
    if (mode === 'automatic') {
        automatic.classList.remove('hidden');
        manual.classList.add('hidden');
    } else {
        automatic.classList.add('hidden');
        manual.classList.remove('hidden');
    }
}
</script>
@endsection

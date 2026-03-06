@extends('layouts.admin')

@section('title', 'Create Collection')
@section('page-title', 'Create Collection')

@section('content')
<div class="max-w-6xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Collections', 'url' => route('collections.index')],
        ['label' => 'Create Collection', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Create New Collection</h2>
        </div>

        <form action="{{ route('collections.store') }}" method="POST" class="p-4 md:p-6">
            @csrf
            
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
                <!-- Basic Information Tab -->
                <x-tab-content id="basic">
                    <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Collection Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="Enter collection name">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="Auto-generated if empty">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Image URL</label>
                        <input type="url" name="image" value="{{ old('image') }}" class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="https://example.com/image.jpg">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Description</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="Enter collection description">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Collection Type *</label>
                        <select name="type" required class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                            <option value="mixed">Mixed (Properties & Projects)</option>
                            <option value="property">Properties Only</option>
                            <option value="project">Projects Only</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Status *</label>
                        <select name="status" required class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Display Order</label>
                        <input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="0">
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 rounded focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                            <span class="ml-2 text-sm" style="color: {{ $theme['accent_color'] }};">Featured Collection</span>
                        </label>
                    </div>
                </div>
                </div>
            </x-tab-content>

            <!-- Filters & Items Tab -->
            <x-tab-content id="filters">
                <div class="space-y-6">
                
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="filter_mode" value="automatic" checked class="w-4 h-4 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="toggleFilterMode()">
                        <span class="ml-2" style="color: {{ $theme['accent_color'] }};">Automatic (Use Filters)</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="filter_mode" value="manual" class="w-4 h-4 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="toggleFilterMode()">
                        <span class="ml-2" style="color: {{ $theme['accent_color'] }};">Manual Selection</span>
                    </label>
                </div>

                <!-- Automatic Filters -->
                <div id="automaticFilters" class="border-2 rounded-xl p-4 space-y-4" style="border-color: {{ $theme['primary_color'] }}15;">
                    <h4 class="font-medium" style="color: {{ $theme['primary_color'] }};">Filter Criteria</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">City</label>
                            <select name="filter_city_id" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                                <option value="">All Cities</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Builder</label>
                            <select name="filter_builder_id" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                                <option value="">All Builders</option>
                                @foreach($builders as $builder)
                                <option value="{{ $builder->id }}">{{ $builder->company_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Property Type</label>
                            <select name="filter_property_type" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                                <option value="">All Types</option>
                                @foreach($propertyTypes as $type)
                                <option value="{{ $type->slug }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Transaction Type</label>
                            <select name="filter_type" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                                <option value="">All</option>
                                <option value="sale">For Sale</option>
                                <option value="rent">For Rent</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Min Price</label>
                            <input type="number" name="filter_min_price" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="0">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Max Price</label>
                            <input type="number" name="filter_max_price" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="No limit">
                        </div>
                    </div>
                </div>

                <!-- Manual Selection -->
                <div id="manualSelection" class="hidden border-2 rounded-xl p-4 space-y-4" style="border-color: {{ $theme['primary_color'] }}15;">
                    <h4 class="font-medium" style="color: {{ $theme['primary_color'] }};">Select Items Manually</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Properties</label>
                            <select name="manual_properties[]" multiple size="10" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                                @foreach($properties as $property)
                                <option value="{{ $property->id }}">{{ $property->title }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Projects</label>
                            <select name="manual_projects[]" multiple size="10" class="w-full px-4 py-2 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                                @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
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
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Items Limit *</label>
                        <input type="number" name="items_limit" value="{{ old('items_limit', 12) }}" min="1" max="100" required class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Sort By *</label>
                        <select name="sort_by" required class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                            <option value="created_at">Date Created</option>
                            <option value="price">Price</option>
                            <option value="title">Title</option>
                            <option value="manual">Manual Order</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Sort Order *</label>
                        <select name="sort_order" required class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                            <option value="desc">Descending</option>
                            <option value="asc">Ascending</option>
                        </select>
                    </div>
                </div>
                </div>
        </x-tab-content>
    </x-form-tabs>

    <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('collections.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Create Collection
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

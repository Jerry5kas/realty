@extends('layouts.admin')

@section('title', 'View Collection')
@section('page-title', 'View Collection')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Collections', 'url' => route('collections.index')],
        ['label' => $collection->name, 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden mb-6" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b flex justify-between items-center" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <div>
                <h2 class="text-lg md:text-xl font-semibold" style="color: white;">{{ $collection->name }}</h2>
                <p class="text-sm mt-1" style="color: rgba(255,255,255,0.9);">{{ $collection->slug }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('collections.edit', $collection) }}" class="px-4 py-2 bg-white rounded-lg text-sm font-medium hover:bg-gray-100 transition-all" style="color: {{ $theme['primary_color'] }};">
                    Edit
                </a>
                <form action="{{ route('collections.destroy', $collection) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this collection?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition-all">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4 md:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="p-4 rounded-xl" style="background-color: {{ $theme['primary_color'] }}10;">
                    <div class="text-sm" style="color: {{ $theme['primary_color'] }};">Type</div>
                    <div class="text-lg font-semibold mt-1" style="color: {{ $theme['accent_color'] }};">{{ ucfirst($collection->type) }}</div>
                </div>
                <div class="p-4 rounded-xl" style="background-color: {{ $theme['primary_color'] }}10;">
                    <div class="text-sm" style="color: {{ $theme['primary_color'] }};">Status</div>
                    <div class="text-lg font-semibold mt-1" style="color: {{ $theme['accent_color'] }};">{{ ucfirst($collection->status) }}</div>
                </div>
                <div class="p-4 rounded-xl" style="background-color: {{ $theme['primary_color'] }}10;">
                    <div class="text-sm" style="color: {{ $theme['primary_color'] }};">Total Items</div>
                    <div class="text-lg font-semibold mt-1" style="color: {{ $theme['accent_color'] }};">{{ $items->count() }}</div>
                </div>
                <div class="p-4 rounded-xl" style="background-color: {{ $theme['primary_color'] }}10;">
                    <div class="text-sm" style="color: {{ $theme['primary_color'] }};">Featured</div>
                    <div class="text-lg font-semibold mt-1" style="color: {{ $theme['accent_color'] }};">{{ $collection->is_featured ? 'Yes' : 'No' }}</div>
                </div>
            </div>

            @if($collection->description)
            <div class="mb-6">
                <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Description</h3>
                <p style="color: {{ $theme['accent_color'] }};">{{ $collection->description }}</p>
            </div>
            @endif

            @if($collection->image)
            <div class="mb-6">
                <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Collection Image</h3>
                <img src="{{ $collection->image }}" alt="{{ $collection->name }}" class="w-full max-w-md rounded-xl">
            </div>
            @endif

            <div class="mb-6">
                <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Collection Mode</h3>
                <p style="color: {{ $theme['accent_color'] }};">
                    @if(!empty($collection->manual_items))
                        Manual Selection ({{ count($collection->manual_items) }} items selected)
                    @else
                        Automatic Filtering
                    @endif
                </p>
            </div>

            @if(!empty($collection->filters))
            <div class="mb-6">
                <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Active Filters</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($collection->filters as $key => $value)
                        <span class="px-3 py-1 rounded-full text-sm" style="background-color: {{ $theme['primary_color'] }}15; color: {{ $theme['primary_color'] }};">
                            {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ is_bool($value) ? ($value ? 'Yes' : 'No') : $value }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            <div>
                <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Items in Collection ({{ $items->count() }})</h3>
                @if($items->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($items as $item)
                    <div class="border-2 rounded-xl p-4 hover:shadow-lg transition-all" style="border-color: {{ $theme['primary_color'] }}15;">
                        @if(isset($item->title))
                            <div class="font-medium mb-1" style="color: {{ $theme['accent_color'] }};">{{ $item->title }}</div>
                            <div class="text-sm text-gray-500">Property</div>
                            @if($item->price)
                            <div class="text-sm mt-2" style="color: {{ $theme['primary_color'] }};">₹{{ number_format($item->price) }}</div>
                            @endif
                        @else
                            <div class="font-medium mb-1" style="color: {{ $theme['accent_color'] }};">{{ $item->name }}</div>
                            <div class="text-sm text-gray-500">Project</div>
                            @if($item->starting_price)
                            <div class="text-sm mt-2" style="color: {{ $theme['primary_color'] }};">From ₹{{ number_format($item->starting_price) }}</div>
                            @endif
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500">No items found matching the collection criteria.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

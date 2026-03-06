<x-layout.frontend>
    <!-- Collection Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('collections.public') }}" class="text-white/80 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-4xl font-bold">{{ $collection->name }}</h1>
            </div>
            @if($collection->description)
            <p class="text-lg text-white/90 max-w-3xl">{{ $collection->description }}</p>
            @endif
            <div class="flex gap-4 mt-4">
                <span class="px-3 py-1 bg-white/20 rounded-full text-sm">
                    {{ ucfirst($collection->type) }}
                </span>
                <span class="px-3 py-1 bg-white/20 rounded-full text-sm">
                    {{ $items->count() }} Items
                </span>
            </div>
        </div>
    </div>

    <!-- Collection Items -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        @if($items->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($items as $item)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                <!-- Item Image -->
                <div class="relative h-48">
                    @php
                        $image = is_a($item, 'App\Models\Property') 
                            ? (is_array($item->images) && count($item->images) > 0 ? $item->images[0] : null)
                            : (is_array($item->images) && count($item->images) > 0 ? $item->images[0] : null);
                    @endphp
                    @if($image)
                    <img src="{{ $image }}" alt="{{ $item->title ?? $item->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    
                    <!-- Type Badge -->
                    <div class="absolute top-2 left-2">
                        <span class="px-2 py-1 bg-black/50 text-white text-xs rounded-full">
                            {{ is_a($item, 'App\Models\Property') ? 'Property' : 'Project' }}
                        </span>
                    </div>

                    @if(is_a($item, 'App\Models\Property') && $item->is_featured)
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 bg-yellow-500 text-white text-xs rounded-full">Featured</span>
                    </div>
                    @endif
                </div>

                <!-- Item Details -->
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        {{ $item->title ?? $item->name }}
                    </h3>

                    @if(isset($item->city))
                    <p class="text-sm text-gray-600 mb-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $item->city->name }}
                    </p>
                    @endif

                    @if(isset($item->price))
                    <p class="text-xl font-bold mb-3" style="color: {{ $theme['primary_color'] }};">
                        ₹{{ number_format($item->price) }}
                    </p>
                    @endif

                    @if(is_a($item, 'App\Models\Property'))
                    <div class="flex gap-3 text-sm text-gray-600 mb-3">
                        @if($item->bedrooms)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            {{ $item->bedrooms }} BHK
                        </span>
                        @endif
                        @if($item->area)
                        <span>{{ $item->area }} {{ $item->area_unit }}</span>
                        @endif
                    </div>
                    @endif

                    <a href="{{ is_a($item, 'App\Models\Property') ? route('properties.show', $item) : route('projects.show', $item) }}" 
                       class="block w-full text-center px-4 py-2 rounded-lg font-semibold transition-all hover:shadow-lg"
                       style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No items in this collection</h3>
            <p class="text-gray-500">This collection doesn't have any items yet.</p>
        </div>
        @endif
    </div>
</x-layout.frontend>

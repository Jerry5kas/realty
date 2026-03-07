<x-layout.frontend>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <div class="pt-16 bg-gray-50">
        <!-- Breadcrumb -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 py-3">
                <nav class="flex items-center gap-2 text-sm">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 flex items-center gap-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Home
                    </a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('listings', ['type' => 'properties']) }}" class="text-gray-600 hover:text-blue-600 transition-colors">Properties</a>
                    @if($property->city)
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <a href="{{ route('listings', ['type' => 'properties', 'city_id' => $property->city_id]) }}" class="text-gray-600 hover:text-blue-600 transition-colors">{{ $property->city->name }}</a>
                    @endif
                    @if($property->locality)
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-600">{{ $property->locality }}</span>
                    @endif
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 font-medium truncate max-w-xs">{{ $property->title }}</span>
                </nav>
            </div>
        </div>

        <!-- Quick Stats Bar -->
        <div class="bg-white border-b shadow-sm sticky top-16 z-40">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-4 md:gap-6 overflow-x-auto">
                        @if($property->price)
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: {{ $theme['primary_color'] }}15;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Price</p>
                                <p class="text-base md:text-lg font-bold" style="color: {{ $theme['primary_color'] }};">{{ $property->formatted_price }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($property->carpet_area)
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-gray-100">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Area</p>
                                <p class="text-base md:text-lg font-bold text-gray-900">{{ number_format($property->carpet_area) }} sqft</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($property->bedrooms)
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-gray-100">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Bedrooms</p>
                                <p class="text-base md:text-lg font-bold text-gray-900">{{ $property->bedrooms }} BHK</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <!-- Favorite Button -->
                        <button 
                            x-data="{ 
                                favorited: {{ auth()->check() && auth()->user()->hasFavorited('App\\Models\\Property', $property->id) ? 'true' : 'false' }},
                                toggleFavorite() {
                                    @auth
                                        fetch('{{ route('favorites.toggle') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                type: 'property',
                                                id: {{ $property->id }}
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                this.favorited = data.favorited;
                                            }
                                        });
                                    @else
                                        window.location.href = '{{ route('login') }}';
                                    @endauth
                                }
                            }"
                            @click="toggleFavorite()"
                            class="p-2.5 rounded-lg font-semibold text-sm transition-all flex items-center gap-2 border-2"
                            :class="favorited ? 'bg-yellow-50 border-yellow-300 text-yellow-700' : 'bg-white border-gray-300 text-gray-700 hover:border-gray-400'"
                            title="Save to favorites">
                            <svg class="w-5 h-5 transition-all" 
                                 :fill="favorited ? 'currentColor' : 'none'" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="hidden md:inline" x-text="favorited ? 'Saved' : 'Save'"></span>
                        </button>
                        
                        <!-- Share Button -->
                        <div x-data="{ showShare: false }" class="relative">
                            <button 
                                @click="showShare = !showShare"
                                class="p-2.5 rounded-lg font-semibold text-sm transition-all flex items-center gap-2 bg-white border-2 border-gray-300 text-gray-700 hover:border-gray-400"
                                title="Share property">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                </svg>
                                <span class="hidden md:inline">Share</span>
                            </button>
                            
                            <!-- Share Dropdown -->
                            <div x-show="showShare" 
                                 x-transition
                                 @click.away="showShare = false"
                                 class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50"
                                 style="display: none;">
                                <a href="https://wa.me/?text={{ urlencode($property->title . ' - ' . url()->current()) }}" target="_blank" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">WhatsApp</span>
                                </a>
                                <button @click="navigator.clipboard.writeText('{{ url()->current() }}'); showShare = false; alert('Link copied!')" class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">Copy Link</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Print Button -->
                        <button onclick="window.print()" class="p-2.5 rounded-lg font-semibold text-sm transition-all flex items-center gap-2 bg-white border-2 border-gray-300 text-gray-700 hover:border-gray-400" title="Print property details">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-7xl mx-auto px-4 py-8" x-data="{ currentImage: 0, images: {{ json_encode($property->images ?? []) }}, showGallery: false }">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Panel - Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Feature Image Gallery -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="relative cursor-pointer" @click="showGallery = true">
                            <template x-if="images.length > 0">
                                <img :src="images[0]" alt="{{ $property->title }}" class="w-full h-full object-cover" style="height: 500px;">
                            </template>
                            <template x-if="images.length === 0">
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200" style="height: 500px;">
                                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- Property Header -->
                        <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-white">
                            <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $property->title }}</h1>
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-medium">{{ $property->locality }}@if($property->city), {{ $property->city->name }}@endif</span>
                            </div>
                        </div>

                        <!-- Price Section -->
                        @if($property->price)
                        <div class="p-6 border-b" style="background: linear-gradient(135deg, {{ $theme['primary_color'] }}08 0%, {{ $theme['primary_color'] }}15 100%);">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Property Price</p>
                                    <p class="text-4xl font-bold" style="color: {{ $theme['primary_color'] }};">{{ $property->formatted_price }}</p>
                                    @if($property->price_per_sqft)
                                    <p class="text-sm text-gray-600 mt-1">₹{{ number_format($property->price_per_sqft, 0) }} per sq.ft</p>
                                    @endif
                                </div>
                                <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background-color: {{ $theme['primary_color'] }};">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Description -->
                        @if($property->description)
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                Description
                            </h2>
                            <p class="text-gray-700 leading-relaxed">{{ $property->description }}</p>
                        </div>
                        @endif

                        <!-- Property Overview Grid -->
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                Property Details
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                <!-- Listing Type -->
                                @if($property->type)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Listing Type</p>
                                        <p class="font-semibold text-gray-900 text-sm capitalize truncate">{{ str_replace('_', ' ', $property->type) }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Sale Type -->
                                @if($property->sale_type)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Sale Type</p>
                                        <p class="font-semibold text-gray-900 text-sm capitalize truncate">{{ str_replace('_', ' ', $property->sale_type) }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Category -->
                                @if($property->category)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Category</p>
                                        <p class="font-semibold text-gray-900 text-sm capitalize truncate">{{ $property->category }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Property Type -->
                                @if($property->property_type)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Property Type</p>
                                        <p class="font-semibold text-gray-900 text-sm capitalize truncate">{{ str_replace('_', ' ', $property->property_type) }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Builder/Developer -->
                                @if($property->builder)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Builder</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->builder->name }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Link to Project -->
                                @if($property->project)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Project</p>
                                        <a href="{{ route('project.show', $property->project->slug) }}" class="font-semibold text-sm hover:underline truncate block" style="color: {{ $theme['primary_color'] }};">{{ $property->project->name }}</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Area Details -->
                        @if($property->carpet_area || $property->built_up_area || $property->super_built_up_area)
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                </svg>
                                Area Details
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <!-- Carpet Area -->
                                @if($property->carpet_area)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Carpet Area</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ number_format($property->carpet_area) }} {{ $property->area_unit ?? 'Sq.Ft' }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Built-up Area -->
                                @if($property->built_up_area)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Built-up Area</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ number_format($property->built_up_area) }} {{ $property->area_unit ?? 'Sq.Ft' }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Super Built-up Area -->
                                @if($property->super_built_up_area)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Super Built-up Area</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ number_format($property->super_built_up_area) }} {{ $property->area_unit ?? 'Sq.Ft' }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Room Configuration -->
                        @if($property->bedrooms || $property->bathrooms || $property->balconies || $property->age_of_property)
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Room Configuration
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <!-- Bedrooms -->
                                @if($property->bedrooms)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Bedrooms</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->bedrooms }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Bathrooms -->
                                @if($property->bathrooms)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Bathrooms</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->bathrooms }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Balconies -->
                                @if($property->balconies)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Balconies</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->balconies }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Age of Property -->
                                @if($property->age_of_property)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Age</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->age_of_property }} Years</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Additional Details -->
                        @if($property->floor_number || $property->total_floors || $property->furnishing_status || $property->facing || $property->parking_covered || $property->parking_open)
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Additional Details
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                <!-- Floor Number -->
                                @if($property->floor_number)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Floor Number</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->floor_number }}@if($property->total_floors) / {{ $property->total_floors }}@endif</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Total Floors -->
                                @if($property->total_floors && !$property->floor_number)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Total Floors</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->total_floors }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Furnishing Status -->
                                @if($property->furnishing_status)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Furnishing</p>
                                        <p class="font-semibold text-gray-900 text-sm capitalize truncate">{{ str_replace('_', ' ', $property->furnishing_status) }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Facing -->
                                @if($property->facing)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Facing</p>
                                        <p class="font-semibold text-gray-900 text-sm capitalize truncate">{{ str_replace('_', ' ', $property->facing) }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Covered Parking -->
                                @if($property->parking_covered)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Covered Parking</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->parking_covered }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Open Parking -->
                                @if($property->parking_open)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}15;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500 mb-0.5">Open Parking</p>
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ $property->parking_open }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Additional Pricing -->
                        @if($property->maintenance_charges || $property->security_deposit)
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Additional Charges
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <!-- Maintenance Charges -->
                                @if($property->maintenance_charges)
                                <div class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-gray-300 transition-colors">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}10;">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Maintenance</p>
                                        <p class="font-bold text-gray-900 text-lg">₹{{ number_format($property->maintenance_charges, 0) }}</p>
                                        @if($property->maintenance_period)
                                        <p class="text-xs text-gray-600">per {{ $property->maintenance_period }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <!-- Security Deposit -->
                                @if($property->security_deposit)
                                <div class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-gray-300 transition-colors">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $theme['primary_color'] }}10;">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Security Deposit</p>
                                        <p class="font-bold text-gray-900 text-lg">₹{{ number_format($property->security_deposit, 0) }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Location & Map -->
                    @if($property->latitude && $property->longitude)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Location
                            </h2>
                            <div class="space-y-3">
                                <!-- Address -->
                                <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $property->locality }}@if($property->city), {{ $property->city->name }}@endif</p>
                                        @if($property->address)
                                        <p class="text-sm text-gray-600 mt-1">{{ $property->address }}</p>
                                        @endif
                                        @if($property->pincode)
                                        <p class="text-xs text-gray-500 mt-1">Pincode: {{ $property->pincode }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Map -->
                        <div id="property-map" class="w-full" style="height: 400px;"></div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Initialize map
                            const map = L.map('property-map').setView([{{ $property->latitude }}, {{ $property->longitude }}], 15);
                            
                            // Add tile layer
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                                maxZoom: 19
                            }).addTo(map);
                            
                            // Custom marker icon
                            const customIcon = L.divIcon({
                                className: 'custom-marker',
                                html: `<div style="background-color: {{ $theme['primary_color'] }}; width: 40px; height: 40px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                        <svg style="width: 20px; height: 20px; transform: rotate(45deg); color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>`,
                                iconSize: [40, 40],
                                iconAnchor: [20, 40],
                                popupAnchor: [0, -40]
                            });
                            
                            // Add marker
                            const marker = L.marker([{{ $property->latitude }}, {{ $property->longitude }}], { icon: customIcon }).addTo(map);
                            
                            // Add popup
                            marker.bindPopup(`
                                <div style="min-width: 200px;">
                                    <h3 style="font-weight: bold; margin-bottom: 8px; color: {{ $theme['primary_color'] }};">{{ $property->title }}</h3>
                                    <p style="font-size: 14px; color: #666; margin-bottom: 4px;">{{ $property->locality }}@if($property->city), {{ $property->city->name }}@endif</p>
                                    @if($property->price)
                                    <p style="font-size: 16px; font-weight: bold; color: {{ $theme['primary_color'] }}; margin-top: 8px;">{{ $property->formatted_price }}</p>
                                    @endif
                                </div>
                            `).openPopup();
                        });
                    </script>
                    @endif
                </div>

                <!-- Right Panel - Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-4">
                    <!-- Small Preview Gallery Images -->
                    <template x-if="images.length > 1">
                        <div class="space-y-3">
                            <template x-for="(image, index) in images.slice(1, 4)" :key="index">
                                <div class="relative group cursor-pointer rounded-xl overflow-hidden shadow-lg" @click="currentImage = index + 1; showGallery = true">
                                    <img :src="image" :alt="'Image ' + (index + 2)" class="w-full h-full object-cover" style="height: 180px;">
                                    <!-- Show More Images Button on Last Image -->
                                    <template x-if="index === 2 && images.length > 4">
                                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-lg font-semibold" style="color: white;" x-text="'+' + (images.length - 4) + ' more'"></span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Vertical Banners -->
                    <div class="space-y-4">
                        <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%209%20(1).png?updatedAt=1772102189108" alt="Banner" class="w-full rounded-xl shadow-lg">
                        <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%208%20(1).png?updatedAt=1772102187814" alt="Banner" class="w-full rounded-xl shadow-lg">
                    </div>
                </div>
            </div>

            <!-- Full Screen Gallery Modal -->
            <div x-show="showGallery" 
                 x-transition
                 @keydown.escape.window="showGallery = false"
                 class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center"
                 style="display: none;">
                <!-- Close Button -->
                <button @click="showGallery = false" class="absolute top-4 right-4 hover:text-gray-300 z-10" style="color: white;">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Main Image -->
                <div class="relative w-full h-full flex items-center justify-center p-4">
                    <img :src="images[currentImage]" class="max-w-full max-h-full object-contain">
                    
                    <!-- Navigation Arrows -->
                    <template x-if="images.length > 1">
                        <div>
                            <button @click="currentImage = currentImage > 0 ? currentImage - 1 : images.length - 1" 
                                    class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button @click="currentImage = currentImage < images.length - 1 ? currentImage + 1 : 0" 
                                    class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <!-- Image Counter -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 px-4 py-2 bg-black/70 rounded-lg" style="color: white;">
                        <span class="text-sm" x-text="currentImage + 1"></span> / <span class="text-sm" x-text="images.length"></span>
                    </div>
                </div>

                <!-- Thumbnail Strip -->
                <div class="absolute bottom-20 left-0 right-0 px-4">
                    <div class="flex gap-2 overflow-x-auto justify-center">
                        <template x-for="(image, index) in images" :key="index">
                            <button @click="currentImage = index" 
                                    class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all"
                                    :class="currentImage === index ? 'border-blue-500 ring-2 ring-blue-200' : 'border-white/30 hover:border-white/60'">
                                <img :src="image" class="w-full h-full object-cover">
                            </button>
                        </template>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</x-layout.frontend>

<x-layout.frontend>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Compact Filters -->
    <div class="py-4 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <form method="GET" action="{{ route('listings') }}" class="bg-white rounded-lg p-4 border-2" style="border-color: {{ $theme['primary_color'] }};">
                <input type="hidden" name="type" value="{{ $type }}">

                <!-- Type Tabs -->
                <div class="flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('listings', array_merge(request()->except('type'), ['type' => 'all'])) }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $type === 'all' ? '' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                       @if($type === 'all') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                        All
                    </a>
                    <a href="{{ route('listings', array_merge(request()->except('type'), ['type' => 'properties'])) }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $type === 'properties' ? '' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                       @if($type === 'properties') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                        Properties
                    </a>
                    <a href="{{ route('listings', array_merge(request()->except('type'), ['type' => 'projects'])) }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $type === 'projects' ? '' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                       @if($type === 'projects') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                        Projects
                    </a>
                </div>

                <!-- Filter Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 mb-3">
                    <!-- Listing Type (Buy/Rent/Sell) -->
                    <select name="listing_type" class="px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:outline-none text-xs" onchange="this.form.submit()">
                        <option value="">Buy/Rent/Sell</option>
                        <option value="buy" {{ request('listing_type') == 'buy' ? 'selected' : '' }}>Buy</option>
                        <option value="rent" {{ request('listing_type') == 'rent' ? 'selected' : '' }}>Rent</option>
                        <option value="sell" {{ request('listing_type') == 'sell' ? 'selected' : '' }}>Sell</option>
                    </select>

                    <!-- City -->
                    <select name="city_id" class="px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:outline-none text-xs">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>

                    <!-- Builder -->
                    <select name="builder_id" class="px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:outline-none text-xs">
                        <option value="">All Builders</option>
                        @foreach($builders as $builder)
                            <option value="{{ $builder->id }}" {{ request('builder_id') == $builder->id ? 'selected' : '' }}>{{ $builder->company_name }}</option>
                        @endforeach
                    </select>

                    <!-- Min Price -->
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price" class="px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:outline-none text-xs">

                    <!-- Max Price -->
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price" class="px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:outline-none text-xs">

                    @if($type !== 'projects')
                    <!-- Property Type -->
                    <select name="property_type_id" class="px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:outline-none text-xs">
                        <option value="">All Types</option>
                        @foreach($propertyTypes as $propertyType)
                            <option value="{{ $propertyType->id }}" {{ request('property_type_id') == $propertyType->id ? 'selected' : '' }}>{{ $propertyType->name }}</option>
                        @endforeach
                    </select>

                    <!-- Bedrooms -->
                    <select name="bedrooms" class="px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:outline-none text-xs">
                        <option value="">Any BHK</option>
                        <option value="1" {{ request('bedrooms') == '1' ? 'selected' : '' }}>1 BHK</option>
                        <option value="2" {{ request('bedrooms') == '2' ? 'selected' : '' }}>2 BHK</option>
                        <option value="3" {{ request('bedrooms') == '3' ? 'selected' : '' }}>3 BHK</option>
                        <option value="4" {{ request('bedrooms') == '4' ? 'selected' : '' }}>4 BHK</option>
                        <option value="5" {{ request('bedrooms') == '5' ? 'selected' : '' }}>5+ BHK</option>
                    </select>

                    <!-- Possession Status -->
                    <select name="possession_status" class="px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:outline-none text-xs">
                        <option value="">Any Status</option>
                        <option value="ready-to-move" {{ request('possession_status') == 'ready-to-move' ? 'selected' : '' }}>Ready to Move</option>
                        <option value="under-construction" {{ request('possession_status') == 'under-construction' ? 'selected' : '' }}>Under Construction</option>
                        <option value="upcoming" {{ request('possession_status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    </select>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-2">
                    <button type="submit" class="px-4 py-1.5 rounded-lg font-semibold text-xs shadow-md hover:shadow-lg transition-all" style="background-color: {{ $theme['primary_color'] }}; color: white;">
                        Apply Filters
                    </button>
                    <a href="{{ route('listings', ['type' => $type]) }}" class="px-4 py-1.5 rounded-lg font-semibold text-xs bg-gray-100 text-gray-700 hover:bg-gray-200 transition-all">
                        Clear Filters
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6 md:py-10" x-data="listingsMap()" x-init="initMap()">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Main Content -->
            <div class="flex-1" :class="viewMode === 'map' ? 'lg:w-2/5' : ''">
                <!-- Results Count and View Options -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <!-- Left Side - Title and Filter Tabs -->
                    <div class="flex-1">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-3">
                            @if($type === 'properties')
                                @if($listingType === 'buy')
                                    Properties for Sale in UAE
                                @elseif($listingType === 'rent')
                                    Properties for Rent in UAE
                                @else
                                    Off-Plan Properties in UAE
                                @endif
                            @elseif($type === 'projects')
                                Projects in UAE
                            @else
                                Listings in UAE
                            @endif
                        </h2>
                        
                        <!-- Filter Tabs -->
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('listings', array_merge(request()->except('sale_type'), ['type' => $type])) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ !request('sale_type') ? '' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}"
                               @if(!request('sale_type')) style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                                Any
                            </a>
                            <a href="{{ route('listings', array_merge(request()->except('sale_type'), ['type' => $type, 'sale_type' => 'initial'])) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request('sale_type') === 'initial' ? '' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}"
                               @if(request('sale_type') === 'initial') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                                Initial Sale
                            </a>
                            <a href="{{ route('listings', array_merge(request()->except('sale_type'), ['type' => $type, 'sale_type' => 'resale'])) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request('sale_type') === 'resale' ? '' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}"
                               @if(request('sale_type') === 'resale') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                                Resale
                            </a>
                            <a href="{{ route('listings', array_merge(request()->except('sale_type'), ['type' => $type, 'sale_type' => 'developer'])) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request('sale_type') === 'developer' ? '' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}"
                               @if(request('sale_type') === 'developer') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                                By Developer
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right Side - Sort and View Options -->
                    <div class="flex items-center gap-3">
                        <!-- Sort Dropdown -->
                        <div class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            <select class="text-sm font-medium text-gray-700 border-none focus:ring-0 focus:outline-none bg-transparent">
                                <option>Popular</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Newest First</option>
                            </select>
                        </div>
                        
                        <!-- View Toggle -->
                        <div class="flex items-center gap-2 bg-white border border-gray-300 rounded-lg p-1">
                            <button @click="viewMode = 'list'" type="button" class="px-3 py-1.5 rounded text-sm font-medium transition-all" :class="viewMode === 'list' ? '' : 'text-gray-600 hover:bg-gray-100'" :style="viewMode === 'list' ? 'background-color: {{ $theme['primary_color'] }}; color: white;' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </button>
                            <button @click="viewMode = 'map'" type="button" class="px-3 py-1.5 rounded text-sm font-medium transition-all" :class="viewMode === 'map' ? '' : 'text-gray-600 hover:bg-gray-100'" :style="viewMode === 'map' ? 'background-color: {{ $theme['primary_color'] }}; color: white;' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Switch View Button (for mobile) -->
                        @if($type === 'properties')
                            <a href="{{ route('listings', ['type' => 'projects']) }}" class="hidden md:flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all" style="background-color: {{ $theme['primary_color'] }}; color: white;">
                                <svg class="w-4 h-4" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Switch to Projects View
                            </a>
                        @elseif($type === 'projects')
                            <a href="{{ route('listings', ['type' => 'properties']) }}" class="hidden md:flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all" style="background-color: {{ $theme['primary_color'] }}; color: white;">
                                <svg class="w-4 h-4" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Switch to Properties View
                            </a>
                        @endif
                    </div>
                </div>
                
                <!-- Results Count -->
                <div class="mb-4 text-sm text-gray-600">
                    @if($type === 'all' || $type === 'properties')
                        <span class="font-semibold">{{ $properties->total() }}</span> Properties
                    @endif
                    @if($type === 'all')
                        <span class="mx-2">•</span>
                    @endif
                    @if($type === 'all' || $type === 'projects')
                        <span class="font-semibold">{{ $projects->total() }}</span> Projects
                    @endif
                </div>

                <!-- Properties List -->
                @if(($type === 'all' || $type === 'properties') && $properties->count() > 0)
                    <div class="mb-8" :class="viewMode === 'map' ? 'max-h-[calc(100vh-300px)] overflow-y-auto pr-2' : ''">
                        @if($type === 'all')
                            <h2 class="text-xl font-bold mb-4" style="color: {{ $theme['primary_color'] }};">Properties</h2>
                        @endif
                        <div class="space-y-4">
                            @foreach($properties as $property)
                                <div @mouseenter="highlightMarker('property-{{ $property->id }}')" @mouseleave="unhighlightMarker('property-{{ $property->id }}')" data-listing-id="property-{{ $property->id }}">
                                    @include('partials.property-card-compact', ['property' => $property])
                                </div>
                            @endforeach
                        </div>
                        
                        @if($properties->hasPages())
                            <div class="mt-6">
                                {{ $properties->appends(request()->except('properties_page'))->links() }}
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Projects List -->
                @if(($type === 'all' || $type === 'projects') && $projects->count() > 0)
                    <div class="mb-8" :class="viewMode === 'map' ? 'max-h-[calc(100vh-300px)] overflow-y-auto pr-2' : ''">
                        @if($type === 'all')
                            <h2 class="text-xl font-bold mb-4" style="color: {{ $theme['primary_color'] }};">Projects</h2>
                        @endif
                        <div class="space-y-4">
                            @foreach($projects as $project)
                                <div @mouseenter="highlightMarker('project-{{ $project->id }}')" @mouseleave="unhighlightMarker('project-{{ $project->id }}')" data-listing-id="project-{{ $project->id }}">
                                    @include('partials.project-card-compact', ['project' => $project])
                                </div>
                            @endforeach
                        </div>
                        
                        @if($projects->hasPages())
                            <div class="mt-6">
                                {{ $projects->appends(request()->except('projects_page'))->links() }}
                            </div>
                        @endif
                    </div>
                @endif

                <!-- No Results -->
                @if(($type === 'properties' && $properties->count() === 0) || ($type === 'projects' && $projects->count() === 0) || ($type === 'all' && $properties->count() === 0 && $projects->count() === 0))
                    <div class="bg-white rounded-xl shadow-md p-8 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No Results Found</h3>
                        <p class="text-gray-600 mb-4">Try adjusting your filters to find what you're looking for</p>
                        <a href="{{ route('listings', ['type' => $type]) }}" class="inline-block px-6 py-2 rounded-lg font-semibold text-sm text-white" style="background-color: {{ $theme['primary_color'] }};">
                            Clear All Filters
                        </a>
                    </div>
                @endif
            </div>

            <!-- Map View (Hidden in list mode) -->
            <div x-show="viewMode === 'map'" x-transition class="lg:w-3/5 hidden lg:block">
                <div class="sticky top-4">
                    <div id="map" class="w-full rounded-xl shadow-lg border-2 border-gray-200" style="height: calc(100vh - 200px); min-height: 600px;"></div>
                </div>
            </div>

            <!-- Sidebar - Map and Vertical Banners (Hidden in map mode) -->
            <div x-show="viewMode === 'list'" class="lg:w-80 space-y-4">
                <div class="sticky top-4 space-y-4">
                    <!-- Map Image -->
                    <img src="https://ik.imagekit.io/area24onestorage/media-assets/map.png" alt="Map" class="w-full rounded-xl shadow-lg">
                    
                    <!-- Vertical Banners -->
                    <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%209%20(1).png?updatedAt=1772102189108" alt="Banner" class="w-full rounded-xl shadow-lg">
                    <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%208%20(1).png?updatedAt=1772102187814" alt="Banner" class="w-full rounded-xl shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        function listingsMap() {
            return {
                viewMode: 'list',
                map: null,
                markers: {},
                
                initMap() {
                    // Wait for Alpine to be ready and map view to be activated
                    this.$watch('viewMode', (value) => {
                        if (value === 'map' && !this.map) {
                            this.$nextTick(() => {
                                this.createMap();
                            });
                        }
                    });
                },
                
                createMap() {
                    // Initialize map centered on UAE
                    this.map = L.map('map').setView([25.2048, 55.2708], 10);
                    
                    // Add tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);
                    
                    // Custom icons
                    const propertyIcon = L.divIcon({
                        className: 'custom-marker',
                        html: `<div style="background-color: {{ $theme['primary_color'] }}; width: 32px; height: 32px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 16px; height: 16px; transform: rotate(45deg); color: white;" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                            </div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });
                    
                    const projectIcon = L.divIcon({
                        className: 'custom-marker',
                        html: `<div style="background-color: {{ $theme['secondary_color'] }}; width: 32px; height: 32px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 16px; height: 16px; transform: rotate(45deg); color: white;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });
                    
                    // Add property markers
                    const properties = @json($properties->count() > 0 ? $properties->all() : []);
                    properties.forEach(property => {
                        if (property.latitude && property.longitude) {
                            const marker = L.marker([property.latitude, property.longitude], { icon: propertyIcon })
                                .addTo(this.map);
                            
                            // Create popup content
                            const popupContent = this.createPropertyPopup(property);
                            marker.bindPopup(popupContent, {
                                maxWidth: 300,
                                className: 'custom-popup'
                            });
                            
                            // Store marker reference
                            this.markers[`property-${property.id}`] = marker;
                            
                            // Click handler
                            marker.on('click', () => {
                                this.scrollToListing(`property-${property.id}`);
                            });
                        }
                    });
                    
                    // Add project markers
                    const projects = @json($projects->count() > 0 ? $projects->all() : []);
                    projects.forEach(project => {
                        if (project.latitude && project.longitude) {
                            const marker = L.marker([project.latitude, project.longitude], { icon: projectIcon })
                                .addTo(this.map);
                            
                            // Create popup content
                            const popupContent = this.createProjectPopup(project);
                            marker.bindPopup(popupContent, {
                                maxWidth: 300,
                                className: 'custom-popup'
                            });
                            
                            // Store marker reference
                            this.markers[`project-${project.id}`] = marker;
                            
                            // Click handler
                            marker.on('click', () => {
                                this.scrollToListing(`project-${project.id}`);
                            });
                        }
                    });
                    
                    // Fit bounds to show all markers
                    if (Object.keys(this.markers).length > 0) {
                        const group = L.featureGroup(Object.values(this.markers));
                        this.map.fitBounds(group.getBounds().pad(0.1));
                    }
                },
                
                createPropertyPopup(property) {
                    const price = property.price ? `₹${(property.price / 100000).toFixed(2)} Lac` : 'Price on Request';
                    const image = property.images && property.images[0] ? property.images[0] : '';
                    const type = property.property_type_name || '';
                    const bedrooms = property.bedrooms ? `${property.bedrooms} BHK` : '';
                    const area = property.carpet_area ? `${property.carpet_area} sqft` : '';
                    
                    return `
                        <div class="property-popup">
                            ${image ? `<img src="${image}" alt="${property.title}" class="w-full h-32 object-cover rounded-t-lg">` : ''}
                            <div class="p-3">
                                <h3 class="font-bold text-sm mb-1 line-clamp-1" style="color: {{ $theme['primary_color'] }};">${property.title}</h3>
                                <p class="text-xs text-gray-600 mb-2 line-clamp-1">${property.location || ''}</p>
                                <div class="flex items-center gap-2 text-xs text-gray-600 mb-2">
                                    ${type ? `<span>${type}</span>` : ''}
                                    ${bedrooms ? `<span>• ${bedrooms}</span>` : ''}
                                    ${area ? `<span>• ${area}</span>` : ''}
                                </div>
                                <div class="text-lg font-bold text-gray-900">${price}</div>
                            </div>
                        </div>
                    `;
                },
                
                createProjectPopup(project) {
                    const price = project.starting_price ? `₹${(project.starting_price / 100000).toFixed(2)} Lac` : 
                                 (project.min_price ? `₹${(project.min_price / 100000).toFixed(2)} Lac` : 'Price on Request');
                    const image = project.images && project.images[0] ? project.images[0] : '';
                    const type = project.project_type || '';
                    const units = project.total_units ? `${project.total_units} Units` : '';
                    const area = project.total_area ? `${project.total_area} sqft` : '';
                    
                    return `
                        <div class="project-popup">
                            ${image ? `<img src="${image}" alt="${project.name}" class="w-full h-32 object-cover rounded-t-lg">` : ''}
                            <div class="p-3">
                                <h3 class="font-bold text-sm mb-1 line-clamp-1" style="color: {{ $theme['secondary_color'] }};">${project.name}</h3>
                                <p class="text-xs text-gray-600 mb-2 line-clamp-1">${project.location || ''}</p>
                                <div class="flex items-center gap-2 text-xs text-gray-600 mb-2">
                                    ${type ? `<span>${type}</span>` : ''}
                                    ${units ? `<span>• ${units}</span>` : ''}
                                    ${area ? `<span>• ${area}</span>` : ''}
                                </div>
                                <div class="text-lg font-bold text-gray-900">${price}</div>
                            </div>
                        </div>
                    `;
                },
                
                highlightMarker(id) {
                    if (this.viewMode === 'map' && this.markers[id]) {
                        this.markers[id].openPopup();
                    }
                },
                
                unhighlightMarker(id) {
                    if (this.viewMode === 'map' && this.markers[id]) {
                        this.markers[id].closePopup();
                    }
                },
                
                scrollToListing(id) {
                    const element = document.querySelector(`[data-listing-id="${id}"]`);
                    if (element) {
                        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        element.classList.add('ring-2', 'ring-blue-500');
                        setTimeout(() => {
                            element.classList.remove('ring-2', 'ring-blue-500');
                        }, 2000);
                    }
                }
            }
        }
    </script>
    
    <style>
        .custom-popup .leaflet-popup-content-wrapper {
            padding: 0;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        
        .custom-popup .leaflet-popup-content {
            margin: 0;
            width: 280px !important;
        }
        
        .custom-popup .leaflet-popup-tip {
            background: white;
        }
        
        .custom-marker {
            background: transparent;
            border: none;
        }
        
        /* Smooth scrollbar for list in map view */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: {{ $theme['primary_color'] }};
            border-radius: 10px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: {{ $theme['secondary_color'] }};
        }
    </style>
</x-layout.frontend>

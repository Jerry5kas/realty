<x-layout.frontend>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Modern Filter Section -->
    <div class="bg-gradient-to-br from-gray-50 to-white border-b border-gray-200">
        <div class="max-w-full mx-auto px-4 py-6">
            <form method="GET" action="{{ route('map.view') }}" class="space-y-4">
                <input type="hidden" name="type" value="{{ $type }}">

                <!-- Top Row: Type Tabs + Possession Toggle -->
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <!-- Type Tabs -->
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('map.view', array_merge(request()->except('type'), ['type' => 'all'])) }}" 
                           class="px-4 py-2.5 rounded-lg text-sm font-semibold transition-all {{ $type === 'all' ? 'shadow-md' : 'bg-white border border-gray-200 text-gray-700 hover:border-gray-300 hover:shadow-sm' }}"
                           @if($type === 'all') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                            All
                        </a>
                        <a href="{{ route('map.view', array_merge(request()->except('type'), ['type' => 'properties'])) }}" 
                           class="px-4 py-2.5 rounded-lg text-sm font-semibold transition-all {{ $type === 'properties' ? 'shadow-md' : 'bg-white border border-gray-200 text-gray-700 hover:border-gray-300 hover:shadow-sm' }}"
                           @if($type === 'properties') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                            Properties
                        </a>
                        <a href="{{ route('map.view', array_merge(request()->except('type'), ['type' => 'projects'])) }}" 
                           class="px-4 py-2.5 rounded-lg text-sm font-semibold transition-all {{ $type === 'projects' ? 'shadow-md' : 'bg-white border border-gray-200 text-gray-700 hover:border-gray-300 hover:shadow-sm' }}"
                           @if($type === 'projects') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                            Projects
                        </a>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <!-- Off Plan / Ready to Move Toggle -->
                        <div class="flex items-center gap-2 bg-white rounded-lg p-1.5 border border-gray-200 shadow-sm">
                            <a href="{{ route('map.view', array_merge(request()->except('possession_filter'), ['type' => $type, 'possession_filter' => 'off-plan'])) }}" 
                               class="px-4 py-2 rounded-md text-sm font-semibold transition-all {{ request('possession_filter') === 'off-plan' ? 'shadow-sm' : 'text-gray-600 hover:text-gray-900' }}"
                               @if(request('possession_filter') === 'off-plan') style="background-color: {{ $theme['primary_color'] }}20; color: {{ $theme['primary_color'] }};" @endif>
                                Off Plan
                            </a>
                            <a href="{{ route('map.view', array_merge(request()->except('possession_filter'), ['type' => $type, 'possession_filter' => 'ready-to-move'])) }}" 
                               class="px-4 py-2 rounded-md text-sm font-semibold transition-all {{ request('possession_filter') === 'ready-to-move' ? 'shadow-sm' : 'text-gray-600 hover:text-gray-900' }}"
                               @if(request('possession_filter') === 'ready-to-move') style="background-color: {{ $theme['primary_color'] }}20; color: {{ $theme['primary_color'] }};" @endif>
                                Ready to Move
                            </a>
                            @if(request('possession_filter'))
                            <a href="{{ route('map.view', array_merge(request()->except('possession_filter'), ['type' => $type])) }}" 
                               class="px-2 py-2 text-gray-400 hover:text-gray-600 transition-all" title="Clear possession filter">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Filter Grid -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-4">
                        @if($type !== 'projects')
                        <!-- Listing Type (Buy/Rent) -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Listing Type</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <select name="listing_type" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent focus:outline-none text-sm appearance-none bg-white hover:border-gray-400 transition-colors">
                                    <option value="">All Types</option>
                                    <option value="buy" {{ request('listing_type') == 'buy' ? 'selected' : '' }}>Buy</option>
                                    <option value="rent" {{ request('listing_type') == 'rent' ? 'selected' : '' }}>Rent</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- City -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Location</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <select name="city_id" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent focus:outline-none text-sm appearance-none bg-white hover:border-gray-400 transition-colors">
                                    <option value="">All Cities</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        @if($type !== 'projects')
                        <!-- Property Type -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Property Type</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                                <select name="property_type_id" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent focus:outline-none text-sm appearance-none bg-white hover:border-gray-400 transition-colors">
                                    <option value="">All Types</option>
                                    @foreach($propertyTypes as $propertyType)
                                        <option value="{{ $propertyType->id }}" {{ request('property_type_id') == $propertyType->id ? 'selected' : '' }}>{{ $propertyType->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Bedrooms -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Bedrooms</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1v-3z"></path>
                                    </svg>
                                </div>
                                <select name="bedrooms" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent focus:outline-none text-sm appearance-none bg-white hover:border-gray-400 transition-colors">
                                    <option value="">Any BHK</option>
                                    <option value="1" {{ request('bedrooms') == '1' ? 'selected' : '' }}>1 BHK</option>
                                    <option value="2" {{ request('bedrooms') == '2' ? 'selected' : '' }}>2 BHK</option>
                                    <option value="3" {{ request('bedrooms') == '3' ? 'selected' : '' }}>3 BHK</option>
                                    <option value="4" {{ request('bedrooms') == '4' ? 'selected' : '' }}>4 BHK</option>
                                    <option value="5" {{ request('bedrooms') == '5' ? 'selected' : '' }}>5+ BHK</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Builder -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Builder/Developer</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <select name="builder_id" class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent focus:outline-none text-sm appearance-none bg-white hover:border-gray-400 transition-colors">
                                    <option value="">All Builders</option>
                                    @foreach($builders as $builder)
                                        <option value="{{ $builder->id }}" {{ request('builder_id') == $builder->id ? 'selected' : '' }}>{{ $builder->company_name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Min Price -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Min Price (₹)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="e.g. 5000000" class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent focus:outline-none text-sm hover:border-gray-400 transition-colors">
                            </div>
                        </div>

                        <!-- Max Price -->
                        <div class="relative">
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Max Price (₹)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="e.g. 50000000" class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent focus:outline-none text-sm hover:border-gray-400 transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit" class="flex items-center gap-2 px-6 py-2.5 rounded-lg font-semibold text-sm shadow-md hover:shadow-lg transition-all" style="background-color: {{ $theme['primary_color'] }}; color: white;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        <a href="{{ route('map.view', ['type' => $type]) }}" class="flex items-center gap-2 px-6 py-2.5 rounded-lg font-semibold text-sm bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Map View Container -->
    <div class="w-full" x-data="mapViewApp()" x-init="initMap()">
        <div class="flex h-[calc(100vh-250px)]">
            <!-- Left Side - Cards List -->
            <div class="w-2/5 overflow-y-auto bg-gray-50 p-4 space-y-4">
                <!-- View Toggle and Sale Type Filter -->
                <div class="flex items-center justify-between gap-4 mb-4">
                    <!-- Sale Type Filter Tabs (only for properties) -->
                    @if($type === 'properties')
                    <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex-1">
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('map.view', array_merge(request()->except('sale_type'), ['type' => $type])) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ !request('sale_type') ? '' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}"
                               @if(!request('sale_type')) style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                                Any
                            </a>
                            <a href="{{ route('map.view', array_merge(request()->except('sale_type'), ['type' => $type, 'sale_type' => 'initial'])) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request('sale_type') === 'initial' ? '' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}"
                               @if(request('sale_type') === 'initial') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                                Initial Sale
                            </a>
                            <a href="{{ route('map.view', array_merge(request()->except('sale_type'), ['type' => $type, 'sale_type' => 'resale'])) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request('sale_type') === 'resale' ? '' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}"
                               @if(request('sale_type') === 'resale') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                                Resale
                            </a>
                            <a href="{{ route('map.view', array_merge(request()->except('sale_type'), ['type' => $type, 'sale_type' => 'developer'])) }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ request('sale_type') === 'developer' ? '' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}"
                               @if(request('sale_type') === 'developer') style="background-color: {{ $theme['primary_color'] }}; color: white;" @endif>
                                By Developer
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="flex-1"></div>
                    @endif
                    
                    <!-- List/Map Toggle Button -->
                    <a href="{{ route('listings', request()->all()) }}" class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold transition-all bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        List View
                    </a>
                </div>
                
                <!-- Results Count -->
                <div class="text-sm font-semibold text-gray-700 mb-4">
                    @if($type === 'all')
                        {{ $properties->count() + $projects->count() }} Listings with location data
                        @if($properties->count() > 0 && $projects->count() > 0)
                            <span class="text-gray-500">({{ $properties->count() }} Properties, {{ $projects->count() }} Projects)</span>
                        @endif
                    @elseif($type === 'properties')
                        {{ $properties->count() }} Properties with location data
                    @else
                        {{ $projects->count() }} Projects with location data
                    @endif
                </div>

                <!-- Properties List -->
                @if(($type === 'properties' || $type === 'all') && $properties->count() > 0)
                    @if($type === 'all' && $properties->count() > 0)
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Properties</div>
                    @endif
                    @foreach($properties as $property)
                        <div @mouseenter="focusLocation({{ $property->latitude }}, {{ $property->longitude }}, 'property-{{ $property->id }}')" 
                             @mouseleave="clearFocus()"
                             @click="centerMap({{ $property->latitude }}, {{ $property->longitude }})"
                             data-listing-id="property-{{ $property->id }}"
                             class="cursor-pointer transition-all hover:scale-[1.02]">
                            @include('partials.property-card-compact', ['property' => $property])
                        </div>
                    @endforeach
                @endif

                <!-- Projects List -->
                @if(($type === 'projects' || $type === 'all') && $projects->count() > 0)
                    @if($type === 'all' && $projects->count() > 0)
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 mt-6">Projects</div>
                    @endif
                    @foreach($projects as $project)
                        <div @mouseenter="focusLocation({{ $project->latitude }}, {{ $project->longitude }}, 'project-{{ $project->id }}')" 
                             @mouseleave="clearFocus()"
                             @click="centerMap({{ $project->latitude }}, {{ $project->longitude }})"
                             data-listing-id="project-{{ $project->id }}"
                             class="cursor-pointer transition-all hover:scale-[1.02]">
                            @include('partials.project-card-compact', ['project' => $project])
                        </div>
                    @endforeach
                @endif

                <!-- No Results -->
                @if($properties->count() === 0 && $projects->count() === 0)
                    <div class="bg-white rounded-xl shadow-md p-8 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No Listings with Location Data</h3>
                        <p class="text-gray-600 mb-4">Try adjusting your filters or check back later</p>
                        <a href="{{ route('map.view', ['type' => $type]) }}" class="inline-block px-6 py-2 rounded-lg font-semibold text-sm text-white" style="background-color: {{ $theme['primary_color'] }};">
                            Clear All Filters
                        </a>
                    </div>
                @endif
            </div>

            <!-- Right Side - Map -->
            <div class="w-3/5 relative">
                <div id="map" class="w-full h-full"></div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        function mapViewApp() {
            return {
                map: null,
                markers: {},
                focusCircle: null,
                currentFocusMarker: null,
                
                initMap() {
                    // Initialize map centered on Bangalore
                    this.map = L.map('map').setView([12.9716, 77.5946], 11);
                    
                    // Add tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(this.map);
                    
                    // Custom icons
                    const propertyIcon = L.divIcon({
                        className: 'custom-marker',
                        html: `<div style="background-color: {{ $theme['primary_color'] }}; width: 36px; height: 36px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 3px 10px rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 18px; height: 18px; transform: rotate(45deg); color: white;" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                            </div>`,
                        iconSize: [36, 36],
                        iconAnchor: [18, 36],
                        popupAnchor: [0, -36]
                    });
                    
                    const projectIcon = L.divIcon({
                        className: 'custom-marker',
                        html: `<div style="background-color: {{ $theme['secondary_color'] }}; width: 36px; height: 36px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 3px 10px rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 18px; height: 18px; transform: rotate(45deg); color: white;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>`,
                        iconSize: [36, 36],
                        iconAnchor: [18, 36],
                        popupAnchor: [0, -36]
                    });
                    
                    // Add markers
                    const properties = @json($properties);
                    const projects = @json($projects);
                    const type = '{{ $type }}';
                    
                    // Add property markers
                    if (type === 'properties' || type === 'all') {
                        properties.forEach(property => {
                            if (property.latitude && property.longitude) {
                                const marker = L.marker([property.latitude, property.longitude], { icon: propertyIcon })
                                    .addTo(this.map);
                                this.markers[`property-${property.id}`] = marker;
                            }
                        });
                    }
                    
                    // Add project markers
                    if (type === 'projects' || type === 'all') {
                        projects.forEach(project => {
                            if (project.latitude && project.longitude) {
                                const marker = L.marker([project.latitude, project.longitude], { icon: projectIcon })
                                    .addTo(this.map);
                                this.markers[`project-${project.id}`] = marker;
                            }
                        });
                    }
                    
                    // Fit bounds to show all markers
                    if (Object.keys(this.markers).length > 0) {
                        const group = L.featureGroup(Object.values(this.markers));
                        this.map.fitBounds(group.getBounds().pad(0.1));
                    }
                },
                
                focusLocation(lat, lng, id) {
                    // Remove previous circle
                    if (this.focusCircle) {
                        this.map.removeLayer(this.focusCircle);
                    }
                    
                    // Add 300m radius circle
                    this.focusCircle = L.circle([lat, lng], {
                        color: '{{ $theme['primary_color'] }}',
                        fillColor: '{{ $theme['primary_color'] }}',
                        fillOpacity: 0.15,
                        radius: 300,
                        weight: 2
                    }).addTo(this.map);
                    
                    // Highlight marker
                    if (this.markers[id]) {
                        this.currentFocusMarker = id;
                    }
                },
                
                clearFocus() {
                    if (this.focusCircle) {
                        this.map.removeLayer(this.focusCircle);
                        this.focusCircle = null;
                    }
                    this.currentFocusMarker = null;
                },
                
                centerMap(lat, lng) {
                    this.map.setView([lat, lng], 16, {
                        animate: true,
                        duration: 0.5
                    });
                }
            }
        }
    </script>
    
    <style>
        .custom-marker {
            background: transparent;
            border: none;
        }
        
        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
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

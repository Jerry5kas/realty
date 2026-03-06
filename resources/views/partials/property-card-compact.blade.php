<div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200">
    <div class="flex flex-col sm:flex-row h-full">
        <!-- Image Section -->
        <div class="relative sm:w-2/5 h-56 sm:h-auto overflow-hidden group">
            @if($property->primary_image)
                <img src="{{ $property->primary_image }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
            @endif
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Top Badges -->
            <div class="absolute top-3 left-3 flex flex-col gap-2">
                @if($property->is_featured)
                    <span class="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg px-3 py-1 text-xs font-bold shadow-lg" style="color: white;">
                        <i class="fas fa-star mr-1"></i>Featured
                    </span>
                @endif
                @if($property->possession_status)
                    <span class="rounded-lg px-3 py-1 text-xs font-semibold shadow-lg backdrop-blur-sm" style="background-color: {{ $theme['primary_color'] }}; color: white;">
                        {{ ucwords(str_replace('-', ' ', $property->possession_status)) }}
                    </span>
                @endif
            </div>
            
            <!-- Favorite Button -->
            <button class="absolute top-3 right-3 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:scale-110 transition-all duration-300 group/fav">
                <svg class="w-5 h-5 text-gray-600 group-hover/fav:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
            
            <!-- Builder Badge -->
            @if($property->builder)
                <div class="absolute bottom-3 left-3 bg-black/80 backdrop-blur-md rounded-lg px-3 py-2 flex items-center gap-2 shadow-lg">
                    <div class="w-7 h-7 bg-white rounded-md flex items-center justify-center">
                        <span class="text-xs font-bold" style="color: {{ $theme['primary_color'] }};">{{ strtoupper(substr($property->builder->company_name, 0, 2)) }}</span>
                    </div>
                    <span class="text-xs font-semibold" style="color: white;">{{ $property->builder->company_name }}</span>
                </div>
            @endif
        </div>
        
        <!-- Content Section -->
        <div class="flex-1 p-5 flex flex-col justify-between">
            <!-- Top Section -->
            <div>
                <!-- Title with Type Badge -->
                <div class="flex items-start justify-between gap-2 mb-2">
                    <h3 class="text-lg font-bold line-clamp-1 hover:text-blue-600 transition-colors cursor-pointer flex-1" style="color: {{ $theme['primary_color'] }};">
                        {{ $property->title }}
                    </h3>
                    @if($property->type)
                        <span class="px-2 py-1 rounded text-xs font-semibold whitespace-nowrap" style="background-color: {{ $theme['primary_color'] }}20; color: {{ $theme['primary_color'] }};">
                            {{ ucfirst($property->type) }}
                        </span>
                    @endif
                </div>
                
                <!-- Location -->
                <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color: {{ $theme['primary_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="line-clamp-1">
                        @if($property->address)
                            {{ $property->address }}@if($property->city), {{ $property->city->name }}@endif
                        @else
                            {{ $property->location }}@if($property->city), {{ $property->city->name }}@endif
                        @endif
                    </span>
                </div>
                
                <!-- Property Details Grid -->
                <div class="grid grid-cols-3 gap-3 mb-3 pb-3 border-b border-gray-200">
                    @if($property->propertyType)
                        <div class="text-center bg-blue-50 rounded-lg p-2">
                            <div class="text-xs text-gray-500 mb-1">Type</div>
                            <div class="text-sm font-semibold text-gray-900">{{ $property->propertyType->name }}</div>
                        </div>
                    @endif
                    @if($property->bedrooms)
                        <div class="text-center bg-blue-50 rounded-lg p-2">
                            <div class="text-xs text-gray-500 mb-1">Bedrooms</div>
                            <div class="text-sm font-semibold text-gray-900">{{ $property->bedrooms }} BHK</div>
                        </div>
                    @endif
                    @if($property->carpet_area)
                        <div class="text-center bg-blue-50 rounded-lg p-2">
                            <div class="text-xs text-gray-500 mb-1">Area</div>
                            <div class="text-sm font-semibold text-gray-900">{{ number_format($property->carpet_area) }} sqft</div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Bottom Section -->
            <div>
                <!-- Price and Payment Plan -->
                <div class="flex items-center justify-between mb-4">
                    <div>
                        @if($property->price)
                            <div class="text-2xl font-bold text-gray-900">₹{{ number_format($property->price / 100000, 2) }} Lac</div>
                            <div class="text-xs text-gray-500">₹{{ number_format($property->price) }}</div>
                        @endif
                    </div>
                    @if($property->possession_status === 'under-construction')
                        <span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-green-50 border border-green-200" style="color: {{ $theme['primary_color'] }};">
                            <i class="fas fa-calendar-check mr-1"></i>Payment Plan
                        </span>
                    @endif
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center gap-2">
                    <a href="mailto:info@area24realty.com?subject=Inquiry about {{ $property->title }}" 
                       class="flex-1 px-4 py-2.5 rounded-lg font-semibold text-sm text-center transition-all flex items-center justify-center gap-2 hover:shadow-lg transform hover:-translate-y-0.5"
                       style="background-color: {{ $theme['primary_color'] }}; color: white;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email
                    </a>
                    <a href="tel:+971501234567" 
                       class="flex-1 px-4 py-2.5 rounded-lg font-semibold text-sm text-center bg-gray-100 hover:bg-gray-200 transition-all flex items-center justify-center gap-2 transform hover:-translate-y-0.5"
                       style="color: {{ $theme['primary_color'] }};">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Call
                    </a>
                    <a href="https://wa.me/{{ config('app.whatsapp_number', '971501234567') }}?text=I'm interested in {{ $property->title }}" 
                       target="_blank"
                       class="flex-1 px-4 py-2.5 rounded-lg font-semibold text-sm text-center bg-green-50 text-green-600 hover:bg-green-100 transition-all flex items-center justify-center gap-2 border border-green-200 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                        </svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

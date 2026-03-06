<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
    <div class="flex flex-col md:flex-row">
        <!-- Image Section -->
        <div class="relative md:w-2/5 h-64 md:h-auto overflow-hidden">
            @if($project->featured_image)
                <img src="{{ $project->featured_image }}" alt="{{ $project->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            @endif
            
            <!-- Top Left Badges -->
            <div class="absolute top-3 left-3 flex flex-col gap-2">
                @if($project->is_featured)
                    <span class="bg-yellow-500 rounded-lg px-3 py-1.5 text-xs font-bold text-white shadow-md">Featured</span>
                @endif
                @if($project->status)
                    <span class="bg-gray-700 rounded-lg px-3 py-1.5 text-xs font-semibold text-white shadow-md">
                        {{ ucwords(str_replace('-', ' ', $project->status)) }}
                    </span>
                @endif
            </div>
            
            <!-- Favorite Button -->
            <button class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-gray-50 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
            
            <!-- Price Badge -->
            @if($project->starting_price)
                <div class="absolute bottom-3 left-3">
                    <div class="px-3 py-1.5 rounded-lg font-bold text-sm text-white" style="background-color: {{ $theme['primary_color'] }};">
                        Price on Request
                    </div>
                </div>
            @endif
            
            <!-- Builder Badge at Bottom -->
            @if($project->builder)
                <div class="absolute bottom-3 left-3 bg-black bg-opacity-70 backdrop-blur-sm rounded-lg px-3 py-2 flex items-center gap-2">
                    <div class="w-8 h-8 bg-white rounded flex items-center justify-center">
                        <span class="text-xs font-bold" style="color: {{ $theme['primary_color'] }};">{{ strtoupper(substr($project->builder->company_name, 0, 2)) }}</span>
                    </div>
                    <span class="text-xs font-semibold text-white">{{ $project->builder->company_name }}</span>
                </div>
            @endif
        </div>
        
        <!-- Content Section -->
        <div class="flex-1 p-5 flex flex-col">
            <!-- Price -->
            <div class="mb-3">
                @if($project->starting_price)
                    <div class="text-3xl font-bold text-gray-900">AED {{ number_format($project->starting_price) }}</div>
                @else
                    <div class="text-3xl font-bold text-gray-900">Price on Request</div>
                @endif
            </div>
            
            <!-- Project Type and Details -->
            <div class="flex items-center gap-4 mb-3 text-sm text-gray-700">
                <span class="font-medium">{{ ucwords($project->project_type ?? 'Residential') }}</span>
                @if($project->total_units)
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span>{{ $project->total_units }} Units</span>
                    </div>
                @endif
                @if($project->total_area)
                    <div class="flex items-center gap-1">
                        <span class="font-medium">Area:</span>
                        <span>{{ number_format($project->total_area) }} sqft</span>
                    </div>
                @endif
            </div>
            
            <!-- Title -->
            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 leading-tight" style="color: {{ $theme['primary_color'] }};">{{ $project->name }}</h3>
            
            <!-- Location -->
            <div class="flex items-start gap-2 text-sm text-gray-600 mb-4">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="line-clamp-1">{{ $project->location }}@if($project->city), {{ $project->city->name }}@endif</span>
            </div>
            
            <!-- Verification Badge -->
            @if($project->is_verified && $project->verified_at)
                <div class="flex items-center gap-2 mb-4 text-sm text-blue-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Property authenticity was validated on {{ \Carbon\Carbon::parse($project->verified_at)->format('jS \\of F') }}</span>
                </div>
            @endif
            
            <!-- Handover -->
            <div class="flex items-center gap-6 mb-4 pb-4 border-b border-gray-200">
                @if($project->completion_date)
                    <div>
                        <div class="text-xs text-gray-500 uppercase mb-1">Handover</div>
                        <div class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($project->completion_date)->format('M Y') }}</div>
                    </div>
                @endif
                @if($project->payment_plan)
                    <div>
                        <div class="text-xs text-gray-500 uppercase mb-1">Payment Plan</div>
                        <div class="text-sm font-semibold text-gray-900 flex items-center gap-1">
                            {{ $project->payment_plan }}
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Action Buttons -->
            <div class="flex items-center gap-3 mt-auto">
                <a href="mailto:info@area24realty.com?subject=Inquiry about {{ $project->name }}" 
                   class="flex-1 px-4 py-2.5 rounded-lg font-semibold text-sm text-center bg-blue-50 hover:bg-blue-100 transition-all flex items-center justify-center gap-2"
                   style="color: {{ $theme['primary_color'] }};">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Email
                </a>
                <a href="tel:+971501234567" 
                   class="flex-1 px-4 py-2.5 rounded-lg font-semibold text-sm text-center bg-blue-50 hover:bg-blue-100 transition-all flex items-center justify-center gap-2"
                   style="color: {{ $theme['primary_color'] }};">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call
                </a>
                <a href="https://wa.me/{{ config('app.whatsapp_number', '971501234567') }}?text=I'm interested in {{ $project->name }}" 
                   target="_blank"
                   class="flex-1 px-4 py-2.5 rounded-lg font-semibold text-sm text-center bg-green-50 text-green-600 hover:bg-green-100 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                    </svg>
                    WhatsApp
                </a>
            </div>
            
            <!-- Builder Logo Bottom Right -->
            @if($project->builder)
                <div class="absolute bottom-5 right-5">
                    <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center">
                        <span class="text-xs font-bold text-gray-400">LOGO</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<x-layout.frontend>
    @if($banners->count() > 0)
    <div class="m-1 sm:m-2">
        <div class="relative w-full overflow-hidden bg-gray-900 rounded-2xl shadow-xl" style="height: 60vh; min-height: 400px; max-height: 700px;">
            
            <div id="banner-slider" class="relative w-full h-full">
                @foreach($banners as $index => $banner)
                <div class="banner-slide absolute inset-0 w-full h-full transition-opacity duration-700 @if($index === 0) opacity-100 @else opacity-0 @endif" data-slide="{{ $index }}">
                    @if(!empty($banner->link_url))
                    <a href="{{ $banner->link_url }}" class="block w-full h-full relative">
                    @else
                    <div class="block w-full h-full relative">
                    @endif
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="hidden md:block w-full h-full object-cover rounded-2xl">
                        <img src="{{ $banner->mobile_image_url ?? $banner->image_url }}" alt="{{ $banner->title }}" class="md:hidden w-full h-full object-cover rounded-2xl">
                        <!-- Very light dark overlay -->
                        <div class="absolute inset-0 bg-black/30 rounded-2xl pointer-events-none"></div>
                    @if(!empty($banner->link_url))
                    </a>
                    @else
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="hero-overlay absolute inset-0 flex flex-col items-center justify-center z-20 pointer-events-none px-4">
                <div class="w-full max-w-6xl pointer-events-auto">
                    
                    <div class="text-center mb-6">
                        <h1 style="color: white;" class="text-white text-3xl md:text-5xl lg:text-6xl font-bold mb-2 drop-shadow-2xl">Find Your Dream Property</h1>
                        <p style="color: white;" class="text-white text-base md:text-xl drop-shadow-lg">Discover the perfect home in your ideal location</p>
                    </div>

                    <div class="hidden md:block bg-white rounded-3xl shadow-2xl p-6 backdrop-blur-sm relative z-50">
                        <div class="flex justify-center gap-3 mb-5">
                            <button class="property-type-tab active px-6 py-2.5 rounded-xl font-semibold transition-all flex items-center gap-2 text-sm" data-type="buy">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span>Buy</span>
                            </button>
                            <button class="property-type-tab px-6 py-2.5 rounded-xl font-semibold transition-all flex items-center gap-2 text-sm" data-type="rent">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                                <span>Rent</span>
                            </button>
                            <button class="property-type-tab px-6 py-2.5 rounded-xl font-semibold transition-all flex items-center gap-2 text-sm" data-type="projects">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>New Projects</span>
                            </button>
                        </div>

                        <div class="flex items-center justify-center gap-3" x-data="{ 
                            propertyTypeOpen: false, 
                            bedsOpen: false,
                            selectedPropertyType: 'Property Type',
                            selectedBeds: 'Beds & Baths'
                        }">
                            <div class="flex-1 max-w-sm">
                                <div class="relative">
                                    <div class="absolute left-3 top-1/2 -translate-y-1/2" style="color: #ffffff;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="Enter location" class="filter-input text-white w-full pl-11 pr-4 py-3 rounded-xl transition-all font-medium text-sm" style="background: transparent; border: 2px solid #ffffff; color: #ffffff !important;">
                                </div>
                            </div>

                            <div class="relative z-[60]" x-on:click.away="propertyTypeOpen = false">
                                <button @click="propertyTypeOpen = !propertyTypeOpen" type="button" class="filter-select text-white flex items-center justify-between pl-11 pr-4 py-3 rounded-xl transition-all font-medium cursor-pointer min-w-[160px] text-sm" style="background: transparent; border: 2px solid #ffffff; color: #ffffff !important;">
                                    <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" style="color: #ffffff;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <span x-text="selectedPropertyType" style="color: #ffffff !important;"></span>
                                    <svg class="w-4 h-4 transition-transform" :class="propertyTypeOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="propertyTypeOpen" x-transition class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl overflow-hidden z-[100]" style="background: #0D1B36;">
                                    <button @click="selectedPropertyType = 'Apartment'; propertyTypeOpen = false" class="w-full px-4 py-2.5 text-left hover:bg-opacity-80 transition-colors text-sm" style="color: #ffffff; background: #0D1B36;">Apartment</button>
                                    <button @click="selectedPropertyType = 'Villa'; propertyTypeOpen = false" class="w-full px-4 py-2.5 text-left hover:bg-opacity-80 transition-colors text-sm" style="color: #ffffff; background: #0D1B36;">Villa</button>
                                    <button @click="selectedPropertyType = 'Townhouse'; propertyTypeOpen = false" class="w-full px-4 py-2.5 text-left hover:bg-opacity-80 transition-colors text-sm" style="color: #ffffff; background: #0D1B36;">Townhouse</button>
                                    <button @click="selectedPropertyType = 'Penthouse'; propertyTypeOpen = false" class="w-full px-4 py-2.5 text-left hover:bg-opacity-80 transition-colors text-sm" style="color: #ffffff; background: #0D1B36;">Penthouse</button>
                                </div>
                            </div>

                            <div class="relative z-[60]" x-on:click.away="bedsOpen = false">
                                <button @click="bedsOpen = !bedsOpen" type="button" class="filter-select text-white flex items-center justify-between pl-11 pr-4 py-3 rounded-xl transition-all font-medium cursor-pointer min-w-[160px] text-sm" style="background: transparent; border: 2px solid #ffffff; color: #ffffff !important;">
                                    <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" style="color: #ffffff;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                    <span x-text="selectedBeds" style="color: #ffffff !important;"></span>
                                    <svg class="w-4 h-4 transition-transform" :class="bedsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="bedsOpen" x-transition class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl overflow-hidden z-[100]" style="background: #0D1B36;">
                                    <button @click="selectedBeds = '1 Bed'; bedsOpen = false" class="w-full px-4 py-2.5 text-left hover:bg-opacity-80 transition-colors text-sm" style="color: #ffffff; background: #0D1B36;">1 Bed</button>
                                    <button @click="selectedBeds = '2 Beds'; bedsOpen = false" class="w-full px-4 py-2.5 text-left hover:bg-opacity-80 transition-colors text-sm" style="color: #ffffff; background: #0D1B36;">2 Beds</button>
                                    <button @click="selectedBeds = '3 Beds'; bedsOpen = false" class="w-full px-4 py-2.5 text-left hover:bg-opacity-80 transition-colors text-sm" style="color: #ffffff; background: #0D1B36;">3 Beds</button>
                                    <button @click="selectedBeds = '4+ Beds'; bedsOpen = false" class="w-full px-4 py-2.5 text-left hover:bg-opacity-80 transition-colors text-sm" style="color: #ffffff; background: #0D1B36;">4+ Beds</button>
                                </div>
                            </div>

                            <button class="px-8 py-3 font-semibold rounded-xl transition-all hover:shadow-xl hover:scale-105 flex items-center gap-2 text-sm" style="background-color: {{ $theme['secondary_color'] }}; color: {{ $theme['secondary_text'] }};">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span>Search</span>
                            </button>
                        </div>
                    </div>

                    <div class="md:hidden bg-white rounded-3xl shadow-2xl p-5">
                        <div class="relative mb-3">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" placeholder="Search properties, location..." class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 font-medium text-sm placeholder-white" style="background: transparent; border-color: rgba(255, 255, 255, 0.5);">
                        </div>
                        <button class="w-full px-6 py-3 font-semibold rounded-xl transition-all hover:shadow-lg flex items-center justify-center gap-2 text-sm" style="background-color: {{ $theme['secondary_color'] }}; color: {{ $theme['secondary_text'] }};">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Search</span>
                        </button>
                    </div>

                    <div class="text-center mt-6 mb-16 md:mb-0 relative z-10">
                        <button class="inline-flex items-center gap-2 px-8 py-3 bg-white bg-opacity-20 backdrop-blur-md text-white font-semibold rounded-full hover:bg-opacity-30 transition-all border-2 border-white border-opacity-40 hover:border-opacity-60 shadow-xl text-sm">
                            <span style="color: #ffffff;">Explore Properties</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            @if($banners->count() > 1)
            <button id="prev-slide" class="hidden md:block absolute left-4 md:left-6 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-md text-white rounded-full p-3 shadow-lg transition-all z-30 border border-white border-opacity-30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button id="next-slide" class="hidden md:block absolute right-4 md:right-6 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-md text-white rounded-full p-3 shadow-lg transition-all z-30 border border-white border-opacity-30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-3 z-30">
                <div class="flex space-x-2">
                    @foreach($banners as $index => $banner)
                    <button class="banner-dot w-2.5 h-2.5 rounded-full transition-all @if($index === 0) bg-white w-8 @else bg-white bg-opacity-40 @endif" data-slide="{{ $index }}" style="@if($index === 0) background-color: #ffffff; @else background-color: rgba(255, 255, 255, 0.4); @endif"></button>
                    @endforeach
                </div>
                <div class="bg-white bg-opacity-20 backdrop-blur-md px-3 py-1 rounded-full border border-white border-opacity-30">
                    <span class="text-white text-xs font-medium" style="color: #ffffff;">
                        <span id="current-slide-number" style="color: #ffffff;">1</span> / <span id="total-slides" style="color: #ffffff;">{{ $banners->count() }}</span>
                    </span>
                </div>
            </div>
            @endif
            
        </div>
    </div>

    @push('styles')
    <style>
        .property-type-tab {
            background-color: #f9fafb;
            color: #6b7280;
            border: 2px solid transparent;
        }
        .property-type-tab:hover {
            background-color: #f3f4f6;
            border-color: #e5e7eb;
        }
        .property-type-tab.active {
            background-color: {{ $theme['secondary_color'] }};
            color: {{ $theme['secondary_text'] }};
            border-color: {{ $theme['secondary_color'] }};
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .property-type-tab.active svg {
            color: {{ $theme['secondary_text'] }};
            stroke: {{ $theme['secondary_text'] }};
        }
        
        /* White placeholder text for filter inputs */
        .filter-input::placeholder,
        .filter-select::placeholder {
            color: #ffffff !important;
            opacity: 0.9 !important;
        }
        
        /* White placeholder for mobile search */
        .placeholder-white::placeholder {
            color: #ffffff !important;
            opacity: 1 !important;
        }
        
        /* White text for filter inputs and selects */
        .filter-input,
        .filter-select {
            color: #ffffff !important;
        }
        
        /* White color for select dropdown arrow */
        .filter-select {
            background-image: none !important;
        }
        
        /* Ensure icons stay white */
        .filter-input + svg,
        .filter-select + svg {
            color: #ffffff !important;
            stroke: #ffffff !important;
        }
        
        /* Smooth transitions for Alpine.js dropdowns */
        [x-cloak] {
            display: none !important;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        (function() {
            const slides = document.querySelectorAll('.banner-slide');
            const dots = document.querySelectorAll('.banner-dot');
            const prevBtn = document.getElementById('prev-slide');
            const nextBtn = document.getElementById('next-slide');
            const currentSlideNumber = document.getElementById('current-slide-number');
            
            let currentSlide = 0;
            const totalSlides = slides.length;
            let autoPlayInterval;

            if (totalSlides > 1) {
                function showSlide(index) {
                    slides.forEach(function(slide) {
                        slide.classList.remove('opacity-100');
                        slide.classList.add('opacity-0');
                    });
                    
                    dots.forEach(function(dot) {
                        dot.classList.remove('bg-white', 'w-8');
                        dot.classList.add('bg-opacity-50');
                    });

                    slides[index].classList.remove('opacity-0');
                    slides[index].classList.add('opacity-100');
                    
                    dots[index].classList.remove('bg-opacity-50');
                    dots[index].classList.add('bg-white', 'w-8');
                    
                    currentSlide = index;
                    
                    if (currentSlideNumber) {
                        currentSlideNumber.textContent = index + 1;
                    }
                }

                function nextSlide() {
                    const next = (currentSlide + 1) % totalSlides;
                    showSlide(next);
                }

                function prevSlide() {
                    const prev = (currentSlide - 1 + totalSlides) % totalSlides;
                    showSlide(prev);
                }

                function startAutoPlay() {
                    autoPlayInterval = setInterval(nextSlide, 5000);
                }

                function stopAutoPlay() {
                    clearInterval(autoPlayInterval);
                }

                if (prevBtn && nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        nextSlide();
                        stopAutoPlay();
                        startAutoPlay();
                    });

                    prevBtn.addEventListener('click', function() {
                        prevSlide();
                        stopAutoPlay();
                        startAutoPlay();
                    });
                }

                dots.forEach(function(dot, index) {
                    dot.addEventListener('click', function() {
                        showSlide(index);
                        stopAutoPlay();
                        startAutoPlay();
                    });
                });

                const slider = document.getElementById('banner-slider');
                if (slider) {
                    slider.addEventListener('mouseenter', stopAutoPlay);
                    slider.addEventListener('mouseleave', startAutoPlay);
                }

                startAutoPlay();
            }

            const tabs = document.querySelectorAll('.property-type-tab');
            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    tabs.forEach(function(t) {
                        t.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        })();
    </script>
    @endpush
    @else
    <div class="m-1 sm:m-2">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20 rounded-2xl">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-5xl font-bold mb-4">Welcome to Area24 Realty</h1>
                <p class="text-xl">Find your dream property with us.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Simple Full Width Banner (Desktop Only) -->
    <div class="hidden md:block max-w-7xl mx-auto" >
        <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%204%20(1).png?updatedAt=1772102188416" alt="Area24 Realty Banner" class="w-full h-auto object-cover" style="max-width: 100%;">
    </div>
     <!-- Simple Full Width Banner (Desktop Only) -->
    <div class="hidden md:block max-w-7xl mx-auto px-4">
        <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%205%20(1).png?updatedAt=1772102188285" alt="Area24 Realty Banner" class="w-full h-auto object-cover rounded-xl" style="max-width: 100%;">
    </div>

    <!-- Mobile Only Slider -->
    <div class="md:hidden w-full p-1" style="max-width: 100%;">
        <div class="relative w-full overflow-hidden rounded-xl">
            <div id="mobile-slider" class="relative w-full">
                <div class="mobile-slide w-full transition-opacity duration-700 opacity-100" data-slide="0">
                    <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/Your%20paragraph%20text%20(2)%20mob.png?updatedAt=1771934883739" alt="Slide 1" class="w-full h-auto object-cover rounded-xl" style="max-width: 100%;">
                </div>
                <div class="mobile-slide w-full transition-opacity duration-700 opacity-0 absolute top-0 left-0" data-slide="1">
                    <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/Get%20Started%20(2)%20mob.png?updatedAt=1771934883551" alt="Slide 2" class="w-full h-auto object-cover rounded-xl" style="max-width: 100%;">
                </div>
            </div>

            <!-- Dots Indicator -->
            <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-2 z-10">
                <button class="mobile-dot w-2 h-2 rounded-full bg-white transition-all" data-slide="0"></button>
                <button class="mobile-dot w-2 h-2 rounded-full bg-white bg-opacity-40 transition-all" data-slide="1"></button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Mobile slider
        (function() {
            const mobileSlides = document.querySelectorAll('.mobile-slide');
            const mobileDots = document.querySelectorAll('.mobile-dot');
            
            if (mobileSlides.length > 0) {
                let currentMobileSlide = 0;
                const totalMobileSlides = mobileSlides.length;
                let mobileAutoPlayInterval;

                function showMobileSlide(index) {
                    mobileSlides.forEach(function(slide) {
                        slide.classList.remove('opacity-100');
                        slide.classList.add('opacity-0');
                    });
                    
                    mobileDots.forEach(function(dot) {
                        dot.classList.remove('bg-white');
                        dot.classList.add('bg-opacity-40');
                    });

                    mobileSlides[index].classList.remove('opacity-0');
                    mobileSlides[index].classList.add('opacity-100');
                    
                    mobileDots[index].classList.remove('bg-opacity-40');
                    mobileDots[index].classList.add('bg-white');
                    
                    currentMobileSlide = index;
                }

                function nextMobileSlide() {
                    const next = (currentMobileSlide + 1) % totalMobileSlides;
                    showMobileSlide(next);
                }

                function startMobileAutoPlay() {
                    mobileAutoPlayInterval = setInterval(nextMobileSlide, 5000);
                }

                function stopMobileAutoPlay() {
                    clearInterval(mobileAutoPlayInterval);
                }

                mobileDots.forEach(function(dot, index) {
                    dot.addEventListener('click', function() {
                        showMobileSlide(index);
                        stopMobileAutoPlay();
                        startMobileAutoPlay();
                    });
                });

                startMobileAutoPlay();
            }
        })();
    </script>
    @endpush

    <!-- Explore New Properties Section - Updated {{ now() }} -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="mb-8">
            <h2 class="text-3xl md:text-4xl font-bold mb-2" style="color: {{ $theme['primary_color'] }};">Explore New Properties</h2>
            <p class="text-gray-600">Discover premium properties in Karnataka's top locations</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
            @foreach($properties as $property)
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col">
                <!-- Image Slider with Alpine.js -->
                <!-- Property Image Slider -->
                <a href="{{ route('property.show', $property->slug) }}" class="relative h-48 md:h-56 overflow-hidden flex-shrink-0 block" x-data="{ currentSlide: 0, totalSlides: {{ count($property->images ?? []) > 0 ? count($property->images) : 1 }} }">
                    @if(count($property->images ?? []) > 0)
                        <!-- Image Slides -->
                        @foreach($property->images as $index => $image)
                        <div x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                            <img src="{{ $image }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        @endforeach

                        <!-- Navigation Arrows (only if multiple images) -->
                        @if(count($property->images) > 1)
                        <button @click="currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full p-1.5 transition-all z-10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full p-1.5 transition-all z-10">
                            </button>

                        <!-- Dots Indicator -->
                        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                            @foreach($property->images as $index => $image)
                            <button @click="currentSlide = {{ $index }}" class="w-1.5 h-1.5 rounded-full transition-all" :class="currentSlide === {{ $index }} ? 'bg-white w-4' : 'bg-white/50'"></button>
                            @endforeach
                        </div>
                        @endif
                    @else
                        <img src="https://via.placeholder.com/400x300" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @endif
                    
                    <!-- Status & Delivery Badges -->
                    <div class="absolute top-3 left-3 flex flex-col gap-2 z-10">
                        @if($property->possession_status === 'ready-to-move')
                        <span class="px-3 py-1 rounded-md text-xs font-semibold" style="background-color: rgba(0, 0, 0, 0.5); color: #ffffff;">Ready to Move</span>
                        @elseif($property->possession_status === 'under-construction')
                        <span class="px-3 py-1 rounded-md text-xs font-semibold" style="background-color: rgba(0, 0, 0, 0.5); color: #ffffff;">Under Construction</span>
                        @else
                        <span class="px-3 py-1 rounded-md text-xs font-semibold" style="background-color: rgba(0, 0, 0, 0.5); color: #ffffff;">{{ ucwords(str_replace('-', ' ', $property->possession_status)) }}</span>
                        @endif
                        
                        @if($property->possession_date)
                        <span class="px-3 py-1 rounded-md text-xs font-semibold" style="background-color: rgba(0, 0, 0, 0.5); color: #ffffff;">Delivery: {{ $property->possession_date->format('M Y') }}</span>
                        @endif
                    </div>

                    <!-- Builder Logo (if available) -->
                    @if($property->builder)
                    <div class="absolute bottom-3 left-3 bg-white px-3 py-1 rounded-lg shadow-md z-10">
                        <span class="text-xs font-bold text-gray-800">{{ $property->builder->company_name }}</span>
                    </div>
                    @endif
                </a>

                <!-- Property Details -->
                <div class="p-4 flex flex-col flex-grow">
                    <!-- Title -->
                    <a href="{{ route('property.show', $property->slug) }}" class="text-lg md:text-xl font-bold mb-1 text-gray-900 hover:underline">{{ $property->title }}</a>
                    
                    <!-- Location -->
                    <p class="text-xs md:text-sm text-gray-600 mb-3 flex items-center gap-1">
                        <svg class="w-3 h-3 md:w-4 md:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="truncate">{{ $property->locality }}, {{ $property->city->name }}</span>
                    </p>

                    <!-- Property Type & Bedrooms -->
                    <div class="flex items-center gap-2 mb-3 text-xs md:text-sm text-gray-700">
                        @if($property->bedrooms)
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3 md:w-4 md:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            {{ $property->bedrooms }} Bed{{ $property->bedrooms > 1 ? 's' : '' }}
                        </span>
                        @endif
                        <span class="text-gray-400">|</span>
                        <span class="capitalize">{{ ucfirst($property->property_type) }}</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">Launch price:</p>
                        <p class="text-xl md:text-2xl font-bold" style="color: {{ $theme['primary_color'] }};">{{ $property->formatted_price }}</p>
                    </div>

                    <!-- Payment Plans Badge (if applicable) -->
                    @if($property->type === 'sale' && $property->possession_status === 'under-construction')
                    <div class="mb-3">
                        <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-semibold">Payment Plans Available</span>
                    </div>
                    @endif

                    <!-- Spacer to push buttons to bottom -->
                    <div class="flex-grow"></div>

                    <!-- Action Buttons - View Details & WhatsApp -->
                    <div class="flex items-center gap-2 mt-auto">
                        <a href="{{ route('property.show', $property->slug) }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 md:py-3 rounded-xl font-semibold transition-all hover:shadow-lg text-sm md:text-base border-2" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                            <span>View Details</span>
                        </a>
                        <a href="https://wa.me/919876543210?text=I'm interested in {{ $property->title }}" target="_blank" class="flex items-center justify-center p-2.5 md:p-3 rounded-xl transition-all hover:shadow-lg" style="background-color: {{ $theme['secondary_color'] }}; color: {{ $theme['secondary_text'] }};" title="Contact via WhatsApp">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- See New Projects Button -->
        <div class="mt-8 text-center">
            <a href="#" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl font-semibold text-lg transition-all hover:shadow-xl hover:scale-105" style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                <span>See New Projects</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Market Insights & Charts Section - Professional UI -->
    <div class="relative bg-gradient-to-br from-slate-50 via-gray-50 to-slate-100 py-8 md:py-12 overflow-hidden">
        <!-- Background Image with Fixed Position -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://ik.imagekit.io/area24onestorage/Realty%20banners/m2.png?updatedAt=1772104790827'); background-size: cover; background-position: center; background-attachment: fixed;"></div>
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 2px 2px, {{ $theme['primary_color'] }} 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Section Header with Stats -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-4" style="background-color: {{ $theme['primary_color'] }}15;">
                    <svg class="w-4 h-4" style="color: {{ $theme['primary_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="text-xs font-semibold" style="color: {{ $theme['primary_color'] }};">MARKET INTELLIGENCE</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold mb-2 text-gray-900">India Real Estate Market Insights 2025</h2>
                <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto">Real-time data analytics and market trends to empower your property investment decisions</p>
            </div>

            <!-- Charts Grid - 4 Columns with Enhanced Design -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-6">
                <!-- Chart 1: City-wise Average Prices -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-4 border-b border-gray-100" style="background: linear-gradient(135deg, {{ $theme['primary_color'] }}08 0%, transparent 100%);">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg" style="background-color: {{ $theme['primary_color'] }}; box-shadow: 0 4px 12px {{ $theme['primary_color'] }}40;">
                                    <svg class="w-4 h-4" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-900">City Prices</h3>
                                    <p class="text-xs text-gray-500">₹/Sq Ft</p>
                                </div>
                            </div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="h-40 md:h-44">
                            <canvas id="cityPricesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart 2: Price Growth Rate -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-4 border-b border-gray-100" style="background: linear-gradient(135deg, {{ $theme['primary_color'] }}08 0%, transparent 100%);">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg" style="background-color: {{ $theme['primary_color'] }}; box-shadow: 0 4px 12px {{ $theme['primary_color'] }}40;">
                                    <svg class="w-4 h-4" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-900">Growth Rate</h3>
                                    <p class="text-xs text-gray-500">2024-25</p>
                                </div>
                            </div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="h-40 md:h-44">
                            <canvas id="priceGrowthChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart 3: Housing Sales Trend -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-4 border-b border-gray-100" style="background: linear-gradient(135deg, {{ $theme['secondary_color'] }}08 0%, transparent 100%);">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg" style="background-color: {{ $theme['secondary_color'] }}; box-shadow: 0 4px 12px {{ $theme['secondary_color'] }}40;">
                                    <svg class="w-4 h-4" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-900">Sales Volume</h3>
                                    <p class="text-xs text-gray-500">Top 8 Cities</p>
                                </div>
                            </div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="h-40 md:h-44">
                            <canvas id="salesTrendChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart 4: Market Share -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-4 border-b border-gray-100" style="background: linear-gradient(135deg, {{ $theme['secondary_color'] }}08 0%, transparent 100%);">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg" style="background-color: {{ $theme['secondary_color'] }}; box-shadow: 0 4px 12px {{ $theme['secondary_color'] }}40;">
                                    <svg class="w-4 h-4" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-900">Market Share</h3>
                                    <p class="text-xs text-gray-500">By Segment</p>
                                </div>
                            </div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="h-40 md:h-44">
                            <canvas id="marketShareChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Insights Cards - Enhanced Design -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <!-- Top Growth City -->
                <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-4 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-5" style="background: radial-gradient(circle, {{ $theme['primary_color'] }} 0%, transparent 70%);"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div class="p-2.5 rounded-xl" style="background: linear-gradient(135deg, {{ $theme['primary_color'] }} 0%, {{ $theme['primary_color'] }}dd 100%); box-shadow: 0 4px 14px {{ $theme['primary_color'] }}40;">
                                <svg class="w-5 h-5" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold" style="color: {{ $theme['primary_color'] }}; background-color: {{ $theme['primary_color'] }}15;">+21%</span>
                        </div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Top Growth City</h4>
                        <p class="text-2xl font-bold mb-1" style="color: {{ $theme['primary_color'] }};">Bengaluru</p>
                        <p class="text-xs text-gray-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Highest appreciation in 2024-25
                        </p>
                    </div>
                </div>

                <!-- Total Sales -->
                <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-4 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-5" style="background: radial-gradient(circle, {{ $theme['secondary_color'] }} 0%, transparent 70%);"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div class="p-2.5 rounded-xl" style="background-color: {{ $theme['secondary_color'] }}; box-shadow: 0 4px 14px {{ $theme['secondary_color'] }}40;">
                                <svg class="w-5 h-5" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold" style="color: {{ $theme['secondary_color'] }}; background-color: {{ $theme['secondary_color'] }}15;">+11%</span>
                        </div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Sales 2025</h4>
                        <p class="text-2xl font-bold mb-1" style="color: {{ $theme['secondary_color'] }};">3.86L Units</p>
                        <p class="text-xs text-gray-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Steady growth from 2024
                        </p>
                    </div>
                </div>

                <!-- Market Leader -->
                <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-4 border border-gray-100 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-5" style="background: radial-gradient(circle, {{ $theme['primary_color'] }} 0%, transparent 70%);"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div class="p-2.5 rounded-xl" style="background-color: {{ $theme['primary_color'] }}; box-shadow: 0 4px 14px {{ $theme['primary_color'] }}40;">
                                <svg class="w-5 h-5" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 10l2 2m0 0l2-2m-2 2v6m9-6a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold" style="color: {{ $theme['primary_color'] }}; background-color: {{ $theme['primary_color'] }}15;">41%</span>
                        </div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Market Leader</h4>
                        <p class="text-2xl font-bold mb-1" style="color: {{ $theme['primary_color'] }};">Mid-Segment</p>
                        <p class="text-xs text-gray-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            ₹50L - ₹1Cr price range
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Chart.js Configuration
        const primaryColor = '{{ $theme["primary_color"] }}';
        const secondaryColor = '{{ $theme["secondary_color"] }}';

        // Chart 1: City-wise Average Prices
        const cityPricesCtx = document.getElementById('cityPricesChart').getContext('2d');
        new Chart(cityPricesCtx, {
            type: 'bar',
            data: {
                labels: ['Mumbai', 'Bengaluru', 'Delhi NCR', 'Hyderabad', 'Pune', 'Chennai', 'Kolkata', 'Ahmedabad'],
                datasets: [{
                    label: '2025 (₹/Sq Ft)',
                    data: [12800, 7900, 8100, 7400, 7100, 7200, 5840, 4730],
                    backgroundColor: primaryColor + '90',
                    borderColor: primaryColor,
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₹' + context.parsed.y.toLocaleString() + '/Sq Ft';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₹' + (value/1000) + 'K';
                            }
                        }
                    }
                }
            }
        });

        // Chart 2: Price Growth Rate
        const priceGrowthCtx = document.getElementById('priceGrowthChart').getContext('2d');
        new Chart(priceGrowthCtx, {
            type: 'bar',
            data: {
                labels: ['Bengaluru', 'Delhi NCR', 'Hyderabad', 'Pune', 'Mumbai', 'Chennai'],
                datasets: [{
                    label: 'Growth %',
                    data: [21, 19, 13, 9, 6, 4],
                    backgroundColor: [
                        '#10b981', '#22c55e', '#84cc16', '#eab308', '#f59e0b', '#f97316'
                    ],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.x + '% Growth';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });

        // Chart 3: Housing Sales Trend
        const salesTrendCtx = document.getElementById('salesTrendChart').getContext('2d');
        new Chart(salesTrendCtx, {
            type: 'line',
            data: {
                labels: ['2023', '2024', '2025'],
                datasets: [{
                    label: 'Units Sold (Lakhs)',
                    data: [3.10, 3.48, 3.86],
                    borderColor: primaryColor,
                    backgroundColor: primaryColor + '20',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: primaryColor,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Lakh Units';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + 'L';
                            }
                        }
                    }
                }
            }
        });

        // Chart 4: Market Share by Price Segment
        const marketShareCtx = document.getElementById('marketShareChart').getContext('2d');
        new Chart(marketShareCtx, {
            type: 'doughnut',
            data: {
                labels: ['Affordable (< ₹50L)', 'Mid Segment (₹50L-₹1Cr)', 'Premium (₹1Cr-₹2Cr)', 'Luxury (> ₹2Cr)'],
                datasets: [{
                    data: [28, 41, 21, 10],
                    backgroundColor: [
                        '#3b82f6',
                        primaryColor,
                        secondaryColor,
                        '#8b5cf6'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: { size: 11 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
    @endpush

    <!-- Features Section - Grid for Desktop, Slider for Mobile -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="mb-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-2" style="color: {{ $theme['primary_color'] }};">Why Choose Area24 Realty</h2>
            <p class="text-gray-600">Your trusted partner in finding the perfect property</p>
        </div>

        <!-- Desktop Grid View -->
        <div class="hidden md:grid md:grid-cols-3 gap-6">
            <!-- Feature 1 - Search Property Using Map -->
            <div class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/vector%203%20(1).png?updatedAt=1772192001896" alt="Search Property Using Map" class="w-full h-auto object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-6">
                    <div class="text-white">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold drop-shadow-lg" style="color: #ffffff;">Interactive Map Search</h3>
                        </div>
                        <p class="text-sm drop-shadow-md" style="color: rgba(255, 255, 255, 0.9);">Explore properties with our advanced map-based search. Find your dream home by location, amenities, and more.</p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 - Property Worth -->
            <div class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/vector%201%20(1).png?updatedAt=1772192001800" alt="Property Worth" class="w-full h-auto object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-6">
                    <div class="text-white">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold drop-shadow-lg" style="color: #ffffff;">Know Your Property Worth</h3>
                        </div>
                        <p class="text-sm drop-shadow-md" style="color: rgba(255, 255, 255, 0.9);">Get accurate property valuations with our AI-powered tools. Make informed decisions with real-time market insights.</p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 - Find Property Nearby -->
            <div class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/vector%202%20(1).png?updatedAt=1772192001402" alt="Find Property Nearby" class="w-full h-auto object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-6">
                    <div class="text-white">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold drop-shadow-lg" style="color: #ffffff;">Discover Nearby Properties</h3>
                        </div>
                        <p class="text-sm drop-shadow-md" style="color: rgba(255, 255, 255, 0.9);">Find properties near you with our location-based search. Explore neighborhoods and local amenities effortlessly.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Slider -->
        <div class="md:hidden">
            <div class="relative overflow-visible">
                <div id="features-slider" class="relative">
                    <!-- Slide 1 -->
                    <div class="feature-slide transition-opacity duration-700 opacity-100" data-slide="0">
                        <div class="relative rounded-2xl overflow-hidden shadow-lg">
                            <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/vector%203%20(1).png?updatedAt=1772192001896" alt="Search Property Using Map" class="w-full h-auto object-contain">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-4">
                                <div class="text-white">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold drop-shadow-lg" style="color: #ffffff;">Interactive Map Search</h3>
                                    </div>
                                    <p class="text-xs drop-shadow-md" style="color: rgba(255, 255, 255, 0.9);">Explore properties with our advanced map-based search.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="feature-slide absolute top-0 left-0 w-full transition-opacity duration-700 opacity-0" data-slide="1">
                        <div class="relative rounded-2xl overflow-hidden shadow-lg">
                            <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/vector%201%20(1).png?updatedAt=1772192001800" alt="Property Worth" class="w-full h-auto object-contain">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-4">
                                <div class="text-white">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold drop-shadow-lg" style="color: #ffffff;">Know Your Property Worth</h3>
                                    </div>
                                    <p class="text-xs drop-shadow-md" style="color: rgba(255, 255, 255, 0.9);">Get accurate property valuations with our AI-powered tools.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="feature-slide absolute top-0 left-0 w-full transition-opacity duration-700 opacity-0" data-slide="2">
                        <div class="relative rounded-2xl overflow-hidden shadow-lg">
                            <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/vector%202%20(1).png?updatedAt=1772192001402" alt="Find Property Nearby" class="w-full h-auto object-contain">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-4">
                                <div class="text-white">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold drop-shadow-lg" style="color: #ffffff;">Discover Nearby Properties</h3>
                                    </div>
                                    <p class="text-xs drop-shadow-md" style="color: rgba(255, 255, 255, 0.9);">Find properties near you with our location-based search.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dots Indicator -->
                <div class="flex justify-center gap-2 mt-4">
                    <button class="feature-dot w-2 h-2 rounded-full transition-all" data-slide="0" style="background-color: {{ $theme['primary_color'] }};"></button>
                    <button class="feature-dot w-2 h-2 rounded-full bg-gray-300 transition-all" data-slide="1"></button>
                    <button class="feature-dot w-2 h-2 rounded-full bg-gray-300 transition-all" data-slide="2"></button>
                </div>
            </div>
        </div>

        <!-- CTA Button -->
        <div class="mt-8 text-center">
            <a href="#" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl font-semibold text-lg transition-all hover:shadow-xl hover:scale-105" style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                <span>Get Started Today</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffffff; stroke: #ffffff;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>

     <!-- Preferred Agents Section - Ultra Compact with Expand/Collapse -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold" style="color: {{ $theme['primary_color'] }};">Preferred Agents in Bangalore</h2>
                <p class="text-xs text-gray-600">Trusted real estate professionals ready to help you</p>
            </div>
            <a href="#" class="hidden md:flex items-center gap-1 text-sm font-semibold hover:underline" style="color: {{ $theme['primary_color'] }};">
                <span>See all</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <!-- Agents Grid - Ultra Compact Cards -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
            @foreach($agents as $agent)
            <div class="agent-card bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 p-3 border border-gray-100 cursor-pointer" data-agent-id="{{ $agent->id }}">
                <!-- Compact View (Always Visible) -->
                <div class="agent-compact">
                    <!-- Agent Profile -->
                    <div class="flex flex-col items-center text-center mb-2">
                        <div class="relative mb-2">
                            @if($agent->profile_image)
                            <img src="{{ $agent->profile_image }}" alt="{{ $agent->name }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                            <div class="w-12 h-12 rounded-full flex items-center justify-center text-white text-sm font-bold" style="background-color: {{ $theme['primary_color'] }};">
                                {{ strtoupper(substr($agent->name, 0, 2)) }}
                            </div>
                            @endif
                            <!-- Verified Badge -->
                            <div class="absolute -bottom-0.5 -right-0.5 bg-green-500 rounded-full p-0.5">
                                <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-sm font-bold text-gray-900 line-clamp-1 mb-1">{{ $agent->name }}</h3>
                        <p class="text-xs text-gray-500">Since {{ $agent->operating_since }}</p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="flex items-center justify-between text-center pt-2 border-t border-gray-100">
                        <div>
                            <p class="text-base font-bold" style="color: {{ $theme['primary_color'] }};">{{ $agent->properties_sold }}</p>
                            <p class="text-xs text-gray-500">Sale</p>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div>
                            <p class="text-base font-bold" style="color: {{ $theme['primary_color'] }};">{{ $agent->properties_rented }}</p>
                            <p class="text-xs text-gray-500">Rent</p>
                        </div>
                    </div>

                    <!-- Expand Indicator -->
                    <div class="flex justify-center mt-2">
                        <svg class="expand-icon w-4 h-4 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Expanded View (Hidden by default) -->
                <div class="agent-expanded hidden mt-3 pt-3 border-t border-gray-200">
                    <div class="space-y-2">
                        <div class="bg-green-50 rounded-lg p-2">
                            <p class="text-xs font-semibold text-green-700 text-center">
                                Buyers Served {{ $agent->buyers_served }}+
                            </p>
                        </div>
                        <div class="text-xs text-gray-600 space-y-1">
                            <p><span class="font-semibold">Properties for Sale:</span> {{ $agent->properties_sold }}</p>
                            <p><span class="font-semibold">Properties for Rent:</span> {{ $agent->properties_rented }}</p>
                        </div>
                        <button class="w-full px-3 py-2 rounded-lg text-xs font-semibold transition-all hover:shadow-md" style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                            Contact Agent
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- See All Button for Mobile -->
        <div class="mt-4 text-center md:hidden">
            <a href="#" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg font-semibold transition-all hover:shadow-lg text-sm" style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                <span>See all</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>

    @push('scripts')
    <script>
        // Agent card expand/collapse functionality
        (function() {
            const agentCards = document.querySelectorAll('.agent-card');
            
            agentCards.forEach(function(card) {
                card.addEventListener('click', function(e) {
                    // Don't toggle if clicking on a button
                    if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                        return;
                    }
                    
                    const expandedSection = card.querySelector('.agent-expanded');
                    const expandIcon = card.querySelector('.expand-icon');
                    const isExpanded = !expandedSection.classList.contains('hidden');
                    
                    // Close all other cards first
                    agentCards.forEach(function(otherCard) {
                        if (otherCard !== card) {
                            const otherExpanded = otherCard.querySelector('.agent-expanded');
                            const otherIcon = otherCard.querySelector('.expand-icon');
                            otherExpanded.classList.add('hidden');
                            otherIcon.style.transform = 'rotate(0deg)';
                        }
                    });
                    
                    // Toggle current card
                    if (isExpanded) {
                        expandedSection.classList.add('hidden');
                        expandIcon.style.transform = 'rotate(0deg)';
                    } else {
                        expandedSection.classList.remove('hidden');
                        expandIcon.style.transform = 'rotate(180deg)';
                    }
                });
            });
        })();
    </script>
    @endpush

    <!-- Collections Sections - Premium Compact Design -->
    @if($collections->count() > 0)
        @foreach($collections as $collectionIndex => $collection)
        @php
            $items = $collection->getItems();
        @endphp
        
        @if($items->count() > 0)
        <!-- Collection Section with Theme-based Background -->
        <div class="py-8 {{ $collectionIndex % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}" x-data="{ isReady: true }" x-cloak>
            <div class="max-w-7xl mx-auto px-4">
                <!-- Collection Header - Compact & Premium -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <!-- Decorative Line -->
                        <div class="w-1 h-8 rounded-full" style="background-color: {{ $theme['primary_color'] }};"></div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-bold" style="color: {{ $theme['primary_color'] }};">{{ $collection->name }}</h2>
                            @if($collection->description)
                            <p class="text-xs text-gray-500 mt-0.5">{{ Str::limit($collection->description, 60) }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Off-Plan/Ready Toggle - Custom Switch (Hidden for Ready to Move Properties) -->
                        @if(strtolower($collection->name) !== 'ready to move properties')
                        <div class="flex items-center gap-2 px-2.5 py-1 bg-white rounded-lg shadow-sm border border-gray-200">
                            <span class="text-xs font-medium transition-colors duration-300" :class="!isReady ? 'text-gray-900' : 'text-gray-500'">Off-Plan</span>
                            <label class="custom-switch">
                                <input type="checkbox" x-model="isReady">
                                <span class="custom-slider">
                                    <svg class="slider-icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation">
                                        <path fill="none" d="m4 16.5 8 8 16-16"></path>
                                    </svg>
                                </span>
                            </label>
                            <span class="text-xs font-medium transition-colors duration-300" :class="isReady ? 'text-gray-900' : 'text-gray-500'">Ready</span>
                        </div>
                        @endif
                        <!-- View All Button -->
                        <a href="{{ route('collection.show', $collection->slug) }}" class="flex items-center gap-1 px-4 py-2 rounded-lg text-xs font-semibold transition-all hover:shadow-md" style="background-color: {{ $theme['primary_color'] }}10; color: {{ $theme['primary_color'] }};">
                            <span class="hidden sm:inline">View All</span>
                            <span class="sm:hidden">All</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Property Cards - Compact Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach($items->take(4) as $item)
                    @php
                        // Determine item status for filtering
                        $itemStatus = '';
                        if (isset($item->possession_status)) {
                            // Property
                            $itemStatus = $item->possession_status;
                        } elseif (isset($item->status)) {
                            // Project
                            $itemStatus = $item->status;
                        }
                        
                        // Determine if item is off-plan or ready
                        $isOffPlan = in_array($itemStatus, ['under-construction', 'upcoming']);
                        $isReady = in_array($itemStatus, ['ready-to-move', 'completed']);
                        
                        // Check if this is "Ready to Move Properties" collection (no toggle)
                        $isReadyCollection = strtolower($collection->name) === 'ready to move properties';
                    @endphp
                    <div class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100"
                         @if(!$isReadyCollection)
                         x-show="(isReady && {{ $isReady ? 'true' : 'false' }}) || (!isReady && {{ $isOffPlan ? 'true' : 'false' }})"
                         style="display: none;"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @endif>
                        <!-- Image Container - Compact Height -->
                        <a href="@if(isset($item->possession_status)){{ route('property.show', $item->slug) }}@else{{ route('project.show', $item->slug) }}@endif" class="relative h-48 overflow-hidden block">
                            @if($item->images && count($item->images) > 0)
                            <img src="{{ $item->images[0] }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                            <div class="w-full h-full" style="background: linear-gradient(135deg, {{ $theme['primary_color'] }} 0%, {{ $theme['secondary_color'] }} 100%);"></div>
                            @endif
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            
                            <!-- Top Badges - Compact -->
                            <div class="absolute top-2 left-2 right-2 flex justify-between items-start">
                                @if($itemStatus)
                                <span class="px-2 py-1 rounded-md text-xs font-semibold backdrop-blur-sm" style="background-color: rgba(0, 0, 0, 0.5); color: #ffffff;">
                                    {{ ucwords(str_replace('-', ' ', $itemStatus)) }}
                                </span>
                                @endif
                                @if(isset($item->is_featured) && $item->is_featured)
                                <span class="px-2 py-1 rounded-md text-xs font-semibold" style="background-color: {{ $theme['secondary_color'] }}; color: {{ $theme['secondary_text'] }};">
                                    ★
                                </span>
                                @endif
                            </div>
                            
                            <!-- Price Badge - Bottom Left -->
                            @if(isset($item->price))
                            <div class="absolute bottom-2 left-2">
                                <div class="px-2.5 py-1 rounded-lg backdrop-blur-md" style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                                    <p class="text-sm font-bold">₹{{ number_format($item->price / 10000000, 2) }} Cr</p>
                                </div>
                            </div>
                            @endif
                        </a>
                        
                        <!-- Content - Compact -->
                        <div class="p-3">
                            <a href="@if(isset($item->possession_status)){{ route('property.show', $item->slug) }}@else{{ route('project.show', $item->slug) }}@endif" class="block">
                                <h3 class="text-sm font-bold text-gray-900 line-clamp-1 mb-1 hover:text-blue-600 transition-colors">{{ $item->title }}</h3>
                            </a>
                            
                            @if(isset($item->city))
                            <div class="flex items-center gap-1 mb-2">
                                <svg class="w-3 h-3 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-xs text-gray-500 line-clamp-1">{{ $item->city->name ?? 'Location' }}</span>
                            </div>
                            @endif
                            
                            <!-- WhatsApp Button - Compact -->
                            <a href="https://wa.me/919876543210?text=I'm interested in {{ urlencode($item->title) }}" target="_blank" class="flex items-center justify-center gap-1.5 w-full px-3 py-2 rounded-lg font-semibold transition-all text-xs hover:opacity-90" style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" style="color: #ffffff;">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                                </svg>
                                <span style="color: #ffffff;">WhatsApp</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @endforeach
    @endif

    <!-- Promotional Banner Section -->
    <div class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="rounded-2xl p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-4" style="background: linear-gradient(135deg, {{ $theme['primary_color'] }}15 0%, {{ $theme['secondary_color'] }}15 100%);">
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-2xl md:text-3xl font-bold mb-2" style="color: {{ $theme['primary_color'] }};">
                        Post your Property for <span class="italic">Free</span>
                    </h2>
                    <p class="text-sm md:text-base text-gray-600">
                        List it on {{ config('app.name', 'Area24 Realty') }} and get genuine leads
                    </p>
                </div>
                <div>
                    <button class="px-6 py-3 rounded-xl font-semibold text-sm md:text-base transition-all hover:shadow-lg hover:scale-105 flex items-center gap-2" style="background-color: {{ $theme['secondary_color'] }}; color: {{ $theme['secondary_text'] }};">
                        <span>Post Property</span>
                        <span class="px-2 py-0.5 bg-white/20 rounded text-xs font-bold">FREE</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Searches Section - Professional Design -->
    <div class="relative py-8 md:py-12 overflow-hidden" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
        <!-- Background Image with Fixed Position -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://ik.imagekit.io/area24onestorage/Realty%20banners/m2.png?updatedAt=1772104790827'); background-size: cover; background-position: center; background-attachment: fixed;"></div>
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 2px 2px, {{ $theme['primary_color'] }} 1px, transparent 0); background-size: 32px 32px;"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-4" style="background-color: {{ $theme['primary_color'] }}15;">
                    <svg class="w-4 h-4" style="color: {{ $theme['primary_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="text-xs font-semibold" style="color: {{ $theme['primary_color'] }};">POPULAR SEARCHES</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold mb-2 text-gray-900">Find Your Perfect Property</h2>
                <p class="text-sm md:text-base text-gray-600">Explore properties in top locations and trending searches</p>
            </div>

            <!-- Tabs for Sale/Rent -->
            <div class="flex justify-center gap-3 mb-6" x-data="{ activeTab: 'sale' }">
                <button @click="activeTab = 'sale'" class="px-6 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-md hover:shadow-lg" :class="activeTab === 'sale' ? '' : 'bg-white text-gray-600 hover:bg-gray-50'" x-bind:style="activeTab === 'sale' ? 'background-color: {{ $theme['primary_color'] }}; color: white;' : ''">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        For Sale
                    </span>
                </button>
                <button @click="activeTab = 'rent'" class="px-6 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-md hover:shadow-lg" :class="activeTab === 'rent' ? '' : 'bg-white text-gray-600 hover:bg-gray-50'" x-bind:style="activeTab === 'rent' ? 'background-color: {{ $theme['primary_color'] }}; color: white;' : ''">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        For Rent
                    </span>
                </button>
            </div>

            <!-- Sale Content -->
            <div x-show="activeTab === 'sale'" x-transition class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Properties by Location -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100" x-data="{ expanded: false }">
                    <div class="p-4 border-b border-gray-100" style="background: linear-gradient(135deg, {{ $theme['primary_color'] }}08 0%, transparent 100%);">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg" style="background-color: {{ $theme['primary_color'] }}; box-shadow: 0 4px 12px {{ $theme['primary_color'] }}40;">
                                    <svg class="w-4 h-4" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-900">By Location</h3>
                                    <p class="text-xs text-gray-500">Top Cities</p>
                                </div>
                            </div>
                            <button @click="expanded = !expanded" class="p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4 text-gray-400 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div x-show="expanded" x-collapse class="p-4 space-y-1">
                        @foreach($cities->take(6) as $city)
                        @if($city->sale_count > 0)
                        <a href="/properties?city={{ $city->id }}&type=sale" class="flex items-center justify-between py-1.5 px-2 rounded hover:bg-gray-50 transition-all group">
                            <span class="text-xs text-gray-700 group-hover:text-gray-900 group-hover:font-medium">Properties in {{ $city->name }}</span>
                            <span class="text-xs text-gray-400 font-medium">{{ $city->sale_count }}</span>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- Properties by Type -->
                <div class="bg-white rounded-lg p-4" x-data="{ expanded: false }">
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-100"><div class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <h3 class="text-sm font-bold" style="color: {{ $theme['primary_color'] }};">Properties by Type</h3></div><button @click="expanded = !expanded" class="text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button></div>
                    <div x-show="expanded" x-collapse class="space-y-1">
                        @foreach($propertyTypes->take(6) as $type)
                        @if($type->sale_count > 0)
                        <a href="/properties?type=sale&property_type={{ $type->id }}" class="flex items-center justify-between py-1.5 px-2 rounded hover:bg-gray-50 transition-all group">
                            <span class="text-xs text-gray-700 group-hover:text-gray-900 group-hover:font-medium">{{ $type->name }} for Sale</span>
                            <span class="text-xs text-gray-400 font-medium">{{ $type->sale_count }}</span>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- Trending Searches -->
                <div class="bg-white rounded-lg p-4" x-data="{ expanded: false }">
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-100"><div class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h3 class="text-sm font-bold" style="color: {{ $theme['primary_color'] }};">Trending Searches</h3></div><button @click="expanded = !expanded" class="text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button></div>
                    <div x-show="expanded" x-collapse class="space-y-1">
                        @php
                            $trendingSearches = [
                                ['label' => 'Luxury Apartments', 'url' => '/properties?type=sale&category=luxury'],
                                ['label' => 'Ready to Move', 'url' => '/properties?type=sale&possession=ready'],
                                ['label' => 'New Projects', 'url' => '/projects?status=upcoming'],
                                ['label' => 'Affordable Homes', 'url' => '/properties?type=sale&price_max=5000000'],
                                ['label' => '3 BHK Apartments', 'url' => '/properties?type=sale&bedrooms=3'],
                                ['label' => 'Villas for Sale', 'url' => '/properties?type=sale&property_type=villa'],
                            ];
                        @endphp
                        @foreach($trendingSearches as $search)
                        <a href="{{ $search['url'] }}" class="flex items-center justify-between py-1.5 px-2 rounded hover:bg-gray-50 transition-all group">
                            <span class="text-xs text-gray-700 group-hover:text-gray-900 group-hover:font-medium">{{ $search['label'] }}</span>
                            <svg class="w-3 h-3 text-gray-300 group-hover:text-gray-500 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Rent Content -->
            <div x-show="activeTab === 'rent'" x-transition class="grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-4">
                <!-- Properties by Location -->
                <div class="bg-white rounded-lg p-4" x-data="{ expanded: false }">
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-100"><div class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <h3 class="text-sm font-bold" style="color: {{ $theme['primary_color'] }};">Properties by Location</h3></div><button @click="expanded = !expanded" class="text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button></div>
                    <div x-show="expanded" x-collapse class="space-y-1">
                        @foreach($cities->take(6) as $city)
                        @if($city->rent_count > 0)
                        <a href="/properties?city={{ $city->id }}&type=rent" class="flex items-center justify-between py-1.5 px-2 rounded hover:bg-gray-50 transition-all group">
                            <span class="text-xs text-gray-700 group-hover:text-gray-900 group-hover:font-medium">Properties in {{ $city->name }}</span>
                            <span class="text-xs text-gray-400 font-medium">{{ $city->rent_count }}</span>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- Properties by Type -->
                <div class="bg-white rounded-lg p-4" x-data="{ expanded: false }">
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-100"><div class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <h3 class="text-sm font-bold" style="color: {{ $theme['primary_color'] }};">Properties by Type</h3></div><button @click="expanded = !expanded" class="text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button></div>
                    <div x-show="expanded" x-collapse class="space-y-1">
                        @foreach($propertyTypes->take(6) as $type)
                        @if($type->rent_count > 0)
                        <a href="/properties?type=rent&property_type={{ $type->id }}" class="flex items-center justify-between py-1.5 px-2 rounded hover:bg-gray-50 transition-all group">
                            <span class="text-xs text-gray-700 group-hover:text-gray-900 group-hover:font-medium">{{ $type->name }} for Rent</span>
                            <span class="text-xs text-gray-400 font-medium">{{ $type->rent_count }}</span>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- Trending Searches -->
                <div class="bg-white rounded-lg p-4" x-data="{ expanded: false }">
                    <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-100"><div class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $theme['primary_color'] }};">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h3 class="text-sm font-bold" style="color: {{ $theme['primary_color'] }};">Trending Searches</h3></div><button @click="expanded = !expanded" class="text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button></div>
                    <div x-show="expanded" x-collapse class="space-y-1">
                        @php
                            $trendingRentSearches = [
                                ['label' => 'Furnished Apartments', 'url' => '/properties?type=rent&furnishing=furnished'],
                                ['label' => 'Studio Apartments', 'url' => '/properties?type=rent&bedrooms=1'],
                                ['label' => '2 BHK for Rent', 'url' => '/properties?type=rent&bedrooms=2'],
                                ['label' => '3 BHK for Rent', 'url' => '/properties?type=rent&bedrooms=3'],
                                ['label' => 'Pet Friendly Homes', 'url' => '/properties?type=rent&pet_friendly=yes'],
                                ['label' => 'Villas for Rent', 'url' => '/properties?type=rent&property_type=villa'],
                            ];
                        @endphp
                        @foreach($trendingRentSearches as $search)
                        <a href="{{ $search['url'] }}" class="flex items-center justify-between py-1.5 px-2 rounded hover:bg-gray-50 transition-all group">
                            <span class="text-xs text-gray-700 group-hover:text-gray-900 group-hover:font-medium">{{ $search['label'] }}</span>
                            <svg class="w-3 h-3 text-gray-300 group-hover:text-gray-500 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Image Slider -->
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="relative rounded-2xl overflow-hidden" x-data="{ 
            currentSlide: 0,
            autoplayInterval: null,
            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % 2;
                }, 5000);
            },
            stopAutoplay() {
                if (this.autoplayInterval) {
                    clearInterval(this.autoplayInterval);
                    this.autoplayInterval = null;
                }
            }
        }" x-init="startAutoplay()" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()" style="min-height: 300px;">
            
            <!-- Slide 1: CTA Content -->
            <div x-show="currentSlide === 0" class="absolute inset-0 w-full h-full">
                <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/sample%20banner.png?updatedAt=1772261229620" alt="Banner 1" class="w-full h-full object-cover rounded-2xl">
                
                <!-- CTA Overlay Content - Right Side -->
                <div class="absolute inset-0 flex items-center justify-end px-4 md:px-8 lg:px-16">
                    <div class="text-center max-w-sm">
                        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3 drop-shadow-lg">
                            Find Your Dream Home
                        </h2>
                        <p class="text-sm md:text-base text-white mb-5 drop-shadow-lg">
                            Discover verified properties from trusted builders
                        </p>
                        <div class="flex flex-col gap-3">
                            <a href="/properties" class="px-6 py-2.5 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300" style="background-color: {{ $theme['primary_color'] }}; color: white;">
                                Browse Properties
                            </a>
                            <a href="/projects" class="px-6 py-2.5 rounded-lg font-semibold text-sm bg-white shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300" style="color: {{ $theme['primary_color'] }};">
                                View Projects
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2: Enquiry Form -->
            <div x-show="currentSlide === 1" class="absolute inset-0 w-full h-full">
                <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/sample%20banner%202.png?updatedAt=1772261229717" alt="Banner 2" class="w-full h-full object-cover rounded-2xl">
                
                <!-- Form Overlay Content - Right Side -->
                <div class="absolute inset-0 flex items-center justify-end px-4 md:px-8 lg:px-16">
                    <div class="bg-white bg-opacity-95 backdrop-blur-sm rounded-xl shadow-2xl p-5 md:p-6 w-full max-w-sm">
                        <h3 class="text-xl md:text-2xl font-bold mb-1 text-center" style="color: {{ $theme['primary_color'] }};">Get in Touch</h3>
                        <p class="text-xs md:text-sm text-gray-600 mb-4 text-center">Find your perfect property</p>
                        
                        <form action="/enquiry" method="POST" class="space-y-3">
                            @csrf
                            
                            <!-- Phone Number -->
                            <div>
                                <input type="tel" name="phone" required class="w-full px-3 py-2.5 text-sm border-2 rounded-lg transition-all text-gray-900 focus:outline-none" placeholder="Phone Number" style="border-color: #e5e7eb; focus:border-color: {{ $theme['primary_color'] }}; color: white; background-color: rgba(255, 255, 255, 0.2);" onfocus="this.style.borderColor='{{ $theme['primary_color'] }}'" onblur="this.style.borderColor='#e5e7eb'">
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <input type="email" name="email" required class="w-full px-3 py-2.5 text-sm border-2 rounded-lg transition-all text-gray-900 focus:outline-none" placeholder="Email Address" style="border-color: #e5e7eb; focus:border-color: {{ $theme['primary_color'] }}; color: white; background-color: rgba(255, 255, 255, 0.2);" onfocus="this.style.borderColor='{{ $theme['primary_color'] }}'" onblur="this.style.borderColor='#e5e7eb'">
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="w-full py-2.5 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300" style="background-color: {{ $theme['primary_color'] }}; color: white;">
                                Submit Enquiry
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Spacer to maintain aspect ratio -->
            <img src="https://ik.imagekit.io/area24onestorage/Realty%20banners/sample%20banner.png?updatedAt=1772261229620" alt="" class="w-full h-auto opacity-0 pointer-events-none">
            
            <!-- Navigation Arrows - Icon Only -->
            <button @click="currentSlide = (currentSlide - 1 + 2) % 2; stopAutoplay(); startAutoplay();" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 text-white transition-all duration-300 hover:scale-125 focus:outline-none">
                <svg class="w-8 h-8 md:w-10 md:h-10 drop-shadow-lg" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <!-- Navigation Arrows - Icon Only -->
            <button @click="currentSlide = (currentSlide + 1) % 2; stopAutoplay(); startAutoplay();" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 text-white transition-all duration-300 hover:scale-125 focus:outline-none">
                <svg class="w-8 h-8 md:w-10 md:h-10 drop-shadow-lg" style="color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
            <!-- Navigation Dots -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
                <button @click="currentSlide = 0; stopAutoplay(); startAutoplay();" class="w-3 h-3 rounded-full transition-all duration-300 bg-white drop-shadow-lg" :class="currentSlide === 0 ? 'w-8 opacity-100' : 'opacity-50'"></button>
                <button @click="currentSlide = 1; stopAutoplay(); startAutoplay();" class="w-3 h-3 rounded-full transition-all duration-300 bg-white drop-shadow-lg" :class="currentSlide === 1 ? 'w-8 opacity-100' : 'opacity-50'"></button>
            </div>
        </div>
    </div>
    
    <style>
        /* White placeholder text for form inputs */
        input[type="tel"]::placeholder,
        input[type="email"]::placeholder {
            color: white;
            opacity: 0.9;
        }
    </style>

    {{-- Preferred Builders Section - Hidden for now
    <!-- Preferred Builders Section -->
    <div class="max-w-7xl mx-auto px-4 py-12 bg-gray-50">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold mb-2" style="color: {{ $theme['primary_color'] }};">Preferred Builders in Bangalore</h2>
                <p class="text-gray-600">Trusted developers with proven track records</p>
            </div>
            <a href="#" class="hidden md:flex items-center gap-2 text-lg font-semibold hover:underline" style="color: {{ $theme['primary_color'] }};">
                <span>See all</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <!-- Builders Grid - Compact Design -->
        <div class="overflow-x-auto pb-4 -mx-4 px-4 md:overflow-visible">
            <div class="flex md:grid md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4" style="min-width: max-content; width: 100%;">
                @foreach($builders as $builder)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-4 flex-shrink-0 w-64 md:w-auto border border-gray-100">
                    <!-- Builder Header - Centered -->
                    <div class="flex flex-col items-center text-center mb-3">
                        <!-- Builder Logo with White Initials -->
                        <div class="relative mb-3">
                            <div class="w-14 h-14 rounded-full flex items-center justify-center font-bold text-lg" style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                                {{ strtoupper(substr($builder->company_name, 0, 2)) }}
                            </div>
                            <!-- Verified Badge -->
                            <div class="absolute -bottom-0.5 -right-0.5 bg-blue-500 rounded-full p-0.5">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Builder Name -->
                        <h3 class="text-sm font-bold text-gray-900 mb-1">{{ $builder->company_name }}</h3>
                        
                        <!-- Operating Since -->
                        <p class="text-xs text-gray-500 mb-2">Since {{ $builder->established_year }}</p>
                        
                        <!-- Buyers Served Badge -->
                        <span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-semibold border border-green-200">
                            {{ $builder->total_projects_completed * 100 }}+ Buyers
                        </span>
                    </div>

                    <!-- Stats - Horizontal Layout -->
                    <div class="flex items-center justify-around pt-3 border-t border-gray-100">
                        <div class="text-center">
                            <p class="text-xl font-bold" style="color: {{ $theme['primary_color'] }};">{{ $builder->projects_count }}</p>
                            <p class="text-xs text-gray-500">For Sale</p>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div class="text-center">
                            <p class="text-xl font-bold" style="color: {{ $theme['primary_color'] }};">{{ $builder->properties_count }}</p>
                            <p class="text-xs text-gray-500">For Rent</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- See All Button for Mobile -->
        <div class="mt-6 text-center md:hidden">
            <a href="#" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold transition-all hover:shadow-lg" style="background-color: {{ $theme['primary_color'] }}; color: #ffffff;">
                <span>See all</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
    --}}

    @push('scripts')
    <script>
        // Features slider for mobile
        (function() {
            const featureSlides = document.querySelectorAll('.feature-slide');
            const featureDots = document.querySelectorAll('.feature-dot');
            
            if (featureSlides.length > 0) {
                let currentFeatureSlide = 0;
                const totalFeatureSlides = featureSlides.length;
                let featureAutoPlayInterval;

                function showFeatureSlide(index) {
                    featureSlides.forEach(function(slide) {
                        slide.classList.remove('opacity-100');
                        slide.classList.add('opacity-0');
                    });
                    
                    featureDots.forEach(function(dot) {
                        dot.style.backgroundColor = '#d1d5db';
                    });

                    featureSlides[index].classList.remove('opacity-0');
                    featureSlides[index].classList.add('opacity-100');
                    
                    featureDots[index].style.backgroundColor = '{{ $theme["primary_color"] }}';
                    
                    currentFeatureSlide = index;
                }

                function nextFeatureSlide() {
                    const next = (currentFeatureSlide + 1) % totalFeatureSlides;
                    showFeatureSlide(next);
                }

                function startFeatureAutoPlay() {
                    featureAutoPlayInterval = setInterval(nextFeatureSlide, 5000);
                }

                function stopFeatureAutoPlay() {
                    clearInterval(featureAutoPlayInterval);
                }

                featureDots.forEach(function(dot, index) {
                    dot.addEventListener('click', function() {
                        showFeatureSlide(index);
                        stopFeatureAutoPlay();
                        startFeatureAutoPlay();
                    });
                });

                startFeatureAutoPlay();
            }
        })();
    </script>
    @endpush

    <!-- Custom Switch Styles -->
    <style>
        /* Alpine.js x-cloak - Hide elements until Alpine is ready */
        [x-cloak] {
            display: none !important;
        }

        /* The switch - the box around the slider */
        .custom-switch {
            font-size: 14px;
            position: relative;
            display: inline-block;
            width: 3.5em;
            height: 2em;
        }

        /* Hide default HTML checkbox */
        .custom-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .custom-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #B0B0B0;
            border: 1px solid #B0B0B0;
            transition: .4s;
            border-radius: 32px;
            outline: none;
        }

        .custom-slider:before {
            position: absolute;
            content: "";
            height: 1.6rem;
            width: 1.6rem;
            border-radius: 50%;
            outline: 2px solid #B0B0B0;
            left: 0px;
            bottom: 0.1rem;
            background-color: #fff;
            transition: transform .25s ease-in-out 0s;
        }

        .slider-icon {
            opacity: 0;
            height: 12px;
            width: 12px;
            stroke-width: 8;
            position: absolute;
            z-index: 999;
            stroke: #222222;
            right: 60%;
            top: 30%;
            transition: right ease-in-out .3s, opacity ease-in-out .15s;
        }

        .custom-switch input:checked + .custom-slider {
            background-color: #222222;
        }

        .custom-switch input:checked + .custom-slider .slider-icon {
            opacity: 1;
            right: 20%;
        }

        .custom-switch input:checked + .custom-slider:before {
            transform: translateX(1.5em);
            outline-color: #181818;
        }
    </style>

    </div>

   
</x-layout.frontend>

   






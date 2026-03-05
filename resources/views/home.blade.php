<x-layout.frontend>
    @if($banners->count() > 0)
    <!-- Hero Banner Slider -->
    <div class="mx-1 my-2">
        <div class="relative w-full overflow-hidden bg-gray-900 rounded-2xl shadow-xl" style="height: 60vh; min-height: 400px; max-height: 700px;">
            
            <!-- Slides Container -->
            <div id="banner-slider" class="relative w-full h-full">
                @foreach($banners as $index => $banner)
                <div class="banner-slide absolute inset-0 w-full h-full transition-opacity duration-700 @if($index === 0) opacity-100 @else opacity-0 @endif" data-slide="{{ $index }}">
                    @if(!empty($banner->link_url))
                    <a href="{{ $banner->link_url }}" class="block w-full h-full">
                    @endif
                        
                        <img src="{{ $banner->image_url }}" 
                             alt="{{ $banner->title }}" 
                             class="hidden md:block w-full h-full object-cover rounded-2xl">
                        
                        <img src="{{ $banner->mobile_image_url ?? $banner->image_url }}" 
                             alt="{{ $banner->title }}" 
                             class="md:hidden w-full h-full object-cover rounded-2xl">
                    
                    @if(!empty($banner->link_url))
                    </a>
                    @endif
                </div>
                @endforeach
            </div>

            @if($banners->count() > 1)
            <!-- Navigation Arrows -->
            <button style="color: white;" id="prev-slide" class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 bg-black/50 bg-opacity-30 hover:bg-opacity-50 text-white rounded-full p-2 md:p-3 shadow-lg transition-all z-10">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button style="color: white;" id="next-slide" class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 bg-black/50 bg-opacity-30 hover:bg-opacity-50 text-white rounded-full p-2 md:p-3 shadow-lg transition-all z-10">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Dots Indicator -->
            <div style="color: white;" class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-2 z-10">
                @foreach($banners as $index => $banner)
                <button class="banner-dot w-3 h-3 rounded-full transition-all @if($index === 0) bg-white w-8 @else bg-white bg-opacity-50 @endif" data-slide="{{ $index }}"></button>
                @endforeach
            </div>

            <!-- Bottom Pagination -->
            <div style="color: white;" class="absolute bottom-6 left-1/2 -translate-x-1/2 bg-black/50 bg-opacity-50 backdrop-blur-sm px-4 py-2 rounded-full z-10">
                <span class="text-white text-sm font-medium">
                    <span id="current-slide-number">1</span> / <span id="total-slides">{{ $banners->count() }}</span>
                </span>
            </div>
            @endif
            
        </div>
    </div>

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

            if (totalSlides <= 1) return;

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
        })();
    </script>
    @endpush
    @else
    <!-- Fallback when no banners -->
    <div class="mx-4 md:mx-8 lg:mx-12 mt-4 mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20 rounded-2xl">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-5xl font-bold mb-4">Welcome to Area24 Realty</h1>
                <p class="text-xl">Find your dream property with us.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Additional Content Sections -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Featured Properties</h2>
        <p class="text-gray-600">Coming soon...</p>
    </div>
</x-layout.frontend>

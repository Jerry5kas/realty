@props(['latitude' => '12.9716', 'longitude' => '77.5946', 'latitudeField' => 'latitude', 'longitudeField' => 'longitude', 'addressField' => 'address', 'skipInitialFetch' => false])

<div x-data="mapPicker{{ $latitudeField }}()" class="space-y-4">
    <div>
        <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">
            Search Location
        </label>
        <div class="flex gap-2">
            <input 
                type="text" 
                x-model="searchQuery"
                @keyup.enter="searchLocation()"
                class="flex-1 px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" 
                placeholder="Search for a location..."
            >
            <button 
                type="button"
                @click="searchLocation()"
                class="px-6 py-3 text-white rounded-xl text-sm font-medium hover:opacity-90 transition-all"
                style="background-color: {{ $theme['secondary_color'] }};"
            >
                Search
            </button>
        </div>
    </div>

    <div>
        <div id="map-{{ $latitudeField }}" style="height: 500px; width: 100%; border: 2px solid {{ $theme['primary_color'] }};" class="rounded-xl bg-gray-100 relative">
            <div x-show="!mapReady" class="absolute inset-0 flex items-center justify-center bg-gray-50 rounded-xl z-10">
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 animate-spin" style="color: {{ $theme['secondary_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <p class="text-sm font-medium" style="color: {{ $theme['primary_color'] }};">Loading map...</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-4 rounded-xl" style="background-color: {{ $theme['primary_color'] }}10;">
        <p class="text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Selected Location:</p>
        <p class="text-sm mb-2" style="color: {{ $theme['accent_color'] }};" x-text="selectedAddress || 'Click on map to select location'"></p>
        <div class="grid grid-cols-2 gap-2 text-xs text-gray-600">
            <div>Latitude: <span class="font-semibold" x-text="lat"></span></div>
            <div>Longitude: <span class="font-semibold" x-text="lng"></span></div>
        </div>
    </div>

    <input type="hidden" name="{{ $latitudeField }}" x-model="lat">
    <input type="hidden" name="{{ $longitudeField }}" x-model="lng">
</div>

@once
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
      crossorigin=""/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script>
function mapPicker{{ $latitudeField }}() {
    return {
        map: null,
        marker: null,
        lat: {{ $latitude }},
        lng: {{ $longitude }},
        searchQuery: '',
        selectedAddress: '',
        mapReady: false,
        skipInitialFetch: {{ $skipInitialFetch ? 'true' : 'false' }},
        
        init() {
            // Wait for Leaflet and tab visibility
            setTimeout(() => {
                this.initMap();
            }, 500);
            
            // Listen for tab changes
            window.addEventListener('tab-changed', (e) => {
                if (e.detail === 'location') {
                    setTimeout(() => {
                        if (this.map) {
                            this.map.invalidateSize();
                        } else {
                            this.initMap();
                        }
                    }, 200);
                }
            });
        },
        
        initMap() {
            if (typeof L === 'undefined') {
                console.error('Leaflet not loaded');
                setTimeout(() => this.initMap(), 500);
                return;
            }
            
            const mapEl = document.getElementById('map-{{ $latitudeField }}');
            if (!mapEl || mapEl.offsetParent === null) {
                console.log('Map element not visible, waiting...');
                return;
            }
            
            if (this.map) {
                this.map.remove();
            }
            
            try {
                this.map = L.map('map-{{ $latitudeField }}').setView([this.lat, this.lng], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap',
                    maxZoom: 19
                }).addTo(this.map);
                
                this.marker = L.marker([this.lat, this.lng], { draggable: true }).addTo(this.map);
                
                this.marker.on('dragend', (e) => {
                    const pos = e.target.getLatLng();
                    this.updateLocation(pos.lat, pos.lng);
                });
                
                this.map.on('click', (e) => {
                    this.updateLocation(e.latlng.lat, e.latlng.lng);
                });
                
                this.mapReady = true;
                
                // Only fetch address on init if not skipping (i.e., in create mode)
                if (!this.skipInitialFetch) {
                    this.getAddress(this.lat, this.lng);
                }
                
                setTimeout(() => {
                    if (this.map) this.map.invalidateSize();
                }, 100);
            } catch (error) {
                console.error('Map init error:', error);
            }
        },
        
        updateLocation(lat, lng) {
            this.lat = parseFloat(lat).toFixed(6);
            this.lng = parseFloat(lng).toFixed(6);
            
            if (this.marker) {
                this.marker.setLatLng([lat, lng]);
            }
            if (this.map) {
                this.map.setView([lat, lng], 13);
            }
            
            this.getAddress(lat, lng);
        },
        
        async getAddress(lat, lng) {
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`,
                    { headers: { 'Accept-Language': 'en', 'User-Agent': 'RealtyApp/1.0' } }
                );
                const data = await response.json();
                
                if (data && data.display_name) {
                    this.selectedAddress = data.display_name;
                    
                    // ALWAYS update address field
                    const addressField = document.querySelector('textarea[name="{{ $addressField }}"]');
                    if (addressField) {
                        addressField.value = this.selectedAddress;
                        addressField.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                    
                    // ALWAYS update pincode
                    if (data.address && data.address.postcode) {
                        const pincodeField = document.querySelector('input[name="pincode"]');
                        if (pincodeField) {
                            pincodeField.value = data.address.postcode;
                            pincodeField.dispatchEvent(new Event('input', { bubbles: true }));
                        }
                    }
                    
                    // ALWAYS update locality
                    if (data.address) {
                        const locality = data.address.suburb || data.address.neighbourhood || data.address.locality || '';
                        const localityField = document.querySelector('input[name="locality"]');
                        if (localityField && locality) {
                            localityField.value = locality;
                            localityField.dispatchEvent(new Event('input', { bubbles: true }));
                        }
                        
                        // Auto-select city based on address - try multiple fields
                        const cityName = data.address.city || 
                                       data.address.town || 
                                       data.address.village || 
                                       data.address.county || 
                                       data.address.state_district || '';
                        
                        console.log('Address data:', data.address);
                        console.log('Extracted city name:', cityName);
                        
                        if (cityName) {
                            this.selectCity(cityName);
                        }
                    }
                }
            } catch (error) {
                console.error('Error fetching address:', error);
            }
        },
        
        selectCity(cityName) {
            const citySelect = document.querySelector('select[name="city_id"]');
            if (!citySelect) return;
            
            // Normalize city name
            const cityLower = cityName.toLowerCase().trim();
            
            // Handle Bangalore/Bengaluru variations
            const cityVariations = [cityLower];
            if (cityLower.includes('bangalore') || cityLower.includes('bengaluru')) {
                cityVariations.push('bangalore', 'bengaluru');
            }
            
            console.log('Trying to match city:', cityName, 'Variations:', cityVariations);
            
            // Try to find matching city in dropdown
            for (let option of citySelect.options) {
                if (!option.value) continue; // Skip empty option
                
                const optionText = option.text.toLowerCase().trim();
                console.log('Checking option:', optionText);
                
                // Check if any variation matches
                for (let variation of cityVariations) {
                    if (optionText.includes(variation) || variation.includes(optionText)) {
                        console.log('Match found! Setting city to:', option.text);
                        citySelect.value = option.value;
                        citySelect.dispatchEvent(new Event('change', { bubbles: true }));
                        return;
                    }
                }
            }
            
            console.log('No city match found for:', cityName);
        },
        
        async searchLocation() {
            if (!this.searchQuery.trim()) {
                alert('Please enter a location to search');
                return;
            }
            
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(this.searchQuery + ', Bangalore, India')}&limit=1`,
                    { headers: { 'Accept-Language': 'en', 'User-Agent': 'RealtyApp/1.0' } }
                );
                const data = await response.json();
                
                if (data && data.length > 0) {
                    this.updateLocation(parseFloat(data[0].lat), parseFloat(data[0].lon));
                } else {
                    alert('Location not found');
                }
            } catch (error) {
                console.error('Search error:', error);
                alert('Search failed');
            }
        }
    }
}
</script>
@endpush
@endonce

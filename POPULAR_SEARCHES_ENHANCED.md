# Enhanced Popular Real Estate Searches Section

## Key Improvements:
1. **Single openSection variable** - Opening one accordion closes others in the same row
2. **Icons for each category** - Visual indicators for better UX
3. **Enhanced styling** - Border highlights, shadows, and hover effects
4. **Better visual hierarchy** - Active state clearly visible

## Changes Needed:

### 1. Update the x-data initialization (line ~983):
```php
<div x-show="activeCity === '{{ $city->id }}'" x-transition x-data="{ 
    openSection: 'apartments'  // Single variable instead of multiple
}">
```

### 2. Replace ALL accordion sections with this enhanced pattern:

#### For APARTMENTS (already done):
- Icon: Building/Apartment icon
- Opens by default

#### For VILLAS:
```php
<div class="border-2 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-all" :class="openSection === 'villas' ? 'border-[{{ $theme['primary_color'] }}] ring-2 ring-[{{ $theme['primary_color'] }}] ring-opacity-20' : 'border-gray-200'">
    <button @click="openSection = openSection === 'villas' ? '' : 'villas'" class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors">
        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center" :style="openSection === 'villas' ? 'background-color: {{ $theme['primary_color'] }};' : 'background-color: #f3f4f6;'">
            <svg class="w-6 h-6" :class="openSection === 'villas' ? 'text-white' : 'text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </div>
        <h3 class="flex-1 text-left text-base font-bold" :style="openSection === 'villas' ? 'color: {{ $theme['primary_color'] }};' : 'color: #374151;'">VILLAS</h3>
        <svg class="w-5 h-5 transition-transform flex-shrink-0" :class="openSection === 'villas' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="'color: ' + (openSection === 'villas' ? '{{ $theme['primary_color'] }}' : '#9ca3af')">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="openSection === 'villas'" x-collapse class="px-4 pb-4 bg-gray-50">
```

#### For OTHER PROPERTIES:
```php
<div class="border-2 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-all" :class="openSection === 'other' ? 'border-[{{ $theme['primary_color'] }}] ring-2 ring-[{{ $theme['primary_color'] }}] ring-opacity-20' : 'border-gray-200'">
    <button @click="openSection = openSection === 'other' ? '' : 'other'" class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors">
        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center" :style="openSection === 'other' ? 'background-color: {{ $theme['primary_color'] }};' : 'background-color: #f3f4f6;'">
            <svg class="w-6 h-6" :class="openSection === 'other' ? 'text-white' : 'text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
        </div>
        <h3 class="flex-1 text-left text-base font-bold" :style="openSection === 'other' ? 'color: {{ $theme['primary_color'] }};' : 'color: #374151;'">OTHER PROPERTIES</h3>
        <svg class="w-5 h-5 transition-transform flex-shrink-0" :class="openSection === 'other' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="'color: ' + (openSection === 'other' ? '{{ $theme['primary_color'] }}' : '#9ca3af')">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="openSection === 'other'" x-collapse class="px-4 pb-4 bg-gray-50">
```

#### For ALL SALE:
```php
<div class="border-2 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-all" :class="openSection === 'allsale' ? 'border-[{{ $theme['primary_color'] }}] ring-2 ring-[{{ $theme['primary_color'] }}] ring-opacity-20' : 'border-gray-200'">
    <button @click="openSection = openSection === 'allsale' ? '' : 'allsale'" class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors">
        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center" :style="openSection === 'allsale' ? 'background-color: {{ $theme['primary_color'] }};' : 'background-color: #f3f4f6;'">
            <svg class="w-6 h-6" :class="openSection === 'allsale' ? 'text-white' : 'text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
        </div>
        <h3 class="flex-1 text-left text-base font-bold" :style="openSection === 'allsale' ? 'color: {{ $theme['primary_color'] }};' : 'color: #374151;'">ALL SALE</h3>
        <svg class="w-5 h-5 transition-transform flex-shrink-0" :class="openSection === 'allsale' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="'color: ' + (openSection === 'allsale' ? '{{ $theme['primary_color'] }}' : '#9ca3af')">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="openSection === 'allsale'" x-collapse class="px-4 pb-4 bg-gray-50">
```

#### For OFF PLAN:
```php
<div class="border-2 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-all" :class="openSection === 'offplan' ? 'border-[{{ $theme['primary_color'] }}] ring-2 ring-[{{ $theme['primary_color'] }}] ring-opacity-20' : 'border-gray-200'">
    <button @click="openSection = openSection === 'offplan' ? '' : 'offplan'" class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors">
        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center" :style="openSection === 'offplan' ? 'background-color: {{ $theme['primary_color'] }};' : 'background-color: #f3f4f6;'">
            <svg class="w-6 h-6" :class="openSection === 'offplan' ? 'text-white' : 'text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <h3 class="flex-1 text-left text-base font-bold" :style="openSection === 'offplan' ? 'color: {{ $theme['primary_color'] }};' : 'color: #374151;'">OFF PLAN</h3>
        <svg class="w-5 h-5 transition-transform flex-shrink-0" :class="openSection === 'offplan' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="'color: ' + (openSection === 'offplan' ? '{{ $theme['primary_color'] }}' : '#9ca3af')">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="openSection === 'offplan'" x-collapse class="px-4 pb-4 bg-gray-50">
```

#### For ALL RENT:
```php
<div class="border-2 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-all" :class="openSection === 'allrent' ? 'border-[{{ $theme['primary_color'] }}] ring-2 ring-[{{ $theme['primary_color'] }}] ring-opacity-20' : 'border-gray-200'">
    <button @click="openSection = openSection === 'allrent' ? '' : 'allrent'" class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors">
        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center" :style="openSection === 'allrent' ? 'background-color: {{ $theme['primary_color'] }};' : 'background-color: #f3f4f6;'">
            <svg class="w-6 h-6" :class="openSection === 'allrent' ? 'text-white' : 'text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
            </svg>
        </div>
        <h3 class="flex-1 text-left text-base font-bold" :style="openSection === 'allrent' ? 'color: {{ $theme['primary_color'] }};' : 'color: #374151;'">ALL RENT</h3>
        <svg class="w-5 h-5 transition-transform flex-shrink-0" :class="openSection === 'allrent' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="'color: ' + (openSection === 'allrent' ? '{{ $theme['primary_color'] }}' : '#9ca3af')">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="openSection === 'allrent'" x-collapse class="px-4 pb-4 bg-gray-50">
```

#### For POPULAR SEARCHES:
```php
<div class="border-2 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-all" :class="openSection === 'popular' ? 'border-[{{ $theme['primary_color'] }}] ring-2 ring-[{{ $theme['primary_color'] }}] ring-opacity-20' : 'border-gray-200'">
    <button @click="openSection = openSection === 'popular' ? '' : 'popular'" class="w-full flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors">
        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center" :style="openSection === 'popular' ? 'background-color: {{ $theme['primary_color'] }};' : 'background-color: #f3f4f6;'">
            <svg class="w-6 h-6" :class="openSection === 'popular' ? 'text-white' : 'text-gray-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
        </div>
        <h3 class="flex-1 text-left text-base font-bold" :style="openSection === 'popular' ? 'color: {{ $theme['primary_color'] }};' : 'color: #374151;'">POPULAR SEARCHES</h3>
        <svg class="w-5 h-5 transition-transform flex-shrink-0" :class="openSection === 'popular' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" :style="'color: ' + (openSection === 'popular' ? '{{ $theme['primary_color'] }}' : '#9ca3af')">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="openSection === 'popular'" x-collapse class="px-4 pb-4 bg-gray-50">
```

## Summary of Changes:

1. **Replace all `openVillas`, `openOther`, `openAllSale`, `openOffPlan`, `openAllRent`, `openPopular`** with **`openSection === 'villas'`**, **`openSection === 'other'`**, etc.

2. **Replace all `@click="openVillas = !openVillas"`** with **`@click="openSection = openSection === 'villas' ? '' : 'villas'"`**

3. **Add icons** to each section header

4. **Update styling** with border-2, ring effects, and conditional classes

5. **Add bg-gray-50** to the content area for better visual separation

This creates a much better UX where:
- Only one accordion is open at a time in each row
- Clear visual feedback with icons and colors
- Better hover states and transitions
- Cleaner, more professional appearance

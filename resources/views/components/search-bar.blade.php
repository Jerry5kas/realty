@props(['placeholder' => 'Search...', 'action' => '', 'value' => ''])

<form action="{{ $action }}" method="GET" class="w-full">
    <div class="relative">
        <input 
            type="text" 
            name="search" 
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="w-full pl-10 pr-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all"
            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
        >
        <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2" style="color: {{ $theme['primary_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
</form>

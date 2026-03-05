@props(['tabs' => []])

<div x-data="{ activeTab: '{{ $tabs[0]['id'] ?? 'tab1' }}' }" x-init="$watch('activeTab', value => { console.log('Tab changed to:', value); window.dispatchEvent(new CustomEvent('tab-changed', { detail: value })); })">
    <!-- Tab Navigation -->
    <div class="border-b-2 mb-6" style="border-color: {{ $theme['primary_color'] }}20;">
        <nav class="flex flex-wrap -mb-px gap-2">
            @foreach($tabs as $tab)
                <button 
                    type="button"
                    @click="activeTab = '{{ $tab['id'] }}'"
                    :class="activeTab === '{{ $tab['id'] }}' ? 'border-b-2 font-semibold' : 'text-gray-500 hover:text-gray-700'"
                    class="px-4 py-3 text-sm transition-all rounded-t-lg"
                    :style="activeTab === '{{ $tab['id'] }}' ? 'border-color: {{ $theme['secondary_color'] }}; color: {{ $theme['primary_color'] }};' : ''"
                >
                    <div class="flex items-center gap-2">
                        @if(isset($tab['icon']))
                            {!! $tab['icon'] !!}
                        @endif
                        <span>{{ $tab['label'] }}</span>
                    </div>
                </button>
            @endforeach
        </nav>
    </div>

    <!-- Tab Content -->
    <div>
        {{ $slot }}
    </div>
</div>

@once
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endonce

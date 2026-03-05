@props(['id', 'title' => null])

<div x-show="activeTab === '{{ $id }}'" x-transition class="space-y-6">
    @if($title)
        <h3 class="text-xl font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>

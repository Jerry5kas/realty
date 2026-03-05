@props(['items'])

<nav class="mb-6">
    <ol class="flex items-center space-x-2 text-sm">
        @foreach($items as $index => $item)
            @if($loop->last)
                <li style="color: {{ $theme['accent_color'] }};">{{ $item['label'] }}</li>
            @else
                <li class="flex items-center">
                    <a href="{{ $item['url'] }}" class="hover:opacity-70 transition-opacity" style="color: {{ $theme['primary_color'] }};">{{ $item['label'] }}</a>
                    <svg class="w-4 h-4 mx-2" style="color: {{ $theme['accent_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</nav>

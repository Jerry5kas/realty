@props(['editRoute' => null, 'deleteRoute' => null, 'deleteMessage' => 'Are you sure you want to delete this item?'])

<div class="flex items-center justify-end gap-2">
    @if($editRoute)
        <a href="{{ $editRoute }}" class="p-2 rounded-lg hover:bg-gray-100 transition-all" style="color: {{ $theme['secondary_color'] }};" title="Edit">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>
    @endif
    
    @if($deleteRoute)
        <button type="button" onclick="deleteItem('{{ $deleteRoute }}', '{{ addslashes($deleteMessage) }}')" class="p-2 rounded-lg hover:bg-red-50 transition-all" style="color: #ef4444;" title="Delete">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    @endif
</div>

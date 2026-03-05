@extends('layouts.admin')

@section('title', 'Media Assets')
@section('page-title', 'Media Assets')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Media Assets', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-2 border-green-500 rounded-xl">
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="mb-6">
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="flex-1">
                <x-search-bar 
                    :action="route('media-assets.index')"
                    placeholder="Search media assets..."
                    :value="request('search')"
                />
            </div>
            <button 
                id="bulkDeleteBtn" 
                onclick="bulkDelete('asset-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected media assets?')" 
                class="hidden p-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all items-center gap-2"
                title="Delete Selected"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                <span class="hidden md:inline">Delete</span>
                <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs font-semibold" id="selectedCount">0</span>
            </button>
        </div>

        <form id="bulkDeleteForm" action="{{ route('media-assets.bulk-delete') }}" method="POST">
            @csrf
            <x-data-table
                title="Media Assets Management"
                description="Manage all images, icons, and media files"
                :createRoute="route('media-assets.create')"
                createLabel="Add Media"
                :columns="[
                    ['label' => 'Select', 'field' => 'checkbox'],
                    ['label' => 'Preview', 'field' => 'preview'],
                    ['label' => 'Title', 'field' => 'title'],
                    ['label' => 'Type', 'field' => 'file_type'],
                    ['label' => 'Category', 'field' => 'category'],
                    ['label' => 'Size', 'field' => 'file_size'],
                    ['label' => 'URL', 'field' => 'file_url'],
                    ['label' => 'Status', 'field' => 'status']
                ]"
            >
                <tr style="background-color: {{ $theme['primary_color'] }}05;">
                    <td class="px-4 md:px-6 py-3">
                        <input 
                            type="checkbox" 
                            id="selectAll"
                            class="w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="toggleSelectAll(this, 'asset-checkbox')"
                        >
                    </td>
                    <td colspan="8" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                        Select All
                    </td>
                </tr>
                @forelse($mediaAssets as $asset)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            <input 
                                type="checkbox" 
                                name="ids[]" 
                                value="{{ $asset->id }}" 
                                class="asset-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                                style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                                onchange="updateBulkDeleteButton('asset-checkbox')"
                            >
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            @if($asset->is_image)
                                <img src="{{ $asset->file_url }}" alt="{{ $asset->title }}" class="w-16 h-16 object-cover rounded-lg border-2" style="border-color: {{ $theme['primary_color'] }}20;">
                            @else
                                <div class="w-16 h-16 rounded-lg flex items-center justify-center text-white font-bold" style="background: linear-gradient(to bottom right, {{ $theme['secondary_color'] }}, {{ $theme['primary_color'] }});">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 md:px-6 py-4">
                            <div class="font-medium" style="color: {{ $theme['primary_color'] }};">{{ $asset->title }}</div>
                            @if($asset->description)
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($asset->description, 50) }}</div>
                            @endif
                            @if($asset->dimensions)
                                <div class="text-xs text-gray-400 mt-1">{{ $asset->dimensions }}</div>
                            @endif
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full" style="background-color: {{ $theme['primary_color'] }}20; color: {{ $theme['primary_color'] }};">
                                {{ ucfirst($asset->file_type) }}
                            </span>
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            @if($asset->category)
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                    {{ ucfirst($asset->category) }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $asset->file_size ?? '-' }}
                        </td>
                        <td class="px-4 md:px-6 py-4">
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    value="{{ $asset->file_url }}" 
                                    id="url-{{ $asset->id }}"
                                    readonly 
                                    class="text-xs text-gray-600 bg-gray-50 px-2 py-1 rounded border max-w-xs truncate"
                                >
                                <button 
                                    type="button"
                                    onclick="copyToClipboard('url-{{ $asset->id }}')"
                                    class="p-1.5 rounded hover:bg-gray-100 transition-colors"
                                    title="Copy URL"
                                >
                                    <svg class="w-4 h-4" style="color: {{ $theme['secondary_color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                            @if($asset->is_active)
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 md:px-6 py-4 text-right whitespace-nowrap">
                            <x-table-actions
                                :editRoute="route('media-assets.edit', $asset)"
                                :deleteRoute="route('media-assets.destroy', $asset)"
                                deleteMessage="Are you sure you want to delete this media asset?"
                            />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 md:px-6 py-8 text-center text-gray-500">
                            No media assets found. <a href="{{ route('media-assets.create') }}" class="font-medium hover:underline" style="color: {{ $theme['secondary_color'] }};">Upload your first media</a>
                        </td>
                    </tr>
                @endforelse
            </x-data-table>
        </form>

        <div class="mt-6">
            {{ $mediaAssets->links() }}
        </div>
    </div>
</div>

<script>
function copyToClipboard(elementId) {
    const input = document.getElementById(elementId);
    input.select();
    input.setSelectionRange(0, 99999);
    
    navigator.clipboard.writeText(input.value).then(() => {
        // Show success feedback
        const button = event.currentTarget;
        const originalHTML = button.innerHTML;
        button.innerHTML = '<svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
        }, 2000);
    }).catch(err => {
        alert('Failed to copy URL');
    });
}
</script>
@endsection

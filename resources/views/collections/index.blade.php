@extends('layouts.admin')

@section('title', 'Collections')
@section('page-title', 'Collections Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Collections', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <x-search-bar 
                placeholder="Search collections by name..." 
                :action="route('collections.index')"
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('collection-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected collections?')" 
            class="hidden p-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all flex items-center gap-2"
            title="Delete Selected"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span class="hidden md:inline">Delete</span>
            <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs font-semibold" id="selectedCount">0</span>
        </button>
    </div>

    <form id="bulkDeleteForm" action="{{ route('collections.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table 
            title="Collection Management"
            description="Manage dynamic collections of properties and projects"
            :createRoute="route('collections.create')"
            createLabel="Create Collection"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'Name', 'field' => 'name'],
                ['label' => 'Type', 'field' => 'type'],
                ['label' => 'Items', 'field' => 'items'],
                ['label' => 'Status', 'field' => 'status'],
                ['label' => 'Featured', 'field' => 'featured']
            ]"
        >
            <tr style="background-color: {{ $theme['primary_color'] }}05;">
                <td class="px-4 md:px-6 py-3">
                    <input 
                        type="checkbox" 
                        id="selectAll"
                        class="w-4 h-4 rounded focus:ring-offset-0" 
                        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                        onchange="toggleSelectAll(this, 'collection-checkbox')"
                    >
                </td>
                <td colspan="6" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($collections as $collection)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $collection->id }}" 
                            class="collection-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('collection-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="flex items-center">
                            @if($collection->image)
                            <img src="{{ $collection->image }}" alt="{{ $collection->name }}" class="w-10 h-10 rounded-lg object-cover mr-3">
                            @endif
                            <div>
                                <div class="font-medium" style="color: {{ $theme['accent_color'] }};">{{ $collection->name }}</div>
                                <div class="text-xs text-gray-500">{{ $collection->slug }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full" style="background-color: {{ $theme['primary_color'] }}15; color: {{ $theme['primary_color'] }};">
                            {{ ucfirst($collection->type) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ $collection->getItemsCount() }} items
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($collection->status === 'active')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($collection->is_featured)
                        <svg class="w-5 h-5" style="color: {{ $theme['secondary_color'] }};" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :viewRoute="route('collections.show', $collection)"
                            :editRoute="route('collections.edit', $collection)"
                            :deleteRoute="route('collections.destroy', $collection)"
                            deleteMessage="Delete {{ $collection->name }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        No collections found. <a href="{{ route('collections.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Create your first collection</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($collections->hasPages())
        <div class="mt-6">
            {{ $collections->links() }}
        </div>
    @endif
</div>
@endsection

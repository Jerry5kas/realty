@extends('layouts.admin')

@section('title', 'Banners')
@section('page-title', 'Banners')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Banners', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-2 border-green-500 rounded-xl">
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <div class="flex-1">
            <x-search-bar 
                :action="route('banners.index')"
                placeholder="Search banners..."
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('banner-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected banners?')" 
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

    <form id="bulkDeleteForm" action="{{ route('banners.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table
            title="Banners Management"
            description="Manage banners for different pages and sections"
            :createRoute="route('banners.create')"
            createLabel="Add Banner"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'Image', 'field' => 'image'],
                ['label' => 'Title', 'field' => 'title'],
                ['label' => 'Page', 'field' => 'page'],
                ['label' => 'Section', 'field' => 'section'],
                ['label' => 'Order', 'field' => 'display_order'],
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
                        onchange="toggleSelectAll(this, 'banner-checkbox')"
                    >
                </td>
                <td colspan="7" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($banners as $banner)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]"
                            value="{{ $banner->id }}"
                            class="banner-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('banner-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($banner->image_url)
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="w-20 h-12 object-cover rounded-lg">
                        @else
                            <div class="w-20 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="font-medium" style="color: {{ $theme['primary_color'] }};">{{ $banner->title }}</div>
                        @if($banner->link_url)
                            <div class="text-xs text-gray-500 mt-1 truncate max-w-xs">{{ $banner->link_url }}</div>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full" style="background-color: {{ $theme['primary_color'] }}20; color: {{ $theme['primary_color'] }};">
                            {{ ucfirst($banner->page) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                            {{ ucfirst($banner->section) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 text-center whitespace-nowrap">
                        <span class="font-medium">{{ $banner->display_order }}</span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($banner->is_active)
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 text-right whitespace-nowrap">
                        <x-table-actions
                            :editRoute="route('banners.edit', $banner)"
                            :deleteRoute="route('banners.destroy', $banner)"
                            deleteMessage="Delete {{ $banner->title }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 md:px-6 py-8 text-center text-gray-500">
                        No banners found. <a href="{{ route('banners.create') }}" class="font-medium hover:underline" style="color: {{ $theme['secondary_color'] }};">Create your first banner</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    <div class="mt-6">
        {{ $banners->links() }}
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Cities')
@section('page-title', 'Cities')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Cities', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <x-search-bar 
                placeholder="Search cities by name or state..." 
                :action="route('cities.index')"
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('city-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected cities?')" 
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

    <form id="bulkDeleteForm" action="{{ route('cities.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table 
            title="City Management"
            description="Manage cities for property listings"
            :createRoute="route('cities.create')"
            createLabel="Add City"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'ID', 'field' => 'id'],
                ['label' => 'Name', 'field' => 'name'],
                ['label' => 'State', 'field' => 'state'],
                ['label' => 'Status', 'field' => 'is_active']
            ]"
        >
            <tr style="background-color: {{ $theme['primary_color'] }}05;">
                <td class="px-4 md:px-6 py-3">
                    <input 
                        type="checkbox" 
                        id="selectAll"
                        class="w-4 h-4 rounded focus:ring-offset-0" 
                        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                        onchange="toggleSelectAll(this, 'city-checkbox')"
                    >
                </td>
                <td colspan="5" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($cities as $city)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $city->id }}" 
                            class="city-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('city-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">{{ $city->id }}</td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: {{ $theme['accent_color'] }};">{{ $city->name }}</td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">{{ $city->state ?? '-' }}</td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($city->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :editRoute="route('cities.edit', $city)"
                            :deleteRoute="route('cities.destroy', $city)"
                            deleteMessage="Delete {{ $city->name }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        No cities found. <a href="{{ route('cities.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Add your first city</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($cities->hasPages())
        <div class="mt-6">
            {{ $cities->links() }}
        </div>
    @endif
</div>


@endsection


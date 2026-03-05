@extends('layouts.admin')

@section('title', 'Builders')
@section('page-title', 'Builders Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Builders', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-300 rounded-xl text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <x-search-bar 
                placeholder="Search builders by name, contact, email, phone, or city..." 
                :action="route('builders.index')"
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('builder-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected builders?')" 
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

    <form id="bulkDeleteForm" action="{{ route('builders.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table
            title="Builders Management"
            description="Manage all builders and developers"
            :createRoute="route('builders.create')"
            createLabel="Add Builder"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'Logo', 'field' => 'logo'],
                ['label' => 'Company', 'field' => 'company_name'],
                ['label' => 'Contact Person', 'field' => 'contact_person_name'],
                ['label' => 'Phone', 'field' => 'phone'],
                ['label' => 'Email', 'field' => 'email'],
                ['label' => 'City', 'field' => 'city'],
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
                        onchange="toggleSelectAll(this, 'builder-checkbox')"
                    >
                </td>
                <td colspan="8" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($builders as $builder)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $builder->id }}" 
                            class="builder-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('builder-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($builder->logo_url)
                            <img src="{{ $builder->logo_url }}" alt="{{ $builder->company_name }}" class="w-12 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center text-white font-bold text-sm" style="background: linear-gradient(to bottom right, {{ $theme['secondary_color'] }}, {{ $theme['primary_color'] }});">
                                {{ $builder->initials }}
                            </div>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="font-medium" style="color: {{ $theme['primary_color'] }};">
                            <a href="{{ route('builders.show', $builder) }}" class="hover:underline">{{ $builder->company_name }}</a>
                        </div>
                        @if($builder->is_featured)
                            <span class="inline-block mt-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Featured</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">{{ $builder->contact_person_name ?? '-' }}</td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">{{ $builder->phone ?? '-' }}</td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">{{ $builder->email ?? '-' }}</td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">{{ $builder->city->name ?? '-' }}</td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($builder->status === 'active')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :editRoute="route('builders.edit', $builder)" 
                            :deleteRoute="route('builders.destroy', $builder)"
                            deleteMessage="Delete {{ $builder->company_name }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                        No builders found. <a href="{{ route('builders.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Add your first builder</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($builders->hasPages())
        <div class="mt-6">
            {{ $builders->links() }}
        </div>
    @endif
</div>


@endsection


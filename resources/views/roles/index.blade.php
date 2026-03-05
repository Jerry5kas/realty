@extends('layouts.admin')

@section('title', 'Roles')
@section('page-title', 'Roles & Permissions')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Roles', 'url' => '']
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
                placeholder="Search roles by name or description..." 
                :action="route('roles.index')"
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('role-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected roles?')" 
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

    <form id="bulkDeleteForm" action="{{ route('roles.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table
            title="Roles Management"
            description="Manage user roles and permissions"
            :createRoute="route('roles.create')"
            createLabel="Add Role"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'Role Name', 'field' => 'name'],
                ['label' => 'Description', 'field' => 'description'],
                ['label' => 'Permissions', 'field' => 'permissions_count'],
                ['label' => 'Users', 'field' => 'users_count'],
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
                        onchange="toggleSelectAll(this, 'role-checkbox')"
                    >
                </td>
                <td colspan="6" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($roles as $role)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $role->id }}" 
                            class="role-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('role-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="font-medium" style="color: {{ $theme['primary_color'] }};">
                            <a href="{{ route('roles.show', $role) }}" class="hover:underline">{{ $role->name }}</a>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">{{ $role->slug }}</div>
                    </td>
                    <td class="px-4 md:px-6 py-4 text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ Str::limit($role->description, 50) ?? '-' }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $role->permissions_count }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                            {{ $role->users_count }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($role->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :editRoute="route('roles.edit', $role)" 
                            :deleteRoute="route('roles.destroy', $role)"
                            deleteMessage="Delete {{ $role->name }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        No roles found. <a href="{{ route('roles.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Add your first role</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($roles->hasPages())
        <div class="mt-6">
            {{ $roles->links() }}
        </div>
    @endif
</div>


@endsection


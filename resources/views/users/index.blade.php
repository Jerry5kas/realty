@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Users', 'url' => '']
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
                placeholder="Search users by name or email..." 
                :action="route('users.index')"
                :value="request('search')"
            />
        </div>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('user-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected users?')" 
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

    <!-- Role Filter Tabs -->
    <div class="mb-6 bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="flex overflow-x-auto">
            <a href="{{ route('users.index') }}" 
               class="flex-1 px-6 py-4 text-center font-medium transition-all border-b-2 {{ !request('role_id') ? 'border-b-2' : 'border-transparent hover:bg-gray-50' }}"
               style="{{ !request('role_id') ? 'border-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . '; background-color: ' . $theme['primary_color'] . '05;' : 'color: #6B7280;' }}">
                All Roles
                <span class="ml-2 px-2 py-0.5 text-xs rounded-full {{ !request('role_id') ? 'text-white' : 'bg-gray-100 text-gray-600' }}" style="{{ !request('role_id') ? 'background-color: ' . $theme['secondary_color'] . ';' : '' }}">
                    {{ $allCount }}
                </span>
            </a>
            @foreach($roles as $role)
                <a href="{{ route('users.index', ['role_id' => $role->id]) }}" 
                   class="flex-1 px-6 py-4 text-center font-medium transition-all border-b-2 whitespace-nowrap {{ request('role_id') == $role->id ? 'border-b-2' : 'border-transparent hover:bg-gray-50' }}"
                   style="{{ request('role_id') == $role->id ? 'border-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . '; background-color: ' . $theme['primary_color'] . '05;' : 'color: #6B7280;' }}">
                    {{ $role->name }}
                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full {{ request('role_id') == $role->id ? 'text-white' : 'bg-gray-100 text-gray-600' }}" style="{{ request('role_id') == $role->id ? 'background-color: ' . $theme['secondary_color'] . ';' : '' }}">
                        {{ $role->users_count }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>

    <form id="bulkDeleteForm" action="{{ route('users.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table
            title="Users Management"
            description="Manage system users and their roles"
            :createRoute="route('users.create')"
            createLabel="Add User"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'User', 'field' => 'name'],
                ['label' => 'Email', 'field' => 'email'],
                ['label' => 'Roles', 'field' => 'roles'],
                ['label' => 'Joined', 'field' => 'created_at']
            ]"
        >
            <tr style="background-color: {{ $theme['primary_color'] }}05;">
                <td class="px-4 md:px-6 py-3">
                    <input 
                        type="checkbox" 
                        id="selectAll"
                        class="w-4 h-4 rounded focus:ring-offset-0" 
                        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                        onchange="toggleSelectAll(this, 'user-checkbox')"
                    >
                </td>
                <td colspan="5" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $user->id }}" 
                            class="user-checkbox w-4 h-4 rounded focus:ring-offset-0"
                            {{ $user->id === auth()->id() ? 'disabled' : '' }}
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('user-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg" style="background: linear-gradient(to bottom right, {{ $theme['secondary_color'] }}, {{ $theme['primary_color'] }});">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="font-medium" style="color: {{ $theme['primary_color'] }};">
                                    <a href="{{ route('users.show', $user) }}" class="hover:underline">{{ $user->name }}</a>
                                </div>
                                @if($user->id === auth()->id())
                                    <span class="text-xs text-gray-500">(You)</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-4 md:px-6 py-4 text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ $user->email }}
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @forelse($user->roles as $role)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $role->name }}
                                </span>
                            @empty
                                <span class="text-xs text-gray-400">No roles</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :editRoute="route('users.edit', $user)" 
                            :deleteRoute="route('users.destroy', $user)"
                            deleteMessage="Delete {{ $user->name }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        No users found. <a href="{{ route('users.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Add your first user</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($users->hasPages())
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    @endif
</div>


@endsection


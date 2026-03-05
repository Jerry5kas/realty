@extends('layouts.admin')

@section('title', 'Role Details')
@section('page-title', 'Role Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Roles', 'url' => route('roles.index')],
        ['label' => 'Role Details', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b flex justify-between items-center" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <div>
                <h2 class="text-lg md:text-xl font-semibold" style="color: white;">{{ $role->name }}</h2>
                <p class="text-sm text-white/80 mt-1">{{ $role->slug }}</p>
            </div>
            <a href="{{ route('roles.edit', $role) }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>

        <div class="p-4 md:p-6 space-y-6">
            <div class="flex gap-2">
                @if($role->is_active)
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                @else
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                @endif
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">{{ $role->permissions->count() }} Permissions</span>
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">{{ $role->users->count() }} Users</span>
            </div>

            @if($role->description)
                <div>
                    <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Description</h3>
                    <p class="text-gray-700">{{ $role->description }}</p>
                </div>
            @endif

            <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Permissions</h3>
                @if($permissionsByModule->count() > 0)
                    <div class="space-y-4">
                        @foreach($permissionsByModule as $module => $permissions)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h5 class="font-semibold mb-3 capitalize" style="color: {{ $theme['secondary_color'] }};">{{ str_replace('-', ' ', $module) }}</h5>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($permissions as $permission)
                                        <span class="px-3 py-1 text-sm bg-white border rounded-lg" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }};">
                                            {{ str_replace($module . '.', '', $permission->slug) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No permissions assigned to this role.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

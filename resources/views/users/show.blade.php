@extends('layouts.admin')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Users', 'url' => route('users.index')],
        ['label' => 'User Details', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b flex justify-between items-center" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg" style="background: linear-gradient(to bottom right, {{ $theme['secondary_color'] }}, {{ $theme['primary_color'] }});">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-lg md:text-xl font-semibold" style="color: white;">{{ $user->name }}</h2>
                    <p class="text-sm text-white/80 mt-1">{{ $user->email }}</p>
                </div>
            </div>
            <a href="{{ route('users.edit', $user) }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>

        <div class="p-4 md:p-6 space-y-6">
            <div>
                <h3 class="font-semibold mb-3" style="color: {{ $theme['primary_color'] }};">Assigned Roles</h3>
                @if($user->roles->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->roles as $role)
                            <span class="px-3 py-2 text-sm font-semibold rounded-lg bg-blue-100 text-blue-800">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No roles assigned to this user.</p>
                @endif
            </div>

            <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Permissions (from roles)</h3>
                @php
                    $allPermissions = $user->getAllPermissions();
                    $permissionsByModule = $allPermissions->groupBy('module');
                @endphp
                
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
                    <p class="text-gray-500">No permissions available.</p>
                @endif
            </div>

            <div class="border-t pt-6 text-sm text-gray-500" style="border-color: {{ $theme['primary_color'] }}20;">
                <p>Joined: {{ $user->created_at->format('M d, Y h:i A') }}</p>
                <p>Last Updated: {{ $user->updated_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

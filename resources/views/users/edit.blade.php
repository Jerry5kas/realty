@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Users', 'url' => route('users.index')],
        ['label' => 'Edit User', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Edit User</h2>
        </div>

        <form action="{{ route('users.update', $user) }}" method="POST" class="p-4 md:p-6">
            @csrf
            @method('PUT')
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-2 border-red-500 rounded-xl">
                    <h3 class="text-red-800 font-semibold mb-2">Please fix the following errors:</h3>
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-input label="Full Name" name="name" :required="true" :value="$user->name" placeholder="Enter full name" />
                    <x-form-input label="Email" name="email" type="email" :required="true" :value="$user->email" placeholder="Enter email address" />
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-input label="Password" name="password" type="password" placeholder="Leave blank to keep current password" />
                    <x-form-input label="Confirm Password" name="password_confirmation" type="password" placeholder="Confirm new password" />
                </div>

                <x-form-select label="Legacy Role" name="role" :required="true" :value="$user->role" :options="[
                    'admin' => 'Admin',
                    'agent' => 'Agent',
                    'user' => 'User'
                ]" />

                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Assign Roles</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($roles as $role)
                            <x-form-checkbox 
                                :label="$role->name" 
                                name="roles[]" 
                                :value="$role->id"
                                :checked="in_array($role->id, $userRoles)"
                            />
                        @endforeach
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Select one or more roles to assign to this user</p>
                </div>
            </div>

            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('users.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

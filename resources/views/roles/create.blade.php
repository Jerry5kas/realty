@extends('layouts.admin')

@section('title', 'Add Role')
@section('page-title', 'Add Role')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Roles', 'url' => route('roles.index')],
        ['label' => 'Add Role', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Add New Role</h2>
        </div>

        <form action="{{ route('roles.store') }}" method="POST" class="p-4 md:p-6">
            @csrf
            
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
                    <x-form-input label="Role Name" name="name" :required="true" placeholder="e.g., Sales Manager" />
                    <x-form-input label="Slug" name="slug" :required="true" placeholder="e.g., sales-manager" />
                </div>
                
                <x-form-textarea label="Description" name="description" rows="2" placeholder="Enter role description" />
                
                <x-form-checkbox label="Active" name="is_active" checked />

                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Permissions</h4>
                    <div class="space-y-4">
                        @foreach($permissions as $module => $modulePermissions)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h5 class="font-semibold mb-3 capitalize" style="color: {{ $theme['secondary_color'] }};">{{ str_replace('-', ' ', $module) }}</h5>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    @foreach($modulePermissions as $permission)
                                        <x-form-checkbox 
                                            :label="str_replace($module . '.', '', $permission->slug)" 
                                            name="permissions[]" 
                                            :value="$permission->id" 
                                        />
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('roles.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Save Role
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

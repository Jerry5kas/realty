@extends('layouts.admin')

@section('title', 'Add Amenity')
@section('page-title', 'Add Amenity')

@section('content')
<div class="max-w-3xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Amenities', 'url' => route('amenities.index')],
        ['label' => 'Add Amenity', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Add New Amenity</h2>
        </div>

        <form action="{{ route('amenities.store') }}" method="POST" class="p-4 md:p-6 space-y-6">
            @csrf
            
            <x-form-input label="Amenity Name" name="name" :required="true" placeholder="e.g., Swimming Pool" />
            
            <x-form-input label="Icon" name="icon" placeholder="e.g., swimming-pool (optional)" />
            
            <x-form-textarea label="Description" name="description" rows="3" placeholder="Brief description (optional)" />
            
            <x-form-input label="Display Order" name="order" type="number" value="0" min="0" placeholder="0" />
            
            <x-form-checkbox label="Active" name="is_active" :checked="true" />

            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('amenities.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Save Amenity
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

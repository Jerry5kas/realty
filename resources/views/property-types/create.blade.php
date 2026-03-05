@extends('layouts.admin')

@section('title', 'Add Property Type')
@section('page-title', 'Add Property Type')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Property Types', 'url' => route('property-types.index')],
        ['label' => 'Add Property Type', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-xl font-semibold text-white">Property Type Information</h2>
        </div>

        <form action="{{ route('property-types.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <x-form-input
                label="Name"
                name="name"
                :value="old('name')"
                required
                placeholder="e.g., Apartment, Villa, Office Space"
            />

            <x-form-select
                label="Category"
                name="category"
                :value="old('category', 'residential')"
                :options="[
                    'residential' => 'Residential',
                    'commercial' => 'Commercial',
                    'land' => 'Land'
                ]"
                required
            />

            <x-form-input
                label="Icon"
                name="icon"
                :value="old('icon')"
                placeholder="e.g., fa-home, fa-building (optional)"
            />

            <x-form-input
                label="Display Order"
                name="order"
                type="number"
                :value="old('order', 0)"
                min="0"
                placeholder="0"
            />

            <x-form-checkbox
                label="Active"
                name="is_active"
                :checked="old('is_active', true)"
            />

            <div class="flex gap-4 pt-4">
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Create Property Type
                </button>
                <a href="{{ route('property-types.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-300 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

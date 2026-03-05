@extends('layouts.admin')

@section('title', 'Add City')
@section('page-title', 'Add City')

@section('content')
<div class="max-w-3xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Cities', 'url' => route('cities.index')],
        ['label' => 'Add City', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Add New City</h2>
        </div>

        <form action="{{ route('cities.store') }}" method="POST" class="p-4 md:p-6 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">City Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all @error('name') border-red-500 @enderror" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="Enter city name">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">State</label>
                <input type="text" name="state" value="{{ old('state') }}" class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['accent_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" placeholder="Enter state name">
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};">
                    <span class="ml-2 text-sm" style="color: {{ $theme['accent_color'] }};">Active</span>
                </label>
            </div>

            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('cities.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Save City
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

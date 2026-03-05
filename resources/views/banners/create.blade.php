@extends('layouts.admin')

@section('title', 'Add Banner')
@section('page-title', 'Add Banner')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Banners', 'url' => route('banners.index')],
        ['label' => 'Add Banner', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }}; color: white;">
            <h2 class="text-xl font-semibold text-white">Add New Banner</h2>
        </div>

        <form action="{{ route('banners.store') }}" method="POST" class="p-6">
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
                <x-form-input
                    label="Banner Title"
                    name="title"
                    :value="old('title')"
                    required
                    placeholder="e.g., Summer Sale Banner"
                />

                <div>
                    <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Desktop Banner Image *</label>
                    <x-imagekit-uploader
                        name="image_url"
                        label="Upload Desktop Banner"
                        :multiple="false"
                        folder="/banners"
                    />
                    <p class="mt-1 text-sm text-gray-500">Recommended size: 1920x600px for hero banners</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Mobile Banner Image (Optional)</label>
                    <x-imagekit-uploader
                        name="mobile_image_url"
                        label="Upload Mobile Banner"
                        :multiple="false"
                        folder="/banners/mobile"
                    />
                    <p class="mt-1 text-sm text-gray-500">Recommended size: 768x400px for mobile devices</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-form-select
                        label="Page"
                        name="page"
                        :value="old('page', 'home')"
                        required
                        :options="[
                            'home' => 'Home',
                            'properties' => 'Properties',
                            'projects' => 'Projects',
                            'about' => 'About',
                            'contact' => 'Contact'
                        ]"
                    />

                    <x-form-select
                        label="Section"
                        name="section"
                        :value="old('section', 'hero')"
                        required
                        :options="[
                            'hero' => 'Hero',
                            'sidebar' => 'Sidebar',
                            'footer' => 'Footer',
                            'content' => 'Content'
                        ]"
                    />
                </div>

                <x-form-input
                    label="Link URL"
                    name="link_url"
                    type="url"
                    :value="old('link_url')"
                    placeholder="https://example.com (Optional)"
                />

                <x-form-input
                    label="Display Order"
                    name="display_order"
                    type="number"
                    :value="old('display_order', 0)"
                    min="0"
                    placeholder="0"
                />

                <div class="border-t pt-6">
                    <x-form-checkbox
                        label="Active"
                        name="is_active"
                        :checked="old('is_active', true)"
                    />
                </div>
            </div>

            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('banners.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Create Banner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

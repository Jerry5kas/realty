@extends('layouts.admin')

@section('title', 'Add Media Asset')
@section('page-title', 'Add Media Asset')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Media Assets', 'url' => route('media-assets.index')],
        ['label' => 'Add Media', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-xl font-semibold text-white">Add New Media Asset</h2>
        </div>

        <form action="{{ route('media-assets.store') }}" method="POST" class="p-6">
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
                    label="Title"
                    name="title"
                    :value="old('title')"
                    required
                    placeholder="e.g., Property Hero Image"
                />

                <div>
                    <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Upload File *</label>
                    <x-imagekit-uploader
                        name="file_url"
                        :value="old('file_url')"
                        folder="media-assets"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-form-select
                        label="File Type"
                        name="file_type"
                        :value="old('file_type', 'image')"
                        required
                        :options="[
                            'image' => 'Image',
                            'icon' => 'Icon',
                            'document' => 'Document',
                            'video' => 'Video'
                        ]"
                    />

                    <x-form-select
                        label="Category"
                        name="category"
                        :value="old('category')"
                        :options="[
                            '' => '-- Select Category (Optional) --',
                            'property' => 'Property',
                            'project' => 'Project',
                            'banner' => 'Banner',
                            'builder' => 'Builder',
                            'general' => 'General'
                        ]"
                    />
                </div>

                <x-form-textarea
                    label="Description"
                    name="description"
                    :value="old('description')"
                    placeholder="Brief description of the media asset..."
                    rows="3"
                />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-form-input
                        label="File Size"
                        name="file_size"
                        :value="old('file_size')"
                        placeholder="e.g., 250 KB"
                    />

                    <x-form-input
                        label="Dimensions"
                        name="dimensions"
                        :value="old('dimensions')"
                        placeholder="e.g., 1920x1080"
                    />
                </div>

                <div class="border-t pt-6">
                    <x-form-checkbox
                        label="Active"
                        name="is_active"
                        :checked="old('is_active', true)"
                    />
                </div>
            </div>

            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('media-assets.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Create Media Asset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

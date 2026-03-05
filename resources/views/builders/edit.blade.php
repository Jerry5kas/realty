@extends('layouts.admin')

@section('title', 'Edit Builder')
@section('page-title', 'Edit Builder')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Builders', 'url' => route('builders.index')],
        ['label' => 'Edit Builder', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-xl font-semibold text-white">Edit Builder Information</h2>
        </div>

        <form action="{{ route('builders.update', $builder) }}" method="POST" class="p-6">
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

            <x-form-tabs :tabs="[
                ['id' => 'basic', 'label' => 'Basic Info', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4\'></path></svg>'],
                ['id' => 'contact', 'label' => 'Contact Info', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z\'></path></svg>'],
                ['id' => 'business', 'label' => 'Business Info', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\'></path></svg>'],
                ['id' => 'social', 'label' => 'Social Media', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z\'></path></svg>'],
                ['id' => 'address', 'label' => 'Address', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z\'></path><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M15 11a3 3 0 11-6 0 3 3 0 016 0z\'></path></svg>'],
                ['id' => 'settings', 'label' => 'Settings', 'icon' => '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z\'></path><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M15 12a3 3 0 11-6 0 3 3 0 016 0z\'></path></svg>']
            ]">
                <!-- Basic Info Tab -->
                <x-tab-content id="basic">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-form-input
                                label="Company Name"
                                name="company_name"
                                :value="old('company_name', $builder->company_name)"
                                required
                                placeholder="e.g., ABC Builders & Developers"
                            />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Logo</label>
                            <x-imagekit-uploader
                                name="logo_url"
                                :value="old('logo_url', $builder->logo_url)"
                                folder="builders"
                            />
                        </div>

                        <div class="md:col-span-2">
                            <x-form-textarea
                                label="Description"
                                name="description"
                                :value="old('description', $builder->description)"
                                placeholder="Brief description about the builder..."
                                rows="4"
                            />
                        </div>
                    </div>
                </x-tab-content>

                <!-- Contact Info Tab -->
                <x-tab-content id="contact">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-input
                            label="Contact Person Name"
                            name="contact_person_name"
                            :value="old('contact_person_name', $builder->contact_person_name)"
                            placeholder="e.g., John Doe"
                        />

                        <x-form-input
                            label="Phone"
                            name="phone"
                            :value="old('phone', $builder->phone)"
                            placeholder="e.g., +91 98765 43210"
                        />

                        <x-form-input
                            label="Email"
                            name="email"
                            type="email"
                            :value="old('email', $builder->email)"
                            placeholder="e.g., contact@builder.com"
                        />

                        <x-form-input
                            label="Website"
                            name="website"
                            type="url"
                            :value="old('website', $builder->website)"
                            placeholder="e.g., https://www.builder.com"
                        />
                    </div>
                </x-tab-content>

                <!-- Business Info Tab -->
                <x-tab-content id="business">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-input
                            label="RERA Registration Number"
                            name="rera_registration_number"
                            :value="old('rera_registration_number', $builder->rera_registration_number)"
                            placeholder="e.g., RERA123456"
                        />

                        <x-form-input
                            label="Established Year"
                            name="established_year"
                            type="number"
                            :value="old('established_year', $builder->established_year)"
                            min="1800"
                            :max="date('Y')"
                            placeholder="e.g., 2000"
                        />

                        <x-form-input
                            label="Total Projects Completed"
                            name="total_projects_completed"
                            type="number"
                            :value="old('total_projects_completed', $builder->total_projects_completed)"
                            min="0"
                            placeholder="e.g., 25"
                        />

                        <x-form-select
                            label="City"
                            name="city_id"
                            :value="old('city_id', $builder->city_id)"
                            :options="$cities->pluck('name', 'id')->prepend('-- Select City (Optional) --', '')"
                        />
                    </div>
                </x-tab-content>

                <!-- Social Media Tab -->
                <x-tab-content id="social">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form-input
                            label="Facebook URL"
                            name="facebook_url"
                            type="url"
                            :value="old('facebook_url', $builder->facebook_url)"
                            placeholder="https://facebook.com/builder"
                        />

                        <x-form-input
                            label="Instagram URL"
                            name="instagram_url"
                            type="url"
                            :value="old('instagram_url', $builder->instagram_url)"
                            placeholder="https://instagram.com/builder"
                        />

                        <x-form-input
                            label="LinkedIn URL"
                            name="linkedin_url"
                            type="url"
                            :value="old('linkedin_url', $builder->linkedin_url)"
                            placeholder="https://linkedin.com/company/builder"
                        />

                        <x-form-input
                            label="Twitter URL"
                            name="twitter_url"
                            type="url"
                            :value="old('twitter_url', $builder->twitter_url)"
                            placeholder="https://twitter.com/builder"
                        />
                    </div>
                </x-tab-content>

                <!-- Address Tab -->
                <x-tab-content id="address">
                    <x-form-textarea
                        label="Office Address"
                        name="office_address"
                        :value="old('office_address', $builder->office_address)"
                        placeholder="Complete office address..."
                        rows="3"
                    />
                </x-tab-content>

                <!-- Settings Tab -->
                <x-tab-content id="settings">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">Status *</label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="active" {{ old('status', $builder->status) === 'active' ? 'checked' : '' }} class="mr-2" style="color: {{ $theme['secondary_color'] }};">
                                    <span>Active</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="inactive" {{ old('status', $builder->status) === 'inactive' ? 'checked' : '' }} class="mr-2" style="color: {{ $theme['secondary_color'] }};">
                                    <span>Inactive</span>
                                </label>
                            </div>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-form-checkbox
                            label="Featured Builder"
                            name="is_featured"
                            :checked="old('is_featured', $builder->is_featured)"
                        />
                    </div>
                </x-tab-content>
            </x-form-tabs>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('builders.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Update Builder
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

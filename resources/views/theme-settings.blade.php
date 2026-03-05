@extends('layouts.admin')

@section('title', 'Theme Settings')
@section('page-title', 'Theme Settings')

@section('content')
<div class="max-w-6xl mx-auto">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('theme.settings.update') }}" method="POST">
        @csrf
        
        <!-- Theme Settings Card -->
        <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $settings['primary_color'] }};">
            <div class="px-6 py-4 border-b" style="background-color: {{ $settings['primary_color'] }}; border-color: {{ $settings['secondary_color'] }}; color: white;">
                <h2 class="text-xl font-semibold text-white" >Theme Configuration</h2>
                <p class="text-white/80 text-sm mt-1">Customize your application's appearance and branding</p>
            </div>

            <div class="p-6 space-y-8">
                <!-- Color Palette -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center" style="color: {{ $settings['primary_color'] }};">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                        Color Palette
                    </h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Primary Color -->
                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-3">Primary Color (Deep Blue)</label>
                            <div class="flex items-center space-x-3 mb-3">
                                <input type="color" name="primary_color" value="{{ $settings['primary_color'] }}" class="w-20 h-20 rounded-lg border-2 border-gray-300 cursor-pointer">
                                <div>
                                    <input type="text" name="primary_color_hex" value="{{ $settings['primary_color'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm font-mono" readonly>
                                    <p class="text-xs text-gray-600 mt-2">Headers, sidebar</p>
                                </div>
                            </div>
                        </div>

                        <!-- Secondary Color -->
                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-3">Secondary Color (Gold)</label>
                            <div class="flex items-center space-x-3 mb-3">
                                <input type="color" name="secondary_color" value="{{ $settings['secondary_color'] }}" class="w-20 h-20 rounded-lg border-2 border-gray-300 cursor-pointer">
                                <div>
                                    <input type="text" name="secondary_color_hex" value="{{ $settings['secondary_color'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm font-mono" readonly>
                                    <p class="text-xs text-gray-600 mt-2">Accents, highlights</p>
                                </div>
                            </div>
                        </div>

                        <!-- Accent Color 1 -->
                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-3">Accent 1 (Dark Blue)</label>
                            <div class="flex items-center space-x-3 mb-3">
                                <input type="color" name="accent_color" value="{{ $settings['accent_color'] }}" class="w-20 h-20 rounded-lg border-2 border-gray-300 cursor-pointer">
                                <div>
                                    <input type="text" name="accent_color_hex" value="{{ $settings['accent_color'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm font-mono" readonly>
                                    <p class="text-xs text-gray-600 mt-2">Text, buttons</p>
                                </div>
                            </div>
                        </div>

                        <!-- Accent Color 2 -->
                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-3">Accent 2 (White)</label>
                            <div class="flex items-center space-x-3 mb-3">
                                <input type="color" name="accent2_color" value="{{ $settings['accent2_color'] }}" class="w-20 h-20 rounded-lg border-2 border-gray-300 cursor-pointer">
                                <div>
                                    <input type="text" name="accent2_color_hex" value="{{ $settings['accent2_color'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm font-mono" readonly>
                                    <p class="text-xs text-gray-600 mt-2">For dark backgrounds</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logo Settings -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center" style="color: {{ $settings['primary_color'] }};">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Logo Settings
                    </h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Dark Logo -->
                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-3">Dark Logo (For Light Backgrounds)</label>
                            <div class="bg-gray-50 rounded-lg p-6 mb-3 flex items-center justify-center">
                                <img src="{{ $settings['logo_dark'] }}" alt="Dark Logo" class="h-20 w-20">
                            </div>
                            <input type="url" name="logo_dark" value="{{ $settings['logo_dark'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-[#0D1B36]" placeholder="Enter logo URL">
                        </div>

                        <!-- White Logo -->
                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-3">White Logo (For Dark Backgrounds)</label>
                            <div class="rounded-lg p-6 mb-3 flex items-center justify-center" style="background-color: {{ $settings['primary_color'] }};">
                                <img src="{{ $settings['logo_light'] }}" alt="White Logo" class="h-20 w-auto">
                            </div>
                            <input type="url" name="logo_light" value="{{ $settings['logo_light'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-[#0D1B36]" placeholder="Enter logo URL">
                        </div>
                    </div>
                </div>

                <!-- Favicon Settings -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center" style="color: {{ $settings['primary_color'] }};">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Favicon Settings
                    </h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-2">32x32</label>
                            <div class="bg-gray-50 rounded-lg p-4 mb-2 flex items-center justify-center">
                                <img src="{{ $settings['favicon_32'] }}" alt="Favicon 32x32" class="h-8 w-8">
                            </div>
                            <input type="url" name="favicon_32" value="{{ $settings['favicon_32'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="Favicon URL">
                        </div>

                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-2">180x180</label>
                            <div class="bg-gray-50 rounded-lg p-4 mb-2 flex items-center justify-center">
                                <img src="{{ $settings['favicon_180'] }}" alt="Favicon 180x180" class="h-12 w-12">
                            </div>
                            <input type="url" name="favicon_180" value="{{ $settings['favicon_180'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="Favicon URL">
                        </div>

                        <div class="border-2 border-gray-200 rounded-lg p-4">
                            <label class="block text-sm font-medium text-[#0D1B36] mb-2">512x512</label>
                            <div class="bg-gray-50 rounded-lg p-4 mb-2 flex items-center justify-center">
                                <img src="{{ $settings['favicon_512'] }}" alt="Favicon 512x512" class="h-16 w-16">
                            </div>
                            <input type="url" name="favicon_512" value="{{ $settings['favicon_512'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="Favicon URL">
                        </div>
                    </div>
                </div>

                <!-- Font Settings -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center" style="color: {{ $settings['primary_color'] }};">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                        Font Settings
                    </h3>
                    <div class="border-2 border-gray-200 rounded-lg p-4">
                        <label class="block text-sm font-medium text-[#0D1B36] mb-3">Primary Font</label>
                        <select name="font_family" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-[#0D1B36]">
                            <option value="Inter" {{ ($settings['font_family'] ?? 'Inter') == 'Inter' ? 'selected' : '' }}>Inter (Default)</option>
                            <option value="Roboto" {{ ($settings['font_family'] ?? '') == 'Roboto' ? 'selected' : '' }}>Roboto</option>
                            <option value="Open Sans" {{ ($settings['font_family'] ?? '') == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                            <option value="Lato" {{ ($settings['font_family'] ?? '') == 'Lato' ? 'selected' : '' }}>Lato</option>
                            <option value="Montserrat" {{ ($settings['font_family'] ?? '') == 'Montserrat' ? 'selected' : '' }}>Montserrat</option>
                            <option value="Poppins" {{ ($settings['font_family'] ?? '') == 'Poppins' ? 'selected' : '' }}>Poppins</option>
                            <option value="Source Sans Pro" {{ ($settings['font_family'] ?? '') == 'Source Sans Pro' ? 'selected' : '' }}>Source Sans Pro</option>
                        </select>
                        <p class="text-xs text-gray-600 mt-2">Select the primary font for your application</p>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit" class="px-6 py-3 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 font-medium hover:opacity-90" style="background-color: {{ $settings['secondary_color'] }};">
                        Save Theme Settings
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Update hex input when color picker changes
document.querySelectorAll('input[type="color"]').forEach(input => {
    input.addEventListener('input', function() {
        const hexInput = this.parentElement.querySelector('input[type="text"]');
        if (hexInput) {
            hexInput.value = this.value.toUpperCase();
        }
    });
});
</script>
@endsection

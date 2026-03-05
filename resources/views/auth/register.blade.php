<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Realty CRM</title>
    
    @php
        $theme = App\Models\ThemeSetting::getAll();
    @endphp
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $theme['favicon_32'] }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ str_replace(' ', '+', $theme['font_family']) }}:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            font-family: '{{ $theme['font_family'] }}', sans-serif !important;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Left Section - Branding -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden" style="background-color: {{ $theme['primary_color'] }};">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="url(#grid)" />
                    <defs>
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                        </pattern>
                    </defs>
                </svg>
            </div>
            
            <div class="relative z-10 flex flex-col justify-center px-16 w-full" style="color: white;">
                <div class="mb-8">
                    <img src="{{ $theme['logo_light'] }}" alt="Logo" class="h-16 w-16 mb-6">
                    <h1 class="text-5xl font-bold text-white mb-4">Join Realty CRM</h1>
                    <p class="text-xl text-white opacity-90">Start managing your real estate business today</p>
                </div>
                
                <div class="mt-12 space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Easy Setup</h3>
                            <p class="text-white opacity-75">Get started in minutes with our simple registration</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Secure & Private</h3>
                            <p class="text-white opacity-75">Your data is protected with enterprise-grade security</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">24/7 Support</h3>
                            <p class="text-white opacity-75">Get help whenever you need it from our team</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-2" style="color: {{ $theme['primary_color'] }};">Create Account</h2>
                    <p class="text-gray-600">Fill in your details to get started</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="text-sm text-red-700 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2 text-gray-700">Full Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            required
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all"
                            style="--tw-ring-color: {{ $theme['primary_color'] }};"
                            placeholder="John Doe"
                            value="{{ old('name') }}"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-2 text-gray-700">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all"
                            style="--tw-ring-color: {{ $theme['primary_color'] }};"
                            placeholder="your@email.com"
                            value="{{ old('email') }}"
                        >
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium mb-2 text-gray-700">Account Type</label>
                        <select 
                            id="role" 
                            name="role" 
                            required
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all"
                            style="--tw-ring-color: {{ $theme['primary_color'] }};"
                        >
                            <option value="">Select account type</option>
                            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner - Full property management access</option>
                            <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>Agent - Manage properties and clients</option>
                            <option value="viewer" {{ old('role') == 'viewer' ? 'selected' : '' }}>Viewer - View properties and listings</option>
                        </select>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium mb-2 text-gray-700">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all"
                            style="--tw-ring-color: {{ $theme['primary_color'] }};"
                            placeholder="••••••••"
                        >
                        <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium mb-2 text-gray-700">Confirm Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all"
                            style="--tw-ring-color: {{ $theme['primary_color'] }};"
                            placeholder="••••••••"
                        >
                    </div>

                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            id="terms" 
                            name="terms" 
                            required
                            class="w-4 h-4 mt-1 rounded border-gray-300 focus:ring-offset-0" 
                            style="color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['primary_color'] }};"
                        >
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            I agree to the <a href="#" class="hover:underline" style="color: {{ $theme['primary_color'] }};">Terms of Service</a> and <a href="#" class="hover:underline" style="color: {{ $theme['primary_color'] }};">Privacy Policy</a>
                        </label>
                    </div>

                    <button 
                        type="submit"
                        class="w-full py-3 px-4 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200"
                        style="background-color: {{ $theme['primary_color'] }};"
                    >
                        Create Account
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium hover:underline" style="color: {{ $theme['primary_color'] }};">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

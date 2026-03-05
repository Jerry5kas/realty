<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Realty CRM</title>
    
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
            
            <div class="relative z-10 flex flex-col justify-center px-16 w-full " style="color: white;">
                <div class="mb-8">
                    <img src="{{ $theme['logo_light'] }}" alt="Logo" class="h-16 w-16 mb-6">
                    <h1 class="text-5xl font-bold text-white mb-4">Welcome to<br>Realty CRM</h1>
                    <p class="text-xl text-white opacity-90">Manage your real estate business with ease</p>
                </div>
                
                <div class="mt-12 space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Property Management</h3>
                            <p class="text-white opacity-75">Manage properties, projects, and listings</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Client Management</h3>
                            <p class="text-white opacity-75">Track clients, leads, and transactions</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">Analytics & Reports</h3>
                            <p class="text-white opacity-75">Get insights and track performance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-2" style="color: {{ $theme['primary_color'] }};">Sign In</h2>
                    <p class="text-gray-600">Enter your credentials to access your account</p>
                </div>

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    
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
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 focus:ring-offset-0" style="color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['primary_color'] }};">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm hover:underline" style="color: {{ $theme['primary_color'] }};">Forgot password?</a>
                    </div>

                    <button 
                        type="submit"
                        class="w-full py-3 px-4 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200"
                        style="background-color: {{ $theme['primary_color'] }};"
                    >
                        Sign In
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium hover:underline" style="color: {{ $theme['primary_color'] }};">Sign up</a>
                    </p>
                </div>

                <!-- Quick Login (Demo) -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-xs text-center mb-3 text-gray-500">Quick Login (Demo)</p>
                    <div class="grid grid-cols-2 gap-2">
                        <button onclick="quickLogin('admin@realty.com')" class="px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 hover:border-gray-400 transition-all" style="color: {{ $theme['primary_color'] }};">
                            Admin
                        </button>
                        <button onclick="quickLogin('owner@realty.com')" class="px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 hover:border-gray-400 transition-all" style="color: {{ $theme['primary_color'] }};">
                            Owner
                        </button>
                        <button onclick="quickLogin('agent@realty.com')" class="px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 hover:border-gray-400 transition-all" style="color: {{ $theme['primary_color'] }};">
                            Agent
                        </button>
                        <button onclick="quickLogin('viewer@realty.com')" class="px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 hover:border-gray-400 transition-all" style="color: {{ $theme['primary_color'] }};">
                            Viewer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function quickLogin(email) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = '12345678';
        }
    </script>
</body>
</html>

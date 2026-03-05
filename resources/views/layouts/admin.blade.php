<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Realty CRM</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $theme['favicon_32'] }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $theme['favicon_180'] }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ $theme['favicon_512'] }}">
    
    <!-- Dynamic Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ str_replace(' ', '+', $theme['font_family']) }}:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- CRUD Actions -->
    <script src="{{ asset('js/crud-actions.js') }}"></script>
    
    <style>
        * {
            font-family: '{{ $theme['font_family'] }}', sans-serif !important;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-white">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-2xl" style="background: linear-gradient(to bottom, {{ $theme['primary_color'] }}, {{ $theme['accent_color'] }});">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center h-20 border-b px-4" style="border-color: {{ $theme['secondary_color'] }}33;">
                    <img src="{{ $theme['logo_light'] }}" alt="Area 24 Realty" class="h-12 w-auto">
                    <div class="ml-3">
                        <h1 class="text-white font-bold text-lg leading-tight">AREA24</h1>
                        <p class="text-xs font-semibold tracking-wide" style="color: {{ $theme['secondary_color'] }};">REALTY</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto px-3 py-6 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('dashboard') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('dashboard') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Listings Group -->
                    <div class="pt-6 pb-2">
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-yellow-500">Listings</h3>
                    </div>

                    <!-- Properties -->
                    <a href="{{ route('properties.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('properties.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('properties.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('properties.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('properties.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="font-medium">Properties</span>
                    </a>

                    <!-- Projects -->
                    <a href="{{ route('projects.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('projects.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('projects.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('projects.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('projects.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="font-medium">Projects</span>
                    </a>

                    <!-- Master Data Group -->
                    <div class="pt-6 pb-2">
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-yellow-500">Master Data</h3>
                    </div>

                    <!-- Cities -->
                    <a href="{{ route('cities.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('cities.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('cities.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('cities.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('cities.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Cities</span>
                    </a>

                    <!-- Amenities -->
                    <a href="{{ route('amenities.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('amenities.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('amenities.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('amenities.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('amenities.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Amenities</span>
                    </a>

                    <!-- Features -->
                    <a href="{{ route('features.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('features.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('features.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('features.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('features.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                        <span class="font-medium">Features</span>
                    </a>

                    <!-- Property Types -->
                    <a href="{{ route('property-types.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('property-types.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('property-types.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('property-types.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('property-types.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span class="font-medium">Property Types</span>
                    </a>

                    <!-- Builders -->
                    <a href="{{ route('builders.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('builders.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('builders.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('builders.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('builders.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="font-medium">Builders</span>
                    </a>

                    <!-- Content Management Group -->
                    <div class="pt-6 pb-2">
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-yellow-500">Content</h3>
                    </div>

                    <!-- Banners -->
                    <a href="{{ route('banners.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('banners.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('banners.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('banners.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('banners.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Banners</span>
                    </a>

                    <!-- Media Assets -->
                    <a href="{{ route('media-assets.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('media-assets.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('media-assets.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('media-assets.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('media-assets.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span class="font-medium">Media Assets</span>
                    </a>

                    <!-- Users & CRM Group -->
                    <div class="pt-6 pb-2">
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-yellow-500">Users & CRM</h3>
                    </div>

                    <!-- Users (System Access) -->
                    <a href="{{ route('users.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('users.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('users.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('users.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="font-medium">Users</span>
                    </a>

                    <!-- Roles & Permissions -->
                    <a href="{{ route('roles.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('roles.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('roles.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('roles.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('roles.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="font-medium">Roles & Permissions</span>
                    </a>

                    <!-- Owners (Property Owners CRM) -->
                    <a href="#" class="group flex items-center px-3 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium">Owners</span>
                        <span class="ml-auto text-xs px-2 py-0.5 bg-yellow-500/20 text-yellow-300 rounded-full">Soon</span>
                    </a>

                    <!-- Agents (Real Estate Agents) -->
                    <a href="#" class="group flex items-center px-3 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Agents</span>
                        <span class="ml-auto text-xs px-2 py-0.5 bg-yellow-500/20 text-yellow-300 rounded-full">Soon</span>
                    </a>

                    <!-- Clients (Customers/Leads) -->
                    <a href="#" class="group flex items-center px-3 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">Clients</span>
                        <span class="ml-auto text-xs px-2 py-0.5 bg-yellow-500/20 text-yellow-300 rounded-full">Soon</span>
                    </a>

                    <!-- Leads -->
                    <a href="#" class="group flex items-center px-3 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="font-medium">Leads</span>
                        <span class="ml-auto text-xs px-2 py-0.5 bg-yellow-500/20 text-yellow-300 rounded-full">Soon</span>
                    </a>

                    <!-- Other Group -->
                    <div class="pt-6 pb-2">
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-yellow-500">Other</h3>
                    </div>

                    <!-- Transactions -->
                    <a href="{{ route('transactions.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('transactions.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('transactions.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('transactions.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('transactions.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="font-medium">Transactions</span>
                    </a>

                    <!-- Calendar -->
                    <a href="{{ route('events.index') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('events.*') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('events.*') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('events.*') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('events.*') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Calendar</span>
                    </a>

                    <!-- Reports -->
                    <a href="#" class="group flex items-center px-3 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="font-medium">Reports</span>
                    </a>

                    <!-- Divider -->
                    <div class="pt-4 pb-2">
                        <div class="border-t border-white/10"></div>
                    </div>

                    <!-- Settings -->
                    <a href="{{ route('theme.settings') }}" class="group flex items-center px-3 py-3 hover:bg-white/10 rounded-xl transition-all duration-200 {{ request()->routeIs('theme.settings') ? 'shadow-lg' : 'text-white' }}" style="{{ request()->routeIs('theme.settings') ? 'background-color: ' . $theme['secondary_color'] . '; color: ' . $theme['primary_color'] . ';' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('theme.settings') ? '' : 'text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="{{ request()->routeIs('theme.settings') ? 'color: ' . $theme['primary_color'] . ';' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Settings</span>
                    </a>
                </nav>

                <!-- User Profile -->
                <div class="border-t border-white/10 p-4">
                    <div class="flex items-center px-3 py-2 rounded-xl bg-white/5 hover:bg-white/10 transition-all cursor-pointer">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg" style="background: linear-gradient(to bottom right, {{ $theme['secondary_color'] }}, {{ $theme['primary_color'] }});">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="ml-3 flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs font-medium" style="color: {{ $theme['secondary_color'] }};">
                                @if(auth()->user()->roles->isNotEmpty())
                                    {{ auth()->user()->roles->first()->name }}
                                @else
                                    {{ ucfirst(auth()->user()->role) }}
                                @endif
                            </p>
                        </div>
                        <svg class="w-4 h-4 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-white border-b border-gray-200 h-20">
                <div class="flex items-center justify-between h-full px-4 lg:px-8">
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="lg:hidden transition-colors" style="color: {{ $theme['primary_color'] }};">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <h1 class="text-2xl font-bold" style="color: {{ $theme['primary_color'] }};">@yield('page-title', 'Dashboard')</h1>

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-4">
                        <button class="transition-colors" style="color: {{ $theme['primary_color'] }};">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </button>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-white rounded-lg transition-colors font-medium hover:opacity-90" style="background-color: {{ $theme['secondary_color'] }};">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    </script>
    
    @stack('scripts')
</body>
</html>

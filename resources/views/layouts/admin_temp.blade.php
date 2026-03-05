<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-white/60">Listings</h3>
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
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-white/60">Master Data</h3>
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
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-white/60">Content</h3>
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
                        <h3 class="px-3 text-xs font-semibold uppercase tracking-wider text-white/60">Users & CRM</h3>
                    </div>

                    <!-- Agents -->
                    <a href="#" class="group flex items-center px-3 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Agents</span>
                    </a>

                    <!-- Clients -->
                    <a href="#" class="group flex items-center px-3 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">Clients</span>
                    </a>

                    <!-- Leads -->
                    <a href="#" class="group flex items-center px-3 py-3 text-white hover:bg-white/10 rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="font-medium">Leads</span>
                        <span class="ml-auto bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">New</span>
                    </a>

@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Stats Cards -->
    <div class="bg-white rounded-xl shadow-md border-l-4 border-[#19376D] p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-[#0D1B36] mb-1">Total Properties</p>
                <p class="text-2xl font-bold text-[#19376D]">0</p>
            </div>
            <div class="w-12 h-12 bg-[#19376D]/10 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-[#19376D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md border-l-4 border-[#D4AF37] p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-[#0D1B36] mb-1">Active Users</p>
                <p class="text-2xl font-bold text-[#19376D]">0</p>
            </div>
            <div class="w-12 h-12 bg-[#D4AF37]/10 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md border-l-4 border-[#0D1B36] p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-[#0D1B36] mb-1">Total Agents</p>
                <p class="text-2xl font-bold text-[#19376D]">0</p>
            </div>
            <div class="w-12 h-12 bg-[#0D1B36]/10 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-[#0D1B36]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md border-l-4 border-green-500 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-[#0D1B36] mb-1">Revenue</p>
                <p class="text-2xl font-bold text-[#19376D]">$0</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Card -->
<div class="bg-white rounded-2xl shadow-lg border-2 border-[#19376D] overflow-hidden">
    <div class="bg-[#19376D] px-6 py-4 border-b border-[#D4AF37]">
        <h2 class="text-xl font-semibold text-white">Welcome to Realty CRM</h2>
    </div>
    <div class="p-6">
        <p class="text-[#0D1B36] mb-4">Your real estate CRM dashboard will be built here.</p>
        <div class="grid md:grid-cols-2 gap-4">
            <div class="border-2 border-[#19376D]/20 rounded-lg p-4">
                <h3 class="font-semibold text-[#19376D] mb-2">Quick Actions</h3>
                <ul class="space-y-2 text-sm text-[#0D1B36]">
                    <li><a href="{{ route('properties.create') }}" class="text-[#19376D] hover:underline">• Add new property</a></li>
                    <li><a href="{{ route('projects.create') }}" class="text-[#19376D] hover:underline">• Add new project</a></li>
                    <li><a href="{{ route('cities.create') }}" class="text-[#19376D] hover:underline">• Add new city</a></li>
                </ul>
            </div>
            <div class="border-2 border-[#19376D]/20 rounded-lg p-4">
                <h3 class="font-semibold text-[#19376D] mb-2">Recent Activity</h3>
                <p class="text-sm text-[#0D1B36]">No recent activity to display</p>
            </div>
        </div>
    </div>
</div>
@endsection

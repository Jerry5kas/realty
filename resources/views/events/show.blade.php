@extends('layouts.admin')

@section('title', 'Event Details')
@section('page-title', 'Event Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Events', 'url' => route('events.index')],
        ['label' => 'Event Details', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b flex justify-between items-center" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">{{ $event->title }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('events.edit', $event) }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
            </div>
        </div>

        <div class="p-4 md:p-6 space-y-6">
            <!-- Status Badges -->
            <div class="flex flex-wrap gap-2">
                @if($event->status === 'scheduled')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">Scheduled</span>
                @elseif($event->status === 'completed')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                @elseif($event->status === 'cancelled')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                @else
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-orange-100 text-orange-800">Rescheduled</span>
                @endif

                @if($event->priority === 'high')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">High Priority</span>
                @elseif($event->priority === 'medium')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Medium Priority</span>
                @else
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">Low Priority</span>
                @endif

                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                    {{ ucfirst(str_replace('-', ' ', $event->event_type)) }}
                </span>
            </div>

            <!-- Description -->
            @if($event->description)
                <div>
                    <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Description</h3>
                    <p class="text-gray-700">{{ $event->description }}</p>
                </div>
            @endif

            <!-- Date & Time -->
            <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Date & Time</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Start</p>
                        <p class="font-medium">{{ $event->start_date->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-600">{{ $event->start_date->format('h:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">End</p>
                        <p class="font-medium">{{ $event->end_date->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-600">{{ $event->end_date->format('h:i A') }}</p>
                    </div>
                </div>
                @if($event->all_day)
                    <p class="mt-2 text-sm text-gray-600">🕐 All Day Event</p>
                @endif
            </div>

            <!-- Location -->
            @if($event->location)
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Location</h3>
                    <p class="text-gray-700">📍 {{ $event->location }}</p>
                </div>
            @endif

            <!-- Associations -->
            @if($event->property || $event->project)
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Linked To</h3>
                    <div class="space-y-2">
                        @if($event->property)
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-500">Property</p>
                                <a href="{{ route('properties.show', $event->property) }}" class="font-medium hover:underline" style="color: {{ $theme['secondary_color'] }};">
                                    {{ $event->property->title }}
                                </a>
                            </div>
                        @endif
                        @if($event->project)
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-500">Project</p>
                                <a href="{{ route('projects.show', $event->project) }}" class="font-medium hover:underline" style="color: {{ $theme['secondary_color'] }};">
                                    {{ $event->project->name }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- People -->
            <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                <h3 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">People</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Created By</p>
                        <p class="font-medium">{{ $event->user->name }}</p>
                    </div>
                    @if($event->assignedUser)
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Assigned To</p>
                            <p class="font-medium">{{ $event->assignedUser->name }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Reminder -->
            @if($event->send_reminder)
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Reminder</h3>
                    <p class="text-gray-700">🔔 {{ $event->reminder_minutes }} minutes before event</p>
                </div>
            @endif

            <!-- Notes -->
            @if($event->notes)
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h3 class="font-semibold mb-2" style="color: {{ $theme['primary_color'] }};">Notes</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $event->notes }}</p>
                </div>
            @endif

            <!-- Timestamps -->
            <div class="border-t pt-6 text-sm text-gray-500" style="border-color: {{ $theme['primary_color'] }}20;">
                <p>Created: {{ $event->created_at->format('M d, Y h:i A') }}</p>
                <p>Last Updated: {{ $event->updated_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

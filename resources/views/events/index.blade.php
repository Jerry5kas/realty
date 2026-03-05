@extends('layouts.admin')

@section('title', 'Events')
@section('page-title', 'Calendar & Events')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Events', 'url' => '']
    ]" />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-300 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <x-search-bar 
                placeholder="Search events by title, description, or location..." 
                :action="route('events.index')"
                :value="request('search')"
            />
        </div>
        <a href="{{ route('events.calendar') }}" class="px-4 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center flex items-center gap-2" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Calendar View
        </a>
        <button 
            id="bulkDeleteBtn" 
            onclick="bulkDelete('event-checkbox', 'bulkDeleteForm', 'Are you sure you want to delete the selected events?')" 
            class="hidden p-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all flex items-center gap-2"
            title="Delete Selected"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span class="hidden md:inline">Delete</span>
            <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs font-semibold" id="selectedCount">0</span>
        </button>
    </div>

    <!-- Filters -->
    <div class="mb-6 bg-white rounded-xl shadow-sm border p-4">
        <form method="GET" action="{{ route('events.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <select name="event_type" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="viewing" {{ request('event_type') === 'viewing' ? 'selected' : '' }}>Viewing</option>
                <option value="meeting" {{ request('event_type') === 'meeting' ? 'selected' : '' }}>Meeting</option>
                <option value="follow-up" {{ request('event_type') === 'follow-up' ? 'selected' : '' }}>Follow-up</option>
                <option value="site-visit" {{ request('event_type') === 'site-visit' ? 'selected' : '' }}>Site Visit</option>
                <option value="deadline" {{ request('event_type') === 'deadline' ? 'selected' : '' }}>Deadline</option>
                <option value="marketing" {{ request('event_type') === 'marketing' ? 'selected' : '' }}>Marketing</option>
                <option value="other" {{ request('event_type') === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <select name="status" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="scheduled" {{ request('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="rescheduled" {{ request('status') === 'rescheduled' ? 'selected' : '' }}>Rescheduled</option>
            </select>
            <select name="priority" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Priority</option>
                <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
            </select>
            <select name="date_filter" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Dates</option>
                <option value="today" {{ request('date_filter') === 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date_filter') === 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date_filter') === 'month' ? 'selected' : '' }}>This Month</option>
                <option value="upcoming" {{ request('date_filter') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
            </select>
            <select name="assigned_to" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-offset-0" style="border-color: {{ $theme['primary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};" onchange="this.form.submit()">
                <option value="">All Assignees</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('assigned_to') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <form id="bulkDeleteForm" action="{{ route('events.bulk-delete') }}" method="POST">
        @csrf
        <x-data-table
            title="Events Management"
            description="Manage all calendar events and schedules"
            :createRoute="route('events.create')"
            createLabel="Add Event"
            :columns="[
                ['label' => 'Select', 'field' => 'checkbox'],
                ['label' => 'Event', 'field' => 'title'],
                ['label' => 'Type', 'field' => 'event_type'],
                ['label' => 'Date & Time', 'field' => 'start_date'],
                ['label' => 'Assigned To', 'field' => 'assigned_to'],
                ['label' => 'Priority', 'field' => 'priority'],
                ['label' => 'Status', 'field' => 'status']
            ]"
        >
            <tr style="background-color: {{ $theme['primary_color'] }}05;">
                <td class="px-4 md:px-6 py-3">
                    <input 
                        type="checkbox" 
                        id="selectAll"
                        class="w-4 h-4 rounded focus:ring-offset-0" 
                        style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                        onchange="toggleSelectAll(this, 'event-checkbox')"
                    >
                </td>
                <td colspan="7" class="px-4 md:px-6 py-3 text-xs font-medium" style="color: {{ $theme['primary_color'] }};">
                    Select All
                </td>
            </tr>
            @forelse($events as $event)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <input 
                            type="checkbox" 
                            name="ids[]" 
                            value="{{ $event->id }}" 
                            class="event-checkbox w-4 h-4 rounded focus:ring-offset-0" 
                            style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['secondary_color'] }}; --tw-ring-color: {{ $theme['secondary_color'] }};"
                            onchange="updateBulkDeleteButton('event-checkbox')"
                        >
                    </td>
                    <td class="px-4 md:px-6 py-4">
                        <div class="font-medium" style="color: {{ $theme['primary_color'] }};">
                            <a href="{{ route('events.show', $event) }}" class="hover:underline">{{ $event->title }}</a>
                        </div>
                        @if($event->location)
                            <div class="text-xs text-gray-500 mt-1">📍 {{ $event->location }}</div>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ ucfirst(str_replace('-', ' ', $event->event_type)) }}
                        </span>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">
                        <div>{{ $event->start_date->format('M d, Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $event->start_date->format('h:i A') }} - {{ $event->end_date->format('h:i A') }}</div>
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: {{ $theme['accent_color'] }};">
                        {{ $event->assignedUser->name ?? '-' }}
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($event->priority === 'high')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">High</span>
                        @elseif($event->priority === 'medium')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Medium</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Low</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        @if($event->status === 'scheduled')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Scheduled</span>
                        @elseif($event->status === 'completed')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                        @elseif($event->status === 'cancelled')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">Rescheduled</span>
                        @endif
                    </td>
                    <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                        <x-table-actions 
                            :editRoute="route('events.edit', $event)" 
                            :deleteRoute="route('events.destroy', $event)"
                            deleteMessage="Delete {{ $event->title }}?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        No events found. <a href="{{ route('events.create') }}" class="font-medium" style="color: {{ $theme['secondary_color'] }};">Add your first event</a>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </form>

    @if($events->hasPages())
        <div class="mt-6">
            {{ $events->links() }}
        </div>
    @endif
</div>


@endsection


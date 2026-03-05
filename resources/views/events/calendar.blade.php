@extends('layouts.admin')

@section('title', 'Calendar')
@section('page-title', 'Calendar View')

@section('content')
<div class="max-w-7xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Events', 'url' => route('events.index')],
        ['label' => 'Calendar', 'url' => '']
    ]" />

    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('events.calendar', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}" class="p-2 border-2 rounded-lg hover:bg-gray-50 transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="text-xl font-bold" style="color: {{ $theme['primary_color'] }};">
                {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}
            </h2>
            <a href="{{ route('events.calendar', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}" class="p-2 border-2 rounded-lg hover:bg-gray-50 transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('events.index') }}" class="px-4 py-2 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all flex items-center gap-2" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                List View
            </a>
            <a href="{{ route('events.create') }}" class="px-4 py-2 text-white rounded-xl font-medium hover:opacity-90 transition-all flex items-center gap-2" style="background-color: {{ $theme['secondary_color'] }};">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Event
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <!-- Calendar Header -->
        <div class="grid grid-cols-7 border-b" style="border-color: {{ $theme['primary_color'] }};">
            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                <div class="px-2 py-3 text-center font-semibold text-sm" style="background-color: {{ $theme['primary_color'] }}; color: white;">
                    {{ $day }}
                </div>
            @endforeach
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7">
            @php
                $firstDay = \Carbon\Carbon::create($year, $month, 1);
                $daysInMonth = $firstDay->daysInMonth;
                $startDayOfWeek = $firstDay->dayOfWeek;
                $today = \Carbon\Carbon::today();
                
                // Group events by date
                $eventsByDate = $events->groupBy(function($event) {
                    return $event->start_date->format('Y-m-d');
                });
            @endphp

            {{-- Empty cells before first day --}}
            @for($i = 0; $i < $startDayOfWeek; $i++)
                <div class="min-h-[120px] p-2 border-b border-r bg-gray-50" style="border-color: {{ $theme['primary_color'] }}20;"></div>
            @endfor

            {{-- Days of the month --}}
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $currentDate = \Carbon\Carbon::create($year, $month, $day);
                    $dateKey = $currentDate->format('Y-m-d');
                    $dayEvents = $eventsByDate->get($dateKey, collect());
                    $isToday = $currentDate->isSameDay($today);
                @endphp
                <div class="min-h-[120px] p-2 border-b border-r hover:bg-gray-50 transition-colors {{ $isToday ? 'bg-blue-50' : '' }}" style="border-color: {{ $theme['primary_color'] }}20;">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm font-semibold {{ $isToday ? 'text-white px-2 py-1 rounded-full' : '' }}" style="{{ $isToday ? 'background-color: ' . $theme['secondary_color'] : 'color: ' . $theme['primary_color'] }};">
                            {{ $day }}
                        </span>
                    </div>
                    <div class="space-y-1">
                        @foreach($dayEvents->take(3) as $event)
                            <a href="{{ route('events.show', $event) }}" class="block p-1 rounded text-xs hover:opacity-80 transition-all" 
                               style="background-color: {{ $event->priority === 'high' ? '#fee2e2' : ($event->priority === 'medium' ? '#fef3c7' : '#e0e7ff') }}; 
                                      color: {{ $event->priority === 'high' ? '#991b1b' : ($event->priority === 'medium' ? '#92400e' : '#3730a3') }};"
                               title="{{ $event->title }} - {{ $event->start_date->format('h:i A') }}">
                                <div class="font-semibold truncate">{{ $event->start_date->format('h:i A') }}</div>
                                <div class="truncate">{{ $event->title }}</div>
                            </a>
                        @endforeach
                        @if($dayEvents->count() > 3)
                            <div class="text-xs text-gray-500 pl-1">+{{ $dayEvents->count() - 3 }} more</div>
                        @endif
                    </div>
                </div>
            @endfor

            {{-- Empty cells after last day --}}
            @php
                $lastDay = \Carbon\Carbon::create($year, $month, $daysInMonth);
                $endDayOfWeek = $lastDay->dayOfWeek;
                $emptyCellsAfter = 6 - $endDayOfWeek;
            @endphp
            @for($i = 0; $i < $emptyCellsAfter; $i++)
                <div class="min-h-[120px] p-2 border-b border-r bg-gray-50" style="border-color: {{ $theme['primary_color'] }}20;"></div>
            @endfor
        </div>
    </div>

    <!-- Legend -->
    <div class="mt-6 flex flex-wrap gap-4 justify-center">
        <div class="flex items-center gap-2">
            <div class="w-4 h-4 rounded" style="background-color: #fee2e2;"></div>
            <span class="text-sm text-gray-600">High Priority</span>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-4 h-4 rounded" style="background-color: #fef3c7;"></div>
            <span class="text-sm text-gray-600">Medium Priority</span>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-4 h-4 rounded" style="background-color: #e0e7ff;"></div>
            <span class="text-sm text-gray-600">Low Priority</span>
        </div>
    </div>
</div>
@endsection

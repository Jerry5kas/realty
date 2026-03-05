@extends('layouts.admin')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Events', 'url' => route('events.index')],
        ['label' => 'Edit Event', 'url' => '']
    ]" />

    <div class="bg-white rounded-2xl shadow-lg border-2 overflow-hidden" style="border-color: {{ $theme['primary_color'] }};">
        <div class="px-4 md:px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }}; border-color: {{ $theme['secondary_color'] }};">
            <h2 class="text-lg md:text-xl font-semibold" style="color: white;">Edit Event</h2>
        </div>

        <form action="{{ route('events.update', $event) }}" method="POST" class="p-4 md:p-6">
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
            
            <div class="space-y-6">
                <!-- Basic Info -->
                <div>
                    <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Event Details</h4>
                    <div class="space-y-4">
                        <x-form-input label="Event Title" name="title" :required="true" :value="$event->title" placeholder="Enter event title" />
                        <x-form-textarea label="Description" name="description" rows="3" :value="$event->description" placeholder="Enter event description" />
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-form-select label="Event Type" name="event_type" :required="true" :value="$event->event_type" :options="[
                                'viewing' => 'Property Viewing',
                                'meeting' => 'Client Meeting',
                                'follow-up' => 'Follow-up',
                                'site-visit' => 'Site Visit',
                                'deadline' => 'Deadline',
                                'marketing' => 'Marketing Activity',
                                'other' => 'Other'
                            ]" />
                            <x-form-input label="Location" name="location" :value="$event->location" placeholder="Enter location" />
                        </div>
                    </div>
                </div>

                <!-- Date & Time -->
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Date & Time</h4>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-form-input label="Start Date & Time" name="start_date" type="datetime-local" :required="true" :value="$event->start_date->format('Y-m-d\TH:i')" />
                            <x-form-input label="End Date & Time" name="end_date" type="datetime-local" :required="true" :value="$event->end_date->format('Y-m-d\TH:i')" />
                        </div>
                        <x-form-checkbox label="All Day Event" name="all_day" :checked="$event->all_day" />
                    </div>
                </div>

                <!-- Associations -->
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Link to Property/Project</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-form-select label="Property" name="property_id" :value="$event->property_id" :options="$properties->pluck('title', 'id')->toArray()" placeholder="Select Property (Optional)" />
                        <x-form-select label="Project" name="project_id" :value="$event->project_id" :options="$projects->pluck('name', 'id')->toArray()" placeholder="Select Project (Optional)" />
                    </div>
                </div>

                <!-- Assignment & Priority -->
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Assignment & Priority</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-form-select label="Assign To" name="assigned_to" :value="$event->assigned_to" :options="$users->pluck('name', 'id')->toArray()" placeholder="Select User (Optional)" />
                        <x-form-select label="Priority" name="priority" :required="true" :value="$event->priority" :options="[
                            'low' => 'Low',
                            'medium' => 'Medium',
                            'high' => 'High'
                        ]" />
                        <x-form-select label="Status" name="status" :required="true" :value="$event->status" :options="[
                            'scheduled' => 'Scheduled',
                            'completed' => 'Completed',
                            'cancelled' => 'Cancelled',
                            'rescheduled' => 'Rescheduled'
                        ]" />
                    </div>
                </div>

                <!-- Reminder -->
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Reminder Settings</h4>
                    <div class="space-y-4">
                        <x-form-checkbox label="Send Reminder" name="send_reminder" :checked="$event->send_reminder" />
                        <x-form-input label="Reminder (Minutes Before)" name="reminder_minutes" type="number" :value="$event->reminder_minutes" min="0" placeholder="30" />
                    </div>
                </div>

                <!-- Notes -->
                <div class="border-t pt-6" style="border-color: {{ $theme['primary_color'] }}20;">
                    <h4 class="font-semibold mb-4" style="color: {{ $theme['primary_color'] }};">Additional Notes</h4>
                    <x-form-textarea label="Notes" name="notes" rows="3" :value="$event->notes" placeholder="Enter any additional notes" />
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('events.index') }}" class="px-6 py-3 border-2 rounded-xl font-medium hover:bg-gray-50 transition-all text-center" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all" style="background-color: {{ $theme['secondary_color'] }};">
                    Update Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

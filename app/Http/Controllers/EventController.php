<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Property;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['property', 'project', 'user', 'assignedUser']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }
        if ($request->filled('date_filter')) {
            switch ($request->date_filter) {
                case 'today':
                    $query->today();
                    break;
                case 'week':
                    $query->thisWeek();
                    break;
                case 'month':
                    $query->thisMonth();
                    break;
                case 'upcoming':
                    $query->upcoming();
                    break;
            }
        }

        $events = $query->orderBy('start_date', 'desc')->paginate(15);
        $users = User::all();

        return view('events.index', compact('events', 'users'));
    }

    public function calendar(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);
        
        $events = Event::with(['property', 'project', 'assignedUser'])
            ->whereYear('start_date', $year)
            ->whereMonth('start_date', $month)
            ->get();

        return view('events.calendar', compact('events', 'month', 'year'));
    }

    public function create()
    {
        $properties = Property::where('status', '!=', 'sold')->get();
        $projects = Project::where('publish_status', 'published')->get();
        $users = User::all();

        return view('events.create', compact('properties', 'projects', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type' => 'required|in:viewing,meeting,follow-up,site-visit,deadline,marketing,other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'all_day' => 'boolean',
            'location' => 'nullable|string|max:255',
            'property_id' => 'nullable|exists:properties,id',
            'project_id' => 'nullable|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:scheduled,completed,cancelled,rescheduled',
            'priority' => 'required|in:low,medium,high',
            'send_reminder' => 'boolean',
            'reminder_minutes' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['all_day'] = $request->has('all_day');
        $validated['send_reminder'] = $request->has('send_reminder');

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $event->load(['property', 'project', 'user', 'assignedUser']);
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $properties = Property::where('status', '!=', 'sold')->get();
        $projects = Project::where('publish_status', 'published')->get();
        $users = User::all();

        return view('events.edit', compact('event', 'properties', 'projects', 'users'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_type' => 'required|in:viewing,meeting,follow-up,site-visit,deadline,marketing,other',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'all_day' => 'boolean',
            'location' => 'nullable|string|max:255',
            'property_id' => 'nullable|exists:properties,id',
            'project_id' => 'nullable|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:scheduled,completed,cancelled,rescheduled',
            'priority' => 'required|in:low,medium,high',
            'send_reminder' => 'boolean',
            'reminder_minutes' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $validated['all_day'] = $request->has('all_day');
        $validated['send_reminder'] = $request->has('send_reminder');

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:events,id'
        ]);

        Event::whereIn('id', $request->ids)->delete();

        return redirect()->route('events.index')
            ->with('success', count($request->ids) . ' event(s) deleted successfully.');
    }
}


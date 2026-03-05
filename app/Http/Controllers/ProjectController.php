<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\City;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['city', 'builder']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('developer_name', 'like', "%{$search}%")
                  ->orWhere('locality', 'like', "%{$search}%")
                  ->orWhere('rera_number', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('project_type')) {
            $query->where('project_type', $request->project_type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->filled('publish_status')) {
            $query->where('publish_status', $request->publish_status);
        }
        if ($request->filled('builder_id')) {
            $query->where('builder_id', $request->builder_id);
        }

        $projects = $query->latest()->paginate(15);
        $cities = City::where('is_active', true)->get();
        $builders = \App\Models\Builder::where('status', 'active')->get();

        return view('projects.index', compact('projects', 'cities', 'builders'));
    }

    public function create()
    {
        $cities = City::where('is_active', true)->get();
        $amenities = Amenity::active()->get();
        $builders = \App\Models\Builder::where('status', 'active')->get();

        return view('projects.create', compact('cities', 'amenities', 'builders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'developer_name' => 'required|string|max:255',
            'project_type' => 'required|in:residential,commercial,mixed',
            'status' => 'required|in:upcoming,under-construction,ready-to-move,completed',
            'city_id' => 'required|exists:cities,id',
            'locality' => 'nullable|string',
            'address' => 'nullable|string',
            'total_units' => 'nullable|integer|min:0',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'rera_number' => 'nullable|string',
            'publish_status' => 'required|in:draft,published,inactive',
        ]);

        $validated['slug'] = Str::slug($request->name);
        
        // Handle images
        if ($request->filled('images')) {
            $validated['images'] = json_decode($request->images, true);
        }

        // Handle approved banks
        if ($request->filled('approved_banks')) {
            $validated['approved_banks'] = json_decode($request->approved_banks, true);
        }

        $project = Project::create($validated);

        // Sync amenities
        if ($request->filled('amenities')) {
            $project->amenities()->sync($request->amenities);
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['city', 'properties', 'amenities']);
        $project->increment('views');
        
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $cities = City::where('is_active', true)->get();
        $amenities = Amenity::active()->get();
        $builders = \App\Models\Builder::where('status', 'active')->get();

        return view('projects.edit', compact('project', 'cities', 'amenities', 'builders'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'developer_name' => 'required|string|max:255',
            'project_type' => 'required|in:residential,commercial,mixed',
            'status' => 'required|in:upcoming,under-construction,ready-to-move,completed',
            'city_id' => 'required|exists:cities,id',
            'locality' => 'nullable|string',
            'address' => 'nullable|string',
            'total_units' => 'nullable|integer|min:0',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'rera_number' => 'nullable|string',
            'publish_status' => 'required|in:draft,published,inactive',
        ]);

        if ($request->name !== $project->name) {
            $validated['slug'] = Str::slug($request->name);
        }

        // Handle images
        if ($request->filled('images')) {
            $validated['images'] = json_decode($request->images, true);
        }

        // Handle approved banks
        if ($request->filled('approved_banks')) {
            $validated['approved_banks'] = json_decode($request->approved_banks, true);
        }

        $project->update($validated);

        // Sync amenities
        if ($request->has('amenities')) {
            $project->amenities()->sync($request->amenities ?? []);
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:projects,id'
        ]);

        Project::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with('success', 'Projects deleted successfully.');
    }
}


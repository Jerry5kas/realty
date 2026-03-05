<?php

namespace App\Http\Controllers;

use App\Models\Builder;
use App\Models\City;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function index(Request $request)
    {
        $query = Builder::with('city');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('contact_person_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhereHas('city', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured === 'yes');
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $builders = $query->orderBy('company_name')->paginate(20)->withQueryString();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('builders.index', compact('builders', 'cities'));
    }

    public function create()
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        return view('builders.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo_url' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'contact_person_name' => 'nullable|string|max:255',
            'phone' => ['nullable', 'regex:/^[\d\s\-\+]+$/'],
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:500',
            'rera_registration_number' => 'nullable|alpha_num|max:100',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'total_projects_completed' => 'nullable|integer|min:0',
            'facebook_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'office_address' => 'nullable|string',
            'city_id' => 'nullable|exists:cities,id',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Builder::generateUniqueSlug($request->company_name);
        $validated['is_featured'] = $request->has('is_featured');

        Builder::create($validated);

        return redirect()->route('builders.index')
            ->with('success', 'Builder created successfully.');
    }

    public function show(Builder $builder)
    {
        $builder->load(['city', 'properties', 'projects']);
        return view('builders.show', compact('builder'));
    }

    public function edit(Builder $builder)
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        return view('builders.edit', compact('builder', 'cities'));
    }

    public function update(Request $request, Builder $builder)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo_url' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'contact_person_name' => 'nullable|string|max:255',
            'phone' => ['nullable', 'regex:/^[\d\s\-\+]+$/'],
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:500',
            'rera_registration_number' => 'nullable|alpha_num|max:100',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'total_projects_completed' => 'nullable|integer|min:0',
            'facebook_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'office_address' => 'nullable|string',
            'city_id' => 'nullable|exists:cities,id',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
        ]);

        if ($request->company_name !== $builder->company_name) {
            $validated['slug'] = Builder::generateUniqueSlug($request->company_name);
        }

        $validated['is_featured'] = $request->has('is_featured');

        $builder->update($validated);

        return redirect()->route('builders.index')
            ->with('success', 'Builder updated successfully.');
    }

    public function destroy(Builder $builder)
    {
        // Check if builder has associated properties or projects
        if ($builder->properties()->count() > 0 || $builder->projects()->count() > 0) {
            return redirect()->route('builders.index')
                ->with('error', 'Cannot delete builder. It is associated with ' . 
                    $builder->properties()->count() . ' properties and ' . 
                    $builder->projects()->count() . ' projects.');
        }

        $builder->delete();
        
        return redirect()->route('builders.index')
            ->with('success', 'Builder deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:builders,id'
        ]);

        $builders = Builder::whereIn('id', $request->ids)->get();
        $cannotDelete = [];
        $deleted = 0;

        foreach ($builders as $builder) {
            if ($builder->properties()->count() > 0 || $builder->projects()->count() > 0) {
                $cannotDelete[] = $builder->company_name;
            } else {
                $builder->delete();
                $deleted++;
            }
        }

        if (count($cannotDelete) > 0) {
            return redirect()->route('builders.index')
                ->with('error', 'Could not delete ' . count($cannotDelete) . ' builders as they are associated with properties or projects: ' . implode(', ', $cannotDelete));
        }

        return redirect()->route('builders.index')
            ->with('success', $deleted . ' builder(s) deleted successfully.');
    }
}


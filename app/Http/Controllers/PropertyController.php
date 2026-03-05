<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\City;
use App\Models\Project;
use App\Models\PropertyType;
use App\Models\Amenity;
use App\Models\PropertyFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['city', 'project', 'user', 'builder']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('locality', 'like', "%{$search}%")
                  ->orWhere('rera_number', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('builder_id')) {
            $query->where('builder_id', $request->builder_id);
        }

        $properties = $query->latest()->paginate(15);
        $cities = City::where('is_active', true)->get();
        $builders = \App\Models\Builder::where('status', 'active')->get();

        return view('properties.index', compact('properties', 'cities', 'builders'));
    }

    public function create()
    {
        $cities = City::where('is_active', true)->get();
        $projects = Project::where('publish_status', 'published')->get();
        $propertyTypes = PropertyType::active()->get();
        $amenities = Amenity::active()->get();
        $features = PropertyFeature::active()->get();
        $builders = \App\Models\Builder::where('status', 'active')->get();

        return view('properties.create', compact('cities', 'projects', 'propertyTypes', 'amenities', 'features', 'builders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:buy,sale,rent,lease,pg',
            'category' => 'required|in:residential,commercial,land',
            'property_type' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'city_id' => 'required|exists:cities,id',
            'locality' => 'nullable|string',
            'address' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'carpet_area' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published,sold,rented,inactive',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['user_id'] = auth()->id();
        
        // Handle images
        if ($request->filled('images')) {
            $validated['images'] = json_decode($request->images, true);
        }

        $property = Property::create($validated);

        // Sync amenities
        if ($request->filled('amenities')) {
            $property->amenities()->sync($request->amenities);
        }

        // Sync features
        if ($request->filled('features')) {
            $property->features()->sync($request->features);
        }

        return redirect()->route('properties.index')
            ->with('success', 'Property created successfully.');
    }

    public function show(Property $property)
    {
        $property->load(['city', 'project', 'user', 'amenities', 'features']);
        $property->increment('views');
        
        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $cities = City::where('is_active', true)->get();
        $projects = Project::where('publish_status', 'published')->get();
        $propertyTypes = PropertyType::active()->get();
        $amenities = Amenity::active()->get();
        $features = PropertyFeature::active()->get();
        $builders = \App\Models\Builder::where('status', 'active')->get();

        return view('properties.edit', compact('property', 'cities', 'projects', 'propertyTypes', 'amenities', 'features', 'builders'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:buy,sale,rent,lease,pg',
            'category' => 'required|in:residential,commercial,land',
            'property_type' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'city_id' => 'required|exists:cities,id',
            'locality' => 'nullable|string',
            'address' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'carpet_area' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published,sold,rented,inactive',
        ]);

        if ($request->title !== $property->title) {
            $validated['slug'] = Str::slug($request->title);
        }

        // Handle images
        if ($request->filled('images')) {
            $validated['images'] = json_decode($request->images, true);
        }

        $property->update($validated);

        // Sync amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities ?? []);
        }

        // Sync features
        if ($request->has('features')) {
            $property->features()->sync($request->features ?? []);
        }

        return redirect()->route('properties.index')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        
        return redirect()->route('properties.index')
            ->with('success', 'Property deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:properties,id'
        ]);

        Property::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with('success', 'Properties deleted successfully.');
    }
}


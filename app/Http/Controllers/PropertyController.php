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
            // Basic Info
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:buy,sale,rent,lease,pg',
            'sale_type' => 'nullable|in:initial,resale',
            'category' => 'required|in:residential,commercial,land',
            'property_type' => 'nullable|string',
            
            // Pricing
            'price' => 'required|numeric|min:0',
            'price_per_sqft' => 'nullable|numeric|min:0',
            'maintenance_charges' => 'nullable|numeric|min:0',
            'maintenance_period' => 'nullable|string',
            'security_deposit' => 'nullable|numeric|min:0',
            
            // Area Details
            'carpet_area' => 'nullable|numeric|min:0',
            'built_up_area' => 'nullable|numeric|min:0',
            'super_built_up_area' => 'nullable|numeric|min:0',
            'area_unit' => 'nullable|string',
            
            // Property Details
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'balconies' => 'nullable|integer|min:0',
            'floor_number' => 'nullable|integer|min:0',
            'total_floors' => 'nullable|integer|min:0',
            'furnishing_status' => 'nullable|string',
            'facing' => 'nullable|string',
            'parking_covered' => 'nullable|integer|min:0',
            'parking_open' => 'nullable|integer|min:0',
            'age_of_property' => 'nullable|string',
            
            // Location
            'city_id' => 'required|exists:cities,id',
            'locality' => 'nullable|string',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            
            // Legal & Compliance
            'rera_number' => 'nullable|string',
            'possession_status' => 'nullable|in:ready-to-move,under-construction,upcoming',
            'possession_date' => 'nullable|date',
            'available_from' => 'nullable|date',
            
            // Media
            'video_url' => 'nullable|url',
            'virtual_tour_url' => 'nullable|url',
            
            // Relationships
            'project_id' => 'nullable|exists:projects,id',
            'builder_id' => 'nullable|exists:builders,id',
            
            // Publishing
            'status' => 'required|in:draft,published,sold,rented,inactive',
            'is_featured' => 'nullable|boolean',
            'is_verified' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['user_id'] = auth()->id();
        
        // Handle boolean fields (checkboxes)
        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['is_verified'] = $request->has('is_verified') ? true : false;
        
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
        $property->load(['city', 'project', 'user', 'amenities', 'features', 'builder', 'propertyType']);
        $property->increment('views');
        
        // Get recommended properties (same city, similar price range)
        $recommendedProperties = Property::with(['city', 'builder', 'propertyType'])
            ->published()
            ->where('id', '!=', $property->id)
            ->where('city_id', $property->city_id)
            ->when($property->price, function($query) use ($property) {
                $minPrice = $property->price * 0.7;
                $maxPrice = $property->price * 1.3;
                return $query->whereBetween('price', [$minPrice, $maxPrice]);
            })
            ->latest()
            ->take(3)
            ->get();
        
        return view('properties.show', compact('property', 'recommendedProperties'));
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
            // Basic Info
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:buy,sale,rent,lease,pg',
            'sale_type' => 'nullable|in:initial,resale',
            'category' => 'required|in:residential,commercial,land',
            'property_type' => 'nullable|string',
            
            // Pricing
            'price' => 'required|numeric|min:0',
            'price_per_sqft' => 'nullable|numeric|min:0',
            'maintenance_charges' => 'nullable|numeric|min:0',
            'maintenance_period' => 'nullable|string',
            'security_deposit' => 'nullable|numeric|min:0',
            
            // Area Details
            'carpet_area' => 'nullable|numeric|min:0',
            'built_up_area' => 'nullable|numeric|min:0',
            'super_built_up_area' => 'nullable|numeric|min:0',
            'area_unit' => 'nullable|string',
            
            // Property Details
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'balconies' => 'nullable|integer|min:0',
            'floor_number' => 'nullable|integer|min:0',
            'total_floors' => 'nullable|integer|min:0',
            'furnishing_status' => 'nullable|string',
            'facing' => 'nullable|string',
            'parking_covered' => 'nullable|integer|min:0',
            'parking_open' => 'nullable|integer|min:0',
            'age_of_property' => 'nullable|string',
            
            // Location
            'city_id' => 'required|exists:cities,id',
            'locality' => 'nullable|string',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            
            // Legal & Compliance
            'rera_number' => 'nullable|string',
            'possession_status' => 'nullable|in:ready-to-move,under-construction,upcoming',
            'possession_date' => 'nullable|date',
            'available_from' => 'nullable|date',
            
            // Media
            'video_url' => 'nullable|url',
            'virtual_tour_url' => 'nullable|url',
            
            // Relationships
            'project_id' => 'nullable|exists:projects,id',
            'builder_id' => 'nullable|exists:builders,id',
            
            // Publishing
            'status' => 'required|in:draft,published,sold,rented,inactive',
            'is_featured' => 'nullable|boolean',
            'is_verified' => 'nullable|boolean',
        ]);

        // Handle slug update
        if ($request->title !== $property->title) {
            $validated['slug'] = Str::slug($request->title);
        }

        // Handle boolean fields (checkboxes)
        $validated['is_featured'] = $request->has('is_featured') ? true : false;
        $validated['is_verified'] = $request->has('is_verified') ? true : false;

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


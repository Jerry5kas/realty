<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Property;
use App\Models\Project;
use App\Models\City;
use App\Models\Builder;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::ordered()
            ->paginate(20);

        return view('collections.index', compact('collections'));
    }

    public function create()
    {
        $cities = City::orderBy('name')->get();
        $builders = Builder::where('status', 'active')->orderBy('company_name')->get();
        $propertyTypes = PropertyType::orderBy('name')->get();
        $properties = Property::where('status', 'published')->orderBy('title')->get();
        $projects = Project::orderBy('name')->get();

        return view('collections.create', compact('cities', 'builders', 'propertyTypes', 'properties', 'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:collections,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'type' => 'required|in:property,project,mixed',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'display_order' => 'integer',
            'items_limit' => 'required|integer|min:1|max:100',
            'sort_by' => 'required|in:created_at,price,title,manual',
            'sort_order' => 'required|in:asc,desc',
            'filter_mode' => 'required|in:automatic,manual',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle filters or manual items based on mode
        if ($request->filter_mode === 'automatic') {
            $validated['filters'] = $this->buildFilters($request);
            $validated['manual_items'] = null;
        } else {
            $validated['manual_items'] = $this->buildManualItems($request);
            $validated['filters'] = null;
        }

        $collection = Collection::create($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Collection created successfully!');
    }

    public function show(Collection $collection)
    {
        $items = $collection->getItems();
        
        return view('collections.show', compact('collection', 'items'));
    }

    public function edit(Collection $collection)
    {
        $cities = City::orderBy('name')->get();
        $builders = Builder::where('status', 'active')->orderBy('company_name')->get();
        $propertyTypes = PropertyType::orderBy('name')->get();
        $properties = Property::where('status', 'published')->orderBy('title')->get();
        $projects = Project::orderBy('name')->get();

        return view('collections.edit', compact('collection', 'cities', 'builders', 'propertyTypes', 'properties', 'projects'));
    }

    public function update(Request $request, Collection $collection)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:collections,slug,' . $collection->id,
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'type' => 'required|in:property,project,mixed',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'display_order' => 'integer',
            'items_limit' => 'required|integer|min:1|max:100',
            'sort_by' => 'required|in:created_at,price,title,manual',
            'sort_order' => 'required|in:asc,desc',
            'filter_mode' => 'required|in:automatic,manual',
        ]);

        // Handle filters or manual items based on mode
        if ($request->filter_mode === 'automatic') {
            $validated['filters'] = $this->buildFilters($request);
            $validated['manual_items'] = null;
        } else {
            $validated['manual_items'] = $this->buildManualItems($request);
            $validated['filters'] = null;
        }

        $collection->update($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Collection updated successfully!');
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();

        return redirect()->route('collections.index')
            ->with('success', 'Collection deleted successfully!');
    }

    /**
     * Build filters array from request
     */
    protected function buildFilters(Request $request)
    {
        $filters = [];

        if ($request->filled('filter_city_id')) {
            $filters['city_id'] = $request->filter_city_id;
        }

        if ($request->filled('filter_builder_id')) {
            $filters['builder_id'] = $request->filter_builder_id;
        }

        if ($request->filled('filter_property_type')) {
            $filters['property_type'] = $request->filter_property_type;
        }

        if ($request->filled('filter_type')) {
            $filters['type'] = $request->filter_type;
        }

        if ($request->filled('filter_project_status')) {
            $filters['project_status'] = $request->filter_project_status;
        }

        if ($request->filled('filter_min_price')) {
            $filters['min_price'] = $request->filter_min_price;
        }

        if ($request->filled('filter_max_price')) {
            $filters['max_price'] = $request->filter_max_price;
        }

        if ($request->filled('filter_bedrooms')) {
            $filters['bedrooms'] = $request->filter_bedrooms;
        }

        if ($request->boolean('filter_is_featured')) {
            $filters['is_featured'] = true;
        }

        if ($request->boolean('filter_is_verified')) {
            $filters['is_verified'] = true;
        }

        if ($request->filled('filter_possession_status')) {
            $filters['possession_status'] = $request->filter_possession_status;
        }

        if ($request->filled('filter_furnishing_status')) {
            $filters['furnishing_status'] = $request->filter_furnishing_status;
        }

        if ($request->filled('filter_created_after')) {
            $filters['created_after'] = $request->filter_created_after;
        }

        if ($request->filled('filter_created_before')) {
            $filters['created_before'] = $request->filter_created_before;
        }

        return $filters;
    }

    /**
     * Build manual items array from request
     */
    protected function buildManualItems(Request $request)
    {
        $items = [];

        if ($request->filled('manual_properties')) {
            foreach ($request->manual_properties as $propertyId) {
                $items[] = ['type' => 'property', 'id' => $propertyId];
            }
        }

        if ($request->filled('manual_projects')) {
            foreach ($request->manual_projects as $projectId) {
                $items[] = ['type' => 'project', 'id' => $projectId];
            }
        }

        return $items;
    }

    /**
     * Frontend: Display collection
     */
    public function showPublic($slug)
    {
        $collection = Collection::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $items = $collection->getItems();

        return view('frontend.collection', compact('collection', 'items'));
    }

    /**
     * Frontend: List all active collections
     */
    public function listPublic()
    {
        $collections = Collection::active()
            ->ordered()
            ->paginate(12);

        return view('frontend.collections', compact('collections'));
    }
}

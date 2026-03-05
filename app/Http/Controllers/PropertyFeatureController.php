<?php

namespace App\Http\Controllers;

use App\Models\PropertyFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyFeatureController extends Controller
{
    public function index(Request $request)
    {
        $query = PropertyFeature::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $features = $query->orderBy('order')->paginate(20);

        return view('features.index', compact('features'));
    }

    public function create()
    {
        return view('features.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->name);
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        PropertyFeature::create($validated);

        return redirect()->route('features.index')
            ->with('success', 'Feature created successfully.');
    }

    public function edit(PropertyFeature $feature)
    {
        return view('features.edit', compact('feature'));
    }

    public function update(Request $request, PropertyFeature $feature)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->name !== $feature->name) {
            $validated['slug'] = Str::slug($request->name);
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $feature->update($validated);

        return redirect()->route('features.index')
            ->with('success', 'Feature updated successfully.');
    }

    public function destroy(PropertyFeature $feature)
    {
        $feature->delete();
        
        return redirect()->route('features.index')
            ->with('success', 'Feature deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:property_features,id'
        ]);

        PropertyFeature::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with('success', 'Features deleted successfully.');
    }
}


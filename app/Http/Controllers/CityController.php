<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('state', 'like', '%' . $request->search . '%');
        }

        $cities = $query->orderBy('name')->paginate(20)->withQueryString();
        
        return view('cities.index', compact('cities'));
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities',
            'state' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        City::create($request->all());

        return redirect()->route('cities.index')->with('success', 'City created successfully!');
    }

    public function edit(City $city)
    {
        return view('cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
            'state' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $city->update($request->all());

        return redirect()->route('cities.index')->with('success', 'City updated successfully!');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with('success', 'City deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:cities,id'
        ]);

        City::whereIn('id', $request->ids)->delete();
        
        return redirect()->route('cities.index')->with('success', count($request->ids) . ' cities deleted successfully!');
    }
}


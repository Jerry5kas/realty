<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Property;
use App\Models\User;
use App\Models\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()
            ->forPage('home')
            ->forSection('hero')
            ->ordered()
            ->get();
        
        $properties = Property::with(['city', 'builder'])
            ->published()
            ->featured()
            ->latest()
            ->take(8)
            ->get();
        
        $builders = \App\Models\Builder::where('status', 'active')
            ->where('is_featured', true)
            ->withCount(['projects', 'properties'])
            ->take(6)
            ->get();
        
        $agents = User::where('role', 'agent')
            ->where('is_featured', true)
            ->take(6)
            ->get();
        
        // Get active collections with items
        $collections = Collection::active()
            ->ordered()
            ->get()
            ->filter(function($collection) {
                return $collection->getItemsCount() > 0;
            })
            ->take(8);
        
        // Get cities with property counts for popular searches
        $cities = \App\Models\City::withCount([
            'properties as sale_count' => function($query) {
                $query->where('type', 'sale')->where('status', 'published');
            },
            'properties as rent_count' => function($query) {
                $query->where('type', 'rent')->where('status', 'published');
            }
        ])->having('sale_count', '>', 0)
          ->orHaving('rent_count', '>', 0)
          ->get();
        
        // Get property types with counts
        $propertyTypes = \App\Models\PropertyType::withCount([
            'properties as sale_count' => function($query) {
                $query->where('type', 'sale')->where('status', 'published');
            },
            'properties as rent_count' => function($query) {
                $query->where('type', 'rent')->where('status', 'published');
            }
        ])->get();
        
        return view('home', compact('banners', 'properties', 'builders', 'agents', 'collections', 'cities', 'propertyTypes'));
    }
    
    public function listings(Request $request)
    {
        $type = $request->get('type', 'properties'); // properties, projects, all
        $listingType = $request->get('listing_type'); // buy, rent, sell
        $saleType = $request->get('sale_type'); // initial, resale, developer
        
        // Get filter data
        $cities = \App\Models\City::orderBy('name')->get();
        $propertyTypes = \App\Models\PropertyType::orderBy('name')->get();
        $builders = \App\Models\Builder::where('status', 'active')->orderBy('company_name')->get();
        
        // Build properties query
        $propertiesQuery = Property::with(['city', 'builder', 'propertyType'])
            ->published();
        
        // Build projects query
        $projectsQuery = \App\Models\Project::with(['city', 'builder'])
            ->where('status', '!=', 'draft');
        
        // Apply listing type filters (buy, rent, sell)
        if ($listingType === 'buy' || $listingType === 'sell') {
            $propertiesQuery->where('type', 'sale');
        } elseif ($listingType === 'rent') {
            $propertiesQuery->where('type', 'rent');
        }
        
        // Apply sale type filters (initial, resale, developer)
        if ($saleType === 'initial') {
            $propertiesQuery->where('category', 'new');
        } elseif ($saleType === 'resale') {
            $propertiesQuery->where('category', 'resale');
        } elseif ($saleType === 'developer') {
            $propertiesQuery->whereNotNull('builder_id');
        }
        
        // Apply filters
        if ($request->filled('city_id')) {
            $propertiesQuery->where('city_id', $request->city_id);
            $projectsQuery->where('city_id', $request->city_id);
        }
        
        if ($request->filled('property_type_id')) {
            $propertiesQuery->where('property_type', $request->property_type_id);
        }
        
        if ($request->filled('builder_id')) {
            $propertiesQuery->where('builder_id', $request->builder_id);
            $projectsQuery->where('builder_id', $request->builder_id);
        }
        
        if ($request->filled('bedrooms')) {
            $propertiesQuery->where('bedrooms', $request->bedrooms);
        }
        
        if ($request->filled('min_price')) {
            $propertiesQuery->where('price', '>=', $request->min_price);
        }
        
        if ($request->filled('max_price')) {
            $propertiesQuery->where('price', '<=', $request->max_price);
        }
        
        if ($request->filled('possession_status')) {
            $propertiesQuery->where('possession_status', $request->possession_status);
        }
        
        // Get results
        $properties = collect();
        $projects = collect();
        
        if ($type === 'properties' || $type === 'all') {
            $properties = $propertiesQuery->latest()->paginate(12, ['*'], 'properties_page');
        }
        
        if ($type === 'projects' || $type === 'all') {
            $projects = $projectsQuery->latest()->paginate(12, ['*'], 'projects_page');
        }
        
        return view('listings', compact('properties', 'projects', 'cities', 'propertyTypes', 'builders', 'type', 'listingType'));
    }
}

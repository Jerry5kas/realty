<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Property;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your favorites');
        }

        $user = Auth::user();
        
        // Get all favorites with their related models
        $favorites = Favorite::where('user_id', $user->id)
            ->with('favoritable')
            ->latest()
            ->get();
        
        // Separate properties and projects
        $properties = collect();
        $projects = collect();
        
        foreach ($favorites as $favorite) {
            if ($favorite->favoritable_type === 'App\\Models\\Property' && $favorite->favoritable) {
                $properties->push($favorite->favoritable);
            } elseif ($favorite->favoritable_type === 'App\\Models\\Project' && $favorite->favoritable) {
                $projects->push($favorite->favoritable);
            }
        }
        
        return view('favorites', compact('properties', 'projects'));
    }

    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add favorites',
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'type' => 'required|in:property,project',
            'id' => 'required|integer'
        ]);

        $user = Auth::user();
        $type = $request->type === 'property' ? 'App\\Models\\Property' : 'App\\Models\\Project';
        $id = $request->id;

        // Check if already favorited
        $favorite = Favorite::where('user_id', $user->id)
            ->where('favoritable_type', $type)
            ->where('favoritable_id', $id)
            ->first();

        if ($favorite) {
            // Remove from favorites
            $favorite->delete();
            return response()->json([
                'success' => true,
                'favorited' => false,
                'message' => 'Removed from favorites'
            ]);
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => $user->id,
                'favoritable_type' => $type,
                'favoritable_id' => $id
            ]);
            return response()->json([
                'success' => true,
                'favorited' => true,
                'message' => 'Added to favorites'
            ]);
        }
    }

    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'type' => 'required|in:property,project',
            'id' => 'required|integer'
        ]);

        $user = Auth::user();
        $type = $request->type === 'property' ? 'App\\Models\\Property' : 'App\\Models\\Project';
        
        Favorite::where('user_id', $user->id)
            ->where('favoritable_type', $type)
            ->where('favoritable_id', $request->id)
            ->delete();

        return redirect()->back()->with('success', 'Removed from favorites');
    }
}

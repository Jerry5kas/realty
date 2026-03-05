<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use Illuminate\Http\Request;

class MediaAssetController extends Controller
{
    public function index(Request $request)
    {
        $query = MediaAsset::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by file type
        if ($request->filled('file_type')) {
            $query->where('file_type', $request->file_type);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $mediaAssets = $query->latest()->paginate(20);

        return view('media-assets.index', compact('mediaAssets'));
    }

    public function create()
    {
        return view('media-assets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file_url' => 'required|string',
            'file_type' => 'required|string|in:image,icon,document,video',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'file_size' => 'nullable|string|max:50',
            'dimensions' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        MediaAsset::create($validated);

        return redirect()->route('media-assets.index')
            ->with('success', 'Media asset created successfully.');
    }

    public function edit(MediaAsset $mediaAsset)
    {
        return view('media-assets.edit', compact('mediaAsset'));
    }

    public function update(Request $request, MediaAsset $mediaAsset)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file_url' => 'required|string',
            'file_type' => 'required|string|in:image,icon,document,video',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'file_size' => 'nullable|string|max:50',
            'dimensions' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $mediaAsset->update($validated);

        return redirect()->route('media-assets.index')
            ->with('success', 'Media asset updated successfully.');
    }

    public function destroy(MediaAsset $mediaAsset)
    {
        $mediaAsset->delete();

        return redirect()->route('media-assets.index')
            ->with('success', 'Media asset deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:media_assets,id'
        ]);

        MediaAsset::whereIn('id', $request->ids)->delete();

        return redirect()->route('media-assets.index')
            ->with('success', count($request->ids) . ' media asset(s) deleted successfully.');
    }
}

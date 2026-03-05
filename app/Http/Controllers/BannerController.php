<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $query = Banner::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('page', 'like', "%{$search}%")
                  ->orWhere('section', 'like', "%{$search}%");
            });
        }

        // Filter by page (banner page, not pagination page)
        if ($request->filled('page_filter') && $request->page_filter !== '') {
            $query->where('page', $request->page_filter);
        }

        // Filter by section
        if ($request->filled('section_filter')) {
            $query->where('section', $request->section_filter);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $banners = $query->orderBy('display_order', 'asc')->orderBy('created_at', 'desc')->simplePaginate(15);

        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'required|string',
            'mobile_image_url' => 'nullable|string',
            'page' => 'required|string|max:50',
            'section' => 'required|string|max:50',
            'link_url' => 'nullable|url|max:500',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Parse JSON if needed (ImageKit uploader returns JSON array)
        if (isset($validated['image_url'])) {
            $imageData = json_decode($validated['image_url'], true);
            $validated['image_url'] = is_array($imageData) && !empty($imageData) ? $imageData[0] : $validated['image_url'];
        }
        
        if (isset($validated['mobile_image_url'])) {
            $mobileImageData = json_decode($validated['mobile_image_url'], true);
            $validated['mobile_image_url'] = is_array($mobileImageData) && !empty($mobileImageData) ? $mobileImageData[0] : $validated['mobile_image_url'];
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        Banner::create($validated);

        return redirect()->route('banners.index')
            ->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'required|string',
            'mobile_image_url' => 'nullable|string',
            'page' => 'required|string|max:50',
            'section' => 'required|string|max:50',
            'link_url' => 'nullable|url|max:500',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Parse JSON if needed (ImageKit uploader returns JSON array)
        if (isset($validated['image_url'])) {
            $imageData = json_decode($validated['image_url'], true);
            $validated['image_url'] = is_array($imageData) && !empty($imageData) ? $imageData[0] : $validated['image_url'];
        }
        
        if (isset($validated['mobile_image_url'])) {
            $mobileImageData = json_decode($validated['mobile_image_url'], true);
            $validated['mobile_image_url'] = is_array($mobileImageData) && !empty($mobileImageData) ? $mobileImageData[0] : $validated['mobile_image_url'];
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $banner->update($validated);

        return redirect()->route('banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('banners.index')
            ->with('success', 'Banner deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:banners,id'
        ]);

        Banner::whereIn('id', $request->ids)->delete();

        return redirect()->route('banners.index')
            ->with('success', count($request->ids) . ' banner(s) deleted successfully.');
    }
}

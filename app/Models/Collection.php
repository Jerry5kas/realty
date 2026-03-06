<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Collection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'type',
        'status',
        'is_featured',
        'display_order',
        'filters',
        'manual_items',
        'items_limit',
        'sort_by',
        'sort_order',
    ];

    protected $casts = [
        'filters' => 'array',
        'manual_items' => 'array',
        'is_featured' => 'boolean',
        'items_limit' => 'integer',
        'display_order' => 'integer',
    ];

    // Automatically generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->name);
            }
        });

        static::updating(function ($collection) {
            if ($collection->isDirty('name') && empty($collection->slug)) {
                $collection->slug = Str::slug($collection->name);
            }
        });
    }

    // Scope for active collections
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for featured collections
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for ordered collections
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Get items for this collection based on filters or manual selection
     */
    public function getItems()
    {
        // If manual items are specified, return those
        if (!empty($this->manual_items)) {
            return $this->getManualItems();
        }

        // Otherwise, use filters to query items
        return $this->getFilteredItems();
    }

    /**
     * Get manually selected items
     */
    protected function getManualItems()
    {
        $items = collect();

        if ($this->type === 'property' || $this->type === 'mixed') {
            $propertyIds = collect($this->manual_items)->where('type', 'property')->pluck('id');
            if ($propertyIds->isNotEmpty()) {
                $properties = Property::whereIn('id', $propertyIds)->get();
                $items = $items->merge($properties);
            }
        }

        if ($this->type === 'project' || $this->type === 'mixed') {
            $projectIds = collect($this->manual_items)->where('type', 'project')->pluck('id');
            if ($projectIds->isNotEmpty()) {
                $projects = Project::whereIn('id', $projectIds)->get();
                $items = $items->merge($projects);
            }
        }

        return $items->take($this->items_limit);
    }

    /**
     * Get items based on filter criteria
     */
    protected function getFilteredItems()
    {
        $items = collect();
        $filters = $this->filters ?? [];

        // Query properties
        if ($this->type === 'property' || $this->type === 'mixed') {
            $propertyQuery = Property::query()->where('status', 'published');
            $propertyQuery = $this->applyFilters($propertyQuery, $filters, 'property');
            $properties = $propertyQuery->get();
            $items = $items->merge($properties);
        }

        // Query projects
        if ($this->type === 'project' || $this->type === 'mixed') {
            $projectQuery = Project::query();
            $projectQuery = $this->applyFilters($projectQuery, $filters, 'project');
            $projects = $projectQuery->get();
            $items = $items->merge($projects);
        }

        // Sort items
        $items = $this->sortItems($items);

        return $items->take($this->items_limit);
    }

    /**
     * Apply filters to query
     */
    protected function applyFilters($query, $filters, $modelType)
    {
        // City filter
        if (!empty($filters['city_id'])) {
            $query->where('city_id', $filters['city_id']);
        }

        // Builder filter
        if (!empty($filters['builder_id'])) {
            $query->where('builder_id', $filters['builder_id']);
        }

        // Property type filter (properties only)
        if ($modelType === 'property' && !empty($filters['property_type'])) {
            $query->where('property_type', $filters['property_type']);
        }

        // Transaction type filter (properties only)
        if ($modelType === 'property' && !empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        // Status filter (projects only)
        if ($modelType === 'project' && !empty($filters['project_status'])) {
            $query->where('status', $filters['project_status']);
        }

        // Price range
        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        // Bedrooms filter (properties only)
        if ($modelType === 'property' && !empty($filters['bedrooms'])) {
            $query->where('bedrooms', $filters['bedrooms']);
        }

        // Featured filter
        if (!empty($filters['is_featured'])) {
            $query->where('is_featured', true);
        }

        // Verified filter (properties only)
        if ($modelType === 'property' && !empty($filters['is_verified'])) {
            $query->where('is_verified', true);
        }

        // Possession status (properties only)
        if ($modelType === 'property' && !empty($filters['possession_status'])) {
            $query->where('possession_status', $filters['possession_status']);
        }

        // Furnishing status (properties only)
        if ($modelType === 'property' && !empty($filters['furnishing_status'])) {
            $query->where('furnishing_status', $filters['furnishing_status']);
        }

        // Date range
        if (!empty($filters['created_after'])) {
            $query->where('created_at', '>=', $filters['created_after']);
        }
        if (!empty($filters['created_before'])) {
            $query->where('created_at', '<=', $filters['created_before']);
        }

        return $query;
    }

    /**
     * Sort items collection
     */
    protected function sortItems($items)
    {
        switch ($this->sort_by) {
            case 'price':
                return $this->sort_order === 'asc' 
                    ? $items->sortBy('price') 
                    : $items->sortByDesc('price');
            
            case 'title':
                return $this->sort_order === 'asc' 
                    ? $items->sortBy('title') 
                    : $items->sortByDesc('title');
            
            case 'created_at':
            default:
                return $this->sort_order === 'asc' 
                    ? $items->sortBy('created_at') 
                    : $items->sortByDesc('created_at');
        }
    }

    /**
     * Get count of items in collection
     */
    public function getItemsCount()
    {
        return $this->getItems()->count();
    }
}

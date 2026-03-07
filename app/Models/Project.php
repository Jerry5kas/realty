<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'highlights',
        'builder_id',
        'project_type', 'status', 'launch_date', 'possession_date', 'completion_percentage',
        'total_units', 'available_units', 'total_towers', 'total_floors',
        'total_area', 'min_price', 'max_price', 'price_range',
        'city_id', 'locality', 'address', 'pincode', 'latitude', 'longitude',
        'rera_number', 'rera_valid_till', 'approved_banks',
        'images', 'brochure_url', 'video_url', 'master_plan_image',
        'meta_title', 'meta_description',
        'is_featured', 'is_verified', 'views', 'publish_status'
    ];

    protected $casts = [
        'images' => 'array',
        'approved_banks' => 'array',
        'launch_date' => 'date',
        'possession_date' => 'date',
        'rera_valid_till' => 'date',
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
        'total_area' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_verified' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function builder()
    {
        return $this->belongsTo(Builder::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_project');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('publish_status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessors
    public function getFormattedPriceRangeAttribute()
    {
        if ($this->min_price && $this->max_price) {
            return $this->formatPrice($this->min_price) . ' - ' . $this->formatPrice($this->max_price);
        }
        return $this->price_range;
    }

    private function formatPrice($price)
    {
        if ($price >= 10000000) {
            return '₹' . number_format($price / 10000000, 2) . ' Cr';
        } elseif ($price >= 100000) {
            return '₹' . number_format($price / 100000, 2) . ' Lac';
        }
        return '₹' . number_format($price, 2);
    }

    public function getPrimaryImageAttribute()
    {
        return $this->images[0] ?? null;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

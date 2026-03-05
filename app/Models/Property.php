<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'type', 'category', 'property_type',
        'price', 'price_per_sqft', 'maintenance_charges', 'maintenance_period', 'security_deposit',
        'carpet_area', 'built_up_area', 'super_built_up_area', 'area_unit',
        'bedrooms', 'bathrooms', 'balconies', 'floor_number', 'total_floors',
        'furnishing_status', 'facing', 'parking_covered', 'parking_open', 'age_of_property',
        'city_id', 'locality', 'address', 'pincode', 'latitude', 'longitude',
        'rera_number', 'possession_status', 'possession_date', 'available_from',
        'images', 'video_url', 'virtual_tour_url',
        'project_id', 'builder_id', 'user_id', 'status', 'is_featured', 'is_verified', 'views'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'price_per_sqft' => 'decimal:2',
        'maintenance_charges' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'carpet_area' => 'decimal:2',
        'built_up_area' => 'decimal:2',
        'super_built_up_area' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_verified' => 'boolean',
        'possession_date' => 'date',
        'available_from' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title);
            }
        });
    }

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function builder()
    {
        return $this->belongsTo(Builder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_property');
    }

    public function features()
    {
        return $this->belongsToMany(PropertyFeature::class, 'feature_property');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeForSale($query)
    {
        return $query->where('type', 'sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('type', 'rent');
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        if ($this->price >= 10000000) {
            return '₹' . number_format($this->price / 10000000, 2) . ' Cr';
        } elseif ($this->price >= 100000) {
            return '₹' . number_format($this->price / 100000, 2) . ' Lac';
        }
        return '₹' . number_format($this->price, 2);
    }

    public function getPrimaryImageAttribute()
    {
        return $this->images[0] ?? null;
    }
}

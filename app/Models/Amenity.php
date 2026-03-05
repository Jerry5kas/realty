<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Amenity extends Model
{
    protected $fillable = ['name', 'slug', 'icon', 'category', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($amenity) {
            if (empty($amenity->slug)) {
                $amenity->slug = Str::slug($amenity->name);
            }
        });
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'amenity_property');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'amenity_project');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}

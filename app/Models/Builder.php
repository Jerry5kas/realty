<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Builder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_name',
        'slug',
        'logo_url',
        'description',
        'contact_person_name',
        'phone',
        'email',
        'website',
        'rera_registration_number',
        'established_year',
        'total_projects_completed',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'office_address',
        'city_id',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'total_projects_completed' => 'integer',
        'established_year' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($builder) {
            if (empty($builder->slug)) {
                $builder->slug = static::generateUniqueSlug($builder->company_name);
            }
        });
    }

    // Relationships
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessors
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->company_name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->company_name, 0, 2));
    }

    // Methods
    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

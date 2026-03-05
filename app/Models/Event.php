<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_type',
        'start_date',
        'end_date',
        'all_day',
        'location',
        'property_id',
        'project_id',
        'user_id',
        'assigned_to',
        'status',
        'priority',
        'send_reminder',
        'reminder_minutes',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'all_day' => 'boolean',
        'send_reminder' => 'boolean',
        'reminder_minutes' => 'integer',
    ];

    /**
     * Relationships
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scopes
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now())
                    ->where('status', 'scheduled')
                    ->orderBy('start_date', 'asc');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('start_date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('start_date', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('start_date', now()->year)
                    ->whereMonth('start_date', now()->month);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('event_type', $type);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    /**
     * Accessors
     */
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date->format('M d, Y h:i A');
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date->format('M d, Y h:i A');
    }

    public function getDurationAttribute()
    {
        return $this->start_date->diffForHumans($this->end_date, true);
    }

    public function getIsUpcomingAttribute()
    {
        return $this->start_date->isFuture() && $this->status === 'scheduled';
    }

    public function getIsPastAttribute()
    {
        return $this->end_date->isPast();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'property_id',
        'project_id',
        'transaction_type',
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'seller_name',
        'seller_phone',
        'seller_email',
        'agent_id',
        'created_by',
        'total_amount',
        'token_amount',
        'booking_amount',
        'down_payment',
        'loan_amount',
        'paid_amount',
        'balance_amount',
        'commission_percentage',
        'commission_amount',
        'commission_status',
        'commission_paid',
        'payment_method',
        'payment_status',
        'emi_months',
        'emi_amount',
        'status',
        'priority',
        'agreement_date',
        'token_date',
        'booking_date',
        'registration_date',
        'possession_date',
        'expected_closing_date',
        'actual_closing_date',
        'notes',
        'terms_conditions',
        'documents',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'token_amount' => 'decimal:2',
        'booking_amount' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'loan_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance_amount' => 'decimal:2',
        'commission_percentage' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'commission_paid' => 'decimal:2',
        'emi_amount' => 'decimal:2',
        'agreement_date' => 'date',
        'token_date' => 'date',
        'booking_date' => 'date',
        'registration_date' => 'date',
        'possession_date' => 'date',
        'expected_closing_date' => 'date',
        'actual_closing_date' => 'date',
        'documents' => 'array',
    ];

    /**
     * Boot method to generate transaction number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_number)) {
                $transaction->transaction_number = 'TXN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }

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

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['completed', 'cancelled']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('transaction_type', $type);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    public function scopeByAgent($query, $agentId)
    {
        return $query->where('agent_id', $agentId);
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }

    /**
     * Accessors
     */
    public function getFormattedTotalAmountAttribute()
    {
        return '₹' . number_format($this->total_amount, 2);
    }

    public function getFormattedCommissionAmountAttribute()
    {
        return '₹' . number_format($this->commission_amount, 2);
    }

    public function getFormattedBalanceAmountAttribute()
    {
        return '₹' . number_format($this->balance_amount, 2);
    }

    public function getPaymentProgressAttribute()
    {
        if ($this->total_amount == 0) return 0;
        return round(($this->paid_amount / $this->total_amount) * 100, 2);
    }

    public function getCommissionProgressAttribute()
    {
        if ($this->commission_amount == 0) return 0;
        return round(($this->commission_paid / $this->commission_amount) * 100, 2);
    }

    public function getIsOverdueAttribute()
    {
        return $this->expected_closing_date && 
               $this->expected_closing_date->isPast() && 
               $this->status !== 'completed';
    }
}

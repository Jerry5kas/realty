<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'favoritable_type',
        'favoritable_id',
    ];

    // Polymorphic relationship
    public function favoritable()
    {
        return $this->morphTo();
    }

    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

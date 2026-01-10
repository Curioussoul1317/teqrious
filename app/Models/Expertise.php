<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected $table = 'expertise';

    protected $fillable = [
        'title', 'description', 'icon', 'icon_type', 'outcomes', 'order', 'is_active'
    ];

    protected $casts = [
        'outcomes' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
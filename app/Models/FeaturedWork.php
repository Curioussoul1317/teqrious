<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedWork extends Model
{
    protected $fillable = [
        'title', 'problem', 'solution', 'outcome', 'image',
        'client_type', 'order', 'is_featured', 'is_active'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
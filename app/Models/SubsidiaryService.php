<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsidiaryService extends Model
{
    protected $fillable = [
        'subsidiary_id', 'title', 'description', 'icon', 'price', 'order', 'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
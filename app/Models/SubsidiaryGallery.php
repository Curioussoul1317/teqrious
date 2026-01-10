<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsidiaryGallery extends Model
{
    protected $table = 'subsidiary_gallery';

    protected $fillable = [
        'subsidiary_id', 'image', 'title', 'order'
    ];

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
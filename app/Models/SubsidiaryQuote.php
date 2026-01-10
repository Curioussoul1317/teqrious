<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsidiaryQuote extends Model
{
    protected $fillable = [
        'subsidiary_id', 'subsidiary_service_id', 'name', 'email',
        'phone', 'quantity', 'requirements', 'attachment', 'status', 'admin_notes'
    ];

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function service()
    {
        return $this->belongsTo(SubsidiaryService::class, 'subsidiary_service_id');
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'contact_type',
        'service_id', 'message', 'attachment', 'status', 'admin_notes'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
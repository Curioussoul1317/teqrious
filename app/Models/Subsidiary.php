<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subsidiary extends Model
{
    protected $fillable = [
        'name', 'slug', 'tagline', 'description', 'logo', 'cover_image',
        'email', 'phone', 'whatsapp', 'website', 'address', 'order', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($subsidiary) {
            if (empty($subsidiary->slug)) {
                $subsidiary->slug = Str::slug($subsidiary->name);
            }
        });
    }

    public function services()
    {
        return $this->hasMany(SubsidiaryService::class)->orderBy('order');
    }

    public function gallery()
    {
        return $this->hasMany(SubsidiaryGallery::class)->orderBy('order');
    }

    public function quotes()
    {
        return $this->hasMany(SubsidiaryQuote::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getWhatsappLinkAttribute()
    {
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);
        return "https://wa.me/{$number}";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
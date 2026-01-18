<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_name',
        'phone',
        'address',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Role checks
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    // Projects where user is the client
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    // Projects created by this user (admin)
    public function createdProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    // Comments made by user
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Documents uploaded by user
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'uploaded_by');
    }

    // Bills for client
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class, 'client_id');
    }

    // Bills created by admin
    public function createdBills(): HasMany
    {
        return $this->hasMany(Bill::class, 'created_by');
    }

    // Project updates
    public function projectUpdates(): HasMany
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    // Get initials for avatar
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials;
    }

    // Scope for active users
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for clients only
    public function scopeClients($query)
    {
        return $query->where('role', 'client');
    }

    // Scope for admins only
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'created_by',
        'title',
        'description',
        'status',
        'progress',
        'start_date',
        'end_date',
        'actual_end_date',
        'budget',
        'priority',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'actual_end_date' => 'date',
            'budget' => 'decimal:2',
            'progress' => 'integer',
        ];
    }

    // Relationships
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updates(): HasMany
    {
        return $this->hasMany(ProjectUpdate::class)->orderBy('created_at', 'desc');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->orderBy('created_at', 'desc');
    }

    public function allComments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    // Accessors
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'draft' => 'bg-secondary',
            'sent' => 'bg-info',
            'paid' => 'bg-success',
            'overdue' => 'bg-danger',
            'cancelled' => 'bg-dark',
            default => 'bg-secondary',
        };
    }
    public function getPriorityBadgeAttribute(): string
    {
        return match($this->priority) {
            'low' => 'bg-secondary',
            'medium' => 'bg-info',
            'high' => 'bg-warning text-dark',
            'urgent' => 'bg-danger',
            default => 'bg-secondary',
        };
    }
    public function getProgressColorAttribute(): string
    {
        return match(true) {
            $this->progress >= 75 => 'bg-success',
            $this->progress >= 50 => 'bg-info',
            $this->progress >= 25 => 'bg-warning',
            default => 'bg-danger',
        };
    }
    public function getDurationAttribute(): ?string
    {
        if (!$this->start_date || !$this->end_date) return null;
        return $this->start_date->diffInDays($this->end_date) . ' days';
    }

    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->end_date) return null;
        return max(0, now()->diffInDays($this->end_date, false));
    }

    public function getIsOverdueAttribute(): bool
    {
        if (!$this->end_date) return false;
        return $this->end_date->isPast() && $this->status !== 'completed';
    }

    // Scopes
    public function scopeForClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress', 'on_hold']);
    }

    public function scopeOverdue($query)
    {
        return $query->where('end_date', '<', now())
                     ->whereNotIn('status', ['completed', 'cancelled']);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'title',
        'content',
        'progress_before',
        'progress_after',
        'status_before',
        'status_after',
    ];

    protected function casts(): array
    {
        return [
            'progress_before' => 'integer',
            'progress_after' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getProgressChangeAttribute(): ?string
    {
        if ($this->progress_before === null || $this->progress_after === null) {
            return null;
        }
        
        $diff = $this->progress_after - $this->progress_before;
        if ($diff > 0) return '+' . $diff . '%';
        if ($diff < 0) return $diff . '%';
        return 'No change';
    }

    public function getStatusChangedAttribute(): bool
    {
        return $this->status_before !== $this->status_after;
    }
}

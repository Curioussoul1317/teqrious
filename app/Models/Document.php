<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'uploaded_by',
        'title',
        'description',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'visibility',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Accessors
    public function getFileSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFileIconAttribute(): string
    {
        return match(true) {
            str_contains($this->file_type, 'image') => 'image',
            str_contains($this->file_type, 'pdf') => 'pdf',
            str_contains($this->file_type, 'word') || str_contains($this->file_type, 'document') => 'doc',
            str_contains($this->file_type, 'excel') || str_contains($this->file_type, 'spreadsheet') => 'excel',
            str_contains($this->file_type, 'zip') || str_contains($this->file_type, 'archive') => 'archive',
            default => 'file',
        };
    }

    public function getDownloadUrlAttribute(): string
    {
        return route('documents.download', $this);
    }

    public function getFullPathAttribute(): string
    {
        return Storage::disk('public')->path($this->file_path);
    }

    // Scopes
    public function scopeVisibleToClient($query)
    {
        return $query->where('visibility', 'client_visible');
    }

    public function scopeAdminOnly($query)
    {
        return $query->where('visibility', 'admin_only');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BlogImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_link', 'image_path'];

    /**
     * Get the absolute URL to the image.
     */
    public function getFileUrlAttribute(): string
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return asset('storage/' . $this->image_path);
        }

        return $this->image_link ?? '';
    }

    /**
     * Get the human-readable file size.
     */
    public function getFileSizeAttribute(): string
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            $bytes = Storage::disk('public')->size($this->image_path);
            $units = ['B', 'KB', 'MB', 'GB'];
            for ($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++) {
                $bytes /= 1024;
            }
            return round($bytes, 2) . ' ' . $units[$i];
        }

        return 'External';
    }
}

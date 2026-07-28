<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the absolute URL to the image.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return asset('storage/'.$this->image_path);
        }

        return asset('images/placeholder.jpg');
    }

    /**
     * Get human readable file size.
     */
    public function getFileSizeAttribute(): string
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            $bytes = Storage::disk('public')->size($this->image_path);
            $units = ['B', 'KB', 'MB', 'GB'];
            for ($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++) {
                $bytes /= 1024;
            }

            return round($bytes, 2).' '.$units[$i];
        }

        return 'Unknown';
    }
}

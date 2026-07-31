<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get YouTube video ID from various URL formats.
     */
    public function getYoutubeIdAttribute(): ?string
    {
        $url = $this->video_url ?? '';

        if (empty($url)) {
            return null;
        }

        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return $match[1];
        }

        return null;
    }

    /**
     * Convert standard YouTube URLs to iframe embed URL format.
     */
    public function getEmbedUrlAttribute(): string
    {
        $id = $this->youtube_id;

        if ($id) {
            return 'https://www.youtube.com/embed/' . $id . '?autoplay=1&rel=0&enablejsapi=1';
        }

        return $this->video_url ?? '';
    }

    /**
     * Get YouTube thumbnail image URL if available.
     */
    public function getThumbnailUrlAttribute(): string
    {
        $id = $this->youtube_id;

        if ($id) {
            return 'https://img.youtube.com/vi/' . $id . '/hqdefault.jpg';
        }

        return 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80';
    }
}

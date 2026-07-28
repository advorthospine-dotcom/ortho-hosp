<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'category_id',
        'title',
        'slug',
        'content',
        'is_active',
        'image_path',
        'image_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Get the category that owns the blog.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    /**
     * Get the user author of the blog.
     */
    public function authorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
    }

    /**
     * Get the absolute image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return asset('storage/'.$this->image_path);
        }

        return 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=600&q=80'; // Default medical placeholder
    }
}

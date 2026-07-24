<?php

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app')] class extends Component
{
    public Blog $blog;

    /**
     * Mount and load the active blog post.
     */
    public function mount(string $slug): void
    {
        $this->blog = Blog::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'authorUser'])
            ->firstOrFail();
    }

    /**
     * Render the details page.
     */
    public function render()
    {
        // Fetch 3 related posts from active blogs in same category with fallback
        $relatedBlogs = Blog::where('is_active', true)
            ->where('id', '!=', $this->blog->id)
            ->when($this->blog->category_id, function ($q) {
                $q->where('category_id', $this->blog->category_id);
            })
            ->with(['category', 'authorUser'])
            ->orderByDesc('id')
            ->take(3)
            ->get();

        if ($relatedBlogs->count() < 3) {
            $existingIds = $relatedBlogs->pluck('id')->push($this->blog->id);
            $additional = Blog::where('is_active', true)
                ->whereNotIn('id', $existingIds)
                ->with(['category', 'authorUser'])
                ->orderByDesc('id')
                ->take(3 - $relatedBlogs->count())
                ->get();
            $relatedBlogs = $relatedBlogs->concat($additional);
        }

        return view('pages.blog-view.blog-view', [
            'relatedBlogs' => $relatedBlogs,
        ])->title(($this->blog->meta_title ?: $this->blog->title) . ' | Advance Ortho & Spine');
    }
};
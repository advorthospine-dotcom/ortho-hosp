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
        // Fetch 3 related posts from the same category
        $relatedBlogs = Blog::where('is_active', true)
            ->where('category_id', $this->blog->category_id)
            ->where('id', '!=', $this->blog->id)
            ->take(3)
            ->get();

        return view('pages.blog-view.blog-view', [
            'relatedBlogs' => $relatedBlogs,
        ])->title(($this->blog->meta_title ?: $this->blog->title) . ' | Advance Ortho & Spine');
    }
};
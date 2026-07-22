<?php

use App\Models\Blog;
use App\Models\BlogCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::app')] #[Title('Medical Blog & Insights | Advance Orthopaedic & Spine Center')] class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $selectedCategory = '';

    /**
     * Reset pagination when search query updates.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Set active category filter.
     */
    public function selectCategory(string $categorySlug): void
    {
        $this->selectedCategory = $categorySlug;
        $this->resetPage();
    }

    /**
     * Render the public blog list page.
     */
    public function render()
    {
        // Fetch active categories that have active blogs
        $categories = BlogCategory::where('is_active', true)
            ->whereHas('blogs', function ($query) {
                $query->where('is_active', true);
            })
            ->get();

        // Query active blogs
        $blogs = Blog::query()
            ->where('is_active', true)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedCategory !== '', function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->selectedCategory);
                });
            })
            ->with(['category', 'authorUser'])
            ->orderByDesc('id')
            ->paginate(9);

        // Fetch recent/popular posts for the sidebar/highlight
        $recentBlogs = Blog::query()
            ->where('is_active', true)
            ->orderByDesc('id')
            ->take(4)
            ->get();

        return view('pages.blog.blog', [
            'blogs' => $blogs,
            'categories' => $categories,
            'recentBlogs' => $recentBlogs
        ]);
    }
};
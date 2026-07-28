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
     * Reset all active filters.
     */
    public function clearFilters(): void
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->resetPage();
    }

    /**
     * Render the public blog list page.
     */
    public function render()
    {
        // Fetch active categories that have active blogs with count
        $categories = BlogCategory::where('is_active', true)
            ->whereHas('blogs', function ($query) {
                $query->where('is_active', true);
            })
            ->withCount(['blogs' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();

        $totalBlogsCount = Blog::where('is_active', true)->count();

        // Get single featured blog when no search/category filter is active
        $featuredBlog = null;
        if ($this->search === '' && $this->selectedCategory === '') {
            $featuredBlog = Blog::where('is_active', true)->with(['category', 'authorUser'])->orderByDesc('id')->first();
        }

        // Query active blogs grid
        $blogs = Blog::query()
            ->where('is_active', true)
            ->when($featuredBlog && $this->search === '' && $this->selectedCategory === '', function ($query) use ($featuredBlog) {
                $query->where('id', '!=', $featuredBlog->id);
            })
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
            ->paginate(6);

        return view('pages.blog.blog', [
            'blogs' => $blogs,
            'categories' => $categories,
            'totalBlogsCount' => $totalBlogsCount,
            'featuredBlog' => $featuredBlog,
        ]);
    }
};
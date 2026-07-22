<?php

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Blog Posts | Admin')] class extends Component
{
    use WithPagination;

    public string $search = '';

    /**
     * Reset pagination when search updates.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Delete blog post.
     */
    public function delete(int $id): void
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        $this->dispatch('toast-show', [
            'message' => 'Blog post deleted successfully!',
            'type' => 'danger',
            'position' => 'top-right',
        ]);
    }

    /**
     * Render view.
     */
    public function render()
    {
        $blogs = Blog::query()
            ->when($this->search !== '', function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->with('category')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.blog.list.list', [
            'blogs' => $blogs,
        ]);
    }
};
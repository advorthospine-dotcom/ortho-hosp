<?php

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin')] #[Title('Edit Blog Post | Admin')] class extends Component
{
    use WithFileUploads;

    public Blog $blog;

    // Fields
    public string $title = '';
    public string $slug = '';
    public ?int $category_id = null;
    public string $content = '';
    public bool $is_active = true;
    
    // File upload
    public $image;
    public string $image_alt = '';

    // SEO Meta
    public string $meta_title = '';
    public string $meta_description = '';
    public string $meta_keywords = '';

    /**
     * Component mount.
     */
    public function mount(int $id): void
    {
        $this->blog = Blog::findOrFail($id);
        
        $this->title = $this->blog->title;
        $this->slug = $this->blog->slug;
        $this->category_id = $this->blog->category_id;
        $this->content = $this->blog->content;
        $this->is_active = (bool) $this->blog->is_active;
        $this->image_alt = $this->blog->image_alt ?? '';
        $this->meta_title = $this->blog->meta_title ?? '';
        $this->meta_description = $this->blog->meta_description ?? '';
        $this->meta_keywords = $this->blog->meta_keywords ?? '';
    }

    /**
     * Auto-generate slug when title changes.
     */
    public function updatedTitle(string $value): void
    {
        $this->slug = Str::slug($value);
    }

    /**
     * Update the blog post.
     */
    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:blogs,slug,' . $this->blog->id,
            'category_id' => 'required|exists:blog_categories,id',
            'content' => 'required|min:10',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'image_alt' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:255',
        ]);

        if ($this->image) {
            $path = $this->image->store('blogs', 'public');
            $validated['image_path'] = $path;
        }

        // Remove temporary upload instance
        unset($validated['image']);

        $this->blog->update($validated);

        session()->flash('toast-message', 'Blog post updated successfully!');
        
        return redirect()->route('admin.blogs.index');
    }

    /**
     * Fetch active categories.
     */
    public function render()
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('name')->get();

        return view('admin.blog.update.update', [
            'categories' => $categories,
        ]);
    }
};
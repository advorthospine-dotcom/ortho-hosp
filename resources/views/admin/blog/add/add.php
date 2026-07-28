<?php

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin')] #[Title('Create Blog Post | Admin')] class extends Component
{
    use WithFileUploads;

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
     * Auto-generate slug when title changes.
     */
    public function updatedTitle(string $value): void
    {
        $this->slug = Str::slug($value);
    }

    /**
     * Save the blog post.
     */
    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:blogs,slug',
            'category_id' => 'required|exists:blog_categories,id',
            'content' => 'required|min:10',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'image_alt' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:255',
        ]);

        $validated['author'] = Auth::id();

        if ($this->image) {
            $path = $this->image->store('blogs', 'public');
            $validated['image_path'] = $path;
        }

        // Remove temporary upload instance
        unset($validated['image']);

        Blog::create($validated);

        session()->flash('toast-message', 'Blog post published successfully!');

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Fetch active categories.
     */
    public function render()
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('name')->get();

        return view('admin.blog.add.add', [
            'categories' => $categories,
        ]);
    }
};

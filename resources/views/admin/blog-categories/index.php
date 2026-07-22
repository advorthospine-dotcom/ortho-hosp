<?php

use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Blog Categories | Admin')] class extends Component
{
    use WithPagination;

    public string $search = '';

    // Form fields
    public ?int $categoryId = null;
    public string $name = '';
    public string $slug = '';

    // Listeners or search reset
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Auto-generate slug when name changes.
     */
    public function updatedName(string $value): void
    {
        $this->slug = Str::slug($value);
    }

    /**
     * Reset form fields.
     */
    public function resetFields(): void
    {
        $this->categoryId = null;
        $this->name = '';
        $this->slug = '';
    }

    /**
     * Open Modal for creating new category.
     */
    public function create(): void
    {
        $this->resetValidation();
        $this->resetFields();
        $this->dispatch('open-category-modal');
    }

    /**
     * Save category (create or update).
     */
    public function save(): void
    {
        $validated = $this->validate([
            'name' => 'required|min:2|max:255',
            'slug' => 'required|max:255|unique:blog_categories,slug,' . ($this->categoryId ?? 'NULL') . ',id',
        ]);

        BlogCategory::updateOrCreate(
            ['id' => $this->categoryId],
            $validated
        );

        $this->dispatch('close-category-modal');
        
        $this->dispatch('toast', [
            'message' => $this->categoryId ? 'Category updated successfully!' : 'Category created successfully!',
            'type' => 'success'
        ]);

        $this->resetFields();
    }

    /**
     * Edit existing category.
     */
    public function edit(int $id): void
    {
        $this->resetValidation();
        
        $category = BlogCategory::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;

        $this->dispatch('open-category-modal');
    }

    /**
     * Delete category.
     */
    public function delete(int $id): void
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();

        $this->dispatch('toast', [
            'message' => 'Category deleted successfully!',
            'type' => 'success'
        ]);
    }

    /**
     * Render view with search filter.
     */
    public function render()
    {
        $categories = BlogCategory::query()
            ->when($this->search !== '', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->withCount('blogs')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.blog-categories.index', [
            'categories' => $categories,
        ]);
    }
};

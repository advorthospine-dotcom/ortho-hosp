<?php

use App\Models\PageContent;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Page SEO Management | Admin')] class extends Component
{
    use WithPagination;

    public string $search = '';

    // Form fields
    public ?int $pageId = null;

    public string $page_name = '';

    public string $slug = '';

    public string $meta_title = '';

    public string $meta_description = '';

    public string $meta_keywords = '';

    public string $og_title = '';

    public string $og_description = '';

    public bool $is_active = true;

    /**
     * Reset pagination when search term updates.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Auto-slug generation from page name if creating a new record.
     */
    public function updatedPageName(string $value): void
    {
        if (! $this->pageId) {
            $this->slug = Str::slug($value);
        }
    }

    /**
     * Clear modal form input fields.
     */
    public function resetFields(): void
    {
        $this->pageId = null;
        $this->page_name = '';
        $this->slug = '';
        $this->meta_title = '';
        $this->meta_description = '';
        $this->meta_keywords = '';
        $this->og_title = '';
        $this->og_description = '';
        $this->is_active = true;
    }

    /**
     * Open modal form for creating a new page entry.
     */
    public function create(): void
    {
        $this->resetValidation();
        $this->resetFields();
        $this->dispatch('open-page-modal');
    }

    /**
     * Save page content record (create or update).
     */
    public function save(): void
    {
        $validated = $this->validate([
            'page_name' => 'required|min:2|max:255',
            'slug' => 'required|max:255|unique:page_contents,slug,'.($this->pageId ?? 'NULL').',id',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'meta_keywords' => 'nullable|max:255',
            'og_title' => 'nullable|max:255',
            'og_description' => 'nullable|max:500',
            'is_active' => 'boolean',
        ]);

        PageContent::updateOrCreate(
            ['id' => $this->pageId],
            $validated
        );

        $this->dispatch('close-page-modal');

        $this->dispatch('toast-show', [
            'message' => $this->pageId ? 'Page SEO updated successfully!' : 'Page SEO created successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);

        $this->resetFields();
    }

    /**
     * Open modal form populated with existing page details.
     */
    public function edit(int $id): void
    {
        $this->resetValidation();

        $page = PageContent::findOrFail($id);
        $this->pageId = $page->id;
        $this->page_name = $page->page_name ?? '';
        $this->slug = $page->slug;
        $this->meta_title = $page->meta_title ?? '';
        $this->meta_description = $page->meta_description ?? '';
        $this->meta_keywords = $page->meta_keywords ?? '';
        $this->og_title = $page->og_title ?? '';
        $this->og_description = $page->og_description ?? '';
        $this->is_active = (bool) $page->is_active;

        $this->dispatch('open-page-modal');
    }

    /**
     * Toggle active publication status of a page.
     */
    public function toggleStatus(int $id): void
    {
        $page = PageContent::findOrFail($id);
        $page->is_active = ! $page->is_active;
        $page->save();

        $this->dispatch('toast-show', [
            'message' => 'Page status updated successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Delete page SEO entry.
     */
    public function delete(int $id): void
    {
        $page = PageContent::findOrFail($id);
        $page->delete();

        $this->dispatch('toast-show', [
            'message' => 'Page SEO deleted successfully!',
            'type' => 'danger',
            'position' => 'top-right',
        ]);
    }

    /**
     * Render admin view.
     */
    public function render()
    {
        $pages = PageContent::query()
            ->when($this->search !== '', function ($query) {
                $query->where('page_name', 'like', '%'.$this->search.'%')
                    ->orWhere('slug', 'like', '%'.$this->search.'%')
                    ->orWhere('meta_title', 'like', '%'.$this->search.'%');
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.page-mangement.page-mangement', [
            'pages' => $pages,
        ]);
    }
};

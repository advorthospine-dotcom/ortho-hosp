<?php

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Gallery | Admin')] class extends Component
{
    use WithFileUploads;
    use WithPagination;

    // File upload state
    public $images = [];

    // Form inputs for single item add/edit
    public ?int $editingId = null;

    public string $title = '';

    public bool $is_active = true;

    // Filters
    public string $search = '';

    public string $filterStatus = 'all';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    /**
     * Upload and create new gallery item(s).
     */
    public function uploadImages(): void
    {
        $this->validate([
            'images.*' => 'required|image|max:10240', // Max 10MB per image
        ]);

        if (empty($this->images)) {
            $this->addError('images', 'Please select at least one image to upload.');

            return;
        }

        $count = count($this->images);

        foreach ($this->images as $index => $image) {
            $path = $image->store('gallery', 'public');

            // Use provided title or fallback to original filename without extension
            $itemTitle = trim($this->title);
            if ($itemTitle === '') {
                $itemTitle = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $itemTitle = str_replace(['-', '_'], ' ', $itemTitle);
                $itemTitle = ucwords($itemTitle);
            } elseif ($count > 1) {
                $itemTitle = $itemTitle.' ('.($index + 1).')';
            }

            Gallery::create([
                'title' => $itemTitle,
                'image_path' => $path,
                'is_active' => $this->is_active,
            ]);
        }

        $this->resetUploadForm();

        $this->dispatch('close-upload-modal');

        $this->dispatch('toast-show', [
            'message' => $count > 1 ? "{$count} gallery images uploaded successfully!" : 'Gallery image uploaded successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Set up item editing.
     */
    public function edit(int $id): void
    {
        $gallery = Gallery::findOrFail($id);
        $this->editingId = $gallery->id;
        $this->title = $gallery->title ?? '';
        $this->is_active = $gallery->is_active;

        $this->dispatch('open-edit-modal');
    }

    /**
     * Update existing gallery item details (e.g. title, status).
     */
    public function updateGallery(): void
    {
        if (! $this->editingId) {
            return;
        }

        $this->validate([
            'title' => 'nullable|string|max:255',
        ]);

        $gallery = Gallery::findOrFail($this->editingId);
        $gallery->update([
            'title' => $this->title,
            'is_active' => $this->is_active,
        ]);

        $this->resetUploadForm();

        $this->dispatch('close-edit-modal');

        $this->dispatch('toast-show', [
            'message' => 'Gallery item updated successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Toggle item active status inline.
     */
    public function toggleStatus(int $id): void
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->is_active = ! $gallery->is_active;
        $gallery->save();

        $statusText = $gallery->is_active ? 'published' : 'hidden';

        $this->dispatch('toast-show', [
            'message' => "Gallery image is now {$statusText}.",
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Delete gallery item and its disk file.
     */
    public function delete(int $id): void
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        $this->dispatch('toast-show', [
            'message' => 'Gallery item deleted permanently!',
            'type' => 'danger',
            'position' => 'top-right',
        ]);
    }

    /**
     * Reset form inputs.
     */
    public function resetUploadForm(): void
    {
        $this->images = [];
        $this->editingId = null;
        $this->title = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }

    /**
     * Render component view.
     */
    public function render()
    {
        $galleries = Gallery::query()
            ->when($this->search !== '', fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->when($this->filterStatus === 'active', fn ($q) => $q->where('is_active', true))
            ->when($this->filterStatus === 'inactive', fn ($q) => $q->where('is_active', false))
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.gallery.gallery', [
            'galleries' => $galleries,
        ]);
    }
};

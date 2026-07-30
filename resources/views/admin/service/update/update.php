<?php

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin')] #[Title('Edit Clinical Service | Admin')] class extends Component
{
    use WithFileUploads;

    public int $id;
    public Service $service;

    // Core Fields
    public string $title = '';
    public string $slug = '';
    public string $category = 'trauma';
    public string $category_label = '';
    public string $color = 'blue';
    public string $badge = '';
    public string $desc = '';
    public string $featuresInput = '';
    public bool $is_active = true;

    // Image Upload
    public $imageFile = null;
    public ?string $existingImage = null;

    // SEO Meta Fields
    public string $meta_title = '';
    public string $meta_desc = '';
    public string $meta_keywords = '';

    public function mount(int $id): void
    {
        $this->id = $id;
        $this->service = Service::findOrFail($id);

        $this->title = $this->service->title;
        $this->slug = $this->service->slug;
        $this->category = $this->service->category;
        $this->category_label = $this->service->category_label ?? '';
        $this->color = $this->service->color ?? 'blue';
        $this->badge = $this->service->badge ?? '';
        $this->desc = $this->service->desc ?? '';
        $this->existingImage = $this->service->image;
        $this->is_active = (bool) $this->service->is_active;

        $this->meta_title = $this->service->meta_title ?? '';
        $this->meta_desc = $this->service->meta_desc ?? $this->service->meta_description ?? '';
        $this->meta_keywords = $this->service->meta_keywords ?? '';

        $features = is_array($this->service->features) ? $this->service->features : [];
        $this->featuresInput = implode("\n", $features);
    }

    /**
     * Auto-generate slug when title changes in edit mode.
     */
    public function updatedTitle(string $value): void
    {
        if (empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    /**
     * Auto-update category label when category changes.
     */
    public function updatedCategory(string $value): void
    {
        $labels = [
            'trauma' => 'Trauma & Emergency Care',
            'spine' => 'Spine & Back Care',
            'joints' => 'Joint Replacements',
            'sports' => 'Sports Medicine & Arthroscopy',
            'specialized' => 'Specialized & Rehabilitation',
        ];

        $this->category_label = $labels[$value] ?? ucfirst($value);
    }

    /**
     * Clear selected or existing image.
     */
    public function removeImage(): void
    {
        $this->imageFile = null;
        $this->existingImage = null;
    }

    /**
     * Update the service.
     */
    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services,slug,' . $this->id,
            'category' => 'required|string|max:100',
            'category_label' => 'nullable|string|max:255',
            'color' => 'required|string|max:50',
            'badge' => 'nullable|string|max:100',
            'desc' => 'required|string|min:10',
            'featuresInput' => 'nullable|string',
            'imageFile' => 'nullable|image|max:10240', // 10MB max
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Process features lines
        $featuresArray = array_values(array_filter(array_map('trim', explode("\n", $this->featuresInput))));

        $imagePath = $this->existingImage;
        if ($this->imageFile) {
            $imagePath = $this->imageFile->store('services', 'public');
        }

        $this->service->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->category,
            'category_label' => $this->category_label ?: ucfirst($this->category),
            'color' => $this->color,
            'badge' => $this->badge,
            'image' => $imagePath,
            'desc' => $this->desc,
            'features' => $featuresArray,
            'meta_title' => $this->meta_title,
            'meta_desc' => $this->meta_desc,
            'meta_keywords' => $this->meta_keywords,
            'is_active' => $this->is_active,
        ]);

        session()->flash('toast-message', 'Clinical service updated successfully!');

        return redirect()->route('admin.services.index');
    }

    public function render()
    {
        return view('admin.service.update.update');
    }
};

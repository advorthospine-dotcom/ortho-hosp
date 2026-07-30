<?php

use App\Models\Service;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin')] #[Title('Add New Clinical Service | Admin')] class extends Component
{
    use WithFileUploads;

    // Core Fields
    public string $title = '';
    public string $slug = '';
    public string $category = 'trauma';
    public string $category_label = 'Trauma & Emergency Care';
    public string $color = 'blue';
    public string $badge = 'Specialty Care';
    public string $desc = '';
    public string $featuresInput = '';
    public bool $is_active = true;

    // Image Upload
    public $imageFile = null;

    // SEO Meta Fields
    public string $meta_title = '';
    public string $meta_desc = '';
    public string $meta_keywords = '';

    /**
     * Auto-generate slug when title changes.
     */
    public function updatedTitle(string $value): void
    {
        $this->slug = Str::slug($value);
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
     * Save the new service.
     */
    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services,slug',
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

        $imagePath = null;
        if ($this->imageFile) {
            $imagePath = $this->imageFile->store('services', 'public');
        }

        Service::create([
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

        session()->flash('toast-message', 'New clinical service created successfully!');

        return redirect()->route('admin.services.index');
    }

    public function render()
    {
        return view('admin.service.add.add');
    }
};

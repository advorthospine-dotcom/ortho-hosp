<?php

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Services Management | Admin')] class extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Filters
    public string $search = '';
    public string $categoryFilter = 'all';

    // Form Fields for Add / Edit
    public ?int $serviceId = null;
    public string $title = '';
    public string $slug = '';
    public string $category = 'trauma';
    public string $category_label = 'Trauma & Emergency';
    public string $color = 'blue';
    public string $badge = '';
    public string $desc = '';
    public string $featuresInput = '';
    public $imageFile = null;
    public ?string $existingImage = null;
    public bool $is_active = true;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Auto-generate slug when title changes in add mode.
     */
    public function updatedTitle(): void
    {
        if (! $this->serviceId) {
            $this->slug = Str::slug($this->title);
        }
    }

    /**
     * Auto-update category label when category changes.
     */
    public function updatedCategory(): void
    {
        $labels = [
            'trauma' => 'Trauma & Emergency',
            'spine' => 'Spine & Back Care',
            'joints' => 'Joint Replacements',
            'sports' => 'Sports Medicine',
            'specialized' => 'Specialized & Rehab',
        ];

        $this->category_label = $labels[$this->category] ?? ucfirst($this->category);
    }

    /**
     * Prepare form for creating a new service.
     */
    public function create(): void
    {
        $this->resetForm();
        $this->dispatch('open-service-modal');
    }

    /**
     * Prepare form for editing an existing service.
     */
    public function edit(int $id): void
    {
        $service = Service::findOrFail($id);

        $this->serviceId = $service->id;
        $this->title = $service->title;
        $this->slug = $service->slug;
        $this->category = $service->category;
        $this->category_label = $service->category_label ?? '';
        $this->color = $service->color ?? 'blue';
        $this->badge = $service->badge ?? '';
        $this->desc = $service->desc ?? '';
        $this->existingImage = $service->image;
        $this->imageFile = null;
        $this->is_active = (bool) $service->is_active;

        $features = is_array($service->features) ? $service->features : [];
        $this->featuresInput = implode("\n", $features);

        $this->resetErrorBag();
        $this->dispatch('open-service-modal');
    }

    /**
     * Save (create or update) service.
     */
    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services,slug,' . ($this->serviceId ?? 'NULL'),
            'category' => 'required|string|max:100',
            'category_label' => 'nullable|string|max:255',
            'color' => 'required|string|max:50',
            'badge' => 'nullable|string|max:100',
            'desc' => 'required|string|max:2000',
            'featuresInput' => 'nullable|string',
            'imageFile' => 'nullable|image|max:10240', // 10MB max
            'is_active' => 'boolean',
        ]);

        // Process features lines
        $featuresArray = array_values(array_filter(array_map('trim', explode("\n", $this->featuresInput))));

        $imagePath = $this->existingImage;

        if ($this->imageFile) {
            $imagePath = $this->imageFile->store('services', 'public');
        }

        Service::updateOrCreate(
            ['id' => $this->serviceId],
            [
                'title' => $this->title,
                'slug' => $this->slug,
                'category' => $this->category,
                'category_label' => $this->category_label ?: ucfirst($this->category),
                'color' => $this->color,
                'badge' => $this->badge,
                'image' => $imagePath,
                'desc' => $this->desc,
                'features' => $featuresArray,
                'is_active' => $this->is_active,
            ]
        );

        $message = $this->serviceId ? 'Service updated successfully!' : 'New service created successfully!';

        $this->resetForm();
        $this->dispatch('close-service-modal');

        $this->dispatch('toast-show', [
            'message' => $message,
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Toggle service active status inline.
     */
    public function toggleStatus(int $id): void
    {
        $service = Service::findOrFail($id);
        $service->is_active = ! $service->is_active;
        $service->save();

        $statusText = $service->is_active ? 'published' : 'hidden';

        $this->dispatch('toast-show', [
            'message' => "Service is now {$statusText}.",
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Delete service.
     */
    public function delete(int $id): void
    {
        $service = Service::findOrFail($id);

        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        $this->dispatch('toast-show', [
            'message' => 'Service deleted permanently!',
            'type' => 'danger',
            'position' => 'top-right',
        ]);
    }

    /**
     * Remove or clear selected image.
     */
    public function removeImage(): void
    {
        $this->imageFile = null;
        $this->existingImage = null;
    }

    /**
     * Reset form.
     */
    public function resetForm(): void
    {
        $this->serviceId = null;
        $this->title = '';
        $this->slug = '';
        $this->category = 'trauma';
        $this->category_label = 'Trauma & Emergency';
        $this->color = 'blue';
        $this->badge = '';
        $this->desc = '';
        $this->featuresInput = '';
        $this->imageFile = null;
        $this->existingImage = null;
        $this->is_active = true;
        $this->resetErrorBag();
    }

    /**
     * Render view.
     */
    public function render()
    {
        $services = Service::query()
            ->when($this->search !== '', function ($q) {
                $q->where(function ($sub) {
                    $sub->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%')
                        ->orWhere('desc', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter !== 'all', fn ($q) => $q->where('category', $this->categoryFilter))
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.service.list.list', [
            'services' => $services,
        ]);
    }
};

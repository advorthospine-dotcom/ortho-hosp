<?php

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Services Management | Admin')] class extends Component
{
    use WithPagination;

    // Filters
    public string $search = '';
    public string $categoryFilter = 'all';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter(): void
    {
        $this->resetPage();
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

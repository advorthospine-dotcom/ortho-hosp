<?php

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app')] class extends Component
{
    public ?Service $service = null;

    /**
     * Load target service page by slug from database.
     */
    public function mount(string $slug): void
    {
        $loaded = Service::where('slug', $slug)->where('is_active', true)->first();

        if (! $loaded) {
            abort(404);
        }

        $this->service = $loaded;
    }

    /**
     * Render layout view.
     */
    public function render()
    {
        $relatedServices = Service::where('category', $this->service->category)
            ->where('id', '!=', $this->service->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('pages.service-view.service-view', [
            'relatedServices' => $relatedServices,
        ])->title($this->service->title.' | Advance Ortho & Spine');
    }
};

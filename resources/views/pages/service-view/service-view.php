<?php

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app')] class extends Component
{
    public array $service = [];

    /**
     * Load the target service page.
     */
    public function mount(string $slug): void
    {
        $loaded = Service::findBySlug($slug);

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
        // Load related services in the same category
        $relatedServices = array_filter(Service::all(), function ($item) {
            return $item['category'] === $this->service['category'] && $item['id'] !== $this->service['id'];
        });

        return view('pages.service-view.service-view', [
            'relatedServices' => array_slice($relatedServices, 0, 4),
        ])->title($this->service['title'].' | Advance Ortho & Spine');
    }
};

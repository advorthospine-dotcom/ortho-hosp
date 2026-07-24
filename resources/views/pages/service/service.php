<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Our Orthopaedic & Spine Services | Advance Center')] class extends Component
{
    public string $search = '';
    public string $activeCategory = 'all';

    /**
     * Reset filters when category selection changes.
     */
    public function selectCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    /**
     * Reset query parameters when typing search.
     */
    public function updatingSearch(): void
    {
        // No pagination to reset, but hook present for consistency
    }

    /**
     * Reset active filters.
     */
    public function clearFilters(): void
    {
        $this->search = '';
        $this->activeCategory = 'all';
    }

    /**
     * Get computed list of services.
     */
    #[Computed]
    public function services(): array
    {
        $allServices = \App\Models\Service::all();

        return array_filter($allServices, function ($service) {
            $matchesCategory = $this->activeCategory === 'all' || $service['category'] === $this->activeCategory;
            $matchesSearch = empty($this->search) ||
                stripos($service['title'], $this->search) !== false ||
                stripos($service['desc'], $this->search) !== false ||
                stripos($service['category_label'], $this->search) !== false;

            return $matchesCategory && $matchesSearch;
        });
    }

    /**
     * Get counts per category.
     */
    #[Computed]
    public function categoryCounts(): array
    {
        $all = \App\Models\Service::all();
        $counts = ['all' => count($all)];

        foreach ($all as $s) {
            $cat = $s['category'];
            $counts[$cat] = ($counts[$cat] ?? 0) + 1;
        }

        return $counts;
    }

    /**
     * Render view.
     */
    public function render()
    {
        return view('pages.service.service');
    }
};
<?php

use App\Models\Service;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Our Orthopaedic & Spine Services | Advance Center')] class extends Component
{
    public string $search = '';

    public string $activeCategory = 'all';

    /**
     * Set active department category filter.
     */
    public function selectCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    /**
     * Reset active search and category filters.
     */
    public function clearFilters(): void
    {
        $this->search = '';
        $this->activeCategory = 'all';
    }

    /**
     * Get computed list of active services from database matching search & category filters.
     */
    #[Computed]
    public function services()
    {
        return Service::query()
            ->where('is_active', true)
            ->when($this->activeCategory !== 'all', fn ($q) => $q->where('category', $this->activeCategory))
            ->when($this->search !== '', function ($q) {
                $q->where(function ($sub) {
                    $sub->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('desc', 'like', '%'.$this->search.'%')
                        ->orWhere('category_label', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Get total active counts per category.
     */
    #[Computed]
    public function categoryCounts(): array
    {
        $all = Service::where('is_active', true)->get();
        $counts = ['all' => $all->count()];

        foreach ($all as $s) {
            $cat = $s->category;
            if ($cat) {
                $counts[$cat] = ($counts[$cat] ?? 0) + 1;
            }
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

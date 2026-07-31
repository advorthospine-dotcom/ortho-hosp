<?php

use App\Models\VideoContent;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::app')] #[Title('Video Gallery & Patient Education | Advance Orthopaedic & Spine Center')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $videos = VideoContent::query()
            ->where('is_active', true)
            ->when($this->search !== '', fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->orderByDesc('id')
            ->paginate(9);

        return view('pages.videos.videos', [
            'videos' => $videos,
        ]);
    }
};

<?php

use App\Models\Gallery;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::app')] #[Title('Hospital Photo Gallery | Advance Orthopaedic & Spine Center')] class extends Component
{
    use WithPagination;

    public function render()
    {
        $galleries = Gallery::query()
            ->where('is_active', true)
            ->whereNotNull('image_path')
            ->where('image_path', '!=', '')
            ->orderByDesc('id')
            ->paginate(12);

        $totalImages = Gallery::where('is_active', true)
            ->whereNotNull('image_path')
            ->where('image_path', '!=', '')
            ->count();

        return view('pages.gallery.gallery', [
            'galleries' => $galleries,
            'totalImages' => $totalImages,
        ]);
    }
};

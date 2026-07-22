<?php

use App\Models\BlogImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Media Library | Admin')] class extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Supports multiple file upload
    public $images = [];

    /**
     * Upload and save multiple images.
     */
    public function upload(): void
    {
        $this->validate([
            'images.*' => 'required|image|max:4096', // 4MB Max per image
        ]);

        foreach ($this->images as $image) {
            $path = $image->store('media', 'public');
            $link = asset('storage/' . $path);

            BlogImage::create([
                'image_path' => $path,
                'image_link' => $link,
            ]);
        }

        // Clear input after successful upload
        $this->images = [];

        $this->dispatch('toast', [
            'message' => 'Images uploaded successfully!',
            'type' => 'success'
        ]);
    }

    /**
     * Delete an image from DB and disk storage.
     */
    public function delete(int $id): void
    {
        $image = BlogImage::findOrFail($id);

        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        $this->dispatch('toast', [
            'message' => 'Image deleted successfully!',
            'type' => 'success'
        ]);
    }

    /**
     * Render view.
     */
    public function render()
    {
        $mediaList = BlogImage::query()
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.media.index', [
            'mediaList' => $mediaList,
        ]);
    }
};

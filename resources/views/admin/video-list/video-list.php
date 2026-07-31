<?php

use App\Models\VideoContent;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Video Library | Admin')] class extends Component
{
    use WithPagination;

    public ?int $editingId = null;
    public string $title = '';
    public string $video_url = '';
    public bool $is_active = true;

    // Filters & Search
    public string $search = '';
    public string $filterStatus = 'all';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    /**
     * Create a new video content item.
     */
    public function createVideo(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url|max:500',
        ]);

        VideoContent::create([
            'title' => trim($this->title),
            'video_url' => trim($this->video_url),
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();

        $this->dispatch('close-add-modal');

        $this->dispatch('toast-show', [
            'message' => 'Video content added successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Prepare video item for edit modal.
     */
    public function edit(int $id): void
    {
        $video = VideoContent::findOrFail($id);
        $this->editingId = $video->id;
        $this->title = $video->title ?? '';
        $this->video_url = $video->video_url ?? '';
        $this->is_active = $video->is_active;

        $this->dispatch('open-edit-modal');
    }

    /**
     * Update an existing video item.
     */
    public function updateVideo(): void
    {
        if (!$this->editingId) {
            return;
        }

        $this->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url|max:500',
        ]);

        $video = VideoContent::findOrFail($this->editingId);
        $video->update([
            'title' => trim($this->title),
            'video_url' => trim($this->video_url),
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();

        $this->dispatch('close-edit-modal');

        $this->dispatch('toast-show', [
            'message' => 'Video updated successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Toggle active status inline.
     */
    public function toggleStatus(int $id): void
    {
        $video = VideoContent::findOrFail($id);
        $video->is_active = !$video->is_active;
        $video->save();

        $statusText = $video->is_active ? 'published' : 'hidden';

        $this->dispatch('toast-show', [
            'message' => "Video is now {$statusText}.",
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Delete video item.
     */
    public function delete(int $id): void
    {
        $video = VideoContent::findOrFail($id);
        $video->delete();

        $this->dispatch('toast-show', [
            'message' => 'Video deleted permanently!',
            'type' => 'danger',
            'position' => 'top-right',
        ]);
    }

    /**
     * Reset form fields.
     */
    public function resetForm(): void
    {
        $this->editingId = null;
        $this->title = '';
        $this->video_url = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        $videos = VideoContent::query()
            ->when($this->search !== '', fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->filterStatus === 'active', fn ($q) => $q->where('is_active', true))
            ->when($this->filterStatus === 'inactive', fn ($q) => $q->where('is_active', false))
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.video-list.video-list', [
            'videos' => $videos,
        ]);
    }
};
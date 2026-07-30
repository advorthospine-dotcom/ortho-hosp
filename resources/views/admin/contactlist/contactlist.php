<?php

use App\Models\Contact;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] #[Title('Contact Inquiries | Admin')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = 'all'; // all, unread, read

    public ?int $selectedId = null;

    public ?array $activeContact = null;

    /**
     * Reset pagination when search or filter changes.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    /**
     * View full contact inquiry details and automatically mark as read.
     */
    public function viewDetails(int $id): void
    {
        $contact = Contact::findOrFail($id);

        if (! $contact->is_read) {
            $contact->is_read = true;
            $contact->save();
        }

        $this->selectedId = $contact->id;
        $this->activeContact = $contact->toArray();

        $this->dispatch('open-contact-modal');
    }

    /**
     * Toggle read / unread status of an inquiry.
     */
    public function toggleRead(int $id): void
    {
        $contact = Contact::findOrFail($id);
        $contact->is_read = ! $contact->is_read;
        $contact->save();

        if ($this->selectedId === $id && $this->activeContact) {
            $this->activeContact['is_read'] = $contact->is_read;
        }

        $this->dispatch('toast-show', [
            'message' => $contact->is_read ? 'Marked as read.' : 'Marked as unread.',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Delete contact record.
     */
    public function delete(int $id): void
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        if ($this->selectedId === $id) {
            $this->selectedId = null;
            $this->activeContact = null;
            $this->dispatch('close-contact-modal');
        }

        $this->dispatch('toast-show', [
            'message' => 'Contact inquiry deleted successfully.',
            'type' => 'danger',
            'position' => 'top-right',
        ]);
    }

    /**
     * Render admin list view.
     */
    public function render()
    {
        $unreadCount = Contact::where('is_read', false)->count();

        $contacts = Contact::query()
            ->when($this->search !== '', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%')
                    ->orWhere('message', 'like', '%'.$this->search.'%')
                    ->orWhere('department', 'like', '%'.$this->search.'%');
            })
            ->when($this->statusFilter === 'unread', fn ($q) => $q->where('is_read', false))
            ->when($this->statusFilter === 'read', fn ($q) => $q->where('is_read', true))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.contactlist.contactlist', [
            'contacts' => $contacts,
            'unreadCount' => $unreadCount,
        ]);
    }
};

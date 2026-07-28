<?php

use App\Models\Service;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Advance Orthopaedic & Spine Center | Super-Specialty Hospital')] class extends Component
{
    public string $search = '';

    public string $activeCategory = 'all';

    // Quick Consultation Booking Form State
    public string $patientName = '';

    public string $patientPhone = '';

    public string $selectedService = 'Trauma & Accident Care';

    public string $preferredTime = 'Morning (9 AM - 12 PM)';

    public bool $bookingSubmitted = false;

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    public function selectCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->activeCategory = 'all';
    }

    public function submitBooking(): void
    {
        $this->validate([
            'patientName' => 'required|min:2',
            'patientPhone' => 'required|min:10',
            'selectedService' => 'required',
        ]);

        $this->bookingSubmitted = true;
    }

    public function resetBooking(): void
    {
        $this->reset(['patientName', 'patientPhone', 'bookingSubmitted']);
    }

    /**
     * Get computed list of active services from database.
     */
    #[Computed]
    public function services()
    {
        return Service::query()
            ->where('is_active', true)
            ->when($this->activeCategory !== 'all', fn ($q) => $q->where('category', $this->activeCategory))
            ->when($this->search !== '', function ($q) {
                $q->where(function ($sub) {
                    $sub->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('desc', 'like', '%' . $this->search . '%')
                        ->orWhere('category_label', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('id', 'asc')
            ->get();
    }
};

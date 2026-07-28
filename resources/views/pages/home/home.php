<?php

use App\Models\Service;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Advance Orthopaedic & Spine Center | World-Class Robotic Surgery & Spine Care')] class extends Component
{
    // Search and filter state
    public string $search = '';

    public string $activeCategory = 'all';

    // Interactive Appointment Booking Form State
    public string $patientName = '';

    public string $patientPhone = '';

    public string $selectedService = 'Robotic Knee Replacement Surgery';

    public string $preferredDate = '';

    public string $consultationMode = 'In-Hospital Visit';

    public bool $bookingSubmitted = false;

    // Interactive Symptom Checker State
    public string $selectedBodyPart = 'spine';

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    public function selectBodyPart(string $part): void
    {
        $this->selectedBodyPart = $part;
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

    #[Computed]
    public function services(): array
    {
        $allServices = Service::all();

        return array_filter($allServices, function ($service) {
            $matchesCategory = $this->activeCategory === 'all' || $service['category'] === $this->activeCategory;
            $matchesSearch = empty($this->search) ||
                stripos($service['title'], $this->search) !== false ||
                stripos($service['desc'], $this->search) !== false ||
                stripos($service['category_label'], $this->search) !== false;

            return $matchesCategory && $matchesSearch;
        });
    }
};

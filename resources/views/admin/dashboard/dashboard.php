<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::admin')] #[Title('Admin Dashboard | Advance Orthopaedic & Spine Center')] class extends Component
{
    /**
     * Component mount.
     */
    public function mount()
    {
        // Add default actions or data fetch here if required
    }
};

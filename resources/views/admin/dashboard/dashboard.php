<?php

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::admin')] #[Title('Admin Dashboard | Advance Orthopaedic & Spine Center')] class extends Component
{
    public int $totalAppointments = 0;
    public int $unreadInquiries = 0;
    public int $totalServices = 0;
    public int $totalBlogs = 0;
    public int $totalGallery = 0;
    public $recentInquiries = [];

    /**
     * Component mount.
     */
    public function mount(): void
    {
        $this->loadDashboardMetrics();
    }

    /**
     * Load real-time stats and metrics from database.
     */
    public function loadDashboardMetrics(): void
    {
        $this->totalAppointments = Contact::count();
        $this->unreadInquiries = Contact::where('is_read', false)->count();
        $this->totalServices = Service::count();
        $this->totalBlogs = Blog::count();
        $this->totalGallery = Gallery::count();
        $this->recentInquiries = Contact::latest()->take(6)->get();
    }

    /**
     * Mark an inquiry as read.
     */
    public function markAsRead(int $id): void
    {
        $inquiry = Contact::find($id);
        if ($inquiry) {
            $inquiry->update(['is_read' => true]);
            $this->loadDashboardMetrics();
            $this->dispatch('toast-show', [
                'message' => 'Inquiry marked as reviewed.',
                'type' => 'success',
                'position' => 'top-right',
            ]);
        }
    }

    /**
     * Delete an inquiry.
     */
    public function deleteInquiry(int $id): void
    {
        Contact::destroy($id);
        $this->loadDashboardMetrics();
        $this->dispatch('toast-show', [
            'message' => 'Inquiry record removed.',
            'type' => 'danger',
            'position' => 'top-right',
        ]);
    }

    public function render()
    {
        return view('admin.dashboard.dashboard');
    }
};

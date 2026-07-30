<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts::admin')] #[Title('Settings | Admin')] class extends Component
{
    use WithFileUploads;

    // Active tab in UI: 'hospital', 'social', 'hero'
    public string $activeTab = 'hospital';

    // Hospital Basic Information
    public string $hospital_name = '';

    public string $phone_number = '';

    public string $whatsapp_number = '';

    public string $email = '';

    public string $address = '';

    public string $opd_timings = '';

    public string $google_maps_url = '';

    // Social Media Links
    public string $social_instagram = '';

    public string $social_facebook = '';

    public string $social_x = '';

    // Hero Section Configuration
    public string $hero_title = '';

    public string $hero_description = '';

    public array $existingHeroImages = [];

    public array $newHeroImages = [];

    /**
     * Mount component & load current settings from DB.
     */
    public function mount(): void
    {
        $this->hospital_name = Setting::get('hospital_name', 'Advance Ortho & Spine Center');
        $this->phone_number = Setting::get('phone_number', '+1 (555) 234-5678');
        $this->whatsapp_number = Setting::get('whatsapp_number', '+1 (555) 987-6543');
        $this->email = Setting::get('email', 'care@advanceorthospine.com');
        $this->address = Setting::get('address', '450 Health Avenue, Medical District, NY 10001');
        $this->opd_timings = Setting::get('opd_timings', 'Mon - Sat: 8:00 AM - 8:00 PM');
        $this->google_maps_url = Setting::get('google_maps_url', 'https://maps.google.com');

        $this->social_instagram = Setting::get('social_instagram', 'https://instagram.com/orthohosp');
        $this->social_facebook = Setting::get('social_facebook', 'https://facebook.com/orthohosp');
        $this->social_x = Setting::get('social_x', 'https://x.com/orthohosp');

        $this->hero_title = Setting::get('hero_title', 'Advanced Orthopedic & Spine Surgery Center');
        $this->hero_description = Setting::get('hero_description', 'Providing world-class comprehensive orthopedic care, joint replacement, and minimally invasive spine surgery.');

        $images = Setting::get('hero_slider_images', []);
        $this->existingHeroImages = is_array($images) ? $images : [];
    }

    /**
     * Save Hospital Contact Information.
     */
    public function saveHospitalInfo(): void
    {
        $this->validate([
            'hospital_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:50',
            'whatsapp_number' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'opd_timings' => 'nullable|string|max:255',
            'google_maps_url' => 'nullable|url|max:500',
        ]);

        Setting::set('hospital_name', $this->hospital_name);
        Setting::set('phone_number', $this->phone_number);
        Setting::set('whatsapp_number', $this->whatsapp_number);
        Setting::set('email', $this->email);
        Setting::set('address', $this->address);
        Setting::set('opd_timings', $this->opd_timings);
        Setting::set('google_maps_url', $this->google_maps_url);

        $this->dispatch('toast-show', [
            'message' => 'Hospital information updated successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Save Social Links.
     */
    public function saveSocialLinks(): void
    {
        $this->validate([
            'social_instagram' => 'nullable|url|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_x' => 'nullable|url|max:255',
        ]);

        Setting::set('social_instagram', $this->social_instagram);
        Setting::set('social_facebook', $this->social_facebook);
        Setting::set('social_x', $this->social_x);

        $this->dispatch('toast-show', [
            'message' => 'Social media links updated successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Save Hero Section Title, Description, and upload new Slider Images.
     */
    public function saveHeroSection(): void
    {
        $this->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string|max:1000',
            'newHeroImages.*' => 'nullable|image|max:10240', // 10MB per image max
        ]);

        Setting::set('hero_title', $this->hero_title);
        Setting::set('hero_description', $this->hero_description);

        // Upload any new images to public storage
        if (! empty($this->newHeroImages)) {
            foreach ($this->newHeroImages as $image) {
                $path = $image->store('hero-slider', 'public');
                $this->existingHeroImages[] = $path;
            }
            $this->newHeroImages = [];
        }

        Setting::set('hero_slider_images', array_values($this->existingHeroImages));

        $this->dispatch('toast-show', [
            'message' => 'Hero section details and image slider updated successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    /**
     * Remove a hero slider image by array index.
     */
    public function removeHeroImage(int $index): void
    {
        if (isset($this->existingHeroImages[$index])) {
            $imagePath = $this->existingHeroImages[$index];

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            unset($this->existingHeroImages[$index]);
            $this->existingHeroImages = array_values($this->existingHeroImages);

            Setting::set('hero_slider_images', $this->existingHeroImages);

            $this->dispatch('toast-show', [
                'message' => 'Slider image removed successfully!',
                'type' => 'danger',
                'position' => 'top-right',
            ]);
        }
    }

    /**
     * Render view.
     */
    public function render()
    {
        return view('admin.setting.setting');
    }
};

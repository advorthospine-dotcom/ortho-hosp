<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Advanced Joint Replacement Operating Suite',
                'image_path' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80',
                'is_active' => true,
            ],
            [
                'title' => 'Advanced Surgical Navigation & Precision Suite',
                'image_path' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80',
                'is_active' => true,
            ],
            [
                'title' => 'Dedicated Orthopaedic & Spine ICU Unit',
                'image_path' => 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=1200&q=80',
                'is_active' => true,
            ],
            [
                'title' => 'Keyhole Minimally Invasive Spine Surgery OT',
                'image_path' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80',
                'is_active' => true,
            ],
            [
                'title' => 'Advanced Physiotherapy & Hydrotherapy Gym',
                'image_path' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80',
                'is_active' => true,
            ],
            [
                'title' => 'Deluxe Private Patient Recovery Suite',
                'image_path' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=80',
                'is_active' => true,
            ],
            [
                'title' => '24/7 Level-1 Trauma & Fracture Triage Center',
                'image_path' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80',
                'is_active' => true,
            ],
            [
                'title' => 'High-Definition Digital MRI & CT Scan Facility',
                'image_path' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80',
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $item) {
            Gallery::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\VideoContent;
use Illuminate\Database\Seeder;

class VideoContentSeeder extends Seeder
{
    /**
     * Seed initial hospital video library data into database.
     */
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Advanced 3D CT-Guided Total Knee Replacement Procedure',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_active' => true,
            ],
            [
                'title' => 'Minimally Invasive Keyhole Discectomy & Spine Decompression Overview',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_active' => true,
            ],
            [
                'title' => '24/7 Level-1 Trauma OT & Emergency Fracture Care Center Walkthrough',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_active' => true,
            ],
            [
                'title' => 'Arthroscopic ACL Reconstruction & Athlete Rehabilitation Protocol',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_active' => true,
            ],
            [
                'title' => 'Advanced Physiotherapy & Hydrotherapy Recovery Exercises',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_active' => true,
            ],
            [
                'title' => 'Patient Recovery Testimonial: Walking 24 Hours Post Hip Replacement',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_active' => true,
            ],
        ];

        foreach ($videos as $data) {
            VideoContent::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}

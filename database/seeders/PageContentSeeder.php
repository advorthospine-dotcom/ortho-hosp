<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_name' => 'Home Page',
                'slug' => 'home',
                'meta_title' => 'Advance Orthopaedic & Spine Center | Super-Specialty Hospital',
                'meta_description' => 'Advance Orthopaedic & Spine Center - Premier hospital for knee replacement, endoscopic spine surgery, joint care, sports injury, and 24/7 emergency care in Kanpur.',
                'meta_keywords' => 'orthopaedic hospital, spine surgeon Kanpur, knee replacement, joint care, sports medicine, trauma center',
                'og_title' => 'Advance Orthopaedic & Spine Center | Leading Super-Specialty Hospital',
                'og_description' => 'World-class joint replacement, spine surgery, and 24/7 trauma emergency services with advanced modular OTs.',
                'is_active' => true,
            ],
            [
                'page_name' => 'About Us',
                'slug' => 'about',
                'meta_title' => 'About Us | Advance Orthopaedic & Spine Center',
                'meta_description' => 'Discover Advance Orthopaedic & Spine Center. Dedicated team of experienced spine surgeons, joint specialists, and state-of-the-art medical infrastructure.',
                'meta_keywords' => 'about orthopaedic center, top spine surgeons, hospital infrastructure, orthopedic excellence',
                'og_title' => 'About Advance Orthopaedic & Spine Center',
                'og_description' => 'Delivering compassionate care and cutting-edge orthopaedic surgery for over two decades.',
                'is_active' => true,
            ],
            [
                'page_name' => 'Clinical Services',
                'slug' => 'services',
                'meta_title' => 'Clinical Services & Treatments | Advance Orthopaedic & Spine Center',
                'meta_description' => 'Comprehensive orthopaedic services including minimally invasive spine surgery, robotic knee replacement, fracture care, and physical therapy.',
                'meta_keywords' => 'orthopaedic services, robotic joint replacement, endoscopic spine surgery, fracture treatment, physical therapy',
                'og_title' => 'Expert Clinical Services & Spine Surgery',
                'og_description' => 'Advanced surgical and non-surgical treatments tailored to restore your mobility.',
                'is_active' => true,
            ],
            [
                'page_name' => 'Hospital Gallery',
                'slug' => 'gallery',
                'meta_title' => 'Hospital Infrastructure & Photo Gallery | Advance Orthopaedic & Spine Center',
                'meta_description' => 'Explore our photo gallery featuring ultra-clean modular operation theaters, advanced ICU units, private suites, and patient care facilities.',
                'meta_keywords' => 'hospital gallery, modular OT, ICU facility, orthopaedic hospital photos',
                'og_title' => 'State-of-the-Art Hospital Facilities',
                'og_description' => 'Take a virtual tour of our modern operating rooms, patient care units, and rehabilitation suites.',
                'is_active' => true,
            ],
            [
                'page_name' => 'Blog & Articles',
                'slug' => 'blog',
                'meta_title' => 'Orthopaedic Health Articles & Medical Insights | Advance Orthopaedic & Spine Center',
                'meta_description' => 'Read expert medical insights, joint care tips, recovery guidelines, and surgical news from our leading orthopedic surgeons.',
                'meta_keywords' => 'orthopaedic blog, spine care tips, joint health, recovery guides, medical news',
                'og_title' => 'Orthopaedic & Spine Health Insights',
                'og_description' => 'Stay informed with medical advice and articles written by board-certified orthopaedic specialists.',
                'is_active' => true,
            ],
            [
                'page_name' => 'Contact Us',
                'slug' => 'contact',
                'meta_title' => 'Contact Us & OPD Appointments | Advance Orthopaedic & Spine Center',
                'meta_description' => 'Book your OPD consultation or contact our 24/7 Emergency Spine Hotline. Location, directions, working hours, and contact details.',
                'meta_keywords' => 'contact orthopaedic hospital, OPD appointment, emergency hotline, hospital location',
                'og_title' => 'Contact Advance Orthopaedic & Spine Center',
                'og_description' => 'Reach out for OPD consultations or 24/7 emergency orthopaedic care.',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            PageContent::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}

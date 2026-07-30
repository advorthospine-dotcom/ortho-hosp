<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'hospital_name' => 'Advanced Orthopaedic & Spine Center',
            'doctor_name' => 'Dr. Md. Shafique Alam',
            'doctor_qualification' => 'MBBS, MS (Orthopaedics), D.Ortho, DNB',
            'doctor_experience' => '21+ Years',
            'address' => 'Advanced Super Speciality Hospital, NH-31, Line Bazar, Purnea, Bihar 854301',
            'phone_number' => '+91 99319 13551',
            'whatsapp_number' => '919931913551',
            'contact_email' => 'contact@advorthospine.com',
            'email' => 'contact@advorthospine.com',
            'opd_timings' => 'Mon - Sat: 8:00 AM - 8:00 PM (24/7 Emergency Open)',
            'google_maps_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7003.261715458082!2d87.49336440221526!3d25.78083705086542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff93a63547e3b%3A0x7975441d4a59bf41!2sAdvanced%20Super%20Speciality%20Hospital!5e0!3m2!1sen!2sin!4v1785412497936!5m2!1sen!2sin',
            'hero_title' => 'Restoring Pain-Free Mobility & Spine Health',
            'hero_description' => 'Advanced Orthopaedic & Spine Center is a trusted destination for advanced bone, joint, trauma, and spine care in Purnea, serving patients across the Seemanchal region.',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}

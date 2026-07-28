<?php

namespace App\Models;

class Service
{
    /**
     * Get all services list.
     */
    public static function all(): array
    {
        return [
            // Trauma & Emergency
            [
                'id' => 1,
                'slug' => 'trauma-and-accident-care',
                'title' => 'Trauma & Accident Care',
                'category' => 'trauma',
                'category_label' => 'Trauma & Emergency',
                'icon' => 'ri-alarm-warning-fill',
                'color' => 'rose',
                'badge' => '24/7 Emergency',
                'desc' => 'Round-the-clock emergency response for severe polytrauma, open fractures, and life-threatening musculoskeletal injuries with dedicated emergency OTs.',
                'features' => ['Level-1 Emergency Facility', '24/7 On-Call Trauma Surgeons', 'Instant ICU & Blood Bank Access'],
            ],
            [
                'id' => 2,
                'slug' => 'pelvic-and-acetabular-fracture-management',
                'title' => 'Pelvis & Acetabulum Fracture Management',
                'category' => 'trauma',
                'category_label' => 'Trauma & Emergency',
                'icon' => 'ri-body-scan-fill',
                'color' => 'rose',
                'badge' => 'Complex Reconstruction',
                'desc' => 'High-precision surgical fixation and minimally invasive reconstruction for complex pelvic ring and acetabular socket fractures.',
                'features' => ['3D CT Pre-Surgical Mapping', 'Minimally Invasive Fixation', 'Early Mobilization Protocols'],
            ],
            [
                'id' => 3,
                'slug' => 'nerve-artery-tendon-injury-management',
                'title' => 'Nerve, Artery & Tendon Injury Management',
                'category' => 'trauma',
                'category_label' => 'Trauma & Emergency',
                'icon' => 'ri-pulse-fill',
                'color' => 'rose',
                'badge' => 'Micro-Vascular Surgery',
                'desc' => 'Micro-surgical repair and nerve grafting for traumatic severed tendons, peripheral nerve injuries, and acute vascular extremity trauma.',
                'features' => ['Operating Microscope Precision', 'Nerve Conduction Guidance', 'Specialized Hand & Micro-Surgeons'],
            ],

            // Spine & Back Care
            [
                'id' => 4,
                'slug' => 'spine-injury-management',
                'title' => 'Spine Injury Management',
                'category' => 'spine',
                'category_label' => 'Spine & Back Care',
                'icon' => 'ri-spine-fill',
                'color' => 'sky',
                'badge' => 'Trauma & Stabilization',
                'desc' => 'Comprehensive emergency and elective care for spinal cord trauma, vertebral fractures, and spinal instability to preserve neurological function.',
                'features' => ['Intraoperative Neuromonitoring', 'Percutaneous Spine Fixation', 'Spinal Cord Injury ICU'],
            ],
            [
                'id' => 5,
                'slug' => 'cervical-thoracic-lumbar-spine-disorders',
                'title' => 'Cervical, Thoracic & Lumbar Spine Disorders',
                'category' => 'spine',
                'category_label' => 'Spine & Back Care',
                'icon' => 'ri-health-book-fill',
                'color' => 'sky',
                'badge' => 'Comprehensive Spine',
                'desc' => 'Expert diagnosis and multi-disciplinary treatment for herniated discs, spinal stenosis, spondylolisthesis, and degenerative spine disease across all regions.',
                'features' => ['Cervical Disc Replacement', 'Lumbar Fusion (TLIF/PLIF)', 'Non-Surgical Pain Therapies'],
            ],
            [
                'id' => 6,
                'slug' => 'endoscopic-spine-surgery',
                'title' => 'Endoscopic Spine Surgery',
                'category' => 'spine',
                'category_label' => 'Spine & Back Care',
                'icon' => 'ri-microscope-fill',
                'color' => 'sky',
                'badge' => 'Keyhole Ultra-Precision',
                'desc' => 'Ultra-minimally invasive spinal discectomy and decompression performed through 7mm micro-incisions with zero back muscle damage and rapid recovery.',
                'features' => ['7mm Keyhole Incisions', 'Same-Day / Overnight Discharge', 'Preserves Native Muscle'],
            ],
            [
                'id' => 7,
                'slug' => 'back-pain-treatment',
                'title' => 'Back Pain Treatment',
                'category' => 'spine',
                'category_label' => 'Spine & Back Care',
                'icon' => 'ri-heart-pulse-fill',
                'color' => 'sky',
                'badge' => 'Non-Surgical & Intervention',
                'desc' => 'Targeted non-surgical therapies, epidural steroid injections, facet joint radiofrequency ablation, and specialized core spine rehab for chronic back pain.',
                'features' => ['Fluoroscopy-Guided Injections', 'Radiofrequency Ablation', 'Ergonomic & Spine Rehab'],
            ],
            [
                'id' => 8,
                'slug' => 'spine-deformity-correction',
                'title' => 'Spine Deformity Correction',
                'category' => 'spine',
                'category_label' => 'Spine & Back Care',
                'icon' => 'ri-guide-fill',
                'color' => 'sky',
                'badge' => 'Scoliosis & Kyphosis',
                'desc' => 'Advanced corrective spinal surgery for adolescent & adult scoliosis, kyphosis, and post-traumatic spinal deformities using 3D navigation.',
                'features' => ['3D O-Arm Intraoperative CT', 'Neuromonitoring Safety', 'Cosmetic Alignment Focus'],
            ],

            // Joint Replacements
            [
                'id' => 9,
                'slug' => 'knee-replacement-surgery',
                'title' => 'Knee Replacement Surgery',
                'category' => 'joints',
                'category_label' => 'Joint Replacements',
                'icon' => 'ri-robot-2-fill',
                'color' => 'blue',
                'badge' => 'Robotic & Conventional',
                'desc' => 'Mako® robotic-arm guided total and partial knee replacement ensuring sub-millimeter implant precision, natural knee feel, and rapid walking.',
                'features' => ['3D CT Pre-Op Planning', 'Muscle-Sparing Technique', 'Walk within 24 Hours'],
            ],
            [
                'id' => 10,
                'slug' => 'hip-replacement-surgery',
                'title' => 'Hip Replacement Surgery',
                'category' => 'joints',
                'category_label' => 'Joint Replacements',
                'icon' => 'ri-repeat-2-fill',
                'color' => 'blue',
                'badge' => 'Direct Anterior Option',
                'desc' => 'Total hip replacement using ceramic-on-ceramic long-life implants and muscle-preserving direct anterior approach for accelerated rehabilitation.',
                'features' => ['Direct Anterior Approach', 'Ceramic Ultra-Durable Bearings', 'Minimal Post-Op Restrictions'],
            ],
            [
                'id' => 11,
                'slug' => 'shoulder-replacement-surgery',
                'title' => 'Shoulder Replacement Surgery',
                'category' => 'joints',
                'category_label' => 'Joint Replacements',
                'icon' => 'ri-user-follow-fill',
                'color' => 'blue',
                'badge' => 'Anatomic & Reverse',
                'desc' => 'Anatomic and reverse total shoulder arthroplasty for severe glenohumeral arthritis, cuff tear arthropathy, and complex proximal humerus fractures.',
                'features' => ['Reverse Shoulder Expertise', 'Patient-Specific Implants', 'Restores Overhead Reach'],
            ],
            [
                'id' => 12,
                'slug' => 'elbow-replacement-surgery',
                'title' => 'Elbow Replacement Surgery',
                'category' => 'joints',
                'category_label' => 'Joint Replacements',
                'icon' => 'ri-stethoscope-fill',
                'color' => 'blue',
                'badge' => 'Sub-Specialized',
                'desc' => 'Total elbow arthroplasty for debilitating rheumatoid arthritis, severe post-traumatic joint destruction, and un-united distal humerus fractures.',
                'features' => ['Linked & Unlinked Options', 'Restores Functional Range', 'Dedicated Upper Limb Unit'],
            ],

            // Sports Medicine & Arthroscopy
            [
                'id' => 13,
                'slug' => 'sports-injury-treatment',
                'title' => 'Sports Injury Treatment',
                'category' => 'sports',
                'category_label' => 'Sports Medicine',
                'icon' => 'ri-football-fill',
                'color' => 'indigo',
                'badge' => 'Athlete Protocol',
                'desc' => 'Advanced medical and physical care tailored for professional and recreational athletes, covering acute sprains, muscle tears, and over-use syndromes.',
                'features' => ['Biomechanical Gait Analysis', 'Biological PRP Therapy', 'Return-to-Sport Assessment'],
            ],
            [
                'id' => 14,
                'slug' => 'ligament-and-meniscus-tear-treatment',
                'title' => 'Ligament & Meniscus Tear Treatment',
                'category' => 'sports',
                'category_label' => 'Sports Medicine',
                'icon' => 'ri-shield-flash-fill',
                'color' => 'indigo',
                'badge' => 'ACL / PCL / Meniscus',
                'desc' => 'Keyhole reconstructive procedures for ACL, PCL, MCL, LCL tears and meniscus repair or preservation using autograft/allograft tissue.',
                'features' => ['Anatomic ACL Reconstruction', 'Meniscal Repair Preservation', 'Accelerated Rehab Track'],
            ],
            [
                'id' => 15,
                'slug' => 'arthroscopic-surgery',
                'title' => 'Arthroscopic Surgery',
                'category' => 'sports',
                'category_label' => 'Sports Medicine',
                'icon' => 'ri-camera-lens-fill',
                'color' => 'indigo',
                'badge' => 'Keyhole Joint Care',
                'desc' => 'Diagnostic and therapeutic keyhole surgery for knee, shoulder, hip, ankle, and wrist joints through HD cameras and micro-instruments.',
                'features' => ['HD 4K Visualization', 'Minimal Post-Op Pain', 'Day-Care Surgery Option'],
            ],

            // Specialized Care & Rehab
            [
                'id' => 16,
                'slug' => 'foot-and-ankle-surgery',
                'title' => 'Foot & Ankle Surgery',
                'category' => 'specialized',
                'category_label' => 'Specialized & Rehab',
                'icon' => 'ri-footprint-fill',
                'color' => 'emerald',
                'badge' => 'Reconstructive Foot',
                'desc' => 'Comprehensive treatment for ankle arthritis, Achilles tendon ruptures, bunions (hallux valgus), flatfoot deformities, and diabetic foot conditions.',
                'features' => ['Ankle Arthroscopy & Fusion', 'Bunion Correction Surgery', 'Diabetic Foot Care Unit'],
            ],
            [
                'id' => 17,
                'slug' => 'congenital-foot-deformity-correction',
                'title' => 'Congenital Foot Deformity Correction',
                'category' => 'specialized',
                'category_label' => 'Specialized & Rehab',
                'icon' => 'ri-parent-fill',
                'color' => 'emerald',
                'badge' => 'Pediatric & Deformity',
                'desc' => 'Non-surgical Ponseti casting and surgical correction for congenital clubfoot (CTEV), vertical talus, and pediatric gait abnormalities.',
                'features' => ['Ponseti Method Experts', 'Tendon Transfer Surgery', 'Child-Centric Rehab Suite'],
            ],
            [
                'id' => 18,
                'slug' => 'rheumatology-services',
                'title' => 'Rheumatology Services',
                'category' => 'specialized',
                'category_label' => 'Specialized & Rehab',
                'icon' => 'ri-flask-fill',
                'color' => 'emerald',
                'badge' => 'Autoimmune & Joints',
                'desc' => 'Specialized medical diagnosis and biologic targeted therapy for Rheumatoid Arthritis, Ankylosing Spondylitis, Gout, Lupus, and Osteoporosis.',
                'features' => ['Biologic Targeted Infusions', 'Bone Densitometry (DEXA)', 'Joint Preservation Focus'],
            ],
            [
                'id' => 19,
                'slug' => 'joint-pain-and-swelling-treatment',
                'title' => 'Joint Pain & Swelling Treatment',
                'category' => 'specialized',
                'category_label' => 'Specialized & Rehab',
                'icon' => 'ri-pulse-line',
                'color' => 'emerald',
                'badge' => 'Early Arthritis & PRP',
                'desc' => 'Comprehensive evaluation of unexplained joint effusion, cartilage wear, and early osteoarthritis utilizing Platelet-Rich Plasma (PRP) and hyaluronic injections.',
                'features' => ['Ultrasound-Guided Injections', 'Platelet-Rich Plasma (PRP)', 'Viscosupplementation'],
            ],
            [
                'id' => 20,
                'slug' => 'physiotherapy-and-rehabilitation',
                'title' => 'Physiotherapy & Rehabilitation',
                'category' => 'specialized',
                'category_label' => 'Specialized & Rehab',
                'icon' => 'ri-run-fill',
                'color' => 'emerald',
                'badge' => 'Advanced Hydro & Physio',
                'desc' => 'State-of-the-art physical rehab facility equipped with hydrotherapy pools, robotic gait trainers, laser therapy, and customized post-op recovery plans.',
                'features' => ['Robotic Gait Training', 'Hydrotherapy Rehabilitation', '1-on-1 Dedicated Physio'],
            ],
        ];
    }

    /**
     * Find a service by slug.
     */
    public static function findBySlug(string $slug): ?array
    {
        foreach (self::all() as $service) {
            if ($service['slug'] === $slug) {
                return $service;
            }
        }

        return null;
    }

    /**
     * Find a service by ID.
     */
    public static function find(int $id): ?array
    {
        foreach (self::all() as $service) {
            if ($service['id'] === $id) {
                return $service;
            }
        }

        return null;
    }
}

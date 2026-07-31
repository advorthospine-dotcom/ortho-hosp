<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create an admin/author user
        $author = User::firstOrCreate(
            ['email' => 'admin@orthohosp.com'],
            [
                'name' => 'Dr. Alexander Vance, MD',
                'password' => bcrypt('admin123'),
            ]
        );

        // Define Categories
        $categoriesData = [
            [
                'name' => 'Joint Surgery',
                'slug' => 'joint-surgery',
            ],
            [
                'name' => 'Spine Care',
                'slug' => 'spine-care',
            ],
            [
                'name' => 'Sports Medicine',
                'slug' => 'sports-medicine',
            ],
            [
                'name' => 'Rehabilitation',
                'slug' => 'rehabilitation',
            ],
        ];

        $categoriesMap = [];
        foreach ($categoriesData as $cat) {
            $createdCategory = BlogCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'is_active' => true,
                ]
            );
            $categoriesMap[$cat['slug']] = $createdCategory->id;
        }

        // Define Blog Posts
        $blogs = [
            [
                'category_slug' => 'joint-surgery',
                'title' => 'Advanced Knee Replacement: What Patients Should Expect',
                'slug' => 'advanced-knee-replacement-what-patients-should-expect',
                'image_alt' => 'Surgeons operating advanced surgical system',
                'meta_title' => 'Advanced Knee Replacement Guide | Advance Ortho',
                'meta_description' => 'Learn how advanced knee replacement ensures precision, less pain, and rapid 24-hour walking recovery.',
                'content' => '
                    <p>Total knee replacement has evolved dramatically with the introduction of 3D CT-guided surgical planning. Unlike traditional manual instrumentation, precision-guided technology allows orthopedic surgeons to customize each procedure with sub-millimeter accuracy.</p>
                    
                    <h2>Why Precision Navigation Matters in Joint Arthroplasty</h2>
                    <p>Every knee joint possesses unique anatomical contours, ligament tension, and wear patterns. Using pre-operative 3D CT scanning, the surgeon creates a virtual 3D model of the patient’s knee joint. During surgery, optical navigation provides real-time feedback, preventing cuts outside the pre-planned boundaries.</p>

                    <ul>
                        <li><strong>Preservation of Healthy Bone & Ligaments:</strong> Cuts are restricted strictly to diseased cartilage zones.</li>
                        <li><strong>Sub-Millimeter Implant Alignment:</strong> Reduces artificial joint friction and enhances longevity.</li>
                        <li><strong>Accelerated Rehabilitation:</strong> Most patients walk with support within 12 to 24 hours post-surgery.</li>
                    </ul>

                    <blockquote>"Precision guidance provides real-time digital balance feedback, allowing us to align the knee implant precisely according to the patient’s natural soft-tissue tension." — Dr. Alexander Vance</blockquote>

                    <h2>What Happens During the Surgical Procedure?</h2>
                    <p>The patient undergoes regional or general anesthesia. Small optical trackers are placed to calibrate the surgical system with the patient’s physical anatomy in real time. The surgeon guides the instrument to resurface damaged bone surfaces before securing high-grade cobalt-chromium and polyethylene implants.</p>
                ',
            ],
            [
                'category_slug' => 'spine-care',
                'title' => 'Minimally Invasive Spine Surgery: Microdiscectomy Guide',
                'slug' => 'minimally-invasive-spine-surgery-microdiscectomy-guide',
                'image_alt' => 'Microscopic spinal surgery setup',
                'meta_title' => 'Minimally Invasive Spine Surgery & Discectomy Guide',
                'meta_description' => 'Discover ultra-minimally invasive keyhole spine surgery performed through a micro-incision with zero back muscle disruption.',
                'content' => '
                    <p>For patients suffering from chronic sciatica, lumbar disc herniation, or spinal stenosis, open spine surgery was historically associated with lengthy hospital stays and significant muscle detachment. Today, minimally invasive spine surgery allows targeted neural decompression through a micro-incision.</p>

                    <h2>How Does Microdiscectomy Work?</h2>
                    <p>Under high-definition microscopic visualization, a slender tubular retractor is inserted directly into the spinal canal through the interlaminar or transforaminal space. Specialized micro-instruments remove disc fragments compressing the nerve root without cutting back muscles.</p>

                    <h2>Key Clinical Advantages</h2>
                    <ul>
                        <li><strong>Minimal Muscle Trauma:</strong> Native back muscles are dilated rather than severed.</li>
                        <li><strong>Same-Day Discharge Option:</strong> Most keyhole discectomy procedures are completed as day-care or overnight stays.</li>
                        <li><strong>Reduced Scarring:</strong> Minimal epidural fibrosis preserves spinal mobility.</li>
                    </ul>
                ',
            ],
            [
                'category_slug' => 'joint-replacement',
                'title' => 'Total Hip Arthroplasty via Direct Anterior Approach',
                'slug' => 'total-hip-arthroplasty-via-direct-anterior-approach',
                'image_alt' => 'Orthopedic surgeon evaluating hip joint X-ray',
                'meta_title' => 'Direct Anterior Hip Replacement Surgery Guide',
                'meta_description' => 'Learn how muscle-preserving direct anterior hip replacement allows faster recovery with fewer post-op movement restrictions.',
                'content' => '
                    <p>The direct anterior approach to total hip replacement is a muscle-sparing surgical technique where the orthopedic surgeon accesses the hip joint from the front of the leg, working between natural inter-muscular planes without detaching key hip gluteal muscles.</p>

                    <h2>Benefits of Muscle Preservation</h2>
                    <p>Because major tendons and muscles are not cut during surgery, joint stability is enhanced immediately following implant placement. Patients experience significantly reduced postoperative pain and lower risk of hip dislocation.</p>

                    <ul>
                        <li>Accelerated unassisted walking and stairs climbing.</li>
                        <li>No traditional hip movement precautions (such as crossing legs or bending past 90 degrees).</li>
                        <li>Ceramic-on-ceramic long-durability bearing surfaces.</li>
                    </ul>
                ',
            ],
            [
                'category_slug' => 'sports-medicine',
                'title' => 'ACL Reconstruction & Meniscus Preservation in Athletes',
                'slug' => 'acl-reconstruction-and-meniscus-preservation-in-athletes',
                'image_alt' => 'Sports injury knee evaluation in clinic',
                'meta_title' => 'ACL Reconstruction & Meniscus Preservation for Athletes',
                'meta_description' => 'Expert breakdown of anatomic ACL autograft reconstruction and meniscus preservation techniques for fast return-to-sport.',
                'content' => '
                    <p>Anterior Cruciate Ligament (ACL) tears are among the most common major knee injuries in pivoting sports such as soccer, basketball, and skiing. Modern sports medicine emphasizes anatomic single-bundle or double-bundle ACL reconstruction paired with aggressive meniscal repair.</p>

                    <h2>Why Save the Meniscus?</h2>
                    <p>The meniscus acts as the primary shock absorber in the knee joint. Rather than removing torn meniscal tissue (meniscectomy), arthroscopic surgeons utilize modern suture anchors to repair and preserve the native fibrocartilage, shielding athletes against early osteoarthritis.</p>

                    <h2>Return to Play Milestones</h2>
                    <ul>
                        <li><strong>Phase 1 (Weeks 0-4):</strong> Quadriceps activation and full knee extension recovery.</li>
                        <li><strong>Phase 2 (Months 2-4):</strong> Proprioception training and progressive strength building.</li>
                        <li><strong>Phase 3 (Months 6-9):</strong> Agility drills, sport-specific movements, and return-to-sport testing.</li>
                    </ul>
                ',
            ],
            [
                'category_slug' => 'pain-management',
                'title' => 'Fluoroscopy-Guided Epidural Injections for Sciatica Relief',
                'slug' => 'fluoroscopy-guided-epidural-injections-for-sciatica-relief',
                'image_alt' => 'C-arm fluoroscopy imaging room',
                'meta_title' => 'Epidural Steroid Injections for Sciatica & Disc Pain',
                'meta_description' => 'Targeted non-surgical relief for nerve root inflammation using real-time fluoroscopic C-arm guidance.',
                'content' => '
                    <p>When herniated spinal discs press against sciatic nerve roots, localized inflammation causes sharp, radiating pain down the leg. Fluoroscopy-guided epidural steroid injections (ESI) deliver concentrated anti-inflammatory medicine directly into the epidural space around the irritated nerve.</p>

                    <h2>Precision Under C-Arm X-Ray Guidance</h2>
                    <p>Using real-time live X-ray fluoroscopy and contrast dye, the spine specialist verifies exact needle tip placement within millimeters of the nerve root, ensuring maximum therapeutic efficacy and patient safety.</p>

                    <h2>Who Benefits Most?</h2>
                    <p>Patients experiencing lumbar disc herniation, radiculopathy, or spinal stenosis who wish to exhaust non-surgical treatment options before considering surgery.</p>
                ',
            ],
            [
                'category_slug' => 'physical-rehab',
                'title' => 'Postoperative Rehabilitation Protocols After Joint Replacement',
                'slug' => 'postoperative-rehabilitation-protocols-after-joint-replacement',
                'image_alt' => 'Physical therapist helping patient with joint rehabilitation',
                'meta_title' => 'Post-Op Physical Therapy & Joint Rehabilitation Guide',
                'meta_description' => 'Step-by-step physical rehabilitation guidelines to rebuild muscle strength and joint flexibility after surgery.',
                'content' => '
                    <p>A successful joint replacement surgery depends heavily on structured post-operative physical rehabilitation. Early mobilization decreases blood clot risks, reduces tissue swelling, and restores joint range of motion.</p>

                    <h2>Phases of Recovery</h2>
                    <p>Rehabilitation begins on Day 1 with simple bed exercises, ankle pumps, and assisted walking using a walker or crutches under 1-on-1 physical therapist supervision.</p>

                    <ul>
                        <li><strong>Gait Re-Education:</strong> Correcting limp patterns and restoring balance.</li>
                        <li><strong>Hydrotherapy Pools:</strong> Low-impact water resistance training for knee and hip flexors.</li>
                        <li><strong>Strength Conditioning:</strong> Target gluteal, hamstring, and core stability muscles.</li>
                    </ul>
                ',
            ],
            [
                'category_slug' => 'spine-care',
                'title' => 'Understanding Scoliosis & Modern 3D Spine Deformity Correction',
                'slug' => 'understanding-scoliosis-and-modern-3d-spine-deformity-correction',
                'image_alt' => 'Spinal curvature 3D CT scan',
                'meta_title' => 'Scoliosis Correction Surgery & 3D O-Arm CT Guidance',
                'meta_description' => 'How 3D O-Arm intraoperative CT navigation and spinal neuromonitoring allow safe surgical correction of adolescent scoliosis.',
                'content' => '
                    <p>Adolescent Idiopathic Scoliosis (AIS) causes three-dimensional curvature and rotation of the spine. When curvature exceeds critical angles, surgical correction with pedicle screw instrumentation restores upright spinal alignment and prevents thoracic compromise.</p>

                    <h2>3D O-Arm CT Intraoperative Navigation</h2>
                    <p>Modern deformity correction incorporates intraoperative 3D CT imaging, allowing spine surgeons to track instrument trajectories with sub-millimeter precision relative to the spinal cord.</p>

                    <h2>Continuous Neuromonitoring Safety</h2>
                    <p>Motor and somatosensory evoked potentials (MEP/SSEP) monitor nerve signal transmission continuously throughout the correction, guaranteeing maximum patient safety.</p>
                ',
            ],
            [
                'category_slug' => 'pain-management',
                'title' => 'Platelet-Rich Plasma (PRP) Therapy for Early Osteoarthritis',
                'slug' => 'platelet-rich-plasma-prp-therapy-for-early-osteoarthritis',
                'image_alt' => 'PRP blood centrifugation in medical laboratory',
                'meta_title' => 'PRP Therapy for Knee Osteoarthritis & Tendon Healing',
                'meta_description' => 'Autologous biological growth factors concentrated from blood to reduce joint pain and preserve knee cartilage.',
                'content' => '
                    <p>Platelet-Rich Plasma (PRP) therapy is a biological regenerative treatment that utilizes the patient’s own blood platelets to promote healing in degenerated cartilage, tendons, and ligaments.</p>

                    <h2>How PRP Works</h2>
                    <p>A small blood sample is drawn and processed in a specialized centrifuge to concentrate platelets containing growth factors (PDGF, TGF-beta, VEGF). The concentrated plasma is injected under ultrasound guidance directly into the joint capsule.</p>

                    <ul>
                        <li>Reduces intra-articular joint inflammation.</li>
                        <li>Stimulates native chondrocyte collagen synthesis.</li>
                        <li>Provides extended pain relief in Grade 1-2 knee osteoarthritis.</li>
                    </ul>
                ',
            ],
            [
                'category_slug' => 'joint-replacement',
                'title' => 'Reverse Shoulder Arthroplasty for Complex Rotator Cuff Arthropathy',
                'slug' => 'reverse-shoulder-arthroplasty-for-complex-rotator-cuff-arthropathy',
                'image_alt' => 'Shoulder joint replacement implant anatomy model',
                'meta_title' => 'Reverse Shoulder Arthroplasty Surgery Guide',
                'meta_description' => 'Discover how reverse shoulder replacement restores overhead arm motion in patients with irreparable rotator cuff tears.',
                'content' => '
                    <p>In a healthy shoulder, the ball (humeral head) sits against the socket (glenoid). However, when severe arthritis is accompanied by massive, irreparable rotator cuff tears, conventional shoulder replacement fails to restore arm elevation.</p>

                    <h2>Reversing the Joint Anatomy</h2>
                    <p>Reverse shoulder arthroplasty switches the position of the ball and socket. The metal ball is attached to the shoulder blade, and the socket is placed on the upper arm bone. This relies on the larger deltoid muscle instead of torn rotator cuff muscles to lift the arm.</p>
                ',
            ],
            [
                'category_slug' => 'sports-medicine',
                'title' => 'Preventing Overuse Injuries in Overhead & Throwing Athletes',
                'slug' => 'preventing-overuse-injuries-in-overhead-and-throwing-athletes',
                'image_alt' => 'Athlete performing shoulder mobility exercise',
                'meta_title' => 'Overuse Injury Prevention in Overhead Athletes',
                'meta_description' => 'Biomechanical guidance, pitch count monitoring, and scapular stabilization routines to protect throwing shoulders.',
                'content' => '
                    <p>Overhead throwing sports place extreme mechanical stress on the shoulder labrum and elbow ulnar collateral ligament (UCL). Implementing preventative conditioning routines is essential for avoiding repetitive stress injuries.</p>

                    <h2>Key Prevention Strategies</h2>
                    <ul>
                        <li><strong>Scapular Stabilization Exercises:</strong> Strengthening serratus anterior and rhomboids to maintain healthy shoulder blade tracking.</li>
                        <li><strong>GIRD Correction:</strong> Stretching posterior shoulder capsule tightness to maintain internal rotation.</li>
                        <li><strong>Rest & Pitch Count Control:</strong> Enforcing mandated recovery days between high-velocity throwing sessions.</li>
                    </ul>
                ',
            ],
        ];

        foreach ($blogs as $blogData) {
            $catId = $categoriesMap[$blogData['category_slug']] ?? reset($categoriesMap);

            Blog::updateOrCreate(
                ['slug' => $blogData['slug']],
                [
                    'author' => $author->id,
                    'category_id' => $catId,
                    'title' => $blogData['title'],
                    'content' => $blogData['content'],
                    'is_active' => true,
                    'image_path' => null, // Uses default fallback image URL in model
                    'image_alt' => $blogData['image_alt'],
                    'meta_title' => $blogData['meta_title'],
                    'meta_description' => $blogData['meta_description'],
                    'meta_keywords' => implode(', ', explode(' ', strtolower($blogData['title']))),
                ]
            );
        }
    }
}

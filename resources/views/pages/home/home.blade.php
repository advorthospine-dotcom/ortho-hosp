@section('title', 'Advance Orthopaedic & Spine Center | Super-Specialty Hospital')
@section('meta_description', 'Advance Orthopaedic & Spine Center - Premier hospital for knee replacement, minimally invasive spine surgery, joint care, sports injury, and 24/7 emergency care.')
@section('meta_keywords', 'orthopaedic hospital, spine surgeon Kanpur, knee replacement, joint care, sports medicine, trauma center')

<div>
    <!-- 1. LIGHT HERO SECTION WITH DYNAMIC AUTO-SLIDING CAROUSEL -->
    @php
        $heroTitle = setting('hero_title', 'Restoring Pain-Free Mobility & Spine Health');
        $heroDescription = setting('hero_description', 'Sub-specialized orthopaedic excellence powered by Advanced Knee Replacements, Minimally Invasive Spine Surgery, and 24/7 Level-1 Trauma Emergency Care.');
        
        $customSliderImages = setting('hero_slider_images', []);
        $slides = [];
        if (!empty($customSliderImages) && is_array($customSliderImages)) {
            foreach ($customSliderImages as $path) {
                $slides[] = asset('storage/' . $path);
            }
        }
        if (empty($slides)) {
            $slides = [
                '/images/modern-hero.png',
                'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1200&q=80',
                'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80',
            ];
        }
    @endphp

    <section id="hero" class="relative bg-gradient-to-b from-teal-50/70 via-white to-slate-50 text-slate-900 pt-8 pb-14 sm:pt-12 sm:pb-20 lg:pt-16 lg:pb-24 border-b border-slate-200/80 overflow-hidden">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Hero Text (6 cols on lg screens) -->
                <div class="lg:col-span-6 space-y-5 sm:space-y-6 text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-teal-50 text-[#114b5f] border border-teal-200/60">
                        <i class="ri-shield-cross-line"></i> Sub-Specialty Orthopaedic Center
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold text-slate-900 tracking-tight leading-tight">
                        {{ $heroTitle }}
                    </h1>
                    
                    <p class="text-slate-600 text-sm sm:text-base lg:text-lg leading-relaxed font-sans max-w-xl">
                        {{ $heroDescription }}
                    </p>

                    <!-- Hero CTAs -->
                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <a href="#services" class="w-full sm:w-auto px-6 py-3.5 bg-[#114b5f] hover:bg-[#0d3b4b] text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-[#114b5f]/20 active:scale-[0.99] transition-all flex items-center justify-center gap-2 group">
                            <span>Explore 20 Specialties</span>
                            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="#why-choose-us" class="w-full sm:w-auto px-5 py-3.5 bg-white hover:bg-slate-50 text-slate-800 font-bold text-xs sm:text-sm rounded-xl border border-slate-200/90 hover:border-teal-300 transition-all flex items-center justify-center gap-2 shadow-xs">
                            <i class="ri-shield-check-fill text-[#114b5f]"></i>
                            <span>Why Choose Us</span>
                        </a>
                    </div>

                    <!-- Quick Stats Ribbon (3 Minimal Cards) -->
                    <div class="pt-6 border-t border-slate-200/80 grid grid-cols-3 gap-2 sm:gap-3 w-full max-w-md">
                        <div class="bg-white/90 px-2.5 py-2.5 sm:px-3 rounded-xl border border-slate-200/80 shadow-2xs text-center">
                            <p class="text-base sm:text-xl font-extrabold text-[#114b5f] tracking-tight">50,000+</p>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 font-semibold leading-tight mt-0.5">Patient Visits</p>
                        </div>
                        <div class="bg-white/90 px-2.5 py-2.5 sm:px-3 rounded-xl border border-slate-200/80 shadow-2xs text-center">
                            <p class="text-base sm:text-xl font-extrabold text-[#114b5f] tracking-tight">99.4%</p>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 font-semibold leading-tight mt-0.5">Satisfaction Rate</p>
                        </div>
                        <div class="bg-white/90 px-2.5 py-2.5 sm:px-3 rounded-xl border border-slate-200/80 shadow-2xs text-center">
                            <p class="text-base sm:text-xl font-extrabold text-[#3b774b] tracking-tight">24/7</p>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 font-semibold leading-tight mt-0.5">Trauma Care</p>
                        </div>
                    </div>
                </div>

                <!-- Clean Minimal Hero Slider on Right Side (6 cols, larger height) -->
                <div class="lg:col-span-6">
                    <div x-data="{ 
                            activeSlide: 0, 
                            slidesCount: {{ count($slides) }},
                            timer: null,
                            startTimer() {
                                this.stopTimer();
                                this.timer = setInterval(() => {
                                    this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
                                }, 4000);
                            },
                            stopTimer() {
                                if (this.timer) clearInterval(this.timer);
                            }
                         }"
                         x-init="startTimer()"
                         @mouseenter="stopTimer()"
                         @mouseleave="startTimer()"
                         class="relative w-full h-72 sm:h-96 lg:h-[450px] rounded-3xl overflow-hidden shadow-2xl group border border-slate-200/80 bg-slate-950">
                        
                        @foreach ($slides as $index => $slideUrl)
                            <div x-show="activeSlide === {{ $index }}"
                                 x-transition:enter="transition ease-out duration-700 transform"
                                 x-transition:enter-start="opacity-0 scale-105"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-500 transform absolute inset-0"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute inset-0 w-full h-full">
                                <img src="{{ $slideUrl }}" 
                                     alt="Hospital Facility {{ $index + 1 }}" 
                                     class="w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            </div>
                        @endforeach

                        <!-- Previous Button -->
                        @if (count($slides) > 1)
                            <button type="button" 
                                    @click="activeSlide = (activeSlide - 1 + slidesCount) % slidesCount"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-950/60 hover:bg-[#114b5f] text-white flex items-center justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition-all cursor-pointer shadow-md">
                                <i class="ri-arrow-left-s-line text-2xl"></i>
                            </button>

                            <!-- Next Button -->
                            <button type="button" 
                                    @click="activeSlide = (activeSlide + 1) % slidesCount"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-950/60 hover:bg-[#114b5f] text-white flex items-center justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition-all cursor-pointer shadow-md">
                                <i class="ri-arrow-right-s-line text-2xl"></i>
                            </button>

                            <!-- Minimal Indicator Dots -->
                            <div class="absolute bottom-4 left-0 right-0 flex items-center justify-center gap-1.5 z-10">
                                @foreach ($slides as $index => $slideUrl)
                                    <button type="button" 
                                            @click="activeSlide = {{ $index }}"
                                            class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"
                                            :class="activeSlide === {{ $index }} ? 'w-6 bg-emerald-400' : 'w-2 bg-white/50 hover:bg-white'"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. MARQUEE TICKER RIBBON DIRECTLY BELOW HERO (Hidden on phone screens) -->
    <div class="hidden md:block bg-[#114b5f] text-white py-3.5 overflow-hidden border-y border-[#1a6882]/40 shadow-sm">
        <div class="animate-marquee whitespace-nowrap flex items-center gap-8 text-xs font-bold uppercase tracking-wider">
            <!-- Track 1 -->
            <div class="flex items-center gap-8">
                <span class="flex items-center gap-2 text-amber-300"><i class="ri-sparkling-fill"></i> 25,000+ SUCCESSFUL SURGERIES</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-white"><i class="ri-health-book-fill text-teal-300"></i> ADVANCED KNEE & JOINT REPLACEMENT</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-white"><i class="ri-spine-fill text-teal-300"></i> MINIMALLY INVASIVE SPINE SURGERY</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-rose-300"><i class="ri-alarm-warning-fill"></i> 24/7 LEVEL-1 EMERGENCY TRAUMA CARE</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-emerald-300"><i class="ri-shield-check-fill text-emerald-300"></i> JCI & NABH GLOBAL ACCREDITATION</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-white"><i class="ri-heart-pulse-fill text-teal-300"></i> 99.4% PATIENT RECOVERY SATISFACTION</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-amber-300"><i class="ri-bank-card-fill"></i> 100% CASHLESS INSURANCE TPA DESK</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-white"><i class="ri-football-fill text-teal-300"></i> ARTHROSCOPIC SPORTS REHABILITATION</span>
                <span class="text-teal-200/60">•</span>
            </div>

            <!-- Track 2 (Duplicate for Seamless Loop) -->
            <div class="flex items-center gap-8">
                <span class="flex items-center gap-2 text-amber-300"><i class="ri-sparkling-fill"></i> 25,000+ SUCCESSFUL SURGERIES</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-white"><i class="ri-health-book-fill text-teal-300"></i> ADVANCED KNEE & JOINT REPLACEMENT</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-white"><i class="ri-spine-fill text-teal-300"></i> MINIMALLY INVASIVE SPINE SURGERY</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-rose-300"><i class="ri-alarm-warning-fill"></i> 24/7 LEVEL-1 EMERGENCY TRAUMA CARE</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-emerald-300"><i class="ri-shield-check-fill text-emerald-300"></i> JCI & NABH GLOBAL ACCREDITATION</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-white"><i class="ri-heart-pulse-fill text-teal-300"></i> 99.4% PATIENT RECOVERY SATISFACTION</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-amber-300"><i class="ri-bank-card-fill"></i> 100% CASHLESS INSURANCE TPA DESK</span>
                <span class="text-teal-200/60">•</span>
                <span class="flex items-center gap-2 text-white"><i class="ri-football-fill text-teal-300"></i> ARTHROSCOPIC SPORTS REHABILITATION</span>
                <span class="text-teal-200/60">•</span>
            </div>
        </div>
    </div>

    <!-- 2.5 DOCTOR & CENTER OVERVIEW SECTION -->
    <section class="py-16 sm:py-20 bg-slate-50/80 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Doctor Image Showcase (5 cols) -->
                <div class="lg:col-span-5 relative">
                    <div class="relative aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl border border-slate-200/80 bg-slate-900 group">
                        <img src="{{ asset('images/doctor.webp') }}" 
                             alt="Dr. Md. Shafique Alam" 
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700" 
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80';" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-transparent"></div>
                        
                        <div class="absolute bottom-5 left-5 right-5 text-white space-y-1">
                            <span class="px-3 py-1 rounded-md bg-[#114b5f] text-[10px] font-extrabold uppercase tracking-wider text-white inline-block shadow-sm">
                                Lead Specialist & Surgeon
                            </span>
                            <h3 class="font-heading font-extrabold text-xl text-white">Dr. Md. Shafique Alam</h3>
                            <p class="text-teal-300 text-xs font-semibold">MBBS, MS (Orthopaedics), D.Ortho, DNB</p>
                        </div>
                    </div>

                    <!-- Floating Quality Badge -->
                    <div class="absolute -bottom-5 -right-3 bg-white border border-slate-200/80 p-3.5 sm:p-4 rounded-2xl shadow-xl flex items-center gap-3 max-w-xs">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#114b5f] flex items-center justify-center text-xl font-bold shrink-0 border border-teal-200/60">
                            <i class="ri-award-fill"></i>
                        </div>
                        <div>
                            <p class="font-bold text-xs text-slate-900 leading-tight">21+ Years Experience</p>
                            <p class="text-[10px] text-slate-500 mt-0.5">Spine & Joint Specialist</p>
                        </div>
                    </div>
                </div>

                <!-- Doctor Description & Center Commitment (7 cols) -->
                <div class="lg:col-span-7 space-y-5">
                    <div class="space-y-2">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#114b5f] bg-teal-50 px-3.5 py-1.5 rounded-full border border-teal-200/80">
                            Trusted Care in Seemanchal
                        </span>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-extrabold text-slate-900 tracking-tight leading-tight">
                            Advanced Orthopaedic & Spine Center, Purnea
                        </h2>
                    </div>

                    <p class="text-slate-700 text-sm sm:text-base leading-relaxed">
                        <strong>Advanced Orthopaedic & Spine Center</strong> is a trusted destination for advanced bone, joint, trauma, and spine care in Purnea, serving patients across the Seemanchal region, including Katihar, Kishanganj, Araria, Supaul, Saharsa, Madhepura, Forbesganj, and nearby areas.
                    </p>

                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Led by <strong>Dr. Md. Shafique Alam (MBBS, MS, D.Ortho, DNB)</strong> with over 21 years of experience, our center offers comprehensive orthopaedic services, including trauma & accident care, spine surgery & back care, joint replacement surgeries, sports injury management, arthroscopic procedures, fracture care, rheumatology, and physiotherapy & rehabilitation.
                    </p>

                    <div class="p-4 rounded-2xl bg-teal-50/70 border border-teal-200/80 space-y-1.5">
                        <p class="text-xs sm:text-sm text-slate-800 font-medium leading-relaxed italic">
                            "We are committed to delivering personalized, evidence-based treatment using modern technology to help patients regain mobility, relieve pain, and lead healthier, more active lives."
                        </p>
                    </div>

                    <div class="pt-2 flex flex-wrap items-center gap-3">
                        <a href="{{ route('about') }}" wire:navigate class="px-5 py-2.5 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-bold text-xs rounded-xl shadow-md shadow-[#114b5f]/15 transition-all inline-flex items-center gap-2">
                            <span>Read Full Profile & Qualifications</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                        <a href="{{ route('contact') }}" wire:navigate class="px-5 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-50 transition-all inline-flex items-center gap-2 shadow-xs">
                            <i class="ri-calendar-check-fill text-[#114b5f]"></i>
                            <span>Book Consultation</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. SERVICES SECTION (ONLY THE 20 SPECIFIED SERVICES) -->
    <section id="services" class="py-24 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-sky-700 bg-sky-100 px-3.5 py-1.5 rounded-full border border-sky-200">
                    Comprehensive Clinical Specialties
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight">
                    Our 20 Specialized Medical Services
                </h2>
                <p class="text-slate-600 text-base mt-3">
                    Sub-specialized surgical and non-surgical treatments for joint, spine, trauma, and sports injuries.
                </p>
            </div>

            <!-- Clean Search Bar & Category Filter Pills -->
            <div class="bg-slate-50 p-5 rounded-3xl border border-slate-200 mb-12 shadow-sm space-y-4">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    
                    <div class="relative w-full md:w-96">
                        <i class="ri-search-line absolute left-4 top-3.5 text-slate-400 text-base"></i>
                        <input type="text" wire:model.live="search" placeholder="Search any service (e.g. Spine, Knee, Foot)..." class="w-full bg-white border border-slate-200 rounded-2xl pl-11 pr-4 py-3 text-xs sm:text-sm text-slate-900 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-[#114b5f]/10 transition-all">
                        @if ($search !== '')
                            <button wire:click="$set('search', '')" class="absolute right-3.5 top-3 text-xs text-slate-400 hover:text-slate-700 bg-slate-200 rounded-full w-5 h-5 flex items-center justify-center">×</button>
                        @endif
                    </div>

                    <!-- Category Slider (Horizontal Scrollable Carousel) -->
                    <div class="w-full md:w-auto overflow-x-auto scrollbar-none [::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] py-1">
                        <div class="flex items-center gap-2.5 min-w-max">
                            <button wire:click="setCategory('all')" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 {{ $activeCategory === 'all' ? 'bg-teal-50 text-[#114b5f] border-2 border-[#114b5f] font-extrabold shadow-2xs' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-[#114b5f]' }}">
                                <i class="ri-apps-2-line text-sm"></i>
                                <span>All (20)</span>
                            </button>
                            <button wire:click="setCategory('trauma')" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 {{ $activeCategory === 'trauma' ? 'bg-rose-50 text-rose-700 border-2 border-rose-600 font-extrabold shadow-2xs' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-[#114b5f]' }}">
                                <i class="ri-alarm-warning-line text-sm text-rose-500"></i>
                                <span>Trauma Care</span>
                            </button>
                            <button wire:click="setCategory('spine')" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 {{ $activeCategory === 'spine' ? 'bg-teal-50 text-[#114b5f] border-2 border-[#114b5f] font-extrabold shadow-2xs' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-[#114b5f]' }}">
                                <i class="ri-health-book-line text-sm text-teal-600"></i>
                                <span>Spine Care</span>
                            </button>
                            <button wire:click="setCategory('joints')" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 {{ $activeCategory === 'joints' ? 'bg-teal-50 text-[#114b5f] border-2 border-[#114b5f] font-extrabold shadow-2xs' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-[#114b5f]' }}">
                                <i class="ri-robot-2-line text-sm text-teal-600"></i>
                                <span>Joint Replacements</span>
                            </button>
                            <button wire:click="setCategory('sports')" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 {{ $activeCategory === 'sports' ? 'bg-emerald-50 text-[#3b774b] border-2 border-[#3b774b] font-extrabold shadow-2xs' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-[#3b774b]' }}">
                                <i class="ri-run-line text-sm text-emerald-600"></i>
                                <span>Sports Medicine</span>
                            </button>
                            <button wire:click="setCategory('specialized')" class="px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 {{ $activeCategory === 'specialized' ? 'bg-emerald-50 text-[#3b774b] border-2 border-[#3b774b] font-extrabold shadow-2xs' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-[#3b774b]' }}">
                                <i class="ri-stethoscope-line text-sm text-purple-500"></i>
                                <span>Rehab & Rheumatology</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Services Cards Grid -->
            @if (count($this->services) === 0)
                <div class="bg-slate-50 rounded-3xl p-10 text-center border border-slate-200 max-w-md mx-auto">
                    <i class="ri-search-2-line text-3xl text-slate-400 mb-2 block"></i>
                    <p class="text-sm font-bold text-slate-800">No matching service found</p>
                    <p class="text-xs text-slate-500 mt-1">Try adjusting your search query or reset the active filter category.</p>
                    <button wire:click="setCategory('all')" class="mt-4 px-5 py-2 bg-[#114b5f] text-white rounded-xl text-xs font-bold shadow-md shadow-[#114b5f]/20">Reset Search</button>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($this->services as $service)
                        @php
                            $title = data_get($service, 'title');
                            $slug = data_get($service, 'slug');
                            $desc = data_get($service, 'desc');
                            $categoryLabel = data_get($service, 'category_label');
                            $badge = data_get($service, 'badge', 'Specialty');
                            $image = data_get($service, 'image') ? (str_starts_with(data_get($service, 'image'), 'http') ? data_get($service, 'image') : asset('storage/'.data_get($service, 'image'))) : data_get($service, 'image_url');
                            $features = data_get($service, 'features', []);
                        @endphp
                        <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200 hover:border-[#114b5f]/50 hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative shadow-xs">
                            
                            <!-- Image Banner -->
                            @if($image)
                                <div class="aspect-16/9 bg-slate-100 relative overflow-hidden">
                                    <a href="{{ route('services.view', $slug) }}" class="block w-full h-full">
                                        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                    </a>
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent pointer-events-none"></div>
                                    <div class="absolute top-3 left-3 z-10 flex items-center gap-2">
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                            {{ $categoryLabel }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between space-y-4">
                                <div>
                                    @if(!$image)
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="text-[11px] font-extrabold uppercase tracking-wider text-[#114b5f] bg-teal-50 px-2.5 py-1 rounded border border-teal-100">
                                                {{ $categoryLabel }}
                                            </span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-white text-slate-700 border border-slate-200 shadow-xs">
                                                {{ $badge }}
                                            </span>
                                        </div>
                                    @endif

                                    <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors leading-snug">
                                        <a href="{{ route('services.view', $slug) }}">
                                            {{ $title }}
                                        </a>
                                    </h3>

                                    <p class="text-slate-600 text-xs sm:text-sm mt-2.5 leading-relaxed line-clamp-3">
                                        {{ strip_tags($desc) }}
                                    </p>

                                    @if(!empty($features))
                                        <ul class="mt-4 space-y-2 text-xs text-slate-700 font-medium border-t border-slate-100 pt-4">
                                            @foreach (array_slice($features, 0, 3) as $feat)
                                                <li class="flex items-center gap-2">
                                                    <i class="ri-checkbox-circle-fill text-[#114b5f] font-bold text-xs shrink-0"></i>
                                                    <span class="line-clamp-1">{{ $feat }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                                    <a href="{{ route('services.view', $slug) }}" class="text-xs font-bold text-[#114b5f] hover:text-[#0e3b4b] flex items-center gap-1">
                                        <span>View Details</span>
                                        <i class="ri-arrow-right-s-line text-base"></i>
                                    </a>
                                    <a href="#booking" wire:click="$set('selectedService', '{{ $title }}')" class="px-3 py-1.5 bg-teal-50 hover:bg-teal-100 text-[#114b5f] border border-teal-200/60 rounded-xl text-[11px] font-bold transition-colors">
                                        Book Consultation
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    <!-- 4. WHY CHOOSE US SECTION (PREMIUM BRAND TEAL MEDICAL DARK) -->
    <section id="why-choose-us" class="py-24 bg-gradient-to-br from-slate-950 via-[#0a2f3c] to-slate-950 text-white border-b border-slate-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-teal-300 bg-[#114b5f]/40 px-3.5 py-1.5 rounded-full border border-teal-400/30">
                    Clinical Perfection & Safety
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-4 tracking-tight font-heading">
                    Why Choose Advance Orthopaedic & Spine Center
                </h2>
                <p class="text-slate-300 text-base mt-3 leading-relaxed">
                    Setting the standard in sub-specialized orthopaedic surgical excellence, patient safety protocols, and rapid rehabilitation.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Card 1 -->
                <div class="bg-slate-900/90 p-7 rounded-3xl border border-slate-800 hover:border-[#114b5f]/60 shadow-xl space-y-4 group transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-[#114b5f]/30 text-teal-300 font-extrabold text-xl flex items-center justify-center border border-[#114b5f]/50 group-hover:scale-110 transition-transform">
                        1
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-teal-300 transition-colors">Sub-Specialized Surgical Leadership</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Surgeons who specialize exclusively in dedicated sub-disciplines (joint replacement, keyhole spine surgery, sports medicine, or trauma care) trained at global institutions.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-slate-900/90 p-7 rounded-3xl border border-slate-800 hover:border-[#114b5f]/60 shadow-xl space-y-4 group transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-[#114b5f]/30 text-teal-300 font-extrabold text-xl flex items-center justify-center border border-[#114b5f]/50 group-hover:scale-110 transition-transform">
                        2
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-teal-300 transition-colors">Daycare Keyhole & Minimal Precision</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Minimally invasive keyhole spine discectomy and 3D precision joint alignment minimize soft tissue disruption, enabling same-day or 24-hour hospital discharge.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-slate-900/90 p-7 rounded-3xl border border-slate-800 hover:border-[#3b774b]/60 shadow-xl space-y-4 group transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-[#3b774b]/30 text-emerald-300 font-extrabold text-xl flex items-center justify-center border border-[#3b774b]/50 group-hover:scale-110 transition-transform">
                        3
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-emerald-300 transition-colors">100% Cashless Insurance TPA Desk</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Dedicated TPA desk offering zero-upfront payment pre-authorization for over 40+ leading private, corporate, and international health insurance providers.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-slate-900/90 p-7 rounded-3xl border border-slate-800 hover:border-[#3b774b]/60 shadow-xl space-y-4 group transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-[#3b774b]/30 text-emerald-300 font-extrabold text-xl flex items-center justify-center border border-[#3b774b]/50 group-hover:scale-110 transition-transform">
                        4
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-emerald-300 transition-colors">24/7 Level-1 Emergency Trauma Care</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Round-the-clock emergency OT, micro-vascular hand surgeons, blood bank access, and intensive care units for acute polytrauma and fracture emergencies.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. FAQ SECTION (CLEAN ACCORDION) -->
    <section id="faqs" class="py-24 bg-slate-50 border-b border-slate-200" x-data="{ activeFaq: 1 }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-[#114b5f] bg-teal-50 px-3.5 py-1.5 rounded-full border border-teal-200/80">
                    Patient Support & Guidance
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight font-heading">
                    Frequently Asked Questions
                </h2>
                <p class="text-slate-600 text-base mt-3">
                    Answers to common patient inquiries regarding surgery, recovery timelines, and insurance approval.
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-4">
                
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="activeFaq = (activeFaq === 1 ? 0 : 1)" class="w-full px-6 py-5 text-left font-bold text-slate-900 text-base flex items-center justify-between gap-4 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="ri-question-fill text-[#114b5f] text-xl"></i>
                            <span>How soon can I walk after knee replacement surgery?</span>
                        </span>
                        <i class="ri-add-line text-slate-400 text-2xl transition-transform duration-200" :class="{ 'rotate-45 text-[#114b5f]': activeFaq === 1 }"></i>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100 leading-relaxed">
                        With advanced joint replacement techniques and muscle-sparing approaches, soft tissue trauma is minimal. Most patients stand and walk supported steps with our physiotherapists within 24 hours post-surgery.
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="activeFaq = (activeFaq === 2 ? 0 : 2)" class="w-full px-6 py-5 text-left font-bold text-slate-900 text-base flex items-center justify-between gap-4 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="ri-question-fill text-[#114b5f] text-xl"></i>
                            <span>What is the recovery time for keyhole spine discectomy surgery?</span>
                        </span>
                        <i class="ri-add-line text-slate-400 text-2xl transition-transform duration-200" :class="{ 'rotate-45 text-[#114b5f]': activeFaq === 2 }"></i>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100 leading-relaxed">
                        Keyhole micro-discectomy spine surgery is performed through a tiny incision without cutting back muscles or damaging spinal ligaments. Patients are usually discharged within 24 hours and return to light activities in 7 to 10 days.
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="activeFaq = (activeFaq === 3 ? 0 : 3)" class="w-full px-6 py-5 text-left font-bold text-slate-900 text-base flex items-center justify-between gap-4 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="ri-question-fill text-[#114b5f] text-xl"></i>
                            <span>Do you offer 100% cashless health insurance pre-authorization?</span>
                        </span>
                        <i class="ri-add-line text-slate-400 text-2xl transition-transform duration-200" :class="{ 'rotate-45 text-[#114b5f]': activeFaq === 3 }"></i>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100 leading-relaxed">
                        Yes! Our hospital TPA desk handles 100% cashless pre-authorization for over 40+ major private, corporate, and international health insurance providers.
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="activeFaq = (activeFaq === 4 ? 0 : 4)" class="w-full px-6 py-5 text-left font-bold text-slate-900 text-base flex items-center justify-between gap-4 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="ri-question-fill text-[#114b5f] text-xl"></i>
                            <span>Is 24/7 emergency accident and trauma care available?</span>
                        </span>
                        <i class="ri-add-line text-slate-400 text-2xl transition-transform duration-200" :class="{ 'rotate-45 text-[#114b5f]': activeFaq === 4 }"></i>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100 leading-relaxed">
                        Yes. Our Level-1 Emergency Trauma Center operates 24 hours a day, 365 days a year. We have on-call orthopaedic trauma surgeons, micro-vascular specialists, an ICU, and dedicated operating rooms.
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
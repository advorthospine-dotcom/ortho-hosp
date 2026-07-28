<div>
    <!-- 1. LIGHT HERO SECTION WITH DYNAMIC AUTO-SLIDING CAROUSEL -->
    @php
        $heroTitle = setting('hero_title', 'Restoring Pain-Free Mobility & Spine Health');
        $heroDescription = setting('hero_description', 'Sub-specialized orthopaedic excellence powered by 3D Robotic Knee Replacements, Keyhole Endoscopic Spine Surgery, and 24/7 Level-1 Trauma Emergency Care.');
        
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

    <section id="hero" class="relative bg-gradient-to-b from-sky-50/80 via-white to-slate-50 text-slate-900 pt-10 pb-16 lg:pt-16 lg:pb-24 border-b border-slate-200/80 overflow-hidden">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Hero Text (7 cols) -->
                <div class="lg:col-span-7 space-y-6 text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-sky-100 text-sky-800 border border-sky-200">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        <i class="ri-award-fill text-amber-500"></i> Region's Premier Center for Robotic & Spine Surgery
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.12]">
                        {{ $heroTitle }}
                    </h1>

                    <p class="text-slate-600 text-base sm:text-lg max-w-2xl leading-relaxed">
                        {{ $heroDescription }}
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center gap-3.5 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-6 py-3 sm:py-3.5 bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-sky-600/20 active:scale-[0.99] transition-all flex items-center justify-center gap-2 group">
                            <span>Explore 20 Clinical Services</span>
                            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        @if(setting('whatsapp_number'))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}" target="_blank" class="w-full sm:w-auto px-5 py-3 sm:py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs sm:text-sm rounded-xl transition-all flex items-center justify-center gap-2 shadow-xs">
                                <i class="ri-whatsapp-line text-lg"></i>
                                <span>WhatsApp Consultation</span>
                            </a>
                        @else
                            <a href="#why-choose-us" class="w-full sm:w-auto px-5 py-3 sm:py-3.5 bg-white hover:bg-slate-50 text-slate-800 font-bold text-xs sm:text-sm rounded-xl border border-slate-200/90 hover:border-sky-300 transition-all flex items-center justify-center gap-2 shadow-xs">
                                <i class="ri-shield-check-fill text-sky-600"></i>
                                <span>Why Choose Us</span>
                            </a>
                        @endif
                    </div>

                    <!-- Quick Stats Ribbon -->
                    <div class="pt-8 border-t border-slate-200/80 grid grid-cols-3 gap-4 max-w-lg text-left">
                        <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-xs">
                            <p class="text-2xl sm:text-3xl font-extrabold text-slate-900">25,000+</p>
                            <p class="text-xs text-slate-500 font-medium">Surgeries Completed</p>
                        </div>
                        <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-xs">
                            <p class="text-2xl sm:text-3xl font-extrabold text-sky-600">99.4%</p>
                            <p class="text-xs text-slate-500 font-medium">Patient Satisfaction</p>
                        </div>
                        <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-xs">
                            <p class="text-2xl sm:text-3xl font-extrabold text-emerald-600">24/7</p>
                            <p class="text-xs text-slate-500 font-medium">Trauma Response</p>
                        </div>
                    </div>
                </div>

                <!-- Modern Auto-Sliding Hero Carousel on Right Side -->
                <div class="lg:col-span-5">
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
                         class="relative bg-white p-3.5 rounded-3xl border border-slate-200 shadow-xl overflow-hidden group">
                        
                        <!-- Slide Window -->
                        <div class="aspect-4/3 sm:aspect-16/10 rounded-2xl relative overflow-hidden bg-slate-900">
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
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                </div>
                            @endforeach

                            <!-- Previous Button -->
                            @if (count($slides) > 1)
                                <button type="button" 
                                        @click="activeSlide = (activeSlide - 1 + slidesCount) % slidesCount"
                                        class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-slate-900/50 hover:bg-sky-600 text-white flex items-center justify-center backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all cursor-pointer shadow-md">
                                    <i class="ri-arrow-left-s-line text-xl"></i>
                                </button>

                                <!-- Next Button -->
                                <button type="button" 
                                        @click="activeSlide = (activeSlide + 1) % slidesCount"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-slate-900/50 hover:bg-sky-600 text-white flex items-center justify-center backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all cursor-pointer shadow-md">
                                    <i class="ri-arrow-right-s-line text-xl"></i>
                                </button>

                                <!-- Indicator Dots -->
                                <div class="absolute bottom-3 left-0 right-0 flex items-center justify-center gap-1.5 z-10">
                                    @foreach ($slides as $index => $slideUrl)
                                        <button type="button" 
                                                @click="activeSlide = {{ $index }}"
                                                class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                                :class="activeSlide === {{ $index }} ? 'w-6 bg-sky-500' : 'w-2 bg-white/60 hover:bg-white'"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Card Detail Footer -->
                        <div class="p-4 flex items-center justify-between bg-white">
                            <div>
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-sky-600 bg-sky-50 px-2 py-0.5 rounded border border-sky-100">Center of Excellence</span>
                                <h3 class="text-sm font-bold text-slate-900 mt-1">{{ setting('hospital_name', 'Advance Ortho & Spine Center') }}</h3>
                            </div>
                            <a href="#booking" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs rounded-xl shadow-xs transition-colors flex items-center gap-1">
                                <span>Book Slot</span>
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. MARQUEE TICKER RIBBON DIRECTLY BELOW HERO -->
    <div class="bg-gradient-to-r from-sky-700 via-blue-700 to-slate-900 text-white py-3.5 overflow-hidden border-y border-sky-600/30 shadow-md">
        <div class="animate-marquee whitespace-nowrap flex items-center gap-8 text-xs font-bold uppercase tracking-wider">
            <!-- Track 1 -->
            <div class="flex items-center gap-8">
                <span class="flex items-center gap-2 text-amber-300"><i class="ri-sparkling-fill"></i> 25,000+ SUCCESSFUL SURGERIES</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-robot-2-fill text-sky-300"></i> 3D MAKO® ROBOTIC KNEE REPLACEMENT</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-spine-fill text-cyan-300"></i> KEYHOLE ENDOSCOPIC SPINE DISCECTOMY</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2 text-rose-300"><i class="ri-alarm-warning-fill"></i> 24/7 LEVEL-1 EMERGENCY TRAUMA CARE</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-shield-check-fill text-emerald-300"></i> JCI & NABH GLOBAL ACCREDITATION</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-heart-pulse-fill text-sky-300"></i> 99.4% PATIENT RECOVERY SATISFACTION</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-bank-card-fill text-amber-300"></i> 100% CASHLESS INSURANCE TPA DESK</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-football-fill text-cyan-300"></i> ARTHROSCOPIC SPORTS REHABILITATION</span>
                <span class="text-sky-300">•</span>
            </div>

            <!-- Track 2 (Duplicate for Seamless Loop) -->
            <div class="flex items-center gap-8">
                <span class="flex items-center gap-2 text-amber-300"><i class="ri-sparkling-fill"></i> 25,000+ SUCCESSFUL SURGERIES</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-robot-2-fill text-sky-300"></i> 3D MAKO® ROBOTIC KNEE REPLACEMENT</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-spine-fill text-cyan-300"></i> KEYHOLE ENDOSCOPIC SPINE DISCECTOMY</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2 text-rose-300"><i class="ri-alarm-warning-fill"></i> 24/7 LEVEL-1 EMERGENCY TRAUMA CARE</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-shield-check-fill text-emerald-300"></i> JCI & NABH GLOBAL ACCREDITATION</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-heart-pulse-fill text-sky-300"></i> 99.4% PATIENT RECOVERY SATISFACTION</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-bank-card-fill text-amber-300"></i> 100% CASHLESS INSURANCE TPA DESK</span>
                <span class="text-sky-300">•</span>
                <span class="flex items-center gap-2"><i class="ri-football-fill text-cyan-300"></i> ARTHROSCOPIC SPORTS REHABILITATION</span>
                <span class="text-sky-300">•</span>
            </div>
        </div>
    </div>

    

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
                        <input type="text" wire:model.live="search" placeholder="Search any service (e.g. Spine, Knee, Foot)..." class="w-full bg-white border border-slate-200 rounded-2xl pl-11 pr-4 py-3 text-xs sm:text-sm text-slate-900 focus:outline-none focus:border-sky-600 transition-all">
                        @if ($search !== '')
                            <button wire:click="$set('search', '')" class="absolute right-3.5 top-3 text-xs text-slate-400 hover:text-slate-700 bg-slate-200 rounded-full w-5 h-5 flex items-center justify-center">×</button>
                        @endif
                    </div>

                    <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                        <button wire:click="setCategory('all')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $activeCategory === 'all' ? 'bg-sky-600 text-white shadow-md shadow-sky-600/20' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            All (20)
                        </button>
                        <button wire:click="setCategory('trauma')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $activeCategory === 'trauma' ? 'bg-rose-600 text-white shadow-md shadow-rose-600/20' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            Trauma Care
                        </button>
                        <button wire:click="setCategory('spine')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $activeCategory === 'spine' ? 'bg-sky-600 text-white shadow-md shadow-sky-600/20' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            Spine Care
                        </button>
                        <button wire:click="setCategory('joints')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $activeCategory === 'joints' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            Joint Replacements
                        </button>
                        <button wire:click="setCategory('sports')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $activeCategory === 'sports' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            Sports Medicine
                        </button>
                        <button wire:click="setCategory('specialized')" class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ $activeCategory === 'specialized' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/20' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            Rehab & Rheumatology
                        </button>
                    </div>

                </div>
            </div>

            <!-- Services Cards Grid -->
            @if (count($this->services) === 0)
                <div class="bg-slate-50 rounded-3xl p-10 text-center border border-slate-200 max-w-md mx-auto">
                    <i class="ri-search-2-line text-3xl text-slate-400 mb-2 block"></i>
                    <p class="text-sm font-bold text-slate-800">No matching service found</p>
                    <p class="text-xs text-slate-500 mt-1">Try adjusting your search query or reset the active filter category.</p>
                    <button wire:click="setCategory('all')" class="mt-4 px-5 py-2 bg-sky-600 text-white rounded-xl text-xs font-bold">Reset Search</button>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($this->services as $service)
                        <div class="group bg-slate-50 hover:bg-white rounded-3xl p-7 border border-slate-200 hover:border-sky-400 hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative">
                            
                            <div>
                                <!-- Card Header Badge & Category -->
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-sky-700 bg-sky-50 px-2.5 py-1 rounded border border-sky-100">
                                        {{ $service['category_label'] }}
                                    </span>
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-white text-slate-700 border border-slate-200 shadow-xs">
                                        {{ $service['badge'] }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-sky-600 transition-colors">
                                    {{ $service['title'] }}
                                </h3>

                                <p class="text-slate-600 text-xs sm:text-sm mt-3 leading-relaxed">
                                    {{ $service['desc'] }}
                                </p>

                                <ul class="mt-4 space-y-2 text-xs text-slate-700 font-medium border-t border-slate-200/80 pt-4">
                                    @foreach ($service['features'] as $feat)
                                        <li class="flex items-center gap-2">
                                            <i class="ri-checkbox-circle-fill text-sky-600 font-bold text-sm"></i>
                                            <span>{{ $feat }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-200/80 flex items-center justify-between">
                                <a href="#booking" wire:click="$set('selectedService', '{{ $service['title'] }}')" class="text-xs font-bold text-sky-600 group-hover:text-sky-700 flex items-center gap-1">
                                    <span>Book Service Consultation</span>
                                    <i class="ri-arrow-right-s-line text-base"></i>
                                </a>
                                <span class="text-[11px] font-semibold text-slate-400">OPD & Surgery</span>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    <!-- 4. WHY CHOOSE US SECTION (ATTRACTIVE DARK MEDICAL NAVY) -->
    <section id="why-choose-us" class="py-24 bg-gradient-to-br from-slate-950 via-sky-950 to-slate-900 text-white border-b border-slate-800 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-sky-300 bg-sky-500/20 px-3.5 py-1.5 rounded-full border border-sky-400/30">
                    Clinical Perfection & Safety
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-4 tracking-tight">
                    Why Choose Advance Orthopaedic & Spine Center
                </h2>
                <p class="text-slate-300 text-base mt-3 leading-relaxed">
                    Setting the standard in sub-specialized orthopaedic surgical excellence, patient safety protocols, and rapid rehabilitation.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Card 1 -->
                <div class="bg-slate-900/90 p-7 rounded-3xl border border-slate-800 hover:border-sky-500/50 shadow-xl space-y-4 group transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/20 text-sky-400 font-extrabold text-xl flex items-center justify-center border border-sky-500/30 group-hover:scale-110 transition-transform">
                        1
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-sky-400 transition-colors">Sub-Specialized Surgical Leadership</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Surgeons who specialize exclusively in dedicated sub-disciplines (joint replacement, keyhole spine surgery, sports medicine, or trauma care) trained at global institutions.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-slate-900/90 p-7 rounded-3xl border border-slate-800 hover:border-sky-500/50 shadow-xl space-y-4 group transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-500/20 text-cyan-400 font-extrabold text-xl flex items-center justify-center border border-cyan-500/30 group-hover:scale-110 transition-transform">
                        2
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-cyan-400 transition-colors">Daycare Keyhole & Robotic Precision</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Endoscopic 7mm spine discectomy and Mako® 3D robotic joint alignment minimize soft tissue disruption, enabling same-day or 24-hour hospital discharge.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-slate-900/90 p-7 rounded-3xl border border-slate-800 hover:border-sky-500/50 shadow-xl space-y-4 group transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 font-extrabold text-xl flex items-center justify-center border border-amber-500/30 group-hover:scale-110 transition-transform">
                        3
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-amber-400 transition-colors">100% Cashless Insurance TPA Desk</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Dedicated TPA desk offering zero-upfront payment pre-authorization for over 40+ leading private, corporate, and international health insurance providers.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-slate-900/90 p-7 rounded-3xl border border-slate-800 hover:border-sky-500/50 shadow-xl space-y-4 group transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 font-extrabold text-xl flex items-center justify-center border border-emerald-500/30 group-hover:scale-110 transition-transform">
                        4
                    </div>
                    <h3 class="font-bold text-white text-lg group-hover:text-emerald-400 transition-colors">24/7 Level-1 Emergency Trauma Care</h3>
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
                <span class="text-xs font-bold uppercase tracking-widest text-sky-700 bg-sky-100 px-3.5 py-1.5 rounded-full border border-sky-200">
                    Patient Support & Guidance
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 tracking-tight">
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
                            <i class="ri-question-fill text-sky-600 text-xl"></i>
                            <span>How soon can I walk after robotic knee replacement surgery?</span>
                        </span>
                        <i class="ri-add-line text-slate-400 text-2xl transition-transform duration-200" :class="{ 'rotate-45 text-sky-600': activeFaq === 1 }"></i>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100 leading-relaxed">
                        With Mako® 3D SmartRobotic knee replacement and muscle-sparing techniques, soft tissue trauma is minimal. Most patients stand and walk supported steps with our physiotherapists within 24 hours post-surgery.
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="activeFaq = (activeFaq === 2 ? 0 : 2)" class="w-full px-6 py-5 text-left font-bold text-slate-900 text-base flex items-center justify-between gap-4 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="ri-question-fill text-sky-600 text-xl"></i>
                            <span>What is the recovery time for keyhole endoscopic spine surgery?</span>
                        </span>
                        <i class="ri-add-line text-slate-400 text-2xl transition-transform duration-200" :class="{ 'rotate-45 text-sky-600': activeFaq === 2 }"></i>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100 leading-relaxed">
                        Keyhole endoscopic spine discectomy is performed through a tiny 7mm portal without cutting back muscles or damaging spinal ligaments. Patients are usually discharged within 24 hours and return to light activities in 7 to 10 days.
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="activeFaq = (activeFaq === 3 ? 0 : 3)" class="w-full px-6 py-5 text-left font-bold text-slate-900 text-base flex items-center justify-between gap-4 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="ri-question-fill text-sky-600 text-xl"></i>
                            <span>Do you offer 100% cashless health insurance pre-authorization?</span>
                        </span>
                        <i class="ri-add-line text-slate-400 text-2xl transition-transform duration-200" :class="{ 'rotate-45 text-sky-600': activeFaq === 3 }"></i>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100 leading-relaxed">
                        Yes! Our hospital TPA desk handles 100% cashless pre-authorization for over 40+ major private, corporate, and international health insurance providers.
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="activeFaq = (activeFaq === 4 ? 0 : 4)" class="w-full px-6 py-5 text-left font-bold text-slate-900 text-base flex items-center justify-between gap-4 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="ri-question-fill text-sky-600 text-xl"></i>
                            <span>Is 24/7 emergency accident and trauma care available?</span>
                        </span>
                        <i class="ri-add-line text-slate-400 text-2xl transition-transform duration-200" :class="{ 'rotate-45 text-sky-600': activeFaq === 4 }"></i>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse x-cloak class="px-6 pb-5 pt-1 text-xs sm:text-sm text-slate-600 border-t border-slate-100 leading-relaxed">
                        Yes. Our Level-1 Emergency Trauma Center operates 24 hours a day, 365 days a year. We have on-call orthopaedic trauma surgeons, micro-vascular specialists, an ICU, and dedicated operating rooms.
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
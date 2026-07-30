@section('title', isset($service) && data_get($service, 'title') ? data_get($service, 'title') . ' | Advance Orthopaedic & Spine Center' : 'Clinical Service')
@section('meta_description', isset($service) && data_get($service, 'desc') ? Str::limit(strip_tags(data_get($service, 'desc')), 155) : 'Specialized orthopaedic procedure and treatment.')
@section('og_title', data_get($service, 'title', ''))
@section('og_description', isset($service) && data_get($service, 'desc') ? Str::limit(strip_tags(data_get($service, 'desc')), 155) : '')

<div class="min-h-screen bg-slate-50/60 py-10 sm:py-14">
    @php
        $title = data_get($service, 'title');
        $slug = data_get($service, 'slug');
        $desc = data_get($service, 'desc');
        $categoryLabel = data_get($service, 'category_label');
        $badge = data_get($service, 'badge', 'Specialty');
        $image = data_get($service, 'image') ? (str_starts_with(data_get($service, 'image'), 'http') ? data_get($service, 'image') : asset('storage/'.data_get($service, 'image'))) : data_get($service, 'image_url');
        $features = data_get($service, 'features', []);
    @endphp

    <!-- Main Outer Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        

        <!-- Main Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            
            <!-- Service Content Body (Left 2 Columns) -->
            <main class="lg:col-span-2 space-y-8">
                
                <!-- Main Header Hero Card -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                    
                    <div class="aspect-16/8 sm:aspect-16/7 bg-slate-900 relative overflow-hidden">
                        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                        
                        <div class="absolute bottom-4 left-6 right-6 flex items-center justify-between text-white">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold uppercase tracking-wider bg-white/90 backdrop-blur-md text-slate-900 rounded-lg shadow-sm">
                                <i class="ri-shield-cross-line text-[#114b5f]"></i>
                                {{ $categoryLabel }}
                            </span>
                            <span class="px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-white bg-slate-900/60 backdrop-blur-md rounded-md border border-white/20">
                                {{ $badge }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 sm:p-10 space-y-6">
                        <div class="space-y-1 min-w-0">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-extrabold text-slate-900 leading-tight">
                                {{ $title }}
                            </h1>
                            <p class="text-xs text-[#114b5f] font-bold uppercase tracking-wider">Advanced Hospital Specialty Treatment</p>
                        </div>

                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed pt-2 border-t border-slate-100">
                            {{ $desc }}
                        </p>

                        <!-- Hospital Quality Badges -->
                        <div class="pt-2 flex flex-wrap items-center gap-4 text-xs font-semibold text-slate-500">
                            <span class="inline-flex items-center gap-1.5"><i class="ri-checkbox-circle-fill text-[#3b774b]"></i> JCI Approved Protocol</span>
                            <span class="inline-flex items-center gap-1.5"><i class="ri-shield-check-fill text-[#114b5f]"></i> 24/7 Emergency Support</span>
                            <span class="inline-flex items-center gap-1.5"><i class="ri-user-star-fill text-amber-500"></i> Expert Surgeon Panel</span>
                        </div>
                    </div>
                </div>

                <!-- Treatment Highlights Grid -->
                @if(!empty($features))
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                        <h3 class="font-heading font-bold text-slate-900 text-base flex items-center gap-2 border-b border-slate-100 pb-3">
                            <i class="ri-task-line text-[#114b5f]"></i> Clinical Deliverables & Key Procedures
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($features as $feat)
                                <div class="flex gap-3.5 items-start p-4 bg-slate-50/80 border border-slate-200/60 rounded-2xl">
                                    <span class="w-7 h-7 rounded-xl bg-teal-50 text-[#114b5f] flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold shadow-xs border border-teal-200/50">
                                        <i class="ri-check-line"></i>
                                    </span>
                                    <div>
                                        <h4 class="font-bold text-xs sm:text-sm text-slate-800 leading-snug">{{ $feat }}</h4>
                                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Conforms to standard international orthopedic patient safety guidelines.</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Surgical & Clinical Pathway Flow -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="font-heading font-bold text-slate-900 text-base flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-route-line text-[#114b5f]"></i> Patient Treatment & Recovery Pathway
                    </h3>
                    
                    <div class="relative pl-7 border-l-2 border-teal-200/80 space-y-8 ml-3 py-2">
                        <!-- Step 1 -->
                        <div class="relative">
                            <span class="absolute -left-[39px] top-0 w-7 h-7 rounded-full bg-[#114b5f] text-white flex items-center justify-center text-xs font-extrabold shadow-md ring-4 ring-white">1</span>
                            <div class="space-y-1">
                                <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-900">Pre-Operative Biometric Mapping & 3D Scan</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Comprehensive biometric CT scans and 3D computer modeling to simulate surgical alignment and implant sizing before any procedure.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative">
                            <span class="absolute -left-[39px] top-0 w-7 h-7 rounded-full bg-[#114b5f] text-white flex items-center justify-center text-xs font-extrabold shadow-md ring-4 ring-white">2</span>
                            <div class="space-y-1">
                                <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-900">Intraoperative Surgical Navigation</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Real-time computer guidance providing sub-millimeter precision to protect native nerves and arteries.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative">
                            <span class="absolute -left-[39px] top-0 w-7 h-7 rounded-full bg-[#114b5f] text-white flex items-center justify-center text-xs font-extrabold shadow-md ring-4 ring-white">3</span>
                            <div class="space-y-1">
                                <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-900">Minimally Invasive Muscle-Sparing Surgery</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Keyhole Discectomy or Direct Anterior Joint approach minimizes blood loss, soft tissue trauma, and postoperative discomfort.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative">
                            <span class="absolute -left-[39px] top-0 w-7 h-7 rounded-full bg-[#114b5f] text-white flex items-center justify-center text-xs font-extrabold shadow-md ring-4 ring-white">4</span>
                            <div class="space-y-1">
                                <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-900">Targeted Rehabilitation & Rapid Discharge</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Dedicated physiotherapists map out personalized daily mobility routines to get you walking safely within 24 hours.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hospital Facility & Technology Suite -->
                <div class="bg-gradient-to-br from-slate-950 via-[#0a2f3c] to-slate-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl space-y-6 relative overflow-hidden">
                    <div class="absolute -top-24 -right-24 w-60 h-60 rounded-full bg-[#114b5f]/20 blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-teal-500/20 text-teal-300 border border-teal-500/30 rounded-lg">
                                Infrastructure
                            </span>
                            <h3 class="font-heading font-extrabold text-base text-white">Surgical Operating Facility</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-1.5">
                                <i class="ri-health-book-fill text-teal-300 text-xl"></i>
                                <h4 class="font-bold text-xs text-white">Precision OT Suite</h4>
                                <p class="text-[11px] text-slate-300 leading-relaxed">Modern surgical suite with 3D intraoperative navigation.</p>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-1.5">
                                <i class="ri-shield-star-fill text-teal-300 text-xl"></i>
                                <h4 class="font-bold text-xs text-white">Laminar Flow OTs</h4>
                                <p class="text-[11px] text-slate-300 leading-relaxed">Ultra-clean HEPA air filtration for 0% infection risk.</p>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-1.5">
                                <i class="ri-heart-pulse-fill text-emerald-400 text-xl"></i>
                                <h4 class="font-bold text-xs text-white">Dedicated ICU</h4>
                                <p class="text-[11px] text-slate-300 leading-relaxed">24/7 cardiac monitoring & trauma critical care.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <!-- Sidebar (Right 1 Column) -->
            <aside class="space-y-8">
                
                <!-- Category Specialties Widget -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-folder-3-line text-[#114b5f]"></i> Category Specialties
                    </h3>
                    <div class="space-y-3">
                        @forelse($relatedServices as $rel)
                            @php
                                $relTitle = data_get($rel, 'title');
                                $relSlug = data_get($rel, 'slug');
                                $relBadge = data_get($rel, 'badge', 'Specialty');
                                $relImage = data_get($rel, 'image') ? (str_starts_with(data_get($rel, 'image'), 'http') ? data_get($rel, 'image') : asset('storage/'.data_get($rel, 'image'))) : data_get($rel, 'image_url');
                            @endphp

                            <a href="{{ route('services.view', $relSlug) }}" class="flex gap-3.5 group items-center p-2 rounded-xl hover:bg-slate-50 transition-colors">
                                <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 border border-slate-200/80 shadow-xs">
                                    <img src="{{ $relImage }}" alt="{{ $relTitle }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                                </div>
                                <div class="min-w-0 space-y-0.5">
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-[#114b5f] transition-colors">
                                        {{ $relTitle }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">{{ $relBadge }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">No other category services found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Emergency Helpline & Appointment CTA -->
                <div class="bg-gradient-to-br from-slate-950 via-[#0a2f3c] to-slate-950 border border-[#114b5f]/40 rounded-2xl p-6 shadow-xl text-white text-center relative overflow-hidden space-y-4">
                    <div class="absolute -top-20 -right-20 w-44 h-44 rounded-full bg-[#114b5f]/20 blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-4 flex flex-col items-center">
                        <div class="w-12 h-12 rounded-xl bg-[#114b5f]/30 border border-teal-400/30 flex items-center justify-center text-teal-300 shadow-lg">
                            <i class="ri-calendar-check-fill text-2xl"></i>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="font-heading font-extrabold text-sm tracking-wide text-teal-100">Schedule Consultation</h4>
                            <p class="text-xs text-slate-300 leading-relaxed max-w-[220px] mx-auto">Book an evaluation with our expert spine and joint reconstructive team.</p>
                        </div>
                        <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center justify-center w-full py-3 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-bold text-xs rounded-xl shadow-lg shadow-[#114b5f]/30 active:scale-[0.99] transition-all cursor-pointer">
                            Book Appointment Now
                        </a>
                    </div>
                </div>

                <!-- Back to all services button -->
                <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-[#114b5f] transition-colors py-2 px-1">
                    <i class="ri-arrow-left-line"></i> Back to all hospital specialties
                </a>

            </aside>

        </div>
    </div>

</div>
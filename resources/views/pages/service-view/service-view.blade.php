<div class="min-h-screen bg-slate-50/60 py-10 sm:py-14">
    
    <!-- Main Outer Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs Navigation -->
        <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400 mb-8 overflow-x-auto whitespace-nowrap pb-1 shrink-0">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors inline-flex items-center gap-1">
                <i class="ri-home-4-line text-sm"></i> Home
            </a>
            <i class="ri-arrow-right-s-line text-slate-300 text-sm"></i>
            <a href="{{ route('services') }}" class="hover:text-blue-600 transition-colors">
                Services
            </a>
            <i class="ri-arrow-right-s-line text-slate-300 text-sm"></i>
            <span class="text-blue-700 bg-blue-50 px-2 py-0.5 rounded font-bold">
                {{ $service['category_label'] }}
            </span>
            <i class="ri-arrow-right-s-line text-slate-300 text-sm"></i>
            <span class="text-slate-600 truncate max-w-[240px]" title="{{ $service['title'] }}">{{ $service['title'] }}</span>
        </nav>

        <!-- Main Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            
            <!-- Service Content Body (Left 2 Columns) -->
            <main class="lg:col-span-2 space-y-8">
                
                <!-- Main Header Hero Card -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.02)] space-y-6">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold uppercase tracking-wider text-blue-700 bg-blue-50 border border-blue-100 rounded-lg shadow-2xs">
                            <i class="ri-shield-cross-line text-blue-500"></i>
                            {{ $service['category_label'] }}
                        </span>
                        <span class="px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-500 bg-slate-100 rounded-md">
                            {{ $service['badge'] }}
                        </span>
                    </div>

                    <div class="flex items-start gap-4">
                        <!-- Dynamic Icon Avatar -->
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm shrink-0 mt-1
                            @if($service['color'] === 'rose') bg-rose-50 text-rose-600 border border-rose-100
                            @elseif($service['color'] === 'sky') bg-sky-50 text-sky-600 border border-sky-100
                            @elseif($service['color'] === 'blue') bg-blue-50 text-blue-600 border border-blue-100
                            @elseif($service['color'] === 'indigo') bg-indigo-50 text-indigo-600 border border-indigo-100
                            @elseif($service['color'] === 'emerald') bg-emerald-50 text-emerald-600 border border-emerald-100
                            @else bg-slate-50 text-slate-600 border border-slate-100 @endif">
                            <i class="{{ $service['icon'] }}"></i>
                        </div>
                        <div class="space-y-1 min-w-0">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-extrabold text-slate-900 leading-tight">
                                {{ $service['title'] }}
                            </h1>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider">Advanced Hospital Speciality Treatment</p>
                        </div>
                    </div>

                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed pt-2 border-t border-slate-100">
                        {{ $service['desc'] }}
                    </p>

                    <!-- Hospital Quality Badges -->
                    <div class="pt-2 flex flex-wrap items-center gap-4 text-xs font-semibold text-slate-500">
                        <span class="inline-flex items-center gap-1.5"><i class="ri-checkbox-circle-fill text-emerald-500"></i> JCI Approved Protocol</span>
                        <span class="inline-flex items-center gap-1.5"><i class="ri-shield-check-fill text-blue-500"></i> 24/7 Emergency Support</span>
                        <span class="inline-flex items-center gap-1.5"><i class="ri-user-star-fill text-amber-500"></i> Expert Surgeon Panel</span>
                    </div>
                </div>

                <!-- Treatment Highlights Grid -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="font-heading font-bold text-slate-900 text-base flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-task-line text-blue-600"></i> Clinical Deliverables & Key Procedures
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($service['features'] as $feat)
                            <div class="flex gap-3.5 items-start p-4 bg-slate-50/80 border border-slate-200/60 rounded-2xl">
                                <span class="w-7 h-7 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold shadow-xs">
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

                <!-- Surgical & Clinical Pathway Flow -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="font-heading font-bold text-slate-900 text-base flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-route-line text-blue-600"></i> Patient Treatment & Recovery Pathway
                    </h3>
                    
                    <div class="relative pl-7 border-l-2 border-blue-100 space-y-8 ml-3 py-2">
                        <!-- Step 1 -->
                        <div class="relative">
                            <span class="absolute -left-[39px] top-0 w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-extrabold shadow-md ring-4 ring-white">1</span>
                            <div class="space-y-1">
                                <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-900">Pre-Operative Biometric Mapping & 3D Scan</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Comprehensive biometric CT scans and 3D computer modeling to simulate surgical alignment and implant sizing before any procedure.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative">
                            <span class="absolute -left-[39px] top-0 w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-extrabold shadow-md ring-4 ring-white">2</span>
                            <div class="space-y-1">
                                <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-900">Intraoperative Robotic / Micro Navigation</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Real-time computer guidance (Mako® robotic arm / O-Arm CT) providing sub-millimeter precision to protect native nerves and arteries.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative">
                            <span class="absolute -left-[39px] top-0 w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-extrabold shadow-md ring-4 ring-white">3</span>
                            <div class="space-y-1">
                                <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-900">Minimally Invasive Muscle-Sparing Surgery</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Keyhole Discectomy or Direct Anterior Joint approach minimizes blood loss, soft tissue trauma, and postoperative discomfort.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative">
                            <span class="absolute -left-[39px] top-0 w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-extrabold shadow-md ring-4 ring-white">4</span>
                            <div class="space-y-1">
                                <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-900">Targeted Rehabilitation & Rapid Discharge</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">Dedicated physiotherapists map out personalized daily mobility routines to get you walking safely within 24 hours.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hospital Facility & Technology Suite -->
                <div class="bg-gradient-to-br from-slate-900 to-blue-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl space-y-6 relative overflow-hidden">
                    <div class="absolute -top-24 -right-24 w-60 h-60 rounded-full bg-blue-500/10 blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-blue-500/20 text-blue-300 border border-blue-500/30 rounded-lg">
                                Infrastructure
                            </span>
                            <h3 class="font-heading font-extrabold text-base text-white">Surgical Operating Facility</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-1.5">
                                <i class="ri-robot-2-fill text-blue-400 text-xl"></i>
                                <h4 class="font-bold text-xs text-white">Robotic Suite</h4>
                                <p class="text-[11px] text-slate-300 leading-relaxed">Mako® robotic arm & 3D intraoperative navigation.</p>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-1.5">
                                <i class="ri-shield-star-fill text-blue-400 text-xl"></i>
                                <h4 class="font-bold text-xs text-white">Laminar Flow OTs</h4>
                                <p class="text-[11px] text-slate-300 leading-relaxed">Ultra-clean HEPA air filtration for 0% infection risk.</p>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-1.5">
                                <i class="ri-heart-pulse-fill text-blue-400 text-xl"></i>
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
                        <i class="ri-folder-3-line text-blue-600"></i> Category Specialties
                    </h3>
                    <div class="space-y-3">
                        @forelse($relatedServices as $rel)
                            <a href="{{ route('services.view', $rel['slug']) }}" class="flex gap-3.5 group items-start p-2 rounded-xl hover:bg-slate-50 transition-colors">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg shrink-0 border border-slate-200/80 shadow-xs
                                    @if($rel['color'] === 'rose') bg-rose-50 text-rose-600
                                    @elseif($rel['color'] === 'sky') bg-sky-50 text-sky-600
                                    @elseif($rel['color'] === 'blue') bg-blue-50 text-blue-600
                                    @elseif($rel['color'] === 'indigo') bg-indigo-50 text-indigo-600
                                    @elseif($rel['color'] === 'emerald') bg-emerald-50 text-emerald-600
                                    @else bg-slate-50 text-slate-600 @endif group-hover:scale-105 transition-all">
                                    <i class="{{ $rel['icon'] }}"></i>
                                </div>
                                <div class="min-w-0 space-y-0.5">
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $rel['title'] }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">{{ $rel['badge'] }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">No other category services found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Emergency Helpline & Appointment CTA -->
                <div class="bg-gradient-to-br from-slate-900 via-slate-950 to-blue-950 border border-blue-900/60 rounded-2xl p-6 shadow-xl text-white text-center relative overflow-hidden space-y-4">
                    <div class="absolute -top-20 -right-20 w-44 h-44 rounded-full bg-blue-500/20 blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-20 -left-20 w-44 h-44 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-4 flex flex-col items-center">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/15 border border-blue-400/20 flex items-center justify-center text-blue-400 shadow-lg">
                            <i class="ri-calendar-check-fill text-2xl"></i>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="font-heading font-extrabold text-sm tracking-wide text-blue-100">Schedule Consultation</h4>
                            <p class="text-xs text-slate-300 leading-relaxed max-w-[220px] mx-auto">Book an evaluation with our expert spine and joint reconstructive team.</p>
                        </div>
                        <a href="{{ route('home') }}#booking" class="inline-flex items-center justify-center w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold text-xs rounded-xl shadow-lg shadow-blue-600/30 active:scale-[0.99] transition-all cursor-pointer">
                            Book Appointment Now
                        </a>
                    </div>
                </div>

                <!-- Back to all services button -->
                <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-blue-600 transition-colors py-2 px-1">
                    <i class="ri-arrow-left-line"></i> Back to all hospital specialties
                </a>

            </aside>

        </div>
    </div>

</div>
<div class="min-h-screen bg-slate-50/50 py-12 sm:py-16">
    
    <!-- Main Content Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs Navigation -->
        <nav class="flex flex-wrap items-center gap-2.5 text-[11px] font-bold tracking-wide uppercase text-slate-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
            <a href="{{ route('services') }}" class="hover:text-blue-600 transition-colors">Services</a>
            <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
            <span class="text-slate-655 truncate max-w-[200px]">{{ $service['title'] }}</span>
        </nav>

        <!-- Main Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            
            <!-- Service Details (Left 2 Columns) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Main Header block details -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <span class="bg-blue-600 text-white text-[9px] font-extrabold tracking-widest uppercase px-2.5 py-1 rounded shadow-sm border border-blue-500/20">
                            {{ $service['category_label'] }}
                        </span>
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">{{ $service['badge'] }}</span>
                    </div>

                    <div class="flex items-start gap-4">
                        <!-- Icon -->
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl shadow-sm shrink-0
                            @if($service['color'] === 'rose') bg-rose-50 text-rose-600 border border-rose-100
                            @elseif($service['color'] === 'sky') bg-sky-50 text-sky-600 border border-sky-100
                            @elseif($service['color'] === 'blue') bg-blue-50 text-blue-600 border border-blue-100
                            @elseif($service['color'] === 'indigo') bg-indigo-50 text-indigo-600 border border-indigo-100
                            @elseif($service['color'] === 'emerald') bg-emerald-50 text-emerald-600 border border-emerald-100
                            @else bg-slate-50 text-slate-600 border border-slate-100 @endif">
                            <i class="{{ $service['icon'] }}"></i>
                        </div>
                        <div class="space-y-1">
                            <h1 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-900 leading-tight">
                                {{ $service['title'] }}
                            </h1>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Advanced Orthopaedic Speciality Treatment</p>
                        </div>
                    </div>

                    <p class="text-sm sm:text-base text-slate-650 leading-relaxed pt-2">
                        {{ $service['desc'] }}
                    </p>
                </div>

                <!-- Treatment Highlights Grid -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="font-heading font-bold text-slate-900 text-base flex items-center gap-2 border-b border-slate-50 pb-3">
                        <i class="ri-checkbox-circle-line text-blue-500"></i> Clinical Highlights & Deliverables
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($service['features'] as $feat)
                            <div class="flex gap-3 items-start p-3 bg-slate-50 border border-slate-100 rounded-xl">
                                <span class="w-6 h-6 rounded-lg bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="ri-check-line"></i>
                                </span>
                                <div>
                                    <h4 class="font-bold text-xs text-slate-800 leading-tight">{{ $feat }}</h4>
                                    <p class="text-[10px] text-slate-400 mt-1 leading-normal">Standard JCI approved guideline protocol implemented for patient safety.</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Surgical & Clinical Methodology flow -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                    <h3 class="font-heading font-bold text-slate-900 text-base flex items-center gap-2 border-b border-slate-50 pb-3">
                        <i class="ri-route-line text-blue-500"></i> Treatment Protocol Pathway
                    </h3>
                    
                    <div class="relative pl-6 border-l border-slate-200 space-y-8 ml-3 py-1">
                        <!-- Step 1 -->
                        <div class="relative">
                            <span class="absolute -left-[35px] top-0.5 w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-md">1</span>
                            <div class="space-y-1">
                                <h4 class="font-bold text-xs sm:text-sm text-slate-800">Pre-Operative Assessment & 3D CT Planning</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Comprehensive biometric scans and 3D reconstruction mapping of joint or spinal segments to simulate outcomes before any incision.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative">
                            <span class="absolute -left-[35px] top-0.5 w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-md">2</span>
                            <div class="space-y-1">
                                <h4 class="font-bold text-xs sm:text-sm text-slate-800">Intraoperative Computer/Robotic Navigation</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Ultra-precise guidance using surgical mapping overlays (e.g. Mako® system or O-Arm CT navigation) to preserve nerves, arteries, and soft-tissues.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative">
                            <span class="absolute -left-[35px] top-0.5 w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-md">3</span>
                            <div class="space-y-1">
                                <h4 class="font-bold text-xs sm:text-sm text-slate-800">Minimally Invasive Execution</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Procedures are performed through micro-incisions with muscle-sparing techniques, significantly reducing post-operative soreness and bleeding.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative">
                            <span class="absolute -left-[35px] top-0.5 w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-md">4</span>
                            <div class="space-y-1">
                                <h4 class="font-bold text-xs sm:text-sm text-slate-800">Postoperative Rehabilitation Care</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Customised physical therapy protocols mapped out by our dedicated rehabilitation specialists to restore full motion and strength.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right 1 Column) -->
            <div class="space-y-8">
                
                <!-- Related Treatments list -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2 border-b border-slate-50 pb-2">
                        <i class="ri-git-repository-line text-blue-500"></i> Category Specialities
                    </h3>
                    <div class="space-y-4">
                        @forelse($relatedServices as $rel)
                            <a href="{{ route('services.view', $rel['slug']) }}" class="flex gap-4 group">
                                <div class="w-11 h-11 rounded-lg bg-slate-50 flex items-center justify-center text-base shrink-0 border border-slate-200
                                    @if($rel['color'] === 'rose') text-rose-600
                                    @elseif($rel['color'] === 'sky') text-sky-600
                                    @elseif($rel['color'] === 'blue') text-blue-600
                                    @elseif($rel['color'] === 'indigo') text-indigo-600
                                    @elseif($rel['color'] === 'emerald') text-emerald-600
                                    @else text-slate-600 @endif shadow-sm group-hover:scale-105 transition-all duration-300">
                                    <i class="{{ $rel['icon'] }}"></i>
                                </div>
                                <div class="min-w-0 space-y-1">
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $rel['title'] }}
                                    </h4>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">{{ $rel['badge'] }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">No other category services found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Appointment Consultation CTA card -->
                <div class="bg-gradient-to-br from-slate-900 to-blue-950 border border-blue-900 rounded-2xl p-6 shadow-xl text-white text-center relative overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-44 h-44 rounded-full bg-blue-500/20 blur-3xl"></div>
                    <div class="absolute -bottom-20 -left-20 w-44 h-44 rounded-full bg-indigo-500/10 blur-3xl"></div>
                    
                    <div class="relative z-10 space-y-5 flex flex-col items-center">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 shadow-lg">
                            <i class="ri-calendar-check-fill text-2xl"></i>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="font-heading font-extrabold text-sm tracking-wide text-blue-100">Need Clinical Guidance?</h4>
                            <p class="text-xs text-blue-100/70 leading-relaxed max-w-[220px] mx-auto">Book an evaluation with our expert spine and joint reconstructive team.</p>
                        </div>
                        <a href="{{ route('home') }}#booking" class="inline-flex items-center justify-center w-full py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold text-xs rounded-xl shadow-lg shadow-blue-500/20 active:scale-[0.99] transition-all cursor-pointer">
                            Schedule Appointment
                        </a>
                    </div>
                </div>

                <!-- Back to list button -->
                <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-blue-600 transition-colors py-2 px-1">
                    <i class="ri-arrow-left-line"></i> Back to all specialities
                </a>
            </div>

        </div>
    </div>
</div>
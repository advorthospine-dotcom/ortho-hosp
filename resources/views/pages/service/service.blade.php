@section('title', 'Clinical Services & Treatments | Advance Orthopaedic & Spine Center')
@section('meta_description', 'Comprehensive orthopaedic services including minimally invasive spine surgery, robotic knee replacement, fracture care, sports medicine, and physical therapy.')
@section('meta_keywords', 'orthopaedic services, robotic joint replacement, endoscopic spine surgery, fracture treatment, physical therapy')

<div class="min-h-screen bg-slate-50/60 pb-20">
    
    <!-- Hero Banner Header -->
    <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white overflow-hidden py-16 sm:py-24 border-b border-blue-500/10">
        <!-- Ambient Grid Pattern & Radial Glows -->
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#3b82f6_1px,transparent_1px),linear-gradient(to_bottom,#3b82f6_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-blue-600/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-12 relative z-10 text-center space-y-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 tracking-wider uppercase shadow-inner">
                <i class="ri-shield-cross-fill text-blue-400"></i> Clinical Specialties & Surgical Excellence
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight max-w-4xl mx-auto leading-tight text-white">
                World-Class <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-400 to-indigo-200">Orthopaedic & Spine Care</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Comprehensive trauma response, joint replacements, micro-endoscopic spine surgery, and 1-on-1 advanced physical rehabilitation.
            </p>

            <!-- Search Bar inside Hero -->
            <div class="pt-2 max-w-xl mx-auto">
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="ri-search-2-line text-base text-sky-400"></i>
                    </div>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           placeholder="Search treatments, knee replacement, spine discectomy, ACL..." 
                           class="w-full pl-11 pr-10 py-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 text-sm text-white placeholder-slate-400 focus:outline-none focus:bg-white/15 focus:border-blue-400 focus:ring-2 focus:ring-blue-500/30 transition-all shadow-lg" />
                    @if($search)
                        <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-white transition-colors cursor-pointer">
                            <i class="ri-close-circle-fill text-base"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Full-Width Responsive Container -->
    <div class="max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-12 py-10 sm:py-14 space-y-10">
        
        <!-- Category Filter Pills -->
        <div class="bg-white border border-slate-200/80 p-4 sm:p-6 rounded-2xl sm:rounded-3xl shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">
                        <i class="ri-hospital-line"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-heading font-extrabold text-slate-900 leading-none">Clinical Departments</h2>
                        <p class="text-[11px] text-slate-500 mt-0.5 hidden sm:block">Filter procedures by medical department or surgical domain</p>
                    </div>
                </div>

                @if($activeCategory !== 'all' || $search !== '')
                    <button wire:click="clearFilters" 
                            class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors cursor-pointer bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg border border-blue-200/60 shrink-0">
                        <i class="ri-refresh-line"></i> Reset
                    </button>
                @endif
            </div>

            <!-- Category Pills Navigation Bar -->
            <div class="flex overflow-x-auto sm:flex-wrap items-center gap-2.5 pb-2 sm:pb-0 scrollbar-none [::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                
                <button wire:click="selectCategory('all')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 @if($activeCategory === 'all') bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                    <i class="ri-apps-2-line text-sm"></i>
                    <span>All Specialties</span>
                    <span class="px-2 py-0.5 text-[10px] rounded-full font-semibold @if($activeCategory === 'all') bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                        {{ $this->categoryCounts['all'] ?? 0 }}
                    </span>
                </button>

                <button wire:click="selectCategory('trauma')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 @if($activeCategory === 'trauma') bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                    <i class="ri-alarm-warning-line text-sm text-rose-500"></i>
                    <span>Trauma & Emergency</span>
                    <span class="px-2 py-0.5 text-[10px] rounded-full font-semibold @if($activeCategory === 'trauma') bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                        {{ $this->categoryCounts['trauma'] ?? 0 }}
                    </span>
                </button>

                <button wire:click="selectCategory('spine')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 @if($activeCategory === 'spine') bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                    <i class="ri-pulse-line text-sm text-sky-500"></i>
                    <span>Spine & Back Care</span>
                    <span class="px-2 py-0.5 text-[10px] rounded-full font-semibold @if($activeCategory === 'spine') bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                        {{ $this->categoryCounts['spine'] ?? 0 }}
                    </span>
                </button>

                <button wire:click="selectCategory('joints')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 @if($activeCategory === 'joints') bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                    <i class="ri-robot-2-line text-sm text-blue-500"></i>
                    <span>Joint Replacements</span>
                    <span class="px-2 py-0.5 text-[10px] rounded-full font-semibold @if($activeCategory === 'joints') bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                        {{ $this->categoryCounts['joints'] ?? 0 }}
                    </span>
                </button>

                <button wire:click="selectCategory('sports')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 @if($activeCategory === 'sports') bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                    <i class="ri-football-line text-sm text-indigo-500"></i>
                    <span>Sports Medicine</span>
                    <span class="px-2 py-0.5 text-[10px] rounded-full font-semibold @if($activeCategory === 'sports') bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                        {{ $this->categoryCounts['sports'] ?? 0 }}
                    </span>
                </button>

                <button wire:click="selectCategory('specialized')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-2 shrink-0 @if($activeCategory === 'specialized') bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                    <i class="ri-run-line text-sm text-emerald-500"></i>
                    <span>Specialized & Rehab</span>
                    <span class="px-2 py-0.5 text-[10px] rounded-full font-semibold @if($activeCategory === 'specialized') bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                        {{ $this->categoryCounts['specialized'] ?? 0 }}
                    </span>
                </button>
            </div>

            <!-- Active Filter Status -->
            @if($activeCategory !== 'all' || $search !== '')
                <div class="pt-2 flex items-center justify-between text-xs text-slate-600 bg-slate-50 px-3.5 py-2 rounded-xl border border-slate-200/60">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-semibold text-slate-700 text-[11px]">Filtered:</span>
                        @if($activeCategory !== 'all')
                            <span class="inline-flex items-center gap-1 font-bold text-blue-700 bg-blue-100/70 px-2.5 py-0.5 rounded-md text-[11px]">
                                <i class="ri-folder-2-line"></i> {{ ucfirst($activeCategory) }}
                            </span>
                        @endif
                        @if($search !== '')
                            <span class="inline-flex items-center gap-1 font-bold text-amber-800 bg-amber-100/70 px-2.5 py-0.5 rounded-md text-[11px]">
                                <i class="ri-search-line"></i> "{{ $search }}"
                            </span>
                        @endif
                    </div>
                    <span class="text-slate-400 text-[11px] font-medium hidden sm:inline">{{ count($this->services) }} procedure(s)</span>
                </div>
            @endif
        </div>

        <!-- Services Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($this->services as $service)
                @php
                    $title = data_get($service, 'title');
                    $slug = data_get($service, 'slug');
                    $desc = data_get($service, 'desc');
                    $categoryLabel = data_get($service, 'category_label');
                    $color = data_get($service, 'color', 'blue');
                    $badge = data_get($service, 'badge', 'Specialty');
                    $image = data_get($service, 'image') ? (str_starts_with(data_get($service, 'image'), 'http') ? data_get($service, 'image') : asset('storage/'.data_get($service, 'image'))) : data_get($service, 'image_url');
                    $features = data_get($service, 'features', []);
                @endphp
                
                <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(37,99,235,0.08)] hover:border-blue-200/80 transition-all duration-300 group relative">
                    
                    <!-- Image Banner -->
                    <div class="aspect-16/9 bg-slate-100 relative overflow-hidden">
                        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                        
                        <!-- Badge overlay on top of image -->
                        <div class="absolute top-3 left-3 z-10 flex items-center gap-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                {{ $categoryLabel }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 space-y-5 flex-1 flex flex-col justify-between">
                        <div class="space-y-4">
                            <!-- Title & Description -->
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors duration-200 leading-snug">
                                    <a href="{{ route('services.view', $slug) }}">
                                        {{ $title }}
                                    </a>
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3">
                                    {{ $desc }}
                                </p>
                            </div>

                            <!-- Clinical Deliverables Checklist -->
                            @if(!empty($features))
                                <ul class="space-y-2 pt-3 border-t border-slate-100">
                                    @foreach($features as $feat)
                                        <li class="flex items-start gap-2 text-slate-600 text-xs">
                                            <i class="ri-checkbox-circle-fill text-blue-600 text-xs shrink-0 mt-0.5"></i>
                                            <span class="font-medium leading-tight">{{ $feat }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <!-- Footer Link Button -->
                        <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between mt-4">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $badge }}</span>
                            <a href="{{ route('services.view', $slug) }}" 
                               class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors group/link">
                                <span>Explore Care</span>
                                <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-20 px-6 text-center bg-white border border-slate-200/80 rounded-2xl shadow-sm">
                    <div class="flex flex-col items-center justify-center max-w-sm mx-auto space-y-3">
                        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-3xl">
                            <i class="ri-search-eye-line"></i>
                        </div>
                        <h3 class="font-heading font-extrabold text-slate-800 text-base">No Specialties Match Your Query</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Try switching category pills or modifying your search terms.
                        </p>
                        <button wire:click="clearFilters" class="mt-2 px-4 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md transition-all cursor-pointer">
                            View All Specialties
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Hospital Accreditation & Safety Reassurance Strip -->
        <div class="bg-white border border-slate-200/80 rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-sm">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
                <div class="space-y-1 p-2">
                    <div class="text-2xl text-blue-600 font-extrabold flex justify-center">
                        <i class="ri-alarm-warning-fill"></i>
                    </div>
                    <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-800">24/7 Level-1 Trauma</h4>
                    <p class="text-[11px] text-slate-400">On-call emergency surgeons & OTs</p>
                </div>
                <div class="space-y-1 p-2 pt-4 md:pt-2">
                    <div class="text-2xl text-blue-600 font-extrabold flex justify-center">
                        <i class="ri-health-book-fill"></i>
                    </div>
                    <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-800">Precision Joint Suite</h4>
                    <p class="text-[11px] text-slate-400">Sub-millimeter implant accuracy</p>
                </div>
                <div class="space-y-1 p-2 pt-4 md:pt-2">
                    <div class="text-2xl text-blue-600 font-extrabold flex justify-center">
                        <i class="ri-shield-check-fill"></i>
                    </div>
                    <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-800">JCI Standard Care</h4>
                    <p class="text-[11px] text-slate-400">Strict infection control protocols</p>
                </div>
                <div class="space-y-1 p-2 pt-4 md:pt-2">
                    <div class="text-2xl text-blue-600 font-extrabold flex justify-center">
                        <i class="ri-user-heart-fill"></i>
                    </div>
                    <h4 class="font-heading font-bold text-xs sm:text-sm text-slate-800">10,000+ Procedures</h4>
                    <p class="text-[11px] text-slate-400">High surgical success rate</p>
                </div>
            </div>
        </div>

    </div>
</div>
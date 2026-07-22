<div class="min-h-screen bg-slate-50/50">
    
    <!-- Hero Banner Header -->
    <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white overflow-hidden py-20 sm:py-24 border-b border-blue-500/10">
        <!-- Abstract Architectural Grid & Blue Glows -->
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#3b82f6_1px,transparent_1px),linear-gradient(to_bottom,#3b82f6_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-blue-600/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 tracking-wider uppercase">
                <i class="ri-shield-check-line"></i> Medical Specialities
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight max-w-3xl mx-auto leading-tight text-white">
                World-Class <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-400 to-indigo-200">Orthopaedic & Spine Services</span>
            </h1>
            <p class="text-blue-100/70 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Advanced clinical diagnostics, robotic joint reconstructions, micro-endoscopic spine treatments, and premium rehabilitation.
            </p>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Filters and Search Bar -->
        <div class="flex flex-col lg:flex-row gap-6 justify-between items-center mb-12 bg-white border border-slate-200/60 p-4.5 rounded-2xl shadow-sm w-full">
            <!-- Category Pills Navigation -->
            <div class="flex flex-wrap items-center gap-2">
                <button wire:click="selectCategory('all')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer @if($activeCategory === 'all') bg-blue-600 text-white shadow-md shadow-blue-600/15 @else bg-slate-50 text-slate-650 hover:text-blue-600 hover:bg-slate-100 @endif">
                    All Specialities
                </button>
                <button wire:click="selectCategory('trauma')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer @if($activeCategory === 'trauma') bg-blue-600 text-white shadow-md shadow-blue-600/15 @else bg-slate-50 text-slate-650 hover:text-blue-600 hover:bg-slate-100 @endif">
                    Trauma & Emergency
                </button>
                <button wire:click="selectCategory('spine')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer @if($activeCategory === 'spine') bg-blue-600 text-white shadow-md shadow-blue-600/15 @else bg-slate-50 text-slate-650 hover:text-blue-600 hover:bg-slate-100 @endif">
                    Spine & Back Care
                </button>
                <button wire:click="selectCategory('joints')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer @if($activeCategory === 'joints') bg-blue-600 text-white shadow-md shadow-blue-600/15 @else bg-slate-50 text-slate-650 hover:text-blue-600 hover:bg-slate-100 @endif">
                    Joint Replacements
                </button>
                <button wire:click="selectCategory('sports')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer @if($activeCategory === 'sports') bg-blue-600 text-white shadow-md shadow-blue-600/15 @else bg-slate-50 text-slate-650 hover:text-blue-600 hover:bg-slate-100 @endif">
                    Sports Medicine
                </button>
                <button wire:click="selectCategory('specialized')" 
                        class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer @if($activeCategory === 'specialized') bg-blue-600 text-white shadow-md shadow-blue-600/15 @else bg-slate-50 text-slate-650 hover:text-blue-600 hover:bg-slate-100 @endif">
                    Specialized & Rehab
                </button>
            </div>

            <!-- Search input -->
            <div class="relative w-full lg:w-72 group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="ri-search-2-line text-sm"></i>
                </div>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Search treatments, surgeries..." 
                       class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all bg-slate-50" />
            </div>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($this->services as $service)
                <div class="bg-white border border-slate-150 rounded-2xl p-6.5 flex flex-col justify-between shadow-[0_8px_30px_rgb(0,0,0,0.015)] hover:shadow-[0_20px_40px_rgba(37,99,235,0.05)] hover:border-blue-200/60 transition-all group duration-500 relative overflow-hidden">
                    <div class="space-y-5">
                        
                        <!-- Header with Category & Icon details -->
                        <div class="flex items-center justify-between">
                            <span class="text-[9px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-lg shadow-inner bg-slate-50 border border-slate-200 text-slate-500">
                                {{ $service['category_label'] }}
                            </span>
                            
                            <!-- Icon background colors mapped dynamically -->
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg shadow-sm
                                @if($service['color'] === 'rose') bg-rose-50 text-rose-600 border border-rose-100
                                @elseif($service['color'] === 'sky') bg-sky-50 text-sky-600 border border-sky-100
                                @elseif($service['color'] === 'blue') bg-blue-50 text-blue-600 border border-blue-100
                                @elseif($service['color'] === 'indigo') bg-indigo-50 text-indigo-600 border border-indigo-100
                                @elseif($service['color'] === 'emerald') bg-emerald-50 text-emerald-600 border border-emerald-100
                                @else bg-slate-50 text-slate-600 border border-slate-100 @endif">
                                <i class="{{ $service['icon'] }}"></i>
                            </div>
                        </div>

                        <!-- Content Details -->
                        <div class="space-y-2">
                            <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors duration-300">
                                <a href="{{ route('services.view', $service['slug']) }}">{{ $service['title'] }}</a>
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-3">
                                {{ $service['desc'] }}
                            </p>
                        </div>

                        <!-- Core Features List -->
                        <ul class="space-y-2 pt-2 border-t border-slate-50">
                            @foreach($service['features'] as $feat)
                                <li class="flex items-start gap-2 text-slate-600 text-[11px]">
                                    <i class="ri-checkbox-circle-fill text-blue-500 text-xs shrink-0 mt-0.5"></i>
                                    <span class="font-medium">{{ $feat }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Footer Link Button -->
                    <div class="pt-6 shrink-0 mt-6 border-t border-slate-50 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400">{{ $service['badge'] }}</span>
                        <a href="{{ route('services.view', $service['slug']) }}" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors group-hover:translate-x-0.5 transition-transform">
                            Explore Care <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-slate-400 bg-white border border-slate-200/60 rounded-2xl">
                    <div class="flex flex-col items-center justify-center gap-3">
                        <i class="ri-heart-pulse-fill text-5xl text-blue-600/15"></i>
                        <span class="font-bold text-slate-700">No specialities match your query</span>
                        <span class="text-xs text-slate-400">Try checking other category pills or modifying your search terms.</span>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</div>
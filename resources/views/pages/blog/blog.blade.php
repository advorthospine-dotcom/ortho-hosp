@section('title', 'Orthopaedic Health Articles & Medical Insights | Advance Orthopaedic & Spine Center')
@section('meta_description', 'Read expert medical insights, joint care tips, recovery guidelines, and surgical news from our leading orthopedic surgeons.')
@section('meta_keywords', 'orthopaedic blog, spine care tips, joint health, recovery guides, medical news')

<div class="min-h-screen bg-slate-50/60 pb-20">
    
    <!-- Hero Banner Header -->
    <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white overflow-hidden py-16 sm:py-24 border-b border-blue-500/10">
        <!-- Ambient Grid Pattern & Radial Glows -->
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#3b82f6_1px,transparent_1px),linear-gradient(to_bottom,#3b82f6_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-blue-600/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-12 relative z-10 text-center space-y-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 tracking-wider uppercase shadow-inner">
                <i class="ri-heart-pulse-fill text-blue-400"></i> Peer-Reviewed Medical Insights & Clinical Studies
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight max-w-4xl mx-auto leading-tight text-white">
                Clinical Insights & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-400 to-indigo-200">Orthopedic Innovations</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Explore peer-reviewed updates, surgical outcomes, and evidence-based rehabilitation protocols authored by our chief surgical faculty.
            </p>

            <!-- Search Bar inside Hero -->
            <div class="pt-2 max-w-xl mx-auto">
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="ri-search-2-line text-base text-blue-400"></i>
                    </div>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           placeholder="Search clinical topics, knee replacement, spine care..." 
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

        <!-- 1. FEATURED ARTICLE SPOTLIGHT SHOWCASE -->
        @if($featuredBlog && $blogs->currentPage() === 1 && $search === '' && $selectedCategory === '')
            <section class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 lg:p-10 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:border-blue-200/80 transition-all duration-300 group">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Spotlight Image (7 Cols) -->
                    <a href="{{ route('blog.view', $featuredBlog->slug) }}" class="lg:col-span-7 block relative aspect-[16/10] bg-slate-100 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm">
                        <img src="{{ $featuredBlog->image_url }}" 
                             alt="{{ $featuredBlog->image_alt ?? $featuredBlog->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" />
                        <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-transparent transition-colors"></div>
                    </a>

                    <!-- Spotlight Content (5 Cols) -->
                    <div class="lg:col-span-5 space-y-5 flex flex-col justify-between">
                        <div class="space-y-4">
                            
                            <!-- Featured Spotlight Badge -->
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold bg-blue-600 text-white uppercase tracking-wider shadow-sm">
                                    <i class="ri-sparkles-fill text-amber-300"></i> Featured Spotlight
                                </span>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 border border-blue-100 rounded-md">
                                    {{ $featuredBlog->category->name }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors leading-snug">
                                <a href="{{ route('blog.view', $featuredBlog->slug) }}">
                                    {{ $featuredBlog->title }}
                                </a>
                            </h2>

                            <!-- Excerpt -->
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-4">
                                {{ strip_tags($featuredBlog->content) }}
                            </p>

                            <!-- Meta details -->
                            <div class="flex items-center gap-3 text-xs text-slate-400 font-medium">
                                <span class="flex items-center gap-1"><i class="ri-calendar-line text-blue-600"></i> {{ $featuredBlog->created_at->format('F d, Y') }}</span>
                                <span>•</span>
                                <span class="flex items-center gap-1"><i class="ri-time-line text-blue-600"></i> {{ max(2, ceil(str_word_count(strip_tags($featuredBlog->content)) / 200)) }} min read</span>
                            </div>
                        </div>

                        <!-- Author & Read Action -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white flex items-center justify-center text-xs font-extrabold uppercase shadow-sm">
                                    {{ substr($featuredBlog->authorUser->name ?? 'D', 0, 2) }}
                                </div>
                                <div class="text-xs">
                                    <p class="font-bold text-slate-800 leading-tight">{{ $featuredBlog->authorUser->name ?? 'Specialist Surgeon' }}</p>
                                    <p class="text-slate-400 text-[10px] mt-0.5 font-bold uppercase tracking-wider">Clinical Faculty</p>
                                </div>
                            </div>

                            <a href="{{ route('blog.view', $featuredBlog->slug) }}" class="inline-flex items-center gap-2 px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-md shadow-blue-600/20 active:scale-[0.98] transition-all cursor-pointer group/btn">
                                <span>Read Story</span>
                                <i class="ri-arrow-right-line group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </section>
        @endif

        <!-- 2. MOBILE SLIDER CATEGORY FILTER SECTION -->
        <div class="bg-white border border-slate-200/80 p-4 sm:p-6 rounded-2xl sm:rounded-3xl shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">
                        <i class="ri-filter-3-line"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-heading font-extrabold text-slate-900 leading-none">Knowledge Domains</h2>
                        <p class="text-[11px] text-slate-500 mt-0.5 hidden sm:block">Filter peer-reviewed publications by medical domain</p>
                    </div>
                </div>

                @if($selectedCategory !== '' || $search !== '')
                    <button wire:click="clearFilters" 
                            class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors cursor-pointer bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg border border-blue-200/60 shrink-0">
                        <i class="ri-refresh-line"></i> Reset
                    </button>
                @endif
            </div>

            <!-- Category Pills Bar: Horizontal Scroll Slider on Mobile Phone, Flex Wrap on Desktop -->
            <div class="flex overflow-x-auto sm:flex-wrap items-center gap-2 pb-2 sm:pb-0 scrollbar-none [::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                
                <!-- All Button -->
                <button wire:click="selectCategory('')" 
                        class="px-3.5 py-1.5 sm:px-4 sm:py-2 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-1.5 shrink-0 @if($selectedCategory === '') bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                    <span>All Articles</span>
                    <span class="px-1.5 py-0.5 text-[10px] rounded-full font-semibold @if($selectedCategory === '') bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                        {{ $totalBlogsCount }}
                    </span>
                </button>

                <!-- Category Items -->
                @foreach($categories as $cat)
                    <button wire:click="selectCategory('{{ $cat->slug }}')" 
                            class="px-3.5 py-1.5 sm:px-4 sm:py-2 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-1.5 shrink-0 @if($selectedCategory === $cat->slug) bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                        <span>{{ $cat->name }}</span>
                        <span class="px-1.5 py-0.5 text-[10px] rounded-full font-semibold @if($selectedCategory === $cat->slug) bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                            {{ $cat->blogs_count }}
                        </span>
                    </button>
                @endforeach
            </div>

            <!-- Filter Notification Bar -->
            @if($selectedCategory !== '' || $search !== '')
                <div class="pt-2 flex items-center justify-between text-xs text-slate-600 bg-slate-50 px-3.5 py-2 rounded-xl border border-slate-200/60">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="font-semibold text-slate-700 text-[11px]">Filtered:</span>
                        @if($selectedCategory !== '')
                            @php $activeCatObj = $categories->firstWhere('slug', $selectedCategory); @endphp
                            <span class="inline-flex items-center gap-1 font-bold text-blue-700 bg-blue-100/70 px-2.5 py-0.5 rounded-md text-[11px]">
                                <i class="ri-folder-2-line"></i> {{ $activeCatObj->name ?? $selectedCategory }}
                            </span>
                        @endif
                        @if($search !== '')
                            <span class="inline-flex items-center gap-1 font-bold text-amber-800 bg-amber-100/70 px-2.5 py-0.5 rounded-md text-[11px]">
                                <i class="ri-search-line"></i> "{{ $search }}"
                            </span>
                        @endif
                    </div>
                    <span class="text-slate-400 text-[11px] font-medium hidden sm:inline">{{ $blogs->total() }} result(s)</span>
                </div>
            @endif
        </div>

        <!-- 3. FULL RESPONSIVE 3-COLUMN ARTICLES GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($blogs as $blog)
                <article class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(37,99,235,0.08)] hover:border-blue-200/80 transition-all duration-300 group flex flex-col overflow-hidden">
                    
                    <!-- Cover Image Thumbnail (No category badge overlay) -->
                    <a href="{{ route('blog.view', $blog->slug) }}" class="block relative aspect-[16/9] bg-slate-100 overflow-hidden shrink-0">
                        <img src="{{ $blog->image_url }}" 
                             alt="{{ $blog->image_alt ?? $blog->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                        <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-transparent transition-colors"></div>
                    </a>

                    <!-- Article Body Content -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-3">
                            
                            <!-- Top Meta Bar (Category inside Content + Date + Read Time) -->
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 border border-blue-100 rounded-md">
                                    <i class="ri-price-tag-3-line text-blue-500 text-xs"></i>
                                    {{ $blog->category->name }}
                                </span>

                                <span class="text-slate-300 text-xs">•</span>

                                <span class="text-[11px] font-semibold text-slate-400 flex items-center gap-1">
                                    <i class="ri-calendar-line text-slate-400"></i>
                                    {{ $blog->created_at->format('M d, Y') }}
                                </span>

                                <span class="text-slate-300 text-xs">•</span>

                                <span class="text-[11px] font-semibold text-slate-400 flex items-center gap-1">
                                    <i class="ri-time-line text-slate-400"></i>
                                    {{ max(2, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min
                                </span>
                            </div>

                            <!-- Article Title -->
                            <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 leading-snug group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                <a href="{{ route('blog.view', $blog->slug) }}">
                                    {{ $blog->title }}
                                </a>
                            </h3>

                            <!-- Excerpt Preview -->
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3">
                                {{ strip_tags($blog->content) }}
                            </p>
                        </div>

                        <!-- Card Footer: Author & Read Link -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between shrink-0">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white flex items-center justify-center text-xs font-extrabold uppercase shadow-sm">
                                    {{ substr($blog->authorUser->name ?? 'D', 0, 2) }}
                                </div>
                                <div class="text-[11px] min-w-0">
                                    <p class="font-bold text-slate-800 truncate leading-tight">{{ $blog->authorUser->name ?? 'Surgeon Specialist' }}</p>
                                    <p class="text-slate-400 text-[10px] leading-none mt-0.5">Medical Staff</p>
                                </div>
                            </div>

                            <a href="{{ route('blog.view', $blog->slug) }}" 
                               class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors group/link">
                                <span>Read Brief</span>
                                <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>

                    </div>
                </article>
            @empty
                <div class="col-span-full py-20 px-6 text-center bg-white border border-slate-200/80 rounded-2xl shadow-sm">
                    <div class="flex flex-col items-center justify-center max-w-sm mx-auto space-y-3">
                        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-3xl">
                            <i class="ri-search-eye-line"></i>
                        </div>
                        <h3 class="font-heading font-extrabold text-slate-800 text-base">No Medical Articles Found</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            We couldn't find any publications matching your current search or category filter.
                        </p>
                        <button wire:click="clearFilters" class="mt-2 px-4 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md transition-all cursor-pointer">
                            View All Articles
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- 4. CLEAN PAGINATION NAVIGATION (Full-Width Frameless) -->
        @if($blogs->hasPages())
            <div class="pt-8 border-t border-slate-200/80">
                {{ $blogs->links() }}
            </div>
        @endif

        <!-- 5. FULL RESPONSIVE MEDICAL CONSULTATION BANNER -->
        <div class="bg-gradient-to-br from-slate-900 via-slate-950 to-blue-950 border border-blue-900/60 rounded-3xl p-6 sm:p-10 shadow-xl text-white relative overflow-hidden">
            <div class="absolute -top-32 -right-32 w-80 h-80 rounded-full bg-blue-500/15 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-indigo-500/15 blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="space-y-2 text-center md:text-left max-w-xl">
                    <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-blue-500/20 text-blue-300 border border-blue-500/30 rounded-lg">
                        Clinical Consultation
                    </span>
                    <h3 class="font-heading font-extrabold text-xl sm:text-2xl text-white">Need Clinical Guidance on Joint or Spine Care?</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Book an evaluation with our chief spine and joint reconstructive surgical faculty at Advance Orthopaedic & Spine Center.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0 w-full sm:w-auto">
                    <a href="{{ route('home') }}#booking" class="w-full sm:w-auto px-5 py-2.5 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold text-xs rounded-xl shadow-md shadow-blue-600/20 active:scale-[0.99] transition-all cursor-pointer inline-flex items-center justify-center gap-2">
                        <i class="ri-calendar-check-fill text-sm"></i>
                        <span>Schedule Appointment</span>
                    </a>
                    <a href="tel:18006784677" class="w-full sm:w-auto px-4 py-2.5 sm:py-3 bg-white/10 hover:bg-white/20 text-white font-bold text-xs rounded-xl transition-all inline-flex items-center justify-center gap-2 border border-white/15">
                        <i class="ri-phone-fill text-emerald-400 text-sm"></i>
                        <span>Call Helpline</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
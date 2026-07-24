<div class="min-h-screen bg-slate-50/60 pb-20">
    
    <!-- Hero Banner Header -->
    <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white overflow-hidden py-16 sm:py-20 border-b border-blue-500/10">
        <!-- Background Grid Pattern & Ambient Glows -->
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#3b82f6_1px,transparent_1px),linear-gradient(to_bottom,#3b82f6_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-blue-600/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 tracking-wider uppercase shadow-inner">
                <i class="ri-heart-pulse-fill text-blue-400"></i> Medical Library & Insights
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight max-w-4xl mx-auto leading-tight text-white">
                Clinical Insights & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-400 to-indigo-200">Orthopedic Innovations</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Explore peer-reviewed updates, robotic surgical outcomes, and evidence-based rehabilitation protocols authored by our chief surgical faculty.
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

    <!-- Main Body Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Interactive Category Filter Section -->
        <div class="mb-10 bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">
                        <i class="ri-filter-3-line"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-heading font-extrabold text-slate-900 leading-none">Filter Knowledge Base</h2>
                        <p class="text-[11px] text-slate-500 mt-0.5">Select a category to browse specialized clinical publications</p>
                    </div>
                </div>

                @if($selectedCategory !== '' || $search !== '')
                    <button wire:click="clearFilters" 
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors cursor-pointer self-start sm:self-auto bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg border border-blue-200/60">
                        <i class="ri-refresh-line"></i> Reset Filters
                    </button>
                @endif
            </div>

            <!-- Filter Category Buttons Bar -->
            <div class="flex flex-wrap items-center gap-2.5">
                <!-- All Button -->
                <button wire:click="selectCategory('')" 
                        class="px-4 py-2 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-2 @if($selectedCategory === '') bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                    <span>All Articles</span>
                    <span class="px-2 py-0.5 text-[10px] rounded-full font-semibold @if($selectedCategory === '') bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                        {{ $totalBlogsCount }}
                    </span>
                </button>

                <!-- Category Items -->
                @foreach($categories as $cat)
                    <button wire:click="selectCategory('{{ $cat->slug }}')" 
                            class="px-4 py-2 text-xs font-bold rounded-xl transition-all cursor-pointer inline-flex items-center gap-2 @if($selectedCategory === $cat->slug) bg-blue-600 text-white shadow-md shadow-blue-600/20 ring-2 ring-blue-600/20 @else bg-slate-100/80 hover:bg-slate-200/70 text-slate-700 hover:text-blue-600 border border-slate-200/60 @endif">
                        <span>{{ $cat->name }}</span>
                        <span class="px-2 py-0.5 text-[10px] rounded-full font-semibold @if($selectedCategory === $cat->slug) bg-white/20 text-white @else bg-slate-200 text-slate-600 @endif">
                            {{ $cat->blogs_count }}
                        </span>
                    </button>
                @endforeach
            </div>

            <!-- Filter Status Banner (If Filtered) -->
            @if($selectedCategory !== '' || $search !== '')
                <div class="pt-2 flex items-center justify-between text-xs text-slate-600 bg-slate-50 px-3.5 py-2 rounded-xl border border-slate-200/60">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-slate-700">Active View:</span>
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
                    <span class="text-slate-400 text-[11px] font-medium hidden sm:inline">Showing {{ $blogs->total() }} matching result(s)</span>
                </div>
            @endif
        </div>

        <!-- Layout Grid: Main Content (Left 2 cols) & Sidebar (Right 1 col) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- Articles Column -->
            <div class="lg:col-span-2 space-y-10">
                
                <!-- Articles Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    @forelse($blogs as $blog)
                        <article class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(37,99,235,0.08)] hover:border-blue-200/80 transition-all duration-300 group flex flex-col overflow-hidden">
                            
                            <!-- Pure Clean Cover Image Thumbnail (No category badge overlay on image) -->
                            <a href="{{ route('blog.view', $blog->slug) }}" class="block relative aspect-[16/9] bg-slate-100 overflow-hidden shrink-0">
                                <img src="{{ $blog->image_url }}" 
                                     alt="{{ $blog->image_alt ?? $blog->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                                <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-transparent transition-colors"></div>
                            </a>

                            <!-- Article Content Body -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-3">
                                    
                                    <!-- Clean Top Meta Bar (Category inside Content + Date + Read Time) -->
                                    <div class="flex flex-wrap items-center gap-2">
                                        <!-- Category Tag inside Card Content -->
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 border border-blue-100 rounded-md">
                                            <i class="ri-price-tag-3-line text-blue-500 text-xs"></i>
                                            {{ $blog->category->name }}
                                        </span>

                                        <span class="text-slate-300 text-xs">•</span>

                                        <!-- Date -->
                                        <span class="text-[11px] font-semibold text-slate-400 flex items-center gap-1">
                                            <i class="ri-calendar-line text-slate-400"></i>
                                            {{ $blog->created_at->format('M d, Y') }}
                                        </span>

                                        <span class="text-slate-300 text-xs">•</span>

                                        <!-- Read Time -->
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

                <!-- Clean & Professional Pagination Navigation -->
                @if($blogs->hasPages())
                    <div class="pt-8 border-t border-slate-200/80">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar (Right 1 Column) -->
            <div class="space-y-8">
                
                <!-- Quick Search Sidebar Widget -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-search-2-line text-blue-600"></i> Search Library
                    </h3>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="ri-search-line text-xs"></i>
                        </div>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Keywords, spinal fusion, joints..." 
                               class="w-full pl-9 pr-8 py-2.5 rounded-xl border border-slate-200/80 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all bg-slate-50/50" />
                        @if($search)
                            <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                <i class="ri-close-line text-xs"></i>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Categories Breakdown Sidebar Widget -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-folder-3-line text-blue-600"></i> Specialties & Topics
                    </h3>
                    <ul class="space-y-1.5">
                        <li>
                            <button wire:click="selectCategory('')" 
                                    class="w-full flex items-center justify-between p-2.5 rounded-xl text-xs font-semibold transition-all cursor-pointer @if($selectedCategory === '') bg-blue-50 text-blue-700 font-bold @else hover:bg-slate-50 text-slate-700 @endif">
                                <span class="flex items-center gap-2">
                                    <i class="ri-archive-line text-xs @if($selectedCategory === '') text-blue-600 @else text-slate-400 @endif"></i>
                                    All Categories
                                </span>
                                <span class="px-2 py-0.5 text-[10px] rounded-full @if($selectedCategory === '') bg-blue-600 text-white @else bg-slate-100 text-slate-600 @endif font-bold">
                                    {{ $totalBlogsCount }}
                                </span>
                            </button>
                        </li>
                        @foreach($categories as $cat)
                            <li>
                                <button wire:click="selectCategory('{{ $cat->slug }}')" 
                                        class="w-full flex items-center justify-between p-2.5 rounded-xl text-xs font-semibold transition-all cursor-pointer @if($selectedCategory === $cat->slug) bg-blue-50 text-blue-700 font-bold @else hover:bg-slate-50 text-slate-700 @endif">
                                    <span class="flex items-center gap-2 truncate">
                                        <i class="ri-folder-line text-xs @if($selectedCategory === $cat->slug) text-blue-600 @else text-slate-400 @endif"></i>
                                        <span class="truncate">{{ $cat->name }}</span>
                                    </span>
                                    <span class="px-2 py-0.5 text-[10px] rounded-full @if($selectedCategory === $cat->slug) bg-blue-600 text-white @else bg-slate-100 text-slate-600 @endif font-bold shrink-0">
                                        {{ $cat->blogs_count }}
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Latest Articles Widget -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-article-line text-blue-600"></i> Recent Articles
                    </h3>
                    <div class="space-y-4">
                        @foreach($recentBlogs as $recent)
                            <a href="{{ route('blog.view', $recent->slug) }}" class="flex gap-3.5 group items-start">
                                <div class="w-16 h-16 rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-slate-200/80 shadow-xs relative">
                                    <img src="{{ $recent->image_url }}" alt="{{ $recent->image_alt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                </div>
                                <div class="min-w-0 space-y-1">
                                    <span class="text-[9px] font-extrabold uppercase tracking-wider text-blue-600 block">
                                        {{ $recent->category->name ?? 'Clinical' }}
                                    </span>
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $recent->title }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 font-medium">
                                        {{ $recent->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Appointment Consultation Banner -->
                <div class="bg-gradient-to-br from-slate-900 via-slate-950 to-blue-950 border border-blue-900/60 rounded-2xl p-6 shadow-xl text-white text-center relative overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-44 h-44 rounded-full bg-blue-500/20 blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-20 -left-20 w-44 h-44 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-4 flex flex-col items-center">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/15 border border-blue-400/20 flex items-center justify-center text-blue-400 shadow-lg">
                            <i class="ri-calendar-check-fill text-2xl"></i>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="font-heading font-extrabold text-sm tracking-wide text-blue-100">Need Clinical Guidance?</h4>
                            <p class="text-xs text-slate-300 leading-relaxed max-w-[220px] mx-auto">Book an evaluation with our expert spine and joint reconstructive team.</p>
                        </div>
                        <a href="{{ route('home') }}#booking" class="inline-flex items-center justify-center w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold text-xs rounded-xl shadow-lg shadow-blue-600/30 active:scale-[0.99] transition-all cursor-pointer">
                            Schedule Appointment
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
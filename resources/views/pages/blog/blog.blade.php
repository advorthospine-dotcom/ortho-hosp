<div class="min-h-screen bg-slate-50/50">
    
    <!-- Hero Banner Header -->
    <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white overflow-hidden py-20 sm:py-24 border-b border-blue-500/10">
        <!-- Abstract Architectural Grid & Blue Glows -->
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#3b82f6_1px,transparent_1px),linear-gradient(to_bottom,#3b82f6_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-blue-600/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 tracking-wider uppercase">
                <i class="ri-pulse-line"></i> Medical Library & Insights
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight max-w-3xl mx-auto leading-tight text-white">
                Clinical Insights & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-400 to-indigo-200">Orthopedic Innovations</span>
            </h1>
            <p class="text-blue-100/70 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Explore peer-reviewed updates, robotic surgical outcomes, and postoperative rehabilitation guidelines authored by our chief surgical staff.
            </p>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- Blogs List Grid (Left 2 Columns) -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Filters Bar -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white border border-slate-200/60 p-4.5 rounded-2xl shadow-sm">
                    <!-- Pill Category Navigation -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button wire:click="selectCategory('')" 
                                class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer @if($selectedCategory === '') bg-blue-600 text-white shadow-md shadow-blue-600/15 @else bg-slate-50 text-slate-650 hover:text-blue-600 hover:bg-slate-100 @endif">
                            All Insights
                        </button>
                        @foreach($categories as $cat)
                            <button wire:click="selectCategory('{{ $cat->slug }}')" 
                                    class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all cursor-pointer @if($selectedCategory === $cat->slug) bg-blue-600 text-white shadow-md shadow-blue-600/15 @else bg-slate-50 text-slate-650 hover:text-blue-600 hover:bg-slate-100 @endif">
                                {{ $cat->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Articles Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    @forelse($blogs as $blog)
                        <article class="bg-white rounded-2xl overflow-hidden flex flex-col shadow-[0_8px_30px_rgba(0,0,0,0.02)] hover:shadow-[0_20px_40px_rgba(37,99,235,0.06)] transition-all group duration-500">
                            <!-- Thumbnail Area -->
                            <a href="{{ route('blog.view', $blog->slug) }}" class="block relative aspect-video bg-slate-100 overflow-hidden shrink-0">
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-700" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 to-transparent"></div>
                                <span class="absolute bottom-3 left-3 bg-blue-600 text-white text-[9px] font-extrabold tracking-widest uppercase px-2.5 py-1 rounded shadow-sm border border-blue-500/20">
                                    {{ $blog->category->name }}
                                </span>
                            </a>

                            <!-- Card Body details -->
                            <div class="p-6 flex-1 flex flex-col justify-between space-y-5">
                                <div class="space-y-3">
                                    <div class="flex items-center gap-2 text-slate-400 text-[9px] font-bold uppercase tracking-wider">
                                        <span class="flex items-center gap-1"><i class="ri-calendar-todo-line text-blue-600"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                        <span>•</span>
                                        <span class="flex items-center gap-1"><i class="ri-time-line text-blue-600"></i> {{ max(2, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read</span>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 leading-snug group-hover:text-blue-600 transition-colors duration-300">
                                        <a href="{{ route('blog.view', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3">
                                        {{ strip_tags($blog->content) }}
                                    </p>
                                </div>

                                <!-- Card Footer details -->
                                <div class="pt-4 border-t border-slate-50 flex items-center justify-between shrink-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-50 text-blue-900 border border-slate-200 flex items-center justify-center text-xs font-bold uppercase shadow-inner">
                                            {{ substr($blog->authorUser->name ?? 'D', 0, 2) }}
                                        </div>
                                        <div class="text-[10px] min-w-0">
                                            <p class="font-bold text-slate-800 truncate leading-tight">{{ $blog->authorUser->name ?? 'Surgeon Specialist' }}</p>
                                            <p class="text-slate-400 mt-0.5 leading-none">Consulting Practitioner</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('blog.view', $blog->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors">
                                        Read Brief <i class="ri-arrow-right-up-line"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-20 text-center text-slate-400 bg-white border border-slate-100 rounded-2xl">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <i class="ri-inbox-archive-line text-5xl text-blue-600/20"></i>
                                <span class="font-bold text-slate-700">No medical briefs found</span>
                                <span class="text-xs text-slate-400">Try adjusting your filters or checking back later.</span>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination navigation -->
                @if($blogs->hasPages())
                    <div class="pt-4">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar (Right 1 Column) -->
            <div class="space-y-8">
                <!-- Search Widget -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2 border-b border-slate-50 pb-2">
                        <i class="ri-search-eye-line text-blue-500"></i> Search Library
                    </h3>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="ri-search-2-line text-sm"></i>
                        </div>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Keywords, spinal fusion, joint outcomes..." 
                               class="w-full pl-9 pr-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all bg-slate-50" />
                    </div>
                </div>

                <!-- Recent Posts Widget -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2 border-b border-slate-50 pb-2">
                        <i class="ri-git-repository-line text-blue-500"></i> Latest Publications
                    </h3>
                    <div class="space-y-4">
                        @foreach($recentBlogs as $recent)
                            <a href="{{ route('blog.view', $recent->slug) }}" class="flex gap-4 group">
                                <div class="w-14 h-14 rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-slate-200 shadow-sm">
                                    <img src="{{ $recent->image_url }}" alt="{{ $recent->image_alt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                </div>
                                <div class="min-w-0 space-y-1">
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $recent->title }}
                                    </h4>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">{{ $recent->created_at->format('M d, Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Appointment Consultation CTA Widget -->
                <div class="bg-gradient-to-br from-slate-900 to-blue-950 border border-blue-900 rounded-2xl p-6 shadow-xl text-white text-center relative overflow-hidden">
                    <!-- Blue light spot -->
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
            </div>

        </div>
    </div>
</div>
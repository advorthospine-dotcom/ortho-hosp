<div class="min-h-screen bg-slate-50">
    
    <!-- Hero Banner Header -->
    <div class="relative bg-slate-950 text-white overflow-hidden py-16 sm:py-20">
        <!-- Abstract Medical Grid Background -->
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-sky-500/20 blur-3xl"></div>
        <div class="absolute -bottom-45 -left-40 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-sky-500/10 text-sky-400 border border-sky-500/20 tracking-wide uppercase">
                <i class="ri-pulse-line"></i> Medical Library & Insights
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight max-w-3xl mx-auto leading-tight">
                Insights from Our <span class="text-sky-400">Orthopedic & Spine</span> Experts
            </h1>
            <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Stay updated with the latest clinical advice, advanced robotic surgeries, sports medicine updates, and wellness guides compiled by our surgeons.
            </p>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Blogs List Grid (Left 2 Columns) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Filters Bar -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white border border-slate-200/60 p-4 rounded-2xl shadow-sm">
                    <!-- Pill Category Navigation -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button wire:click="selectCategory('')" 
                                class="px-4 py-2 text-xs font-semibold rounded-xl transition-all cursor-pointer @if($selectedCategory === '') bg-sky-600 text-white shadow-sm @else bg-slate-50 text-slate-600 hover:bg-slate-100 @endif">
                            All Articles
                        </button>
                        @foreach($categories as $cat)
                            <button wire:click="selectCategory('{{ $cat->slug }}')" 
                                    class="px-4 py-2 text-xs font-semibold rounded-xl transition-all cursor-pointer @if($selectedCategory === $cat->slug) bg-sky-600 text-white shadow-sm @else bg-slate-50 text-slate-600 hover:bg-slate-100 @endif">
                                {{ $cat->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Articles Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @forelse($blogs as $blog)
                        <article class="bg-white border border-slate-200/60 rounded-2xl overflow-hidden flex flex-col shadow-sm hover:shadow-md transition-all group duration-300">
                            <!-- Thumbnail Area -->
                            <a href="{{ route('blog.show', $blog->slug) }}" class="block relative aspect-video bg-slate-100 overflow-hidden shrink-0">
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/20 to-transparent"></div>
                                <span class="absolute bottom-3 left-3 bg-sky-600 text-white text-[10px] font-extrabold tracking-wide uppercase px-2 py-0.5 rounded shadow-sm">
                                    {{ $blog->category->name }}
                                </span>
                            </a>

                            <!-- Card Body details -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase">
                                        <span><i class="ri-calendar-line"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                        <span>•</span>
                                        <span><i class="ri-time-line"></i> {{ max(2, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read</span>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-heading font-bold text-slate-900 leading-snug group-hover:text-sky-600 transition-colors">
                                        <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3">
                                        {{ strip_tags($blog->content) }}
                                    </p>
                                </div>

                                <!-- Card Footer details -->
                                <div class="pt-4 border-t border-slate-50 flex items-center justify-between shrink-0">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-700 border border-slate-200 flex items-center justify-center text-[10px] font-bold uppercase shadow-inner">
                                            {{ substr($blog->authorUser->name ?? 'D', 0, 2) }}
                                        </div>
                                        <div class="text-[10px] min-w-0">
                                            <p class="font-bold text-slate-800 truncate leading-none">{{ $blog->authorUser->name ?? 'Surgeon Specialist' }}</p>
                                            <p class="text-slate-400 mt-0.5 leading-none">Medical Consultant</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-sky-600 group-hover:translate-x-0.5 transition-transform">
                                        Read Article <i class="ri-arrow-right-line"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-16 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i class="ri-article-line text-5xl text-slate-300"></i>
                                <span class="font-semibold">No articles found</span>
                                <span>Try adjusting your category filters or search queries.</span>
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
            <div class="space-y-6">
                <!-- Search Widget -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-5 shadow-sm space-y-3">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2">
                        <i class="ri-search-line text-sky-600"></i> Search Articles
                    </h3>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="ri-search-2-line text-sm"></i>
                        </div>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Keywords, surgeries, guidelines..." 
                               class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all bg-slate-55" />
                    </div>
                </div>

                <!-- Recent Posts Widget -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-5 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2 border-b border-slate-50 pb-2">
                        <i class="ri-history-line text-sky-600"></i> Recent Posts
                    </h3>
                    <div class="space-y-3.5">
                        @foreach($recentBlogs as $recent)
                            <a href="{{ route('blog.show', $recent->slug) }}" class="flex gap-3 group">
                                <div class="w-14 h-14 rounded-lg bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                                    <img src="{{ $recent->image_url }}" alt="{{ $recent->image_alt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                </div>
                                <div class="min-w-0 space-y-1">
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-sky-600 transition-colors">
                                        {{ $recent->title }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 font-semibold">{{ $recent->created_at->format('M d, Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Appointment Consultation CTA Widget -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-950 border border-slate-800 rounded-2xl p-6 shadow-md text-white text-center relative overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-44 h-44 rounded-full bg-sky-500/10 blur-2xl"></div>
                    <div class="relative z-10 space-y-4 flex flex-col items-center">
                        <div class="w-11 h-11 rounded-xl bg-sky-600/10 border border-sky-500/20 flex items-center justify-center text-sky-400">
                            <i class="ri-hospital-line text-2xl"></i>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="font-heading font-extrabold text-sm tracking-tight">Need Orthopedic Advice?</h4>
                            <p class="text-xs text-slate-400 leading-relaxed max-w-[200px]">Book a consultation with our advanced robotic surgery specialists.</p>
                        </div>
                        <a href="{{ route('home') }}#booking" class="inline-flex items-center justify-center w-full py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs rounded-xl shadow-md shadow-sky-600/20 active:scale-[0.99] transition-all cursor-pointer">
                            <i class="ri-calendar-check-line text-sm mr-1.5"></i> Schedule Appointment
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
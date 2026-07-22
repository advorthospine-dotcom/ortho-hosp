<div class="min-h-screen bg-slate-50/50 py-12 sm:py-16">
    
    <!-- Scoped style sheet override for TinyMCE output with Navy & Cobalt Blue theme -->
    <style>
        .blog-rich-content h1, .blog-rich-content h2, .blog-rich-content h3, .blog-rich-content h4 {
            color: #0f172a !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 800 !important;
            line-height: 1.3 !important;
            margin-top: 2.25rem !important;
            margin-bottom: 1.25rem !important;
        }
        .blog-rich-content h2 { font-size: 1.6rem !important; border-b: 1px solid #e2e8f0; padding-bottom: 0.5rem; }
        .blog-rich-content h3 { font-size: 1.3rem !important; }
        .blog-rich-content p {
            margin-bottom: 1.5rem !important;
            line-height: 1.8 !important;
            color: #334155 !important;
            font-size: 1rem !important;
        }
        .blog-rich-content ul {
            list-style-type: disc !important;
            margin-left: 1.75rem !important;
            margin-bottom: 1.5rem !important;
        }
        .blog-rich-content ol {
            list-style-type: decimal !important;
            margin-left: 1.75rem !important;
            margin-bottom: 1.5rem !important;
        }
        .blog-rich-content li {
            margin-bottom: 0.6rem !important;
            color: #334155 !important;
            line-height: 1.7 !important;
        }
        .blog-rich-content blockquote {
            border-left: 4px solid #2563eb !important;
            padding: 0.75rem 1.5rem !important;
            font-style: italic !important;
            color: #475569 !important;
            margin: 2rem 0 !important;
            background-color: #eff6ff !important;
            border-radius: 0 0.75rem 0.75rem 0;
        }
        .blog-rich-content strong {
            color: #0f172a !important;
            font-weight: 700 !important;
        }
        .blog-rich-content img {
            border-radius: 1.25rem !important;
            box-shadow: 0 10px 30px -10px rgba(37,99,235,0.08) !important;
            margin: 2.5rem auto !important;
            max-width: 100% !important;
            height: auto !important;
        }
        .blog-rich-content table {
            display: block !important;
            width: 100% !important;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
            border-collapse: collapse !important;
            margin: 2rem 0 !important;
            font-size: 0.875rem !important;
        }
        .blog-rich-content th, .blog-rich-content td {
            border: 1px solid #e2e8f0 !important;
            padding: 0.85rem 1.1rem !important;
            text-align: left !important;
        }
        .blog-rich-content th {
            background-color: #f8fafc !important;
            font-weight: 700 !important;
            color: #0f172a !important;
        }
    </style>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs Navigation -->
        <nav class="flex items-center gap-2.5 text-[11px] font-bold tracking-wide uppercase text-slate-400 mb-8 shrink-0">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
            <a href="{{ route('blog') }}" class="hover:text-blue-600 transition-colors">Insights</a>
            <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
            <span class="text-slate-655 truncate max-w-[200px]" title="{{ $blog->title }}">{{ $blog->title }}</span>
        </nav>

        <!-- Main Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            
            <!-- Article Body Area (Left 2 Columns) -->
            <article class="lg:col-span-2 bg-white border border-slate-200/60 rounded-2xl p-6 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.01)] space-y-6">
                <!-- Meta tags / Category Badge -->
                <div class="flex items-center gap-2.5 flex-wrap">
                    <span class="bg-blue-600 text-white text-[9px] font-extrabold tracking-widest uppercase px-2.5 py-1 rounded shadow-sm border border-blue-500/20">
                        {{ $blog->category->name }}
                    </span>
                    <span class="text-slate-300 text-xs">|</span>
                    <span class="text-slate-400 text-xs font-semibold flex items-center gap-1.5">
                        <i class="ri-calendar-line text-blue-600"></i> {{ $blog->created_at->format('F d, Y') }}
                    </span>
                    <span class="text-slate-300 text-xs">•</span>
                    <span class="text-slate-400 text-xs font-semibold flex items-center gap-1.5">
                        <i class="ri-time-line text-blue-600"></i> {{ max(2, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read
                    </span>
                </div>

                <!-- Main Post Title -->
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-extrabold text-slate-905 tracking-tight leading-tight">
                    {{ $blog->title }}
                </h1>

                <!-- Author details tag -->
                <div class="flex items-center gap-3.5 p-3.5 bg-slate-50 border border-slate-100 rounded-2xl max-w-fit shadow-sm">
                    <div class="w-9 h-9 rounded-full bg-white text-blue-900 border border-slate-200 flex items-center justify-center text-xs font-bold uppercase shadow-inner">
                        {{ substr($blog->authorUser->name ?? 'D', 0, 2) }}
                    </div>
                    <div class="text-xs">
                        <p class="font-bold text-slate-800 leading-tight">{{ $blog->authorUser->name ?? 'Specialist Surgeon' }}</p>
                        <p class="text-slate-400 text-[9px] mt-0.5 font-bold uppercase tracking-wider">Clinical Author</p>
                    </div>
                </div>

                <!-- Main Wide Image Banner -->
                @if($blog->image_path)
                    <div class="aspect-video bg-slate-100 rounded-2xl overflow-hidden border border-slate-200 shadow-inner">
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="w-full h-full object-cover" />
                    </div>
                @endif

                <!-- Rich text Editor output -->
                <div class="blog-rich-content">
                    {!! $blog->content !!}
                </div>
            </article>

            <!-- Sidebar Info Area (Right 1 Column) -->
            <div class="space-y-8">
                <!-- Share Widget -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-6 shadow-sm space-y-4"
                     x-data="{ copied: false, shareUrl: window.location.href }">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2 border-b border-slate-50 pb-2">
                        <i class="ri-share-forward-line text-blue-500"></i> Share Article
                    </h3>
                    <div class="flex flex-col gap-2">
                        <!-- Custom copying button -->
                        <button type="button" 
                                @click="navigator.clipboard.writeText(shareUrl); copied = true; setTimeout(() => copied = false, 2000)"
                                class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl border text-xs font-bold transition-all cursor-pointer focus:outline-none"
                                :class="copied ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : 'bg-slate-50 hover:bg-slate-100 border-slate-200 text-slate-700'">
                            <i :class="copied ? 'ri-checkbox-circle-fill text-emerald-500' : 'ri-file-copy-2-line'"></i>
                            <span x-text="copied ? 'Link Copied!' : 'Copy Article Link'"></span>
                        </button>
                    </div>
                </div>

                <!-- Related Articles list -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2 border-b border-slate-50 pb-2">
                        <i class="ri-git-repository-line text-blue-500"></i> Related Insights
                    </h3>
                    <div class="space-y-4">
                        @forelse($relatedBlogs as $rel)
                            <a href="{{ route('blog.view', $rel->slug) }}" class="flex gap-4 group">
                                <div class="w-14 h-14 rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-slate-200 shadow-sm">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->image_alt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                </div>
                                <div class="min-w-0 space-y-1">
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $rel->title }}
                                    </h4>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">{{ $rel->created_at->format('M d, Y') }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">No related insights found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Consultation CTA card -->
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
                <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-blue-600 transition-colors py-2 px-1">
                    <i class="ri-arrow-left-line"></i> Back to all articles
                </a>
            </div>

        </div>
    </div>
</div>
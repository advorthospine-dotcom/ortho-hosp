<div class="min-h-screen bg-slate-50 py-8 sm:py-12">
    
    <!-- Scoped style sheet override for TinyMCE output -->
    <style>
        .blog-rich-content h1, .blog-rich-content h2, .blog-rich-content h3, .blog-rich-content h4 {
            color: #0f172a !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 800 !important;
            line-height: 1.3 !important;
            margin-top: 2rem !important;
            margin-bottom: 1rem !important;
        }
        .blog-rich-content h2 { font-size: 1.5rem !important; border-b: 1px solid #f1f5f9; padding-bottom: 0.5rem; }
        .blog-rich-content h3 { font-size: 1.25rem !important; }
        .blog-rich-content p {
            margin-bottom: 1.25rem !important;
            line-height: 1.75 !important;
            color: #334155 !important;
        }
        .blog-rich-content ul {
            list-style-type: disc !important;
            margin-left: 1.5rem !important;
            margin-bottom: 1.25rem !important;
            space-y: 0.5rem;
        }
        .blog-rich-content ol {
            list-style-type: decimal !important;
            margin-left: 1.5rem !important;
            margin-bottom: 1.25rem !important;
            space-y: 0.5rem;
        }
        .blog-rich-content li {
            margin-bottom: 0.5rem !important;
            color: #334155 !important;
        }
        .blog-rich-content blockquote {
            border-left: 4px solid #0284c7 !important;
            padding-left: 1.25rem !important;
            font-style: italic !important;
            color: #475569 !important;
            margin: 1.5rem 0 !important;
            background-color: #f0f9ff;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            border-radius: 0 0.5rem 0.5rem 0;
        }
        .blog-rich-content strong {
            color: #0f172a !important;
            font-weight: 700 !important;
        }
        .blog-rich-content img {
            border-radius: 1rem !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05) !important;
            margin: 2rem auto !important;
            max-width: 100% !important;
            height: auto !important;
        }
        .blog-rich-content table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin: 1.5rem 0 !important;
            font-size: 0.875rem !important;
        }
        .blog-rich-content th, .blog-rich-content td {
            border: 1px solid #e2e8f0 !important;
            padding: 0.75rem 1rem !important;
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
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6 shrink-0">
            <a href="{{ route('home') }}" class="hover:text-sky-600 transition-colors">Home</a>
            <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
            <a href="{{ route('blog.index') }}" class="hover:text-sky-600 transition-colors">Blog</a>
            <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
            <span class="text-slate-600 truncate max-w-[200px]" title="{{ $blog->title }}">{{ $blog->title }}</span>
        </nav>

        <!-- Main Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- Article Body Area (Left 2 Columns) -->
            <article class="lg:col-span-2 bg-white border border-slate-200/60 rounded-2xl p-6 sm:p-8 shadow-sm space-y-6">
                <!-- Meta tags / Category Badge -->
                <div class="flex items-center gap-2.5">
                    <span class="bg-sky-50 text-sky-600 text-[10px] font-extrabold tracking-wide uppercase px-2.5 py-1 rounded-lg">
                        {{ $blog->category->name }}
                    </span>
                    <span class="text-slate-300 text-xs">|</span>
                    <span class="text-slate-400 text-xs font-semibold flex items-center gap-1">
                        <i class="ri-calendar-line"></i> {{ $blog->created_at->format('F d, Y') }}
                    </span>
                    <span class="text-slate-300 text-xs">•</span>
                    <span class="text-slate-400 text-xs font-semibold flex items-center gap-1">
                        <i class="ri-time-line"></i> {{ max(2, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read
                    </span>
                </div>

                <!-- Main Post Title -->
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-extrabold text-slate-900 tracking-tight leading-tight">
                    {{ $blog->title }}
                </h1>

                <!-- Author details tag -->
                <div class="flex items-center gap-3.5 p-3 bg-slate-50 border border-slate-100 rounded-xl max-w-fit">
                    <div class="w-9 h-9 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-bold uppercase shadow-inner border border-slate-300">
                        {{ substr($blog->authorUser->name ?? 'D', 0, 2) }}
                    </div>
                    <div class="text-xs">
                        <p class="font-bold text-slate-800 leading-tight">{{ $blog->authorUser->name ?? 'Specialist Surgeon' }}</p>
                        <p class="text-slate-500 text-[10px] mt-0.5 leading-none">Medical Author & Consultant</p>
                    </div>
                </div>

                <!-- Main Wide Image Banner -->
                @if($blog->image_path)
                    <div class="aspect-video bg-slate-100 rounded-2xl overflow-hidden border border-slate-200 shadow-inner">
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="w-full h-full object-cover" />
                    </div>
                @endif

                <!-- Rich text Editor output -->
                <div class="blog-rich-content text-sm sm:text-base">
                    {!! $blog->content !!}
                </div>
            </article>

            <!-- Sidebar Info Area (Right 1 Column) -->
            <div class="space-y-6">
                <!-- Share Widget -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-5 shadow-sm space-y-4"
                     x-data="{ copied: false, shareUrl: window.location.href }">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2 border-b border-slate-50 pb-2">
                        <i class="ri-share-line text-sky-600"></i> Share Article
                    </h3>
                    <div class="flex flex-col gap-2">
                        <!-- Custom copying button -->
                        <button type="button" 
                                @click="navigator.clipboard.writeText(shareUrl); copied = true; setTimeout(() => copied = false, 2000)"
                                class="w-full inline-flex items-center justify-center gap-2 py-2 rounded-xl border text-xs font-bold transition-all cursor-pointer focus:outline-none"
                                :class="copied ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : 'bg-slate-50 hover:bg-slate-100 border-slate-200 text-slate-700'">
                            <i :class="copied ? 'ri-checkbox-circle-fill text-emerald-500' : 'ri-file-copy-2-line'"></i>
                            <span x-text="copied ? 'Link Copied!' : 'Copy Article Link'"></span>
                        </button>
                    </div>
                </div>

                <!-- Related Articles list -->
                <div class="bg-white border border-slate-200/60 rounded-2xl p-5 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-800 text-sm flex items-center gap-2 border-b border-slate-50 pb-2">
                        <i class="ri-links-line text-sky-600"></i> Related Articles
                    </h3>
                    <div class="space-y-4">
                        @forelse($relatedBlogs as $rel)
                            <a href="{{ route('blog.show', $rel->slug) }}" class="flex gap-3 group">
                                <div class="w-14 h-14 rounded-lg bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->image_alt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                </div>
                                <div class="min-w-0 space-y-1">
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-sky-600 transition-colors">
                                        {{ $rel->title }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 font-semibold">{{ $rel->created_at->format('M d, Y') }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">No related articles found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Consultation CTA card -->
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

                <!-- Back to list button -->
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-sky-600 transition-colors py-2 px-1">
                    <i class="ri-arrow-left-line"></i> Back to all articles
                </a>
            </div>

        </div>
    </div>
</div>
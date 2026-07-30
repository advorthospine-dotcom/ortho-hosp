@section('title', isset($blog) && $blog->title ? $blog->title . ' | Orthopaedic Medical Blog' : 'Medical Article')
@section('meta_description', isset($blog) && $blog->content ? Str::limit(strip_tags($blog->content), 155) : 'Read our latest medical article from Advance Orthopaedic & Spine Center.')
@section('og_title', isset($blog) ? $blog->title : '')
@section('og_description', isset($blog) && $blog->content ? Str::limit(strip_tags($blog->content), 155) : '')

<div class="min-h-screen bg-slate-50/60 py-10 sm:py-14">
    
    <!-- Scoped style sheet for TinyMCE HTML output with Brand Teal theme -->
    <style>
        .blog-rich-content {
            font-family: 'Inter', sans-serif;
            color: #334155;
            font-size: 1.05rem;
            line-height: 1.85;
        }
        .blog-rich-content h1, 
        .blog-rich-content h2, 
        .blog-rich-content h3, 
        .blog-rich-content h4 {
            color: #0f172a !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 800 !important;
            line-height: 1.3 !important;
            letter-spacing: -0.02em !important;
        }
        .blog-rich-content h1 {
            font-size: 2rem !important;
            margin-top: 2.5rem !important;
            margin-bottom: 1.25rem !important;
        }
        .blog-rich-content h2 { 
            font-size: 1.65rem !important; 
            border-bottom: 2px solid #f1f5f9; 
            padding-bottom: 0.6rem; 
            margin-top: 2.5rem !important;
            margin-bottom: 1.25rem !important;
        }
        .blog-rich-content h3 { 
            font-size: 1.35rem !important; 
            margin-top: 2rem !important;
            margin-bottom: 1rem !important;
        }
        .blog-rich-content h4 { 
            font-size: 1.15rem !important; 
            margin-top: 1.75rem !important;
            margin-bottom: 0.75rem !important;
        }
        .blog-rich-content p {
            margin-bottom: 1.6rem !important;
            color: #334155 !important;
        }
        .blog-rich-content ul {
            list-style-type: disc !important;
            margin-left: 1.75rem !important;
            margin-bottom: 1.6rem !important;
        }
        .blog-rich-content ol {
            list-style-type: decimal !important;
            margin-left: 1.75rem !important;
            margin-bottom: 1.6rem !important;
        }
        .blog-rich-content li {
            margin-bottom: 0.65rem !important;
            color: #334155 !important;
            line-height: 1.75 !important;
        }
        .blog-rich-content blockquote {
            border-left: 4px solid #114b5f !important;
            padding: 1.25rem 1.75rem !important;
            font-style: italic !important;
            color: #1e293b !important;
            margin: 2.25rem 0 !important;
            background-color: #f0fdfa !important;
            border-radius: 0 1rem 1rem 0;
            position: relative;
        }
        .blog-rich-content strong {
            color: #0f172a !important;
            font-weight: 700 !important;
        }
        .blog-rich-content a {
            color: #114b5f !important;
            text-decoration: underline !important;
            font-weight: 600 !important;
        }
        .blog-rich-content a:hover {
            color: #0d3b4b !important;
        }
        .blog-rich-content img {
            border-radius: 1.25rem !important;
            box-shadow: 0 12px 32px -8px rgba(17,75,95,0.08) !important;
            margin: 2.5rem auto !important;
            max-width: 100% !important;
            height: auto !important;
            border: 1px solid #e2e8f0;
        }
        .blog-rich-content table {
            display: block !important;
            width: 100% !important;
            overflow-x: auto !important;
            border-collapse: collapse !important;
            margin: 2.25rem 0 !important;
            font-size: 0.9rem !important;
            border-radius: 0.75rem;
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

    <!-- Main Outer Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        

        <!-- Main Content Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            
            <!-- Main Article Card Column (Left 2 Cols) -->
            <main class="lg:col-span-2 bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.02)] space-y-8">
                
                <!-- Article Header Info -->
                <div class="space-y-4">
                    <!-- Meta Row: Category, Date, Reading Time -->
                    <div class="flex items-center gap-3 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#114b5f] bg-teal-50 border border-teal-200/60 rounded-lg shadow-2xs">
                            <i class="ri-price-tag-3-line text-[#114b5f] text-xs"></i>
                            {{ $blog->category->name }}
                        </span>

                        <span class="text-slate-300 text-xs">•</span>

                        <span class="text-xs font-semibold text-slate-500 flex items-center gap-1.5">
                            <i class="ri-calendar-line text-[#114b5f]"></i>
                            {{ $blog->created_at->format('F d, Y') }}
                        </span>

                        <span class="text-slate-300 text-xs">•</span>

                        <span class="text-xs font-semibold text-slate-500 flex items-center gap-1.5">
                            <i class="ri-time-line text-[#114b5f]"></i>
                            {{ max(2, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read
                        </span>
                    </div>

                    <!-- Main Article Title -->
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-extrabold text-slate-900 tracking-tight leading-tight">
                        {{ $blog->title }}
                    </h1>

                    <!-- Author Badge Card -->
                    <div class="pt-2 flex items-center justify-between border-y border-slate-100 py-3.5">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-full bg-[#114b5f] text-white flex items-center justify-center text-xs font-extrabold uppercase shadow-md border-2 border-white">
                                {{ substr($blog->authorUser->name ?? 'D', 0, 2) }}
                            </div>
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <p class="font-bold text-slate-800 text-sm leading-tight">{{ $blog->authorUser->name ?? 'Specialist Surgeon' }}</p>
                                    <span class="text-[#114b5f] text-xs" title="Verified Medical Author"><i class="ri-verified-badge-fill"></i></span>
                                </div>
                                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mt-0.5">Clinical Faculty & Staff</p>
                            </div>
                        </div>

                        <!-- Back Button Pill -->
                        <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-[#114b5f] bg-slate-100 hover:bg-slate-200/70 px-3 py-1.5 rounded-xl transition-all cursor-pointer">
                            <i class="ri-arrow-left-line"></i> <span class="hidden sm:inline">Back to Insights</span>
                        </a>
                    </div>
                </div>

                <!-- Featured Image Banner -->
                @if($blog->image_path)
                    <div class="space-y-2">
                        <div class="aspect-[16/9] bg-slate-100 rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm relative group">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="w-full h-full object-cover" />
                        </div>
                        @if($blog->image_alt)
                            <p class="text-[11px] text-slate-400 italic text-center font-medium">
                                <i class="ri-image-line"></i> {{ $blog->image_alt }}
                            </p>
                        @endif
                    </div>
                @endif

                <!-- Article Body Content -->
                <div class="blog-rich-content pt-2">
                    {!! $blog->content !!}
                </div>

                <!-- Medical Disclaimer Callout Box -->
                <div class="mt-8 bg-teal-50/70 border border-teal-200/80 rounded-2xl p-5 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[#114b5f] text-white flex items-center justify-center text-lg shrink-0 shadow-sm mt-0.5">
                        <i class="ri-shield-cross-fill"></i>
                    </div>
                    <div class="space-y-1 text-xs">
                        <h4 class="font-heading font-extrabold text-slate-900">Clinical Information Disclaimer</h4>
                        <p class="text-slate-600 leading-relaxed">
                            This publication is authored by clinical staff at Advance Orthopaedic & Spine Center for informational purposes only. It is not a substitute for formal clinical diagnosis or personalized medical evaluation.
                        </p>
                    </div>
                </div>

                <!-- Social Media Share Icons Row (Facebook, Instagram, WhatsApp, X) -->
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                     x-data="{ copied: false, shareUrl: window.location.href }">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-slate-700">Share Article:</span>
                        <div class="flex items-center gap-2">
                            <!-- Facebook -->
                            <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl)" 
                               target="_blank" 
                               class="w-9 h-9 rounded-xl bg-[#114b5f] hover:bg-[#0d3b4b] text-white flex items-center justify-center text-base shadow-sm hover:scale-105 transition-all"
                               title="Share on Facebook">
                                <i class="ri-facebook-fill"></i>
                            </a>

                            <!-- Instagram -->
                            <button @click="navigator.clipboard.writeText(shareUrl); copied = true; setTimeout(() => copied = false, 2000); window.open('https://www.instagram.com', '_blank')"
                                    class="w-9 h-9 rounded-xl bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 hover:opacity-90 text-white flex items-center justify-center text-base shadow-sm hover:scale-105 transition-all cursor-pointer"
                                    title="Copy Link & Open Instagram">
                                <i class="ri-instagram-line"></i>
                            </button>

                            <!-- WhatsApp -->
                            <a :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent('{{ $blog->title }} - ' + shareUrl)" 
                               target="_blank" 
                               class="w-9 h-9 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center text-base shadow-sm hover:scale-105 transition-all"
                               title="Share on WhatsApp">
                                <i class="ri-whatsapp-fill"></i>
                            </a>

                            <!-- X (Twitter) -->
                            <a :href="'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent('{{ $blog->title }}')" 
                               target="_blank" 
                               class="w-9 h-9 rounded-xl bg-slate-900 hover:bg-black text-white flex items-center justify-center text-base shadow-sm hover:scale-105 transition-all"
                               title="Share on X">
                                <i class="ri-twitter-x-fill"></i>
                            </a>

                            <!-- Copy Link Button -->
                            <button @click="navigator.clipboard.writeText(shareUrl); copied = true; setTimeout(() => copied = false, 2000)" 
                                    class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-base transition-all cursor-pointer"
                                    title="Copy Article Link">
                                <i :class="copied ? 'ri-checkbox-circle-fill text-emerald-600' : 'ri-file-copy-2-line'"></i>
                            </button>
                        </div>
                    </div>

                    <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors">
                        <i class="ri-arrow-left-line"></i> View All Medical Insights
                    </a>
                </div>

            </main>

            <!-- Sidebar Column (Right 1 Col) -->
            <aside class="space-y-8">
                
                <!-- Share Knowledge Sidebar Widget with Icons (Facebook, Instagram, WhatsApp, X) -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4"
                     x-data="{ copied: false, shareUrl: window.location.href }">
                    <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-share-forward-line text-[#114b5f]"></i> Share Knowledge
                    </h3>
                    <div class="grid grid-cols-2 gap-2.5">
                        <!-- Facebook -->
                        <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl)" 
                           target="_blank" 
                           class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-teal-50 hover:bg-teal-100 border border-teal-200/60 text-[#114b5f] text-xs font-bold transition-all">
                            <i class="ri-facebook-circle-fill text-[#114b5f] text-base"></i>
                            <span>Facebook</span>
                        </a>

                        <!-- Instagram -->
                        <button type="button"
                                @click="navigator.clipboard.writeText(shareUrl); copied = true; setTimeout(() => copied = false, 2000); window.open('https://www.instagram.com', '_blank')"
                                class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-200/60 text-rose-700 text-xs font-bold transition-all cursor-pointer">
                            <i class="ri-instagram-fill text-rose-600 text-base"></i>
                            <span>Instagram</span>
                        </button>

                        <!-- WhatsApp -->
                        <a :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent('{{ $blog->title }} - ' + shareUrl)" 
                           target="_blank" 
                           class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200/60 text-emerald-700 text-xs font-bold transition-all">
                            <i class="ri-whatsapp-fill text-emerald-600 text-base"></i>
                            <span>WhatsApp</span>
                        </a>

                        <!-- X (Twitter) -->
                        <a :href="'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent('{{ $blog->title }}')" 
                           target="_blank" 
                           class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-300/60 text-slate-900 text-xs font-bold transition-all">
                            <i class="ri-twitter-x-fill text-slate-900 text-base"></i>
                            <span>X (Twitter)</span>
                        </a>
                    </div>

                    <!-- Direct Copy Button -->
                    <button type="button" 
                            @click="navigator.clipboard.writeText(shareUrl); copied = true; setTimeout(() => copied = false, 2000)"
                            class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-xl border text-xs font-bold transition-all cursor-pointer focus:outline-none"
                            :class="copied ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : 'bg-slate-50 hover:bg-slate-100 border-slate-200/80 text-slate-700'">
                        <i :class="copied ? 'ri-checkbox-circle-fill text-emerald-500' : 'ri-file-copy-2-line'"></i>
                        <span x-text="copied ? 'Link Copied to Clipboard!' : 'Copy Article Link'"></span>
                    </button>
                </div>

                <!-- Related Insights Widget -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-4">
                    <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2 border-b border-slate-100 pb-3">
                        <i class="ri-git-repository-line text-[#114b5f]"></i> Related Insights
                    </h3>
                    <div class="space-y-4">
                        @forelse($relatedBlogs as $rel)
                            <a href="{{ route('blog.view', $rel->slug) }}" class="flex gap-3.5 group items-start">
                                <div class="w-16 h-16 rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-slate-200/80 shadow-xs relative">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->image_alt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                </div>
                                <div class="min-w-0 space-y-1">
                                    <span class="text-[9px] font-extrabold uppercase tracking-wider text-[#114b5f] block">
                                        {{ $rel->category->name ?? 'Clinical' }}
                                    </span>
                                    <h4 class="text-xs font-bold text-slate-800 leading-snug line-clamp-2 group-hover:text-[#114b5f] transition-colors">
                                        {{ $rel->title }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 font-medium">
                                        {{ $rel->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">No related insights found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Doctor Appointment CTA Widget -->
                <div class="bg-gradient-to-br from-slate-950 via-[#0a2f3c] to-slate-950 border border-[#114b5f]/40 rounded-2xl p-6 shadow-xl text-white text-center relative overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-44 h-44 rounded-full bg-[#114b5f]/20 blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-20 -left-20 w-44 h-44 rounded-full bg-[#3b774b]/10 blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-4 flex flex-col items-center">
                        <div class="w-12 h-12 rounded-xl bg-[#114b5f]/30 border border-teal-400/30 flex items-center justify-center text-teal-300 shadow-lg">
                            <i class="ri-calendar-check-fill text-2xl"></i>
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="font-heading font-extrabold text-sm tracking-wide text-teal-100">Need Expert Evaluation?</h4>
                            <p class="text-xs text-slate-300 leading-relaxed max-w-[220px] mx-auto">Book an evaluation with our expert spine and joint reconstructive team.</p>
                        </div>
                        <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center justify-center w-full py-3 bg-[#114b5f] hover:bg-[#0d3b4b] text-white font-bold text-xs rounded-xl shadow-lg shadow-[#114b5f]/30 active:scale-[0.99] transition-all cursor-pointer">
                            Schedule Appointment
                        </a>
                    </div>
                </div>

            </aside>

        </div>
    </div>

</div>
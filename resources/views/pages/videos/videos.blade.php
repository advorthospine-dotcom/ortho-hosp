@section('title', 'Video Gallery & Patient Education | Advance Orthopaedic & Spine Center')
@section('meta_description', 'Watch clinical procedure videos, keyhole spine surgery walkthroughs, knee replacement guides, and patient recovery stories at Advance Orthopaedic & Spine Center.')
@section('meta_keywords', 'orthopedic surgery videos, knee replacement video, keyhole spine surgery, patient education videos, hospital video gallery')

<div class="min-h-screen bg-slate-50/60 pb-20" 
     x-data="{ 
         modalOpen: false, 
         modalUrl: '', 
         modalTitle: '',
         playModal(url, title) {
             this.modalUrl = url;
             this.modalTitle = title;
             this.modalOpen = true;
         },
         closeModal() {
             this.modalOpen = false;
             this.modalUrl = '';
             this.modalTitle = '';
         }
     }">
    
    <!-- Hero Banner Header -->
    <div class="relative bg-gradient-to-br from-slate-950 via-[#0a2f3c] to-slate-950 text-white overflow-hidden py-16 sm:py-20 border-b border-slate-800">
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#0d9488_1px,transparent_1px),linear-gradient(to_bottom,#0d9488_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-[#114b5f]/30 blur-3xl pointer-events-none"></div>

        <div class="max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-12 relative z-10 text-center space-y-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#114b5f]/40 text-teal-300 border border-teal-400/30 tracking-wider uppercase shadow-inner">
                <i class="ri-video-line text-teal-300"></i> Media & Patient Education Library
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight max-w-4xl mx-auto leading-tight text-white">
                Clinical Procedures & <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-200 via-emerald-300 to-teal-100">Video Gallery</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Watch surgical walkthroughs, sub-specialty procedure explanations, and patient rehabilitation journeys directly from our specialists.
            </p>

            <!-- Search Bar inside Hero -->
            <div class="pt-2 max-w-xl mx-auto">
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="ri-search-2-line text-base text-teal-300"></i>
                    </div>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           placeholder="Search videos (e.g. knee replacement, keyhole spine)..." 
                           class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-slate-400 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 focus:bg-slate-900/90 transition-all shadow-lg" />
                </div>
            </div>
        </div>
    </div>

    <!-- Video Grid Section -->
    <div class="max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-12 pt-12 sm:pt-16">
        
        @if($videos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($videos as $video)
                    <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(17,75,95,0.08)] hover:border-[#114b5f]/40 transition-all duration-300 group relative">
                        
                        <!-- Video Media Container with In-Card Play Capability -->
                        <div class="aspect-video bg-slate-950 relative overflow-hidden group" x-data="{ playingInline: false }">
                            
                            <!-- Thumbnail view before play -->
                            <div x-show="!playingInline" class="relative w-full h-full cursor-pointer" @click="playingInline = true">
                                <img src="{{ $video->thumbnail_url }}" 
                                     alt="{{ $video->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out opacity-90" />
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent group-hover:via-slate-950/10 transition-colors flex items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-[#114b5f]/90 hover:bg-[#114b5f] text-white flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform border-2 border-teal-400/40">
                                        <i class="ri-play-fill text-3xl ml-1"></i>
                                    </div>
                                </div>

                                <div class="absolute top-3 left-3 z-10">
                                    <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-slate-950/80 text-teal-300 border border-teal-500/30 backdrop-blur-md shadow-xs">
                                        Click to Play
                                    </span>
                                </div>
                            </div>

                            <!-- Embedded YouTube iframe when playing inline -->
                            <template x-if="playingInline">
                                <iframe src="{{ $video->embed_url }}" 
                                        class="w-full h-full border-0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen></iframe>
                            </template>
                        </div>

                        <!-- Video Content Info -->
                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors leading-snug">
                                    {{ $video->title }}
                                </h3>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Watch sub-specialty insights and procedure walkthroughs presented by our board-certified surgeons.
                                </p>
                            </div>

                            <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ $video->video_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-[#114b5f] transition-colors">
                                    <i class="ri-youtube-line text-rose-500 text-sm"></i>
                                    <span>YouTube</span>
                                </a>

                                <button type="button" 
                                        data-url="{{ $video->embed_url }}"
                                        data-title="{{ $video->title }}"
                                        @click="playModal($el.dataset.url, $el.dataset.title)"
                                        class="inline-flex items-center gap-1.5 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors cursor-pointer bg-teal-50 hover:bg-teal-100/80 px-3 py-1.5 rounded-lg border border-teal-200/60">
                                    <i class="ri-fullscreen-line text-sm"></i>
                                    <span>Theater Mode</span>
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $videos->links() }}
            </div>
        @else
            <div class="bg-white p-12 sm:p-16 rounded-3xl border border-slate-200 text-center space-y-4 max-w-xl mx-auto shadow-xs">
                <div class="w-16 h-16 rounded-full bg-teal-50 text-[#114b5f] flex items-center justify-center mx-auto text-3xl">
                    <i class="ri-video-search-line"></i>
                </div>
                <h3 class="font-heading font-extrabold text-slate-900 text-lg">No Videos Found</h3>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    No clinical video recordings matched your search keywords. Try searching for general terms like "knee", "spine", or "rehab".
                </p>
                <button type="button" wire:click="$set('search', '')" class="px-5 py-2.5 bg-[#114b5f] text-white font-bold text-xs rounded-xl shadow-md cursor-pointer">
                    Clear Search Filter
                </button>
            </div>
        @endif

    </div>

    <!-- FULLSCREEN THEATER MODAL PLAYER -->
    <div x-show="modalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4 sm:p-6"
         x-cloak>
        <div @click.outside="closeModal()" class="bg-slate-900 rounded-3xl max-w-4xl w-full border border-slate-800 overflow-hidden shadow-2xl flex flex-col">
            <!-- Modal Header -->
            <div class="p-4 px-6 border-b border-slate-800 flex items-center justify-between bg-slate-950">
                <h3 class="font-heading font-bold text-white text-sm sm:text-base truncate max-w-lg" x-text="modalTitle"></h3>
                <button @click="closeModal()" type="button" class="w-8 h-8 rounded-full bg-slate-800 text-slate-300 hover:text-white flex items-center justify-center transition-colors cursor-pointer">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <!-- Responsive Video Frame -->
            <div class="aspect-video bg-black relative">
                <template x-if="modalOpen && modalUrl">
                    <iframe :src="modalUrl" 
                            class="w-full h-full border-0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen></iframe>
                </template>
            </div>
        </div>
    </div>

</div>

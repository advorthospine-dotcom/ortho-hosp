@section('title', 'Hospital Photo Gallery & Infrastructure | Advance Orthopaedic & Spine Center')
@section('meta_description', 'Explore our photo gallery featuring ultra-clean modular operation theaters, advanced ICU units, private suites, and patient care facilities.')
@section('meta_keywords', 'hospital gallery, modular OT, ICU facility, orthopaedic hospital photos')

<div x-data="{ 
    isOpen: false, 
    activeImage: '', 
    activeTitle: '',
    currentIndex: 0,
    images: [
        @foreach($galleries as $index => $item)
            { url: '{{ $item->image_url }}', title: '{{ addslashes($item->title ?? "Hospital Facility") }}' },
        @endforeach
    ],
    openLightbox(index, url, title) {
        this.currentIndex = index;
        this.activeImage = url;
        this.activeTitle = title;
        this.isOpen = true;
    },
    nextImage() {
        if (this.images.length === 0) return;
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
        this.activeImage = this.images[this.currentIndex].url;
        this.activeTitle = this.images[this.currentIndex].title;
    },
    prevImage() {
        if (this.images.length === 0) return;
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        this.activeImage = this.images[this.currentIndex].url;
        this.activeTitle = this.images[this.currentIndex].title;
    }
}" @keydown.escape.window="isOpen = false" @keydown.right.window="if(isOpen) nextImage()" @keydown.left.window="if(isOpen) prevImage()">

    <!-- HERO HEADER BANNER -->
    <section class="relative bg-gradient-to-br from-slate-900 via-sky-950 to-slate-900 text-white py-16 lg:py-20 overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#0f172a12_1px,transparent_1px),linear-gradient(to_bottom,#0f172a12_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                <a href="{{ route('home') }}" wire:navigate class="hover:text-sky-400 transition-colors flex items-center gap-1">
                    <i class="ri-home-4-line text-sm"></i>
                    <span>Home</span>
                </a>
                <i class="ri-arrow-right-s-line text-slate-600"></i>
                <span class="text-sky-400 font-semibold">Gallery</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="space-y-4 max-w-3xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/20 text-sky-300 text-xs font-semibold">
                        <i class="ri-camera-lens-line text-sky-400"></i>
                        <span>World-Class Infrastructure</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white">
                        Hospital Photo <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-cyan-300">Gallery</span>
                    </h1>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Take a visual tour of Advance Orthopaedic & Spine Center. Experience our state-of-the-art surgical suites, advanced ICU care, rehabilitation center, and luxury patient suites.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl px-5 py-3.5 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center font-bold text-xl">
                            <i class="ri-image-2-line"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-extrabold text-white">{{ $totalImages > 0 ? $totalImages : '6+' }}</div>
                            <div class="text-xs text-slate-400 font-medium">Verified Photos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GALLERY CONTENT SECTION -->
    <section class="py-12 lg:py-16 bg-slate-50 min-h-[500px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if($galleries->count() > 0)
                <!-- PHOTO GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($galleries as $index => $item)
                        <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 flex flex-col">
                            <!-- Image Container -->
                            <div class="relative aspect-[4/3] overflow-hidden bg-slate-100 cursor-pointer" 
                                 @click="openLightbox({{ $index }}, '{{ $item->image_url }}', '{{ addslashes($item->title ?? 'Hospital Photo') }}')">
                                
                                <img src="{{ $item->image_url }}" 
                                     alt="{{ $item->title ?? 'Hospital Gallery Image' }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out"
                                     loading="lazy">

                                <!-- Hover Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-4">
                                    <div class="flex justify-end">
                                        <span class="w-9 h-9 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center shadow-lg hover:bg-white/40 transition-colors">
                                            <i class="ri-zoom-in-line text-lg"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="inline-block px-2.5 py-1 bg-sky-500/80 backdrop-blur-md text-white text-[10px] font-bold rounded-md uppercase tracking-wider mb-1">
                                            Facility View
                                        </span>
                                        <h3 class="text-white font-bold text-sm line-clamp-1">
                                            {{ $item->title ?? 'Hospital Facility' }}
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="p-4 bg-white flex items-center justify-between gap-2 border-t border-slate-100">
                                <span class="text-xs font-semibold text-slate-800 line-clamp-1">
                                    {{ $item->title ?? 'Advance Ortho & Spine Facility' }}
                                </span>
                                <button type="button" 
                                        @click="openLightbox({{ $index }}, '{{ $item->image_url }}', '{{ addslashes($item->title ?? 'Hospital Photo') }}')"
                                        class="text-xs font-bold text-sky-600 hover:text-sky-700 transition-colors flex items-center gap-1 shrink-0">
                                    <span>Expand</span>
                                    <i class="ri-external-link-line"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- PAGINATION LINKS -->
                <div class="pt-6">
                    {{ $galleries->links() }}
                </div>

            @else
                <!-- CURATED SAMPLE FACILITY GALLERY SHOWCASE (Fallback when no DB items uploaded yet) -->
                <div class="space-y-6">
                    <div class="bg-sky-50 border border-sky-200 rounded-2xl p-4 sm:p-5 flex items-center gap-4 text-sky-950">
                        <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center shrink-0 font-bold">
                            <i class="ri-information-line text-xl"></i>
                        </div>
                        <div class="text-xs sm:text-sm">
                            <span class="font-bold text-sky-900">Hospital Facility Showcase:</span> Below are glimpses of our core departments and infrastructure. New clinical event photos will appear here as uploaded by the hospital administration.
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Sample Item 1 -->
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300">
                            <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden cursor-pointer"
                                 @click="openLightbox(0, 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80', 'Advanced Joint Replacement Operating Suite')">
                                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80" 
                                     alt="Joint Replacement Operating Suite" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-0 group-hover:opacity-100 transition-opacity p-4 flex items-end justify-between">
                                    <span class="text-white font-bold text-sm">Advanced Operating Suite</span>
                                    <i class="ri-zoom-in-line text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="p-4 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-900">Modern Joint Replacement Theatre</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Ultra-clean laminar airflow OT designed for zero-infection joint replacements.</p>
                            </div>
                        </div>

                        <!-- Sample Item 2 -->
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300">
                            <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden cursor-pointer"
                                 @click="openLightbox(1, 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=1200&q=80', 'Advanced ICU & Critical Care Unit')">
                                <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=800&q=80" 
                                     alt="ICU & Critical Care Unit" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-0 group-hover:opacity-100 transition-opacity p-4 flex items-end justify-between">
                                    <span class="text-white font-bold text-sm">Advanced ICU & Critical Care</span>
                                    <i class="ri-zoom-in-line text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="p-4 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-900">Dedicated Ortho-Spine ICU</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">24/7 continuous cardiac, hemodynamic, and neurological monitoring.</p>
                            </div>
                        </div>

                        <!-- Sample Item 3 -->
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300">
                            <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden cursor-pointer"
                                 @click="openLightbox(2, 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80', 'Endoscopic Spine Surgery Suite')">
                                <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80" 
                                     alt="Endoscopic Spine Suite" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-0 group-hover:opacity-100 transition-opacity p-4 flex items-end justify-between">
                                    <span class="text-white font-bold text-sm">Keyhole Spine Surgery Suite</span>
                                    <i class="ri-zoom-in-line text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="p-4 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-900">Endoscopic Spine Theatre</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Equipped with 4K Karl Storz ultra-HD spine endoscopes.</p>
                            </div>
                        </div>

                        <!-- Sample Item 4 -->
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300">
                            <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden cursor-pointer"
                                 @click="openLightbox(3, 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80', 'Modern Physiotherapy & Rehab Center')">
                                <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80" 
                                     alt="Physiotherapy Center" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-0 group-hover:opacity-100 transition-opacity p-4 flex items-end justify-between">
                                    <span class="text-white font-bold text-sm">Physiotherapy & Rehab Center</span>
                                    <i class="ri-zoom-in-line text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="p-4 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-900">Physiotherapy & Hydrotherapy Center</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">State-of-the-art gait training, electrotherapy, and sports recovery equipment.</p>
                            </div>
                        </div>

                        <!-- Sample Item 5 -->
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300">
                            <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden cursor-pointer"
                                 @click="openLightbox(4, 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=80', 'Deluxe Patient Suite')">
                                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=800&q=80" 
                                     alt="Deluxe Patient Room" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-0 group-hover:opacity-100 transition-opacity p-4 flex items-end justify-between">
                                    <span class="text-white font-bold text-sm">Deluxe Patient Suite</span>
                                    <i class="ri-zoom-in-line text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="p-4 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-900">Private Inpatient Patient Suite</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Comfortable private rooms with nurse call buttons and motorized beds.</p>
                            </div>
                        </div>

                        <!-- Sample Item 6 -->
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300">
                            <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden cursor-pointer"
                                 @click="openLightbox(5, 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80', '24/7 Trauma Emergency Reception')">
                                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80" 
                                     alt="Trauma Emergency Room" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-0 group-hover:opacity-100 transition-opacity p-4 flex items-end justify-between">
                                    <span class="text-white font-bold text-sm">24/7 Emergency Triage</span>
                                    <i class="ri-zoom-in-line text-white text-lg"></i>
                                </div>
                            </div>
                            <div class="p-4 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-900">24/7 Trauma Emergency Desk</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Immediate triage with dedicated orthopedic emergency response team.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- FULLSCREEN LIGHTBOX MODAL (ALPINE.JS) -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/90 backdrop-blur-md p-4 sm:p-6">

        <!-- Close Button -->
        <button type="button" 
                @click="isOpen = false" 
                class="absolute top-4 right-4 sm:top-6 sm:right-6 w-11 h-11 rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors flex items-center justify-center z-50">
            <i class="ri-close-line text-2xl"></i>
        </button>

        <!-- Navigation Buttons -->
        <template x-if="images.length > 1">
            <div class="contents">
                <button type="button" 
                        @click="prevImage()" 
                        class="absolute left-4 sm:left-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors flex items-center justify-center z-50">
                    <i class="ri-arrow-left-s-line text-2xl"></i>
                </button>
                <button type="button" 
                        @click="nextImage()" 
                        class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors flex items-center justify-center z-50">
                    <i class="ri-arrow-right-s-line text-2xl"></i>
                </button>
            </div>
        </template>

        <!-- Lightbox Content Container -->
        <div class="relative max-w-5xl w-full max-h-[85vh] flex flex-col items-center justify-center" @click.outside="isOpen = false">
            <img :src="activeImage" 
                 :alt="activeTitle" 
                 class="max-h-[75vh] w-auto max-w-full object-contain rounded-xl shadow-2xl border border-white/10">

            <div class="mt-4 text-center space-y-1">
                <h4 x-text="activeTitle" class="text-white font-bold text-base sm:text-lg"></h4>
                <div x-show="images.length > 0" class="text-xs text-slate-400 font-medium">
                    Image <span x-text="currentIndex + 1"></span> of <span x-text="images.length"></span>
                </div>
            </div>
        </div>
    </div>

</div>
@section('title', 'Hospital Photo Gallery & Infrastructure | Advance Orthopaedic & Spine Center')
@section('meta_description', 'Explore our photo gallery featuring ultra-clean modular operation theaters, advanced ICU units, private suites, and patient care facilities.')
@section('meta_keywords', 'hospital gallery, modular OT, ICU facility, orthopaedic hospital photos')

<div class="min-h-screen bg-slate-50/60 pb-20"
     x-data="{ 
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
    }" 
    @keydown.escape.window="isOpen = false" 
    @keydown.right.window="if(isOpen) nextImage()" 
    @keydown.left.window="if(isOpen) prevImage()">

    <!-- Hero Banner Header (Matching Service, Blog & Contact Pages) -->
    <div class="relative bg-gradient-to-br from-slate-950 via-[#0a2f3c] to-slate-950 text-white overflow-hidden py-16 sm:py-20 border-b border-slate-800">
        <!-- Ambient Grid Pattern & Radial Glows -->
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#0d9488_1px,transparent_1px),linear-gradient(to_bottom,#0d9488_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-[#114b5f]/30 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-[#3b774b]/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-12 relative z-10 text-center space-y-5">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#114b5f]/40 text-teal-300 border border-teal-400/30 tracking-wider uppercase shadow-inner">
                <i class="ri-camera-lens-fill text-teal-300"></i> World-Class Infrastructure & Facility Showcase
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold tracking-tight max-w-4xl mx-auto leading-tight text-white">
                Hospital Photo <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-200 via-emerald-300 to-teal-100">Gallery</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Take a visual tour of Advance Orthopaedic & Spine Center. Experience our state-of-the-art modular surgical suites, advanced ICU care, hydrotherapy center, and luxury patient suites.
            </p>
        </div>
    </div>

    <!-- Main Full-Width Responsive Container (Matching Service & Blog Layout) -->
    <div class="max-w-[1440px] mx-auto px-4 sm:px-8 lg:px-12 py-10 sm:py-14 space-y-10">

        @if($galleries->count() > 0)
            <!-- PHOTO GRID (Matching Services Cards Grid Layout) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($galleries as $index => $item)
                    <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(17,75,95,0.08)] hover:border-[#114b5f]/40 transition-all duration-300 group relative">
                        
                        <!-- Image Banner with Overlay Badge & Lightbox Action -->
                        <div class="aspect-16/9 bg-slate-100 relative overflow-hidden cursor-pointer"
                             @click="openLightbox({{ $index }}, '{{ $item->image_url }}', '{{ addslashes($item->title ?? 'Hospital Photo') }}')">
                            <img src="{{ $item->image_url }}" 
                                 alt="{{ $item->title ?? 'Hospital Gallery Image' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" 
                                 loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-3 left-3 z-10 flex items-center gap-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                    Facility View
                                </span>
                            </div>

                            <div class="absolute top-3 right-3 z-10">
                                <span class="w-8 h-8 rounded-full bg-slate-950/60 backdrop-blur-md text-white flex items-center justify-center shadow-md group-hover:bg-[#114b5f] transition-colors">
                                    <i class="ri-zoom-in-line text-sm"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Content Body -->
                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors duration-200 leading-snug cursor-pointer"
                                    @click="openLightbox({{ $index }}, '{{ $item->image_url }}', '{{ addslashes($item->title ?? 'Hospital Photo') }}')">
                                    {{ $item->title ?? 'Advance Ortho & Spine Facility' }}
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    State-of-the-art medical infrastructure and clinical care wing.
                                </p>
                            </div>

                            <!-- Footer Action Button -->
                            <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between mt-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Hospital Infrastructure</span>
                                <button type="button" 
                                        @click="openLightbox({{ $index }}, '{{ $item->image_url }}', '{{ addslashes($item->title ?? 'Hospital Photo') }}')"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors group/link cursor-pointer">
                                    <span>Expand Photo</span>
                                    <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- PAGINATION LINKS -->
            @if($galleries->hasPages())
                <div class="pt-8 border-t border-slate-200/80">
                    {{ $galleries->links() }}
                </div>
            @endif

        @else
            <!-- CURATED SAMPLE FACILITY GALLERY SHOWCASE (Matching Services Cards Grid Layout) -->
            <div class="space-y-6">
                <div class="bg-teal-50 border border-teal-200/80 rounded-2xl p-4 sm:p-5 flex items-center gap-4 text-slate-800">
                    <div class="w-10 h-10 rounded-xl bg-[#114b5f] text-white flex items-center justify-center shrink-0 font-bold">
                        <i class="ri-information-line text-lg"></i>
                    </div>
                    <p class="text-xs leading-relaxed font-medium">
                        <span class="font-bold text-[#114b5f]">Hospital Facility Showcase:</span> Below are glimpses of our core departments and infrastructure. New clinical event photos will appear here as uploaded by the hospital administration.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Sample 1 -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(17,75,95,0.08)] hover:border-[#114b5f]/40 transition-all duration-300 group relative">
                        <div class="aspect-16/9 bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openLightbox(0, 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80', 'Advanced Joint Replacement Operating Suite')">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80" 
                                 alt="Joint Replacement Operating Suite" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-3 left-3 z-10">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                    Surgical OT
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 z-10">
                                <span class="w-8 h-8 rounded-full bg-slate-950/60 backdrop-blur-md text-white flex items-center justify-center shadow-md group-hover:bg-[#114b5f] transition-colors">
                                    <i class="ri-zoom-in-line text-sm"></i>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors leading-snug">
                                    Modern Joint Replacement Theatre
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    Ultra-clean laminar airflow OT designed for zero-infection joint replacements.
                                </p>
                            </div>

                            <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between mt-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Infrastructure</span>
                                <button type="button" 
                                        @click="openLightbox(0, 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80', 'Advanced Joint Replacement Operating Suite')"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors group/link cursor-pointer">
                                    <span>Expand Photo</span>
                                    <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sample 2 -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(17,75,95,0.08)] hover:border-[#114b5f]/40 transition-all duration-300 group relative">
                        <div class="aspect-16/9 bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openLightbox(1, 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=1200&q=80', 'Advanced ICU & Critical Care Unit')">
                            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=800&q=80" 
                                 alt="ICU & Critical Care Unit" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-3 left-3 z-10">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                    Critical Care
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 z-10">
                                <span class="w-8 h-8 rounded-full bg-slate-950/60 backdrop-blur-md text-white flex items-center justify-center shadow-md group-hover:bg-[#114b5f] transition-colors">
                                    <i class="ri-zoom-in-line text-sm"></i>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors leading-snug">
                                    Dedicated Ortho-Spine ICU
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    24/7 continuous cardiac, hemodynamic, and neurological monitoring.
                                </p>
                            </div>

                            <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between mt-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Infrastructure</span>
                                <button type="button" 
                                        @click="openLightbox(1, 'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=1200&q=80', 'Advanced ICU & Critical Care Unit')"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors group/link cursor-pointer">
                                    <span>Expand Photo</span>
                                    <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sample 3 -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(17,75,95,0.08)] hover:border-[#114b5f]/40 transition-all duration-300 group relative">
                        <div class="aspect-16/9 bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openLightbox(2, 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80', 'Endoscopic Spine Surgery Suite')">
                            <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80" 
                                 alt="Endoscopic Spine Suite" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-3 left-3 z-10">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                    Keyhole Spine
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 z-10">
                                <span class="w-8 h-8 rounded-full bg-slate-950/60 backdrop-blur-md text-white flex items-center justify-center shadow-md group-hover:bg-[#114b5f] transition-colors">
                                    <i class="ri-zoom-in-line text-sm"></i>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors leading-snug">
                                    Endoscopic Spine Theatre
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    Equipped with 4K Karl Storz ultra-HD spine endoscopes for keyhole procedures.
                                </p>
                            </div>

                            <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between mt-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Infrastructure</span>
                                <button type="button" 
                                        @click="openLightbox(2, 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80', 'Endoscopic Spine Surgery Suite')"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors group/link cursor-pointer">
                                    <span>Expand Photo</span>
                                    <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sample 4 -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(17,75,95,0.08)] hover:border-[#114b5f]/40 transition-all duration-300 group relative">
                        <div class="aspect-16/9 bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openLightbox(3, 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80', 'Modern Physiotherapy & Rehab Center')">
                            <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80" 
                                 alt="Physiotherapy Center" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-3 left-3 z-10">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                    Rehabilitation
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 z-10">
                                <span class="w-8 h-8 rounded-full bg-slate-950/60 backdrop-blur-md text-white flex items-center justify-center shadow-md group-hover:bg-[#114b5f] transition-colors">
                                    <i class="ri-zoom-in-line text-sm"></i>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors leading-snug">
                                    Physiotherapy & Hydrotherapy Center
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    State-of-the-art gait training, electrotherapy, and sports recovery equipment.
                                </p>
                            </div>

                            <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between mt-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Infrastructure</span>
                                <button type="button" 
                                        @click="openLightbox(3, 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80', 'Modern Physiotherapy & Rehab Center')"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors group/link cursor-pointer">
                                    <span>Expand Photo</span>
                                    <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sample 5 -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(17,75,95,0.08)] hover:border-[#114b5f]/40 transition-all duration-300 group relative">
                        <div class="aspect-16/9 bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openLightbox(4, 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=80', 'Deluxe Patient Suite')">
                            <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=800&q=80" 
                                 alt="Deluxe Patient Room" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-3 left-3 z-10">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                    Inpatient Suites
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 z-10">
                                <span class="w-8 h-8 rounded-full bg-slate-950/60 backdrop-blur-md text-white flex items-center justify-center shadow-md group-hover:bg-[#114b5f] transition-colors">
                                    <i class="ri-zoom-in-line text-sm"></i>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors leading-snug">
                                    Private Inpatient Patient Suite
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    Comfortable private rooms with nurse call buttons and motorized beds.
                                </p>
                            </div>

                            <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between mt-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Infrastructure</span>
                                <button type="button" 
                                        @click="openLightbox(4, 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1200&q=80', 'Deluxe Patient Suite')"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors group/link cursor-pointer">
                                    <span>Expand Photo</span>
                                    <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sample 6 -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_16px_32px_rgba(17,75,95,0.08)] hover:border-[#114b5f]/40 transition-all duration-300 group relative">
                        <div class="aspect-16/9 bg-slate-900 relative overflow-hidden cursor-pointer"
                             @click="openLightbox(5, 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80', '24/7 Trauma Emergency Reception')">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80" 
                                 alt="Trauma Emergency Room" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-3 left-3 z-10">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-white/90 backdrop-blur-md text-slate-800 shadow-sm">
                                    Emergency Wing
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 z-10">
                                <span class="w-8 h-8 rounded-full bg-slate-950/60 backdrop-blur-md text-white flex items-center justify-center shadow-md group-hover:bg-[#114b5f] transition-colors">
                                    <i class="ri-zoom-in-line text-sm"></i>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 flex-1 flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 group-hover:text-[#114b5f] transition-colors leading-snug">
                                    24/7 Trauma Emergency Desk
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    Immediate triage with dedicated orthopedic emergency response team.
                                </p>
                            </div>

                            <div class="pt-4 shrink-0 border-t border-slate-100 flex items-center justify-between mt-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Infrastructure</span>
                                <button type="button" 
                                        @click="openLightbox(5, 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80', '24/7 Trauma Emergency Reception')"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[#114b5f] hover:text-[#0d3b4b] transition-colors group/link cursor-pointer">
                                    <span>Expand Photo</span>
                                    <i class="ri-arrow-right-line group-hover/link:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- FULL RESPONSIVE MEDICAL CONSULTATION BANNER (Identical to Service & Blog Pages) -->
        <div class="bg-gradient-to-br from-slate-950 via-[#0a2f3c] to-slate-950 border border-[#114b5f]/40 rounded-3xl p-6 sm:p-10 shadow-xl text-white relative overflow-hidden mt-12">
            <div class="absolute -top-32 -right-32 w-80 h-80 rounded-full bg-[#114b5f]/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-[#3b774b]/10 blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="space-y-2 text-center md:text-left max-w-xl">
                    <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-teal-500/20 text-teal-300 border border-teal-500/30 rounded-lg">
                        Clinical Consultation
                    </span>
                    <h3 class="font-heading font-extrabold text-xl sm:text-2xl text-white">Need Clinical Guidance on Joint or Spine Care?</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Book an evaluation with our chief spine and joint reconstructive surgical faculty at Advance Orthopaedic & Spine Center.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0 w-full sm:w-auto">
                    <a href="{{ route('home') }}#booking" class="w-full sm:w-auto px-5 py-2.5 sm:py-3 bg-[#114b5f] hover:bg-[#0d3b4b] text-white font-bold text-xs rounded-xl shadow-md shadow-[#114b5f]/20 active:scale-[0.99] transition-all cursor-pointer inline-flex items-center justify-center gap-2">
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
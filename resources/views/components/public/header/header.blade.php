<!-- CLEAN & PROFESSIONAL HEADER COMPONENT -->
<div x-data="{ mobileMenuOpen: false, servicesOpen: false, mobileServicesOpen: false }" @keydown.escape.window="mobileMenuOpen = false">
    <!-- Top Contact Bar -->
    <div class="bg-slate-900 text-slate-300 text-xs py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-4">
                <span>JCI & NABH Accredited Center</span>
                <span class="text-slate-700">|</span>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', setting('phone_number', '1-800-678-4677')) }}" class="text-emerald-400 font-bold hover:underline">
                    24/7 Emergency Helpline: {{ setting('phone_number', '1-800-678-4677') }}
                </a>
            </div>
            <div class="hidden sm:flex items-center gap-4 text-slate-400">
                @if(setting('whatsapp_number'))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}" target="_blank" class="text-emerald-400 font-semibold hover:underline flex items-center gap-1">
                        <i class="ri-whatsapp-line text-sm"></i> WhatsApp Us
                    </a>
                    <span class="text-slate-700">|</span>
                @endif
                <a href="{{ route('home') }}#booking" wire:navigate class="hover:text-white transition-colors">Book Appointment</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="bg-white py-4 border-b border-slate-200/90 relative z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-sky-600 group-hover:bg-sky-700 transition-colors flex items-center justify-center text-white font-bold text-xl shadow-sm">
                    <i class="ri-heart-pulse-line"></i>
                </div>
                <div>
                    <div class="flex items-baseline gap-1">
                        <span class="font-extrabold text-xl text-slate-900 tracking-tight">{{ setting('hospital_name', 'Advance Ortho & Spine Center') }}</span>
                    </div>
                    <p class="text-[11px] text-slate-500 font-medium tracking-wide">Orthopaedic & Spine Specialty Center</p>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-700">
                <a href="{{ route('home') }}" wire:navigate class="hover:text-sky-600 transition-colors py-1 {{ request()->routeIs('home') ? 'text-sky-600 font-bold border-b-2 border-sky-600' : '' }}">Home</a>
                
                <!-- Services Dropdown with Sub-Menu -->
                <div class="relative" @mouseleave="servicesOpen = false">
                    <button @click="servicesOpen = !servicesOpen" 
                            @mouseenter="servicesOpen = true" 
                            type="button"
                            class="flex items-center gap-1.5 hover:text-sky-600 transition-colors py-1 focus:outline-none {{ request()->routeIs('services*') ? 'text-sky-600 font-bold border-b-2 border-sky-600' : '' }}">
                        <span>Services</span>
                        <i class="ri-arrow-down-s-line text-slate-400 transition-transform duration-200" :class="{ 'rotate-180 text-sky-600': servicesOpen }"></i>
                    </button>

                    <!-- Sub-Menu Dropdown Panel -->
                    <div x-show="servicesOpen" 
                          x-transition:enter="transition ease-out duration-200"
                          x-transition:enter-start="opacity-0 translate-y-2"
                          x-transition:enter-end="opacity-100 translate-y-0"
                          x-transition:leave="transition ease-in duration-150"
                          x-transition:leave-start="opacity-100 translate-y-0"
                          x-transition:leave-end="opacity-0 translate-y-2"
                          @click.outside="servicesOpen = false"
                          x-cloak
                          class="absolute top-full left-0 w-80 bg-white rounded-2xl shadow-xl border border-slate-200/90 p-3 z-50 mt-2 space-y-1">
                        
                        <div class="px-3 py-2 border-b border-slate-100 font-extrabold text-[11px] text-slate-400 uppercase tracking-wider flex items-center justify-between">
                            <span>Surgical Specialties</span>
                            <span class="text-sky-600 bg-sky-50 px-2 py-0.5 rounded-md font-bold">20 Services</span>
                        </div>
                        
                        <div class="py-1 space-y-1">
                            <a href="{{ route('services.view', 'trauma-and-accident-care') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-slate-100 text-sky-600 flex items-center justify-center shrink-0">
                                    <i class="ri-first-aid-kit-line text-sm"></i>
                                </div>
                                <span>Trauma & Accident Care</span>
                            </a>
                            <a href="{{ route('services.view', 'endoscopic-spine-surgery') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-slate-100 text-sky-600 flex items-center justify-center shrink-0">
                                    <i class="ri-health-book-line text-sm"></i>
                                </div>
                                <span>Endoscopic Spine Surgery</span>
                            </a>
                            <a href="{{ route('services.view', 'knee-replacement-surgery') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-slate-100 text-sky-600 flex items-center justify-center shrink-0">
                                    <i class="ri-pulse-line text-sm"></i>
                                </div>
                                <span>Knee & Hip Replacement</span>
                            </a>
                            <a href="{{ route('services.view', 'sports-injury-treatment') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-slate-100 text-sky-600 flex items-center justify-center shrink-0">
                                    <i class="ri-run-line text-sm"></i>
                                </div>
                                <span>Sports Injury & Arthroscopy</span>
                            </a>
                            <a href="{{ route('services.view', 'physiotherapy-and-rehabilitation') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-slate-100 text-sky-600 flex items-center justify-center shrink-0">
                                    <i class="ri-body-scan-line text-sm"></i>
                                </div>
                                <span>Physiotherapy & Rehabilitation</span>
                            </a>
                        </div>

                        <div class="pt-2 border-t border-slate-100">
                            <a href="{{ route('services') }}" wire:navigate @click="servicesOpen = false" class="flex items-center justify-between px-3 py-2 text-xs font-bold text-sky-600 hover:bg-sky-50 rounded-xl transition-colors">
                                <span>View All 20 Services</span>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('gallery') }}" wire:navigate class="hover:text-sky-600 transition-colors py-1 {{ request()->routeIs('gallery') ? 'text-sky-600 font-bold border-b-2 border-sky-600' : '' }}">Gallery</a>
                <a href="{{ route('blog') }}" wire:navigate class="hover:text-sky-600 transition-colors py-1 {{ request()->routeIs('blog*') ? 'text-sky-600 font-bold border-b-2 border-sky-600' : '' }}">Blog</a>
                <a href="{{ route('contact') }}" wire:navigate class="hover:text-sky-600 transition-colors py-1 {{ request()->routeIs('contact') ? 'text-sky-600 font-bold border-b-2 border-sky-600' : '' }}">Contact</a>
            </nav>

            <!-- CTA & Mobile Trigger Button -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}#booking" wire:navigate class="hidden sm:inline-block px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs rounded-xl transition-colors shadow-sm">
                    Book Appointment
                </a>

                <!-- Mobile Hamburger Button -->
                <button @click="mobileMenuOpen = true" 
                        type="button"
                        aria-label="Open Navigation Menu"
                        class="lg:hidden p-2 text-slate-700 hover:bg-slate-100 rounded-xl transition-colors focus:outline-none">
                    <i class="ri-menu-3-line text-2xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- FULL-PAGE MOBILE NAVIGATION MENU OVERLAY -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 z-50 bg-slate-950/95 backdrop-blur-2xl flex flex-col justify-between lg:hidden overflow-hidden">
        
        <!-- Mobile Header Bar -->
        <div class="px-6 py-5 border-b border-slate-800/80 flex items-center justify-between shrink-0">
            <a href="{{ route('home') }}" wire:navigate @click="mobileMenuOpen = false" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-500 to-cyan-400 p-0.5 shadow-lg">
                    <div class="w-full h-full bg-slate-950 rounded-[10px] flex items-center justify-center text-sky-400 font-bold text-xl">
                        <i class="ri-heart-pulse-fill"></i>
                    </div>
                </div>
                <div>
                    <span class="font-extrabold text-base text-white tracking-tight">{{ setting('hospital_name', 'Advance Ortho & Spine') }}</span>
                    <p class="text-[10px] text-sky-400 font-semibold tracking-wider uppercase">Navigation Menu</p>
                </div>
            </a>

            <!-- Close Button -->
            <button @click="mobileMenuOpen = false" 
                    type="button"
                    aria-label="Close Navigation Menu"
                    class="w-10 h-10 rounded-full bg-slate-800 text-slate-300 hover:text-white hover:bg-slate-700 flex items-center justify-center transition-colors focus:outline-none">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>

        <!-- Scrollable Navigation Links -->
        <div class="flex-1 overflow-y-auto px-6 py-6 space-y-3">
            
            <!-- Home Link -->
            <a href="{{ route('home') }}" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-base font-bold transition-all duration-200 {{ request()->routeIs('home') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-200 hover:bg-slate-900 hover:text-sky-400 border border-slate-800/50' }}">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center {{ request()->routeIs('home') ? 'bg-white/20' : 'bg-slate-900 text-sky-400' }}">
                    <i class="ri-home-4-line text-xl"></i>
                </div>
                <span>Home</span>
            </a>

            <!-- Services Accordion Sub-Menu on Mobile -->
            <div class="rounded-2xl border border-slate-800/50 overflow-hidden bg-slate-900/40">
                <button type="button" 
                        @click="mobileServicesOpen = !mobileServicesOpen" 
                        class="w-full flex items-center justify-between px-4 py-3.5 text-base font-bold text-slate-200 hover:text-sky-400 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-9 h-9 rounded-xl bg-slate-900 text-sky-400 flex items-center justify-center">
                            <i class="ri-stethoscope-line text-xl"></i>
                        </div>
                        <span>Services & Specialties</span>
                    </div>
                    <i class="ri-arrow-down-s-line text-slate-400 text-xl transition-transform duration-200" :class="{ 'rotate-180 text-sky-400': mobileServicesOpen }"></i>
                </button>

                <!-- Collapsible Sub-Menu List -->
                <div x-show="mobileServicesOpen" x-transition x-cloak class="px-4 pb-4 space-y-2 border-t border-slate-800/60 pt-3">
                    <a href="{{ route('services') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 text-xs font-bold text-sky-400 bg-sky-500/10 border border-sky-500/20 rounded-xl">
                        View All 20 Services →
                    </a>
                    <a href="{{ route('services.view', 'trauma-and-accident-care') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-300 hover:text-white hover:bg-slate-800/80 rounded-xl transition-colors">
                        • Trauma & Accident Care
                    </a>
                    <a href="{{ route('services.view', 'endoscopic-spine-surgery') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-800/80 rounded-xl transition-colors">
                        • Endoscopic Spine Surgery
                    </a>
                    <a href="{{ route('services.view', 'knee-replacement-surgery') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-800/80 rounded-xl transition-colors">
                        • Knee & Hip Replacement
                    </a>
                    <a href="{{ route('services.view', 'sports-injury-treatment') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-800/80 rounded-xl transition-colors">
                        • Sports Injury & Arthroscopy
                    </a>
                    <a href="{{ route('services.view', 'physiotherapy-and-rehabilitation') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-800/80 rounded-xl transition-colors">
                        • Physiotherapy & Rehabilitation
                    </a>
                </div>
            </div>

            <!-- Gallery Link -->
            <a href="{{ route('gallery') }}" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-base font-bold transition-all duration-200 {{ request()->routeIs('gallery') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-200 hover:bg-slate-900 hover:text-sky-400 border border-slate-800/50' }}">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center {{ request()->routeIs('gallery') ? 'bg-white/20' : 'bg-slate-900 text-sky-400' }}">
                    <i class="ri-gallery-line text-xl"></i>
                </div>
                <span>Hospital Gallery</span>
            </a>

            <!-- Blog Link -->
            <a href="{{ route('blog') }}" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-base font-bold transition-all duration-200 {{ request()->routeIs('blog*') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-200 hover:bg-slate-900 hover:text-sky-400 border border-slate-800/50' }}">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center {{ request()->routeIs('blog*') ? 'bg-white/20' : 'bg-slate-900 text-sky-400' }}">
                    <i class="ri-article-line text-xl"></i>
                </div>
                <span>Medical Blog</span>
            </a>

            <!-- Contact Link -->
            <a href="{{ route('contact') }}" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="flex items-center gap-4 px-4 py-3.5 rounded-2xl text-base font-bold transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/30' : 'text-slate-200 hover:bg-slate-900 hover:text-sky-400 border border-slate-800/50' }}">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center {{ request()->routeIs('contact') ? 'bg-white/20' : 'bg-slate-900 text-sky-400' }}">
                    <i class="ri-contacts-line text-xl"></i>
                </div>
                <span>Contact Us</span>
            </a>

        </div>

        <!-- Bottom Action CTA Buttons -->
        <div class="px-6 py-6 border-t border-slate-800/80 space-y-3 bg-slate-950 shrink-0">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', setting('phone_number', '1-800-678-4677')) }}" 
               class="w-full flex items-center justify-center gap-2 py-3 px-4 bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-2xl font-bold text-xs transition-colors">
                <i class="ri-phone-fill text-base"></i>
                <span>24/7 Helpline: {{ setting('phone_number', '1-800-678-4677') }}</span>
            </a>

            <a href="{{ route('home') }}#booking" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="w-full flex items-center justify-center gap-2 py-3.5 px-4 bg-gradient-to-r from-sky-500 to-cyan-500 hover:from-sky-600 hover:to-cyan-600 text-white font-bold text-sm rounded-2xl shadow-xl shadow-sky-500/20 transition-all">
                <i class="ri-calendar-check-line text-lg"></i>
                <span>Book Appointment</span>
            </a>
        </div>

    </div>
</div>
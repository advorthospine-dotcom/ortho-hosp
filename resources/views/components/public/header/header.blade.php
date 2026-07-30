<!-- CLEAN & PROFESSIONAL HEADER COMPONENT -->
<div x-data="{ mobileMenuOpen: false, servicesOpen: false, mobileServicesOpen: false }" @keydown.escape.window="mobileMenuOpen = false">
    <!-- Top Contact Bar (Dark Theme: Left = Phone & Email, Right = 24/7 Open) -->
    <div class="bg-slate-950 text-slate-300 text-xs py-2.5 border-b border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between gap-3">
            
            <!-- Left Side: Phone & Email -->
            <div class="flex items-center gap-4 sm:gap-6">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', setting('phone_number', '1-800-678-4677')) }}" 
                   class="inline-flex items-center gap-1.5 text-white font-bold hover:text-emerald-400 transition-colors">
                    <i class="ri-phone-fill text-emerald-400 text-sm"></i>
                    <span>{{ setting('phone_number', '1-800-678-4677') }}</span>
                </a>

                <span class="text-slate-800">|</span>

                <a href="mailto:{{ setting('email', setting('contact_email', 'care@advanceorthospine.com')) }}" 
                   class="inline-flex items-center gap-1.5 text-slate-300 hover:text-white transition-colors text-[11px] sm:text-xs">
                    <i class="ri-mail-line text-emerald-400 text-sm"></i>
                    <span>{{ setting('email', setting('contact_email', 'care@advanceorthospine.com')) }}</span>
                </a>
            </div>

            <!-- Right Side: 24/7 Open Indicator -->
            <div class="flex items-center gap-2 text-emerald-400 font-extrabold uppercase tracking-wider text-[11px] sm:text-xs">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <i class="ri-time-line text-sm"></i>
                <span>24/7 Emergency & OPD Open</span>
            </div>

        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="bg-white py-4 border-b border-slate-200/90 relative z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" wire:navigate class="flex items-center group">
                <img src="{{ asset('logo.webp') }}" 
                     alt="{{ setting('hospital_name', 'Advance Ortho & Spine Center') }}" 
                     class="h-11 sm:h-13 max-h-14 w-auto object-contain transition-transform group-hover:scale-[1.02]" />
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-700">
                <a href="{{ route('home') }}" wire:navigate class="hover:text-[#114b5f] transition-colors py-1 {{ request()->routeIs('home') ? 'text-[#114b5f] font-extrabold border-b-2 border-[#114b5f]' : '' }}">Home</a>
                
                <!-- Services Dropdown with Sub-Menu -->
                <div class="relative" @mouseleave="servicesOpen = false">
                    <button @click="servicesOpen = !servicesOpen" 
                            @mouseenter="servicesOpen = true" 
                            type="button"
                            class="flex items-center gap-1.5 hover:text-[#114b5f] transition-colors py-1 focus:outline-none {{ request()->routeIs('services*') ? 'text-[#114b5f] font-extrabold border-b-2 border-[#114b5f]' : '' }}">
                        <span>Services</span>
                        <i class="ri-arrow-down-s-line text-slate-400 transition-transform duration-200" :class="{ 'rotate-180 text-[#114b5f]': servicesOpen }"></i>
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
                            <span class="text-[#114b5f] bg-teal-50 px-2 py-0.5 rounded-md font-bold">20 Services</span>
                        </div>
                        
                        <div class="py-1 space-y-1">
                            <a href="{{ route('services.view', 'trauma-and-accident-care') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-teal-50/80 hover:text-[#114b5f] rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#114b5f] flex items-center justify-center shrink-0">
                                    <i class="ri-first-aid-kit-line text-sm"></i>
                                </div>
                                <span>Trauma & Accident Care</span>
                            </a>
                            <a href="{{ route('services.view', 'endoscopic-spine-surgery') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-teal-50/80 hover:text-[#114b5f] rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#114b5f] flex items-center justify-center shrink-0">
                                    <i class="ri-health-book-line text-sm"></i>
                                </div>
                                <span>Endoscopic Spine Surgery</span>
                            </a>
                            <a href="{{ route('services.view', 'knee-replacement-surgery') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-teal-50/80 hover:text-[#114b5f] rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#114b5f] flex items-center justify-center shrink-0">
                                    <i class="ri-pulse-line text-sm"></i>
                                </div>
                                <span>Knee & Hip Replacement</span>
                            </a>
                            <a href="{{ route('services.view', 'sports-injury-treatment') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-teal-50/80 hover:text-[#114b5f] rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#114b5f] flex items-center justify-center shrink-0">
                                    <i class="ri-run-line text-sm"></i>
                                </div>
                                <span>Sports Injury & Arthroscopy</span>
                            </a>
                            <a href="{{ route('services.view', 'physiotherapy-and-rehabilitation') }}" wire:navigate @click="servicesOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-teal-50/80 hover:text-[#114b5f] rounded-xl transition-colors">
                                <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#114b5f] flex items-center justify-center shrink-0">
                                    <i class="ri-body-scan-line text-sm"></i>
                                </div>
                                <span>Physiotherapy & Rehabilitation</span>
                            </a>
                        </div>

                        <div class="pt-2 border-t border-slate-100">
                            <a href="{{ route('services') }}" wire:navigate @click="servicesOpen = false" class="flex items-center justify-between px-3 py-2 text-xs font-bold text-[#114b5f] hover:bg-teal-50 rounded-xl transition-colors">
                                <span>View All 20 Services</span>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('gallery') }}" wire:navigate class="hover:text-[#114b5f] transition-colors py-1 {{ request()->routeIs('gallery') ? 'text-[#114b5f] font-extrabold border-b-2 border-[#114b5f]' : '' }}">Gallery</a>
                <a href="{{ route('blog') }}" wire:navigate class="hover:text-[#114b5f] transition-colors py-1 {{ request()->routeIs('blog*') ? 'text-[#114b5f] font-extrabold border-b-2 border-[#114b5f]' : '' }}">Blog</a>
                <a href="{{ route('contact') }}" wire:navigate class="hover:text-[#114b5f] transition-colors py-1 {{ request()->routeIs('contact') ? 'text-[#114b5f] font-extrabold border-b-2 border-[#114b5f]' : '' }}">Contact</a>
            </nav>

            <!-- CTA & Mobile Trigger Button -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}#booking" wire:navigate class="hidden sm:inline-block px-5 py-2.5 bg-[#114b5f] hover:bg-[#0e3d4e] text-white font-bold text-xs rounded-xl transition-all shadow-md shadow-[#114b5f]/20">
                    Book Appointment
                </a>

                <!-- Mobile Hamburger Menu Button -->
                <button @click="mobileMenuOpen = true" 
                        type="button" 
                        aria-label="Open Navigation Menu"
                        class="lg:hidden p-2.5 rounded-xl bg-slate-100 text-slate-700 hover:text-[#114b5f] hover:bg-teal-50 transition-colors focus:outline-none border border-slate-200">
                    <i class="ri-menu-3-line text-xl"></i>
                </button>
            </div>

        </div>
    </header>

    <!-- MOBILE OVERLAY NAVIGATION DRAWER (Pristine Light Theme - Soft Active Tint) -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 z-50 bg-white flex flex-col justify-between lg:hidden overflow-hidden text-slate-800">
        
        <!-- Mobile Header Bar -->
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between shrink-0 bg-white">
            <a href="{{ route('home') }}" wire:navigate @click="mobileMenuOpen = false" class="flex items-center">
                <img src="{{ asset('logo.webp') }}" 
                     alt="{{ setting('hospital_name', 'Advance Ortho & Spine Center') }}" 
                     class="h-9 sm:h-11 w-auto object-contain" />
            </a>

            <!-- Close Button -->
            <button @click="mobileMenuOpen = false" 
                    type="button"
                    aria-label="Close Navigation Menu"
                    class="w-9 h-9 rounded-full bg-slate-100 text-slate-500 hover:text-slate-900 hover:bg-slate-200 flex items-center justify-center transition-colors focus:outline-none border border-slate-200">
                <i class="ri-close-line text-xl"></i>
            </button>
        </div>

        <!-- Scrollable Navigation Links -->
        <div class="flex-1 overflow-y-auto px-5 py-6 space-y-2">
            
            <!-- Home Link -->
            <a href="{{ route('home') }}" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('home') ? 'bg-teal-50 text-[#114b5f] border border-teal-200/80 font-extrabold shadow-2xs' : 'text-slate-700 hover:bg-slate-50 hover:text-[#114b5f]' }}">
                <i class="ri-home-4-line text-lg {{ request()->routeIs('home') ? 'text-[#114b5f]' : 'text-slate-400' }}"></i>
                <span>Home</span>
            </a>

            <!-- Services Accordion Sub-Menu on Mobile -->
            <div class="rounded-xl border border-slate-200/80 overflow-hidden bg-slate-50/50">
                <button type="button" 
                        @click="mobileServicesOpen = !mobileServicesOpen" 
                        class="w-full flex items-center justify-between px-4 py-3 text-sm font-semibold text-slate-700 hover:text-[#114b5f] transition-colors">
                    <div class="flex items-center gap-3.5">
                        <i class="ri-stethoscope-line text-lg text-slate-400"></i>
                        <span>Services & Specialties</span>
                    </div>
                    <i class="ri-arrow-down-s-line text-slate-400 text-lg transition-transform duration-200" :class="{ 'rotate-180 text-[#114b5f]': mobileServicesOpen }"></i>
                </button>

                <!-- Collapsible Sub-Menu List -->
                <div x-show="mobileServicesOpen" x-transition x-cloak class="px-3 pb-3 space-y-1 border-t border-slate-200/60 pt-2 text-xs">
                    <a href="{{ route('services') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 font-extrabold text-[#114b5f] bg-teal-50 border border-teal-200/80 rounded-lg">
                        View All 20 Services →
                    </a>
                    <a href="{{ route('services.view', 'trauma-and-accident-care') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 font-medium text-slate-600 hover:text-[#114b5f] hover:bg-white rounded-lg transition-colors">
                        • Trauma & Accident Care
                    </a>
                    <a href="{{ route('services.view', 'endoscopic-spine-surgery') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 font-medium text-slate-600 hover:text-[#114b5f] hover:bg-white rounded-lg transition-colors">
                        • Endoscopic Spine Surgery
                    </a>
                    <a href="{{ route('services.view', 'knee-replacement-surgery') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 font-medium text-slate-600 hover:text-[#114b5f] hover:bg-white rounded-lg transition-colors">
                        • Knee & Hip Replacement
                    </a>
                    <a href="{{ route('services.view', 'sports-injury-treatment') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 font-medium text-slate-600 hover:text-[#114b5f] hover:bg-white rounded-lg transition-colors">
                        • Sports Injury & Arthroscopy
                    </a>
                    <a href="{{ route('services.view', 'physiotherapy-and-rehabilitation') }}" wire:navigate @click="mobileMenuOpen = false" class="block px-3 py-2 font-medium text-slate-600 hover:text-[#114b5f] hover:bg-white rounded-lg transition-colors">
                        • Physiotherapy & Rehabilitation
                    </a>
                </div>
            </div>

            <!-- Gallery Link -->
            <a href="{{ route('gallery') }}" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('gallery') ? 'bg-teal-50 text-[#114b5f] border border-teal-200/80 font-extrabold shadow-2xs' : 'text-slate-700 hover:bg-slate-50 hover:text-[#114b5f]' }}">
                <i class="ri-gallery-line text-lg {{ request()->routeIs('gallery') ? 'text-[#114b5f]' : 'text-slate-400' }}"></i>
                <span>Hospital Gallery</span>
            </a>

            <!-- Blog Link -->
            <a href="{{ route('blog') }}" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('blog*') ? 'bg-teal-50 text-[#114b5f] border border-teal-200/80 font-extrabold shadow-2xs' : 'text-slate-700 hover:bg-slate-50 hover:text-[#114b5f]' }}">
                <i class="ri-article-line text-lg {{ request()->routeIs('blog*') ? 'text-[#114b5f]' : 'text-slate-400' }}"></i>
                <span>Medical Blog</span>
            </a>

            <!-- Contact Link -->
            <a href="{{ route('contact') }}" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('contact') ? 'bg-teal-50 text-[#114b5f] border border-teal-200/80 font-extrabold shadow-2xs' : 'text-slate-700 hover:bg-slate-50 hover:text-[#114b5f]' }}">
                <i class="ri-contacts-line text-lg {{ request()->routeIs('contact') ? 'text-[#114b5f]' : 'text-slate-400' }}"></i>
                <span>Contact Us</span>
            </a>

        </div>

        <!-- Bottom Action CTA Buttons -->
        <div class="px-5 py-5 border-t border-slate-100 space-y-2.5 bg-slate-50/50 shrink-0">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', setting('phone_number', '1-800-678-4677')) }}" 
               class="w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-emerald-50 text-[#3b774b] border border-emerald-200/80 rounded-xl font-extrabold text-xs">
                <i class="ri-phone-fill text-sm"></i>
                <span>24/7 Helpline: {{ setting('phone_number', '1-800-678-4677') }}</span>
            </a>

            <a href="{{ route('home') }}#booking" 
               wire:navigate 
               @click="mobileMenuOpen = false" 
               class="w-full flex items-center justify-center gap-2 py-3 px-4 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-bold text-xs sm:text-sm rounded-xl shadow-md shadow-[#114b5f]/20 transition-all">
                <i class="ri-calendar-check-line text-base"></i>
                <span>Book Appointment</span>
            </a>
        </div>

    </div>
</div>
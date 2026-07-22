<!-- CLEAN & MINIMAL HEADER COMPONENT -->
<div x-data="{ mobileMenuOpen: false, servicesOpen: false }">
    <!-- Top Contact Bar -->
    <div class="bg-slate-900 text-slate-300 text-xs py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-4">
                <span>JCI & NABH Accredited Center</span>
                <span class="text-slate-700">|</span>
                <a href="tel:18006784677" class="text-emerald-400 font-bold hover:underline">
                    24/7 Emergency Helpline: 1-800-ORTHO-CARE
                </a>
            </div>
            <div class="hidden sm:flex items-center gap-4 text-slate-400">
                <a href="#booking" class="hover:text-white transition-colors">Book Appointment</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="bg-white py-4 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            
            <!-- Plain Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-sky-600 flex items-center justify-center text-white font-bold text-xl">
                    <i class="ri-heart-pulse-line"></i>
                </div>
                <div>
                    <div class="flex items-baseline gap-1">
                        <span class="font-bold text-xl text-slate-900 tracking-tight">ADVANCE</span>
                        <span class="text-xs font-bold text-sky-600 bg-sky-50 px-1.5 py-0.5 rounded">ORTHO</span>
                    </div>
                    <p class="text-[11px] text-slate-500 font-medium">Orthopaedic & Spine Center</p>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-700">
                <a href="{{ route('home') }}" class="hover:text-sky-600 transition-colors">Home</a>
                
                <!-- Services Dropdown with Alpine.js -->
                <div class="relative" @mouseleave="servicesOpen = false">
                    <button @click="servicesOpen = !servicesOpen" @mouseenter="servicesOpen = true" class="flex items-center gap-1 hover:text-sky-600 transition-colors py-1 focus:outline-none">
                        <span>Services</span>
                        <i class="ri-arrow-down-s-line text-slate-400 transition-transform" :class="{ 'rotate-180': servicesOpen }"></i>
                    </button>

                    <div x-show="servicesOpen" 
                          x-transition
                          @click.outside="servicesOpen = false"
                          x-cloak
                          class="absolute top-full left-0 w-72 bg-white rounded-xl shadow-lg border border-slate-200 p-2 z-50 mt-1">
                        
                        <div class="px-3 py-2 border-b border-slate-100 font-bold text-xs text-slate-400 uppercase">Our 20 Services</div>
                        
                        <div class="py-1 space-y-1">
                            <a href="{{ route('services.view', 'trauma-and-accident-care') }}" @click="servicesOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-sky-600 rounded-lg">
                                Trauma & Accident Care
                            </a>
                            <a href="{{ route('services.view', 'endoscopic-spine-surgery') }}" @click="servicesOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-sky-600 rounded-lg">
                                Endoscopic Spine Surgery
                            </a>
                            <a href="{{ route('services.view', 'knee-replacement-surgery') }}" @click="servicesOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-sky-600 rounded-lg">
                                Knee & Hip Replacement
                            </a>
                            <a href="{{ route('services.view', 'sports-injury-treatment') }}" @click="servicesOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-sky-600 rounded-lg">
                                Sports Injury & Arthroscopy
                            </a>
                            <a href="{{ route('services.view', 'physiotherapy-and-rehabilitation') }}" @click="servicesOpen = false" class="block px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-sky-600 rounded-lg">
                                Physiotherapy & Rehabilitation
                            </a>
                        </div>

                        <div class="pt-2 border-t border-slate-100">
                            <a href="{{ route('services') }}" @click="servicesOpen = false" class="block text-center text-xs font-bold text-sky-600 hover:underline py-1">
                                View All 20 Services →
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('home') }}#why-choose-us" class="hover:text-sky-600 transition-colors">Why Choose Us</a>
                <a href="{{ route('home') }}#faqs" class="hover:text-sky-600 transition-colors">FAQ</a>
                <a href="{{ route('blog') }}" class="hover:text-sky-600 transition-colors {{ request()->routeIs('blog*') ? 'text-sky-600' : '' }}">Blog</a>
            </nav>

            <!-- CTA Button -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}#booking" class="hidden sm:inline-block px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs rounded-lg transition-colors">
                    Book Appointment
                </a>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-700 hover:bg-slate-100 rounded-lg">
                    <i class="ri-menu-line text-xl" x-show="!mobileMenuOpen"></i>
                    <i class="ri-close-line text-xl" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" x-transition x-cloak class="lg:hidden bg-white border-t border-slate-200 px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-800 py-1">Home</a>
            <a href="{{ route('services') }}" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-800 py-1">Services (20)</a>
            <a href="{{ route('home') }}#why-choose-us" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-800 py-1">Why Choose Us</a>
            <a href="{{ route('home') }}#faqs" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-800 py-1">FAQ</a>
            <a href="{{ route('blog') }}" @click="mobileMenuOpen = false" class="block text-sm font-semibold text-slate-800 py-1">Blog</a>
            <a href="{{ route('home') }}#booking" @click="mobileMenuOpen = false" class="block w-full text-center py-2.5 bg-sky-600 text-white font-bold text-xs rounded-lg">
                Book Appointment
            </a>
        </div>
    </header>
</div>
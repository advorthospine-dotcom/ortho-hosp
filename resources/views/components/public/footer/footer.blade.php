<!-- PREMIUM & ATTRACTIVE PUBLIC FOOTER COMPONENT -->
<footer class="bg-slate-950 text-slate-300 text-xs pt-16 pb-12 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Main Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-900">
            
            <!-- Col 1: Brand & Accreditations (2 cols) -->
            <div class="lg:col-span-2 space-y-4">
                <a href="{{ route('home') }}" class="inline-block">
                    <img src="{{ asset('logo.webp') }}" 
                         alt="{{ setting('hospital_name', 'Advance Ortho & Spine Center') }}" 
                         class="h-11 sm:h-13 w-auto object-contain brightness-105" />
                </a>

                <p class="text-slate-400 leading-relaxed text-xs max-w-sm">
                    A tertiary super-specialty hospital dedicated exclusively to joint replacements, 7mm keyhole endoscopic spine procedures, trauma emergency, and advanced sports injury rehabilitation.
                </p>

                <!-- Social Icons & Badges -->
                <div class="flex flex-wrap items-center gap-2.5 pt-2">
                    @if(setting('social_instagram'))
                        <a href="{{ setting('social_instagram') }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-pink-600 text-slate-400 hover:text-white border border-slate-800 flex items-center justify-center transition-colors" title="Instagram">
                            <i class="ri-instagram-line text-sm"></i>
                        </a>
                    @endif

                    @if(setting('social_facebook'))
                        <a href="{{ setting('social_facebook') }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-[#114b5f] text-slate-400 hover:text-white border border-slate-800 flex items-center justify-center transition-colors" title="Facebook">
                            <i class="ri-facebook-fill text-sm"></i>
                        </a>
                    @endif

                    @if(setting('social_x'))
                        <a href="{{ setting('social_x') }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-white border border-slate-800 flex items-center justify-center transition-colors" title="X (Twitter)">
                            <i class="ri-twitter-x-line text-sm"></i>
                        </a>
                    @endif

                    @if(setting('whatsapp_number'))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white border border-slate-800 flex items-center justify-center transition-colors" title="WhatsApp">
                            <i class="ri-whatsapp-line text-sm"></i>
                        </a>
                    @endif

                    <span class="px-3 py-1 bg-[#114b5f]/30 text-teal-300 rounded-xl text-[11px] font-bold border border-[#114b5f]/50 flex items-center gap-1">
                        <i class="ri-award-fill text-amber-400"></i> JCI Accredited
                    </span>
                </div>
            </div>

            <!-- Col 2: Surgical Specialties -->
            <div class="space-y-3.5">
                <h4 class="text-xs font-extrabold text-white uppercase tracking-wider">Specialties</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="{{ route('services.view', 'trauma-and-accident-care') }}" class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Trauma & Accident Care</a></li>
                    <li><a href="{{ route('services.view', 'endoscopic-spine-surgery') }}" class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Endoscopic Spine Surgery</a></li>
                    <li><a href="{{ route('services.view', 'knee-replacement-surgery') }}" class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Knee Replacement Surgery</a></li>
                    <li><a href="{{ route('services.view', 'hip-replacement-surgery') }}" class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Hip Replacement Surgery</a></li>
                    <li><a href="{{ route('services.view', 'sports-injury-treatment') }}" class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Sports Injury Treatment</a></li>
                </ul>
            </div>

            <!-- Col 3: Quick Navigation -->
            <div class="space-y-3.5">
                <h4 class="text-xs font-extrabold text-white uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="{{ route('home') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Home Page</a></li>
                    <li><a href="{{ route('services') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> 20 Medical Specialties</a></li>
                    <li><a href="{{ route('gallery') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Photo Gallery</a></li>
                    <li><a href="{{ route('blog') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Medical Blog</a></li>
                    <li><a href="{{ route('contact') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-[#114b5f]"></i> Contact Us</a></li>
                    <li><a href="{{ route('home') }}#booking" wire:navigate class="text-emerald-400 font-bold hover:underline flex items-center gap-1.5"><i class="ri-calendar-check-line"></i> Book Appointment</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact & OPD Hours -->
            <div class="space-y-3.5">
                <h4 class="text-xs font-extrabold text-white uppercase tracking-wider">Contact & OPD</h4>
                <div class="space-y-2.5 text-xs text-slate-300">
                    <p class="flex items-start gap-2">
                        <i class="ri-map-pin-2-fill text-teal-400 text-sm mt-0.5 shrink-0"></i>
                        <span>450 Health Avenue, Medical District, NY 10001</span>
                    </p>
                    <p class="flex items-center gap-2 text-emerald-400 font-bold">
                        <i class="ri-phone-fill text-sm shrink-0"></i>
                        <span>Helpline: {{ setting('phone_number', '1-800-678-4677') }}</span>
                    </p>
                    <p class="flex items-center gap-2 text-slate-300">
                        <i class="ri-mail-fill text-teal-400 text-sm shrink-0"></i>
                        <span>{{ setting('contact_email', 'care@advanceorthospine.com') }}</span>
                    </p>
                    <div class="pt-2 border-t border-slate-900 text-[11px] text-slate-400 space-y-1">
                        <p class="font-bold text-slate-300">OPD Consultation Hours:</p>
                        <p>Mon - Sat: 8:00 AM - 8:00 PM</p>
                        <p class="text-emerald-400 font-bold">24/7 Trauma Emergency</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Bar with Back to Top -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-400">
            <p>&copy; {{ date('Y') }} Advance Orthopaedic & Spine Center. All Rights Reserved.</p>

            <div class="flex items-center gap-6">
                <a href="{{ route('contact') }}" wire:navigate class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('contact') }}" wire:navigate class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-[#114b5f] text-slate-400 hover:text-white border border-slate-800 flex items-center justify-center transition-colors" title="Back to Top">
                    <i class="ri-arrow-up-line text-sm"></i>
                </a>
            </div>
        </div>

    </div>
</footer>
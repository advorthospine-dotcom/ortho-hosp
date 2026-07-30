<!-- CLEAN & ATTRACTIVE PUBLIC FOOTER COMPONENT -->
<footer class="bg-slate-950 text-slate-300 text-xs pt-16 pb-10 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Main Footer Grid (4 Columns) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-slate-900">
            
            <!-- Col 1: Brand & Social Links -->
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="inline-block">
                    <img src="{{ asset('logo.webp') }}" 
                         alt="{{ setting('hospital_name', 'Advance Ortho & Spine Center') }}" 
                         class="h-11 sm:h-12 w-auto object-contain brightness-105" />
                </a>

                <p class="text-slate-400 leading-relaxed text-xs">
                    Super-specialty hospital for joint replacements, endoscopic spine surgery, trauma emergency, and physical rehabilitation.
                </p>

                <!-- Social Links Icons -->
                <div class="flex items-center gap-2 pt-1">
                    @if(setting('social_instagram'))
                        <a href="{{ setting('social_instagram') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-[#114b5f] text-slate-400 hover:text-white border border-slate-800/80 flex items-center justify-center transition-colors" title="Instagram">
                            <i class="ri-instagram-line text-sm"></i>
                        </a>
                    @endif

                    @if(setting('social_facebook'))
                        <a href="{{ setting('social_facebook') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-[#114b5f] text-slate-400 hover:text-white border border-slate-800/80 flex items-center justify-center transition-colors" title="Facebook">
                            <i class="ri-facebook-fill text-sm"></i>
                        </a>
                    @endif

                    @if(setting('social_x'))
                        <a href="{{ setting('social_x') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-[#114b5f] text-slate-400 hover:text-white border border-slate-800/80 flex items-center justify-center transition-colors" title="X (Twitter)">
                            <i class="ri-twitter-x-line text-sm"></i>
                        </a>
                    @endif

                    @php
                        $waFooterNum = preg_replace('/[^0-9]/', '', setting('whatsapp_number') ?: setting('phone_number', '18006784677'));
                    @endphp
                    <a href="https://wa.me/{{ $waFooterNum ?: '18006784677' }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-emerald-600 text-slate-400 hover:text-white border border-slate-800/80 flex items-center justify-center transition-colors" title="WhatsApp">
                        <i class="ri-whatsapp-line text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Col 2: Surgical Specialties -->
            <div class="space-y-3">
                <h4 class="text-xs font-extrabold text-white uppercase tracking-wider">Specialties</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ route('services.view', 'trauma-and-accident-care') }}" class="text-slate-400 hover:text-teal-300 transition-colors">Trauma & Accident Care</a></li>
                    <li><a href="{{ route('services.view', 'cervical-thoracic-lumbar-spine-disorders') }}" class="text-slate-400 hover:text-teal-300 transition-colors">Spine & Back Care</a></li>
                    <li><a href="{{ route('services.view', 'knee-replacement-surgery') }}" class="text-slate-400 hover:text-teal-300 transition-colors">Knee Replacement Surgery</a></li>
                    <li><a href="{{ route('services.view', 'hip-replacement-surgery') }}" class="text-slate-400 hover:text-teal-300 transition-colors">Hip Replacement Surgery</a></li>
                    <li><a href="{{ route('services.view', 'sports-injury-treatment') }}" class="text-slate-400 hover:text-teal-300 transition-colors">Sports Injury & Arthroscopy</a></li>
                </ul>
            </div>

            <!-- Col 3: Essential Navigation Links -->
            <div class="space-y-3">
                <h4 class="text-xs font-extrabold text-white uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ route('home') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors">About Us</a></li>
                    <li><a href="{{ route('services') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors">Specialties</a></li>
                    <li><a href="{{ route('gallery') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors">Gallery</a></li>
                    <li><a href="{{ route('blog') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors">Medical Insights</a></li>
                    <li><a href="{{ route('contact') }}" wire:navigate class="text-slate-400 hover:text-teal-300 transition-colors">Contact Us</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact & OPD Helpline -->
            <div class="space-y-3">
                <h4 class="text-xs font-extrabold text-white uppercase tracking-wider">Emergency & OPD</h4>
                <div class="space-y-2 text-xs text-slate-300">
                    <p class="flex items-start gap-2">
                        <i class="ri-map-pin-2-fill text-teal-400 text-sm shrink-0"></i>
                        <span>{{ setting('address', '450 Health Avenue, Medical District, NY') }}</span>
                    </p>
                    <p class="flex items-center gap-2 text-emerald-400 font-bold">
                        <i class="ri-phone-fill text-sm shrink-0"></i>
                        <span>{{ setting('phone_number', '1-800-678-4677') }}</span>
                    </p>
                    <p class="flex items-center gap-2 text-slate-300">
                        <i class="ri-mail-fill text-teal-400 text-sm shrink-0"></i>
                        <span>{{ setting('email', setting('contact_email', 'contact@advorthospine.com')) }}</span>
                    </p>
                    <p class="text-[11px] text-slate-400 pt-1">OPD: {{ setting('opd_timings', 'Mon - Sat: 8:00 AM - 8:00 PM') }} • 24/7 Emergency</p>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright Bar -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-400">
            <p>&copy; {{ date('Y') }} {{ setting('hospital_name', 'Advance Orthopaedic & Spine Center') }}. All Rights Reserved.</p>

            <div class="flex items-center gap-5">
                <a href="{{ route('contact') }}" wire:navigate class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('contact') }}" wire:navigate class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="w-7 h-7 rounded-lg bg-slate-900 hover:bg-[#114b5f] text-slate-400 hover:text-white border border-slate-800 flex items-center justify-center transition-colors" title="Back to Top">
                    <i class="ri-arrow-up-line text-xs"></i>
                </a>
            </div>
        </div>

    </div>
</footer>
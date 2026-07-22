<!-- PREMIUM & ATTRACTIVE PUBLIC FOOTER COMPONENT -->
<footer class="bg-slate-950 text-slate-300 text-xs pt-16 pb-12 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
 
        <!-- 2. Main 5-Column Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800/80">
            
            <!-- Col 1: Brand & Accreditations -->
            <div class="lg:col-span-2 space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-sky-500 to-cyan-400 p-0.5 shadow-md">
                        <div class="w-full h-full bg-slate-950 rounded-[10px] flex items-center justify-center text-sky-400 font-bold text-lg">
                            <i class="ri-heart-pulse-fill"></i>
                        </div>
                    </div>
                    <div>
                        <span class="font-extrabold text-lg text-white tracking-tight">ADVANCE ORTHOPAEDIC</span>
                        <p class="text-[10px] text-sky-400 uppercase tracking-widest font-semibold">& Spine Center</p>
                    </div>
                </a>

                <p class="text-slate-400 leading-relaxed text-xs max-w-sm">
                    A tertiary hospital dedicated exclusively to bone, joint, spine, and musculoskeletal care. Powered by 3D Mako® Robotic Joint Replacements and 7mm Keyhole Endoscopic Spine procedures.
                </p>

                <div class="flex items-center gap-2 pt-1">
                    <span class="px-2.5 py-1 bg-slate-900 text-sky-300 rounded-lg text-[11px] font-bold border border-slate-800">
                        JCI Accredited
                    </span>
                    <span class="px-2.5 py-1 bg-slate-900 text-sky-300 rounded-lg text-[11px] font-bold border border-slate-800">
                        NABH Certified
                    </span>
                </div>
            </div>

            <!-- Col 2: Surgical Specialties -->
            <div class="space-y-3">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider">Specialties</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ route('services.view', 'trauma-and-accident-care') }}" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> Trauma & Accident Care</a></li>
                    <li><a href="{{ route('services.view', 'endoscopic-spine-surgery') }}" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> Endoscopic Spine Surgery</a></li>
                    <li><a href="{{ route('services.view', 'knee-replacement-surgery') }}" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> Knee Replacement Surgery</a></li>
                    <li><a href="{{ route('services.view', 'hip-replacement-surgery') }}" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> Hip Replacement Surgery</a></li>
                    <li><a href="{{ route('services.view', 'sports-injury-treatment') }}" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> Sports Injury Treatment</a></li>
                </ul>
            </div>

            <!-- Col 3: Quick Navigation -->
            <div class="space-y-3">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ route('home') }}" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> Home</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> 20 Medical Services</a></li>
                    <li><a href="{{ route('home') }}#why-choose-us" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> Why Choose Us</a></li>
                    <li><a href="{{ route('home') }}#faqs" class="hover:text-sky-400 transition-colors flex items-center gap-1.5"><i class="ri-arrow-right-s-line text-sky-500"></i> FAQ</a></li>
                    <li><a href="{{ route('home') }}#booking" class="text-sky-400 font-bold hover:underline flex items-center gap-1.5"><i class="ri-calendar-check-line text-sky-400"></i> Book Appointment</a></li>
                </ul>
            </div>

            <!-- Col 4: Hospital Contact & Hours -->
            <div class="space-y-3">
                <h4 class="text-sm font-bold text-white uppercase tracking-wider">Contact & OPD</h4>
                <div class="space-y-2 text-xs text-slate-300">
                    <p class="flex items-start gap-2">
                        <i class="ri-map-pin-2-fill text-sky-400 text-sm mt-0.5"></i>
                        <span>450 Health Avenue, Medical District, NY 10001</span>
                    </p>
                    <p class="flex items-center gap-2 text-emerald-400 font-bold">
                        <i class="ri-phone-fill text-sm"></i>
                        <span>Helpline: 1-800-678-4677</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="ri-mail-fill text-sky-400 text-sm"></i>
                        <span>care@advanceorthospine.com</span>
                    </p>
                    <div class="pt-2 border-t border-slate-900 text-[11px] text-slate-400">
                        <p class="font-bold text-slate-300">OPD Consultation Hours:</p>
                        <p>Mon - Sat: 8:00 AM - 8:00 PM</p>
                        <p class="text-rose-400">Sunday: 24/7 Trauma Emergency</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- 3. Bottom Bar with Back to Top -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-slate-400">
            <p>&copy; {{ date('Y') }} Advance Orthopaedic & Spine Center. All Rights Reserved.</p>

            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="w-8 h-8 rounded-xl bg-slate-900 hover:bg-sky-600 text-slate-300 hover:text-white border border-slate-800 flex items-center justify-center transition-colors" title="Back to Top">
                    <i class="ri-arrow-up-line text-sm"></i>
                </a>
            </div>
        </div>

    </div>
</footer>
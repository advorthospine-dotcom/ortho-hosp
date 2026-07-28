<div class="space-y-6">

    <!-- Header Section -->
    <div class="border-b border-slate-200/80 pb-5">
        <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">System Settings</h1>
        <p class="text-slate-500 text-sm mt-1">Configure hospital contact credentials, social media channels, and homepage hero banner settings.</p>
    </div>

    <!-- Settings Container with Sidebar Tabs -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-4 min-h-[600px]">
        
        <!-- Tabs Navigation Left -->
        <div class="p-4 bg-slate-50/70 border-b lg:border-b-0 lg:border-r border-slate-200/80 space-y-1.5 shrink-0">
            <button wire:click="$set('activeTab', 'hospital')" 
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all cursor-pointer text-left {{ $activeTab === 'hospital' ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-200/60 hover:text-slate-900' }}">
                <i class="ri-hospital-line text-lg"></i>
                <div>
                    <span class="block">Hospital Info</span>
                    <span class="text-[10px] opacity-80 font-normal">Phone, WhatsApp, Email</span>
                </div>
            </button>

            <button wire:click="$set('activeTab', 'social')" 
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all cursor-pointer text-left {{ $activeTab === 'social' ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-200/60 hover:text-slate-900' }}">
                <i class="ri-share-line text-lg"></i>
                <div>
                    <span class="block">Social Links</span>
                    <span class="text-[10px] opacity-80 font-normal">Instagram, Facebook, X</span>
                </div>
            </button>

            <button wire:click="$set('activeTab', 'hero')" 
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all cursor-pointer text-left {{ $activeTab === 'hero' ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-200/60 hover:text-slate-900' }}">
                <i class="ri-slideshow-3-line text-lg"></i>
                <div>
                    <span class="block">Hero Section & Slider</span>
                    <span class="text-[10px] opacity-80 font-normal">Title, Text, Slider Images</span>
                </div>
            </button>
        </div>

        <!-- Tab Content Right -->
        <div class="lg:col-span-3 p-6 sm:p-8 space-y-6">

            <!-- TAB 1: HOSPITAL INFORMATION -->
            @if ($activeTab === 'hospital')
                <div class="space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-base font-heading font-bold text-slate-800 flex items-center gap-2">
                            <i class="ri-building-4-line text-sky-600"></i> Hospital Contact Information
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Primary contact info displayed in website headers, footers, and patient contact sections.</p>
                    </div>

                    <form wire:submit.prevent="saveHospitalInfo" class="space-y-5 max-w-2xl">
                        <!-- Hospital Name -->
                        <div class="space-y-1.5">
                            <label for="hospital_name" class="text-xs font-semibold text-slate-700">Hospital / Center Name <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="ri-hospital-fill text-base"></i>
                                </div>
                                <input id="hospital_name" 
                                       type="text" 
                                       wire:model="hospital_name" 
                                       placeholder="e.g. Advance Ortho & Spine Center" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all @error('hospital_name') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror" 
                                       required />
                            </div>
                            @error('hospital_name')
                                <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                    <i class="ri-error-warning-line"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="space-y-1.5">
                            <label for="phone_number" class="text-xs font-semibold text-slate-700">Official Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="ri-phone-fill text-base"></i>
                                </div>
                                <input id="phone_number" 
                                       type="text" 
                                       wire:model="phone_number" 
                                       placeholder="e.g. +1 (555) 234-5678" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
                            </div>
                        </div>

                        <!-- WhatsApp Number -->
                        <div class="space-y-1.5">
                            <label for="whatsapp_number" class="text-xs font-semibold text-slate-700">WhatsApp Emergency / Appointment Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-500">
                                    <i class="ri-whatsapp-fill text-base"></i>
                                </div>
                                <input id="whatsapp_number" 
                                       type="text" 
                                       wire:model="whatsapp_number" 
                                       placeholder="e.g. +1 (555) 987-6543" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
                            </div>
                            <p class="text-[11px] text-slate-400">Include country code for direct click-to-chat links (e.g. +15559876543).</p>
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label for="email" class="text-xs font-semibold text-slate-700">Official Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="ri-mail-fill text-base"></i>
                                </div>
                                <input id="email" 
                                       type="email" 
                                       wire:model="email" 
                                       placeholder="e.g. contact@orthohosp.com" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex justify-end">
                            <button type="submit" 
                                    class="px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.99] transition-all flex items-center gap-2 cursor-pointer">
                                <span wire:loading wire:target="saveHospitalInfo" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                <i wire:loading.remove wire:target="saveHospitalInfo" class="ri-save-line text-base"></i>
                                <span>Save Hospital Info</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- TAB 2: SOCIAL MEDIA LINKS -->
            @if ($activeTab === 'social')
                <div class="space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-base font-heading font-bold text-slate-800 flex items-center gap-2">
                            <i class="ri-global-line text-sky-600"></i> Social Media Links
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Links to official hospital social profiles (Instagram, Facebook, X/Twitter).</p>
                    </div>

                    <form wire:submit.prevent="saveSocialLinks" class="space-y-5 max-w-2xl">
                        <!-- Instagram -->
                        <div class="space-y-1.5">
                            <label for="social_instagram" class="text-xs font-semibold text-slate-700">Instagram Profile URL</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-pink-500">
                                    <i class="ri-instagram-fill text-base"></i>
                                </div>
                                <input id="social_instagram" 
                                       type="url" 
                                       wire:model="social_instagram" 
                                       placeholder="https://instagram.com/your-hospital" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
                            </div>
                        </div>

                        <!-- Facebook -->
                        <div class="space-y-1.5">
                            <label for="social_facebook" class="text-xs font-semibold text-slate-700">Facebook Page URL</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-blue-600">
                                    <i class="ri-facebook-circle-fill text-base"></i>
                                </div>
                                <input id="social_facebook" 
                                       type="url" 
                                       wire:model="social_facebook" 
                                       placeholder="https://facebook.com/your-hospital" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
                            </div>
                        </div>

                        <!-- X / Twitter -->
                        <div class="space-y-1.5">
                            <label for="social_x" class="text-xs font-semibold text-slate-700">X (Twitter) Profile URL</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-900">
                                    <i class="ri-twitter-x-fill text-base"></i>
                                </div>
                                <input id="social_x" 
                                       type="url" 
                                       wire:model="social_x" 
                                       placeholder="https://x.com/your-hospital" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all" />
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex justify-end">
                            <button type="submit" 
                                    class="px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.99] transition-all flex items-center gap-2 cursor-pointer">
                                <span wire:loading wire:target="saveSocialLinks" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                <i wire:loading.remove wire:target="saveSocialLinks" class="ri-save-line text-base"></i>
                                <span>Save Social Links</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- TAB 3: HERO SECTION & SLIDER -->
            @if ($activeTab === 'hero')
                <div class="space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-base font-heading font-bold text-slate-800 flex items-center gap-2">
                            <i class="ri-layout-top-line text-sky-600"></i> Homepage Hero Section & Image Slider
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Manage the main headline title, description, and slider image background assets.</p>
                    </div>

                    <form wire:submit.prevent="saveHeroSection" class="space-y-6 max-w-3xl">
                        <!-- Hero Title -->
                        <div class="space-y-1.5">
                            <label for="hero_title" class="text-xs font-semibold text-slate-700">Hero Main Title / Headline <span class="text-rose-500">*</span></label>
                            <input id="hero_title" 
                                   type="text" 
                                   wire:model="hero_title" 
                                   placeholder="e.g. Advanced Orthopedic & Spine Surgery Center" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all @error('hero_title') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror" 
                                   required />
                            @error('hero_title')
                                <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                    <i class="ri-error-warning-line"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Hero Description -->
                        <div class="space-y-1.5">
                            <label for="hero_description" class="text-xs font-semibold text-slate-700">Hero Section Subtitle / Description <span class="text-rose-500">*</span></label>
                            <textarea id="hero_description" 
                                      wire:model="hero_description" 
                                      rows="3" 
                                      placeholder="e.g. Comprehensive joint replacement, sports medicine, and state-of-the-art robotic spine surgery." 
                                      class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all @error('hero_description') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror"
                                      required></textarea>
                            @error('hero_description')
                                <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                    <i class="ri-error-warning-line"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Multiple Image Upload for Hero Slider -->
                        <div class="space-y-3 pt-2">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-semibold text-slate-700">Hero Slider Images</label>
                                <span class="text-[11px] text-slate-400">Upload multiple high-res landscape images (16:9 recommended)</span>
                            </div>

                            <!-- Upload Box -->
                            <div class="relative border-2 border-dashed border-slate-200 hover:border-sky-500 rounded-2xl p-6 flex flex-col items-center justify-center transition-colors text-center group cursor-pointer bg-slate-50/50 hover:bg-sky-50/20">
                                <input type="file" 
                                       wire:model="newHeroImages" 
                                       id="hero-images-input" 
                                       accept="image/*" 
                                       multiple
                                       class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                                
                                <div class="space-y-2 pointer-events-none">
                                    <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-400 group-hover:text-sky-600 group-hover:border-sky-200 transition-colors mx-auto">
                                        <i class="ri-landscape-line text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-slate-700">Click to choose hero slider photos or drag & drop</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">JPG, PNG, WEBP files up to 10MB each</p>
                                    </div>
                                </div>
                            </div>
                            @error('newHeroImages.*')
                                <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                                    <i class="ri-error-warning-line"></i> {{ $message }}
                                </span>
                            @enderror

                            <!-- Newly Selected Files Queue -->
                            @if (count($newHeroImages) > 0)
                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/80 space-y-2">
                                    <div class="flex items-center justify-between text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">
                                        <span>New Images to Upload ({{ count($newHeroImages) }})</span>
                                        <button type="button" wire:click="$set('newHeroImages', [])" class="text-rose-600 hover:underline cursor-pointer">Clear</button>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach ($newHeroImages as $key => $img)
                                            <div class="flex items-center justify-between bg-white px-3 py-2 rounded-lg border border-slate-200 text-xs">
                                                <div class="flex items-center gap-2 truncate">
                                                    <i class="ri-image-line text-sky-600"></i>
                                                    <span class="truncate font-medium text-slate-700">{{ $img->getClientOriginalName() }}</span>
                                                </div>
                                                <span class="text-[11px] text-slate-400 shrink-0 font-mono">{{ round($img->getSize() / 1024, 1) }} KB</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Current Stored Hero Slider Gallery Grid -->
                            @if (count($existingHeroImages) > 0)
                                <div class="space-y-3 pt-2">
                                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Active Hero Slider Images ({{ count($existingHeroImages) }})</h4>
                                    
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                        @foreach ($existingHeroImages as $index => $imgPath)
                                            <div class="bg-slate-50 border border-slate-200 rounded-xl overflow-hidden shadow-sm relative group">
                                                <div class="aspect-16/9 bg-slate-200 relative overflow-hidden">
                                                    <img src="{{ asset('storage/' . $imgPath) }}" 
                                                         alt="Hero Slider Image {{ $index + 1 }}" 
                                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                                    
                                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-2">
                                                        <button type="button" 
                                                                wire:click="removeHeroImage({{ $index }})"
                                                                class="w-8 h-8 rounded-lg bg-rose-600 text-white flex items-center justify-center shadow-md hover:bg-rose-700 transition-colors cursor-pointer"
                                                                title="Delete Slider Image">
                                                            <i class="ri-delete-bin-line text-base"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="p-2 text-center bg-white border-t border-slate-100">
                                                    <span class="text-[10px] font-semibold text-slate-500">Slide #{{ $index + 1 }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 text-center text-xs text-slate-400">
                                    No slider images uploaded yet. Select files above and click "Save Hero Section".
                                </div>
                            @endif
                        </div>

                        <!-- Action Submit Button -->
                        <div class="pt-4 border-t border-slate-100 flex justify-end">
                            <button type="submit" 
                                    class="px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.99] transition-all flex items-center gap-2 cursor-pointer">
                                <span wire:loading wire:target="saveHeroSection" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                <i wire:loading.remove wire:target="saveHeroSection" class="ri-save-line text-base"></i>
                                <span>Save Hero Section</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif

        </div>
    </div>

</div>
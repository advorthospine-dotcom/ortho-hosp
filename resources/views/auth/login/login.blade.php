<div class="min-h-screen flex">
    <!-- Left Pane: Info/Brand (Hidden on Mobile) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900 overflow-hidden items-center justify-center p-12">
        <!-- Background Gradients and Effects -->
        <div class="absolute inset-0 bg-gradient-to-tr from-sky-950 via-slate-900 to-sky-900/60 opacity-90 z-10"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl"></div>
        
        <!-- Grid overlay -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-30"></div>

        <!-- Content -->
        <div class="relative z-20 max-w-lg text-white space-y-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-500 flex items-center justify-center text-white shadow-lg shadow-sky-500/30">
                    <i class="ri-heart-pulse-fill text-2xl"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-heading font-extrabold text-lg tracking-tight text-white leading-none">Advance Ortho</span>
                    <span class="text-[10px] text-sky-400 font-bold tracking-widest uppercase mt-0.5">Spine Center</span>
                </div>
            </div>

            <div class="space-y-4">
                <h1 class="text-4xl font-heading font-bold leading-tight tracking-tight">
                    World-Class Care, <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-sky-200">Right at Your Fingertips.</span>
                </h1>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Access the hospital administrative portal. Manage patient records, schedule operations, monitor staff attendance, and review hospital analytics securely.
                </p>
            </div>

            <!-- Decorative Dashboard Mockup Widget -->
            <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-6 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-white/5 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                    </div>
                    <span class="text-[10px] font-bold text-sky-400 tracking-wider uppercase bg-sky-500/10 px-2 py-0.5 rounded">Realtime Stats</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <p class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider">Active Operations</p>
                        <p class="text-2xl font-bold text-white">18</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider">Available Beds</p>
                        <p class="text-2xl font-bold text-emerald-400">84%</p>
                    </div>
                </div>
            </div>

            <!-- Footer Quote -->
            <div class="pt-6 border-t border-white/5 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 text-slate-300">
                    <i class="ri-double-quotes-l"></i>
                </div>
                <p class="text-xs text-slate-500 italic">
                    "Precision in surgery, compassion in recovery."
                </p>
            </div>
        </div>
    </div>

    <!-- Right Pane: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white px-6 sm:px-12 lg:px-16 py-12">
        <div class="w-full max-w-md space-y-8">
            
            <!-- Branding (Mobile Only) -->
            <div class="flex lg:hidden items-center gap-3 justify-center mb-8">
                <div class="w-10 h-10 rounded-xl bg-sky-600 flex items-center justify-center text-white shadow-lg shadow-sky-500/20">
                    <i class="ri-heart-pulse-fill text-2xl"></i>
                </div>
                <div class="flex flex-col text-left">
                    <span class="font-heading font-extrabold text-base tracking-tight text-slate-900 leading-none">Advance Ortho</span>
                    <span class="text-[9px] text-sky-600 font-bold tracking-widest uppercase mt-0.5">Spine Center</span>
                </div>
            </div>

            <!-- Heading -->
            <div class="text-center lg:text-left">
                <h2 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Admin Login</h2>
                <p class="text-slate-500 text-sm mt-2">Sign in to access your administrative workspace.</p>
            </div>

            <!-- Form -->
            <form wire:submit="login" class="space-y-6" x-data="{ showPassword: false }">
                
                <!-- Email Field -->
                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-semibold text-slate-700">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-mail-line text-slate-400 group-focus-within:text-sky-600 transition-colors"></i>
                        </div>
                        <input id="email" 
                               type="email" 
                               wire:model="email" 
                               placeholder="name@orthohosp.com" 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all @error('email') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror"
                               required 
                               autocomplete="email" 
                               autofocus />
                    </div>
                    @error('email')
                        <span class="text-xs font-medium text-rose-500 flex items-center gap-1.5 mt-1">
                            <i class="ri-error-warning-line"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-xs font-semibold text-slate-700">Password</label>
                        <a href="#" class="text-xs font-semibold text-sky-600 hover:text-sky-700">Forgot password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-lock-2-line text-slate-400 group-focus-within:text-sky-600 transition-colors"></i>
                        </div>
                        <input id="password" 
                               :type="showPassword ? 'text' : 'password'" 
                               wire:model="password" 
                               placeholder="••••••••" 
                               class="w-full pl-10 pr-12 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition-all @error('password') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @enderror"
                               required 
                               autocomplete="current-password" />
                        
                        <!-- Toggle Password Button -->
                        <button type="button" 
                                @click="showPassword = !showPassword" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                            <i :class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'" class="text-lg"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-xs font-medium text-rose-500 flex items-center gap-1.5 mt-1">
                            <i class="ri-error-warning-line"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" 
                               wire:model="remember" 
                               class="w-4 h-4 rounded text-sky-600 border-slate-300 focus:ring-sky-500 focus:ring-2" />
                        <span class="text-xs text-slate-600 font-medium">Keep me signed in</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        wire:loading.attr="disabled"
                        class="w-full bg-sky-600 hover:bg-sky-700 text-white font-semibold text-sm py-3 px-4 rounded-xl shadow-lg shadow-sky-600/10 hover:shadow-sky-600/20 active:scale-[0.99] transition-all flex items-center justify-center gap-2 group cursor-pointer disabled:opacity-75 disabled:cursor-not-allowed">
                    
                    <!-- Loading Indicator -->
                    <span wire:loading.delay class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                    
                    <span wire:loading.remove.delay>Sign In to Portal</span>
                    <span wire:loading.delay>Authenticating...</span>
                    
                    <i wire:loading.remove.delay class="ri-arrow-right-line text-lg group-hover:translate-x-0.5 transition-transform"></i>
                </button>

            </form>
            
            <!-- Quick Helper / Demo Credentials -->
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 space-y-1.5 text-xs text-slate-500">
                <span class="font-bold text-slate-700 block"><i class="ri-information-line text-sky-600"></i> Demo Credentials:</span>
                <p>Email: <code class="bg-slate-100 text-slate-800 px-1 py-0.5 rounded font-mono">admin@orthohosp.com</code></p>
                <p>Password: <code class="bg-slate-100 text-slate-800 px-1 py-0.5 rounded font-mono">admin123</code></p>
            </div>
            
        </div>
    </div>
</div>
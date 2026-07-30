<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
        <a href="{{ route('admin.blogs.index') }}" 
           class="w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 flex items-center justify-center text-slate-500 hover:text-slate-900 transition-all cursor-pointer">
            <i class="ri-arrow-left-line text-lg"></i>
        </a>
        <div>
            <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Create Blog Post</h1>
            <p class="text-slate-500 text-sm mt-0.5">Write a new article, case study, or research update.</p>
        </div>
    </div>

    <!-- Main Form Grid -->
    <form wire:submit="save" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Pane: Editor (Takes 2 columns) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Core Content Card -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
                
                <!-- Title Field -->
                <div class="space-y-1.5">
                    <label for="title" class="text-xs font-semibold text-slate-700">Article Title</label>
                    <input id="title" 
                           type="text" 
                           wire:model.live="title" 
                           placeholder="e.g. Advancements in Knee Replacement" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 font-medium focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('title') border-rose-400 focus:border-rose-500 @enderror"
                           required />
                    @error('title')
                        <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                            <i class="ri-error-warning-line"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Slug Field -->
                <div class="space-y-1.5">
                    <label for="slug" class="text-xs font-semibold text-slate-700">Slug URL</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-slate-400 text-xs font-mono select-none">/blog/</span>
                        <input id="slug" 
                               type="text" 
                               wire:model="slug" 
                               placeholder="advancements-in-robotic-knee-replacement" 
                               class="w-full pl-[52px] pr-4 py-2.5 rounded-xl border border-slate-200 text-xs font-mono text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('slug') border-rose-400 focus:border-rose-500 @enderror"
                               required />
                    </div>
                    @error('slug')
                        <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                            <i class="ri-error-warning-line"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Content Textarea -->
                <div class="space-y-1.5" wire:ignore x-data="{
                    content: @entangle('content'),
                    initTinyMCE() {
                        const init = () => {
                            if (typeof tinymce === 'undefined') {
                                setTimeout(init, 100);
                                return;
                            }
                            if (tinymce.get($refs.editor.id)) {
                                tinymce.get($refs.editor.id).destroy();
                            }
                            tinymce.init({
                                target: $refs.editor,
                                height: 420,
                                menubar: false,
                                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
                                toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link code | help',
                                setup: (editor) => {
                                    editor.on('init', () => {
                                        editor.setContent(this.content || '');
                                    });
                                    editor.on('change keyup undo redo', () => {
                                        this.content = editor.getContent();
                                    });
                                }
                            });
                        };
                        init();
                    },
                    destroy() {
                        if (typeof tinymce !== 'undefined' && tinymce.get($refs.editor.id)) {
                            tinymce.get($refs.editor.id).destroy();
                        }
                    }
                }" x-init="initTinyMCE()" x-on:destroy="destroy()">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Body Content</label>
                    <textarea x-ref="editor" id="content" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm outline-none"></textarea>
                    @error('content')
                        <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                            <i class="ri-error-warning-line"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>

            <!-- SEO Settings Card -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="border-b border-slate-50 pb-2 flex items-center gap-2">
                    <i class="ri-seo-line text-[#114b5f] text-lg"></i>
                    <h3 class="font-heading font-bold text-slate-800 text-sm">SEO Meta Settings</h3>
                </div>

                <!-- Meta Title -->
                <div class="space-y-1.5">
                    <label for="meta_title" class="text-xs font-semibold text-slate-700">Meta Title</label>
                    <input id="meta_title" 
                           type="text" 
                           wire:model="meta_title" 
                           placeholder="Recommended length: 50-60 characters" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
                </div>

                <!-- Meta Description -->
                <div class="space-y-1.5">
                    <label for="meta_description" class="text-xs font-semibold text-slate-700">Meta Description</label>
                    <textarea id="meta_description" 
                              wire:model="meta_description" 
                              rows="3" 
                              placeholder="Recommended length: 150-160 characters" 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all"></textarea>
                </div>

                <!-- Meta Keywords -->
                <div class="space-y-1.5">
                    <label for="meta_keywords" class="text-xs font-semibold text-slate-700">Meta Keywords</label>
                    <input id="meta_keywords" 
                           type="text" 
                           wire:model="meta_keywords" 
                           placeholder="e.g. robotic knee surgery, orthopaedic center, knee replacement" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
                </div>

            </div>

        </div>

        <!-- Right Pane: Sidebar Controls (Takes 1 column) -->
        <div class="space-y-6">
            
            <!-- Action / Publish settings card -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
                <h3 class="font-heading font-bold text-slate-800 text-sm border-b border-slate-50 pb-2">Publish Settings</h3>
                
                <!-- Category Select -->
                <div class="space-y-1.5">
                    <label for="category_id" class="text-xs font-semibold text-slate-700">Blog Category</label>
                    <select id="category_id" 
                            wire:model="category_id" 
                            class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 bg-white focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('category_id') border-rose-400 focus:border-rose-500 @enderror"
                            required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                            <i class="ri-error-warning-line"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Status Checkbox / Toggle -->
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-slate-700 block">Publication Status</label>
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" 
                               wire:model="is_active" 
                               class="w-4 h-4 rounded text-[#114b5f] border-slate-300 focus:ring-[#114b5f] focus:ring-2" />
                        <span class="text-xs text-slate-700 font-semibold">Publish immediately (Visible on website)</span>
                    </label>
                </div>

                <div class="border-t border-slate-50 pt-4 flex gap-2">
                    <a href="{{ route('admin.blogs.index') }}" 
                       class="flex-1 inline-flex items-center justify-center px-4 py-2.5 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-semibold text-xs rounded-xl shadow-md shadow-[#114b5f]/15 active:scale-[0.99] transition-all cursor-pointer">
                        <span wire:loading.delay wire:target="save" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                        <span wire:loading.remove.delay wire:target="save">Publish Post</span>
                        <span wire:loading.delay wire:target="save">Saving...</span>
                    </button>
                </div>
            </div>

            <!-- Image Upload Card -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
                <h3 class="font-heading font-bold text-slate-800 text-sm border-b border-slate-50 pb-2">Featured Image</h3>
                
                <!-- Upload input area -->
                <div class="space-y-3">
                    <div class="relative border-2 border-dashed border-slate-200 rounded-2xl p-4 flex flex-col items-center justify-center hover:border-[#114b5f] transition-colors text-center group cursor-pointer">
                        <input type="file" 
                               wire:model="image" 
                               id="image-upload" 
                               accept="image/*"
                               class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                        
                        <!-- Upload icon & prompts -->
                        <div class="space-y-1.5 py-4">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:text-[#114b5f] transition-colors mx-auto">
                                <i class="ri-upload-cloud-2-line text-xl"></i>
                            </div>
                            <p class="text-xs font-semibold text-slate-600">Click to upload header image</p>
                            <p class="text-[10px] text-slate-400">PNG, JPG or WEBP (Max 2MB)</p>
                        </div>
                    </div>

                    <!-- Uploading Progress Indicator -->
                    <div wire:loading.delay wire:target="image" class="w-full bg-slate-50 border border-slate-100 p-2.5 rounded-xl text-center flex items-center justify-center gap-2">
                        <span class="w-3.5 h-3.5 border-2 border-[#114b5f] border-t-transparent rounded-full animate-spin"></span>
                        <span class="text-[11px] text-slate-500 font-semibold">Uploading image, please wait...</span>
                    </div>

                    <!-- File validation error -->
                    @error('image')
                        <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                            <i class="ri-error-warning-line"></i> {{ $message }}
                        </span>
                    @enderror

                    <!-- Preview Container -->
                    @if ($image && !$errors->has('image'))
                        <div class="space-y-2 border border-slate-150 p-2 rounded-xl bg-slate-50">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Image Preview:</span>
                            <div class="aspect-video w-full rounded-lg overflow-hidden border border-slate-200">
                                <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover" alt="Preview" />
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image Alt text -->
                <div class="space-y-1.5 pt-2">
                    <label for="image_alt" class="text-xs font-semibold text-slate-700">Image Alt Text (Accessibility)</label>
                    <input id="image_alt" 
                           type="text" 
                           wire:model="image_alt" 
                           placeholder="Describe the image content..." 
                           class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
                </div>
            </div>

        </div>

    </form>
</div>
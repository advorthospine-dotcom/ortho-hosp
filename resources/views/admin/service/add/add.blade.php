<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200/80 pb-5">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.services.index') }}" class="text-slate-400 hover:text-[#114b5f] transition-colors">
                    <i class="ri-arrow-left-line text-xl"></i>
                </a>
                <h1 class="text-2xl font-heading font-bold text-slate-900 tracking-tight">Add New Clinical Service</h1>
            </div>
            <p class="text-slate-500 text-sm mt-1">Configure medical procedure details, treatment features checklist, SEO tags, and header image.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.services.index') }}" 
               class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                Cancel
            </a>
            <button type="button" 
                    @click="$refs.serviceForm.requestSubmit()"
                    class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-semibold text-xs rounded-xl shadow-md shadow-[#114b5f]/15 active:scale-[0.99] transition-all cursor-pointer">
                <i class="ri-save-line text-sm"></i>
                <span>Save & Publish</span>
            </button>
        </div>
    </div>

    <!-- Main Grid Form -->
    <form x-ref="serviceForm" wire:submit.prevent="save" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Pane: Main Content & Settings (Takes 2 columns) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Basic Service Information Card -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-5">
                <div class="border-b border-slate-50 pb-2 flex items-center gap-2">
                    <i class="ri-stethoscope-line text-[#114b5f] text-lg"></i>
                    <h3 class="font-heading font-bold text-slate-800 text-sm">Basic Service Information</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Title -->
                    <div class="space-y-1.5">
                        <label for="title" class="text-xs font-semibold text-slate-700">Service Title <span class="text-rose-500">*</span></label>
                        <input id="title" 
                               type="text" 
                               wire:model.live.debounce.300ms="title" 
                               placeholder="e.g. Minimally Invasive Spine Surgery" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('title') border-rose-400 @enderror" 
                               required />
                        @error('title') <span class="text-xs font-medium text-rose-500 flex items-center gap-1"><i class="ri-error-warning-line"></i> {{ $message }}</span> @enderror
                    </div>

                    <!-- Slug -->
                    <div class="space-y-1.5">
                        <label for="slug" class="text-xs font-semibold text-slate-700">URL Slug <span class="text-rose-500">*</span></label>
                        <input id="slug" 
                               type="text" 
                               wire:model="slug" 
                               placeholder="e.g. minimally-invasive-spine-surgery" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all @error('slug') border-rose-400 @enderror" 
                               required />
                        @error('slug') <span class="text-xs font-medium text-rose-500 flex items-center gap-1"><i class="ri-error-warning-line"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Department Category -->
                    <div class="space-y-1.5">
                        <label for="category" class="text-xs font-semibold text-slate-700">Department <span class="text-rose-500">*</span></label>
                        <select id="category" 
                                wire:model.live="category" 
                                class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#114b5f] transition-all bg-white cursor-pointer">
                            <option value="trauma">Trauma & Emergency</option>
                            <option value="spine">Spine & Back Care</option>
                            <option value="joints">Joint Replacements</option>
                            <option value="sports">Sports Medicine</option>
                            <option value="specialized">Specialized & Rehab</option>
                        </select>
                    </div>

                    <!-- Category Label -->
                    <div class="space-y-1.5">
                        <label for="category_label" class="text-xs font-semibold text-slate-700">Category Display Label</label>
                        <input id="category_label" 
                               type="text" 
                               wire:model="category_label" 
                               placeholder="e.g. Spine & Back Care" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-[#114b5f] transition-all" />
                    </div>

                    <!-- Badge / Tag -->
                    <div class="space-y-1.5">
                        <label for="badge" class="text-xs font-semibold text-slate-700">Specialty Badge Tag</label>
                        <input id="badge" 
                               type="text" 
                               wire:model="badge" 
                               placeholder="e.g. Keyhole Surgery" 
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 focus:outline-none focus:border-[#114b5f] transition-all" />
                    </div>
                </div>

                <!-- Color Accent Theme -->
                <div class="space-y-1.5">
                    <label for="color" class="text-xs font-semibold text-slate-700">Color Theme Accent</label>
                    <select id="color" 
                            wire:model="color" 
                            class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#114b5f] transition-all bg-white cursor-pointer">
                        <option value="rose">Rose (Emergency / Critical)</option>
                        <option value="sky">Sky Blue (Spine & Neuro)</option>
                        <option value="blue">Blue (Joint Replacements)</option>
                        <option value="indigo">Indigo (Sports Medicine)</option>
                        <option value="emerald">Emerald (Rehabilitation)</option>
                    </select>
                </div>

                <!-- Description (TinyMCE Rich Text Editor) -->
                <div class="space-y-1.5"
                     x-data="{
                         content: @entangle('desc'),
                         initTinyMCE() {
                             let init = () => {
                                 if (typeof tinymce === 'undefined') {
                                     setTimeout(init, 100);
                                     return;
                                 }
                                 if (tinymce.get($refs.addEditor.id)) {
                                     tinymce.get($refs.addEditor.id).destroy();
                                 }
                                 tinymce.init({
                                     target: $refs.addEditor,
                                     height: 420,
                                     menubar: 'insert format table tools',
                                     plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
                                     toolbar: 'undo redo | blocks | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | removeformat | code help',
                                     image_title: true,
                                     automatic_uploads: true,
                                     file_picker_types: 'image',
                                     file_picker_callback: (cb, value, meta) => {
                                         const input = document.createElement('input');
                                         input.setAttribute('type', 'file');
                                         input.setAttribute('accept', 'image/*');
                                         input.addEventListener('change', (e) => {
                                             const file = e.target.files[0];
                                             const reader = new FileReader();
                                             reader.addEventListener('load', () => {
                                                 const id = 'blobid' + (new Date()).getTime();
                                                 const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                                 const base64 = reader.result.split(',')[1];
                                                 const blobInfo = blobCache.create(id, file, base64);
                                                 blobCache.add(blobInfo);
                                                 cb(blobInfo.blobUri(), { title: file.name });
                                             });
                                             reader.readAsDataURL(file);
                                         });
                                         input.click();
                                     },
                                     setup: (editor) => {
                                         editor.on('init', () => {
                                             if (this.content) {
                                                 editor.setContent(this.content);
                                             }
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
                             if (typeof tinymce !== 'undefined' && tinymce.get($refs.addEditor.id)) {
                                 tinymce.get($refs.addEditor.id).destroy();
                             }
                         }
                     }" 
                     x-init="initTinyMCE()" 
                     x-on:destroy="destroy()"
                     wire:ignore>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Detailed Clinical Description (TinyMCE Rich Text Editor) <span class="text-rose-500">*</span></label>
                    <textarea x-ref="addEditor" id="add-desc" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm outline-none"></textarea>
                    @error('desc') <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1"><i class="ri-error-warning-line"></i> {{ $message }}</span> @enderror
                </div>

                <!-- Features / Checklist (1 per line) -->
                <div class="space-y-1.5">
                    <label for="featuresInput" class="text-xs font-semibold text-slate-700">Key Features / Procedures Checklist <span class="text-slate-400 font-normal">(Enter 1 procedure per line)</span></label>
                    <textarea id="featuresInput" 
                              wire:model="featuresInput" 
                              rows="4" 
                              placeholder="Keyhole Micro-Incisions&#10;Same-Day Mobilization Protocol&#10;3D High-Definition Microscopic Guidance" 
                              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-medium text-slate-800 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all leading-relaxed"></textarea>
                </div>
            </div>

            <!-- SEO Settings Card -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
                <div class="border-b border-slate-50 pb-2 flex items-center gap-2">
                    <i class="ri-seo-line text-[#114b5f] text-lg"></i>
                    <h3 class="font-heading font-bold text-slate-800 text-sm">SEO Search Engine Metadata</h3>
                </div>

                <!-- Meta Title -->
                <div class="space-y-1.5">
                    <label for="meta_title" class="text-xs font-semibold text-slate-700">Meta Search Title</label>
                    <input id="meta_title" 
                           type="text" 
                           wire:model="meta_title" 
                           placeholder="Recommended: 50-60 characters (e.g. Minimally Invasive Spine Surgery in Purnea)" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
                </div>

                <!-- Meta Description -->
                <div class="space-y-1.5">
                    <label for="meta_desc" class="text-xs font-semibold text-slate-700">Meta Search Description</label>
                    <textarea id="meta_desc" 
                              wire:model="meta_desc" 
                              rows="3" 
                              placeholder="Recommended: 150-160 characters summary for Google search snippets..." 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all"></textarea>
                </div>

                <!-- Meta Keywords -->
                <div class="space-y-1.5">
                    <label for="meta_keywords" class="text-xs font-semibold text-slate-700">Meta Search Keywords</label>
                    <input id="meta_keywords" 
                           type="text" 
                           wire:model="meta_keywords" 
                           placeholder="e.g. spine surgery, slip disc treatment, Dr Shafique Alam, Purnea hospital" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#114b5f] focus:ring-2 focus:ring-teal-100 transition-all" />
                </div>
            </div>

        </div>

        <!-- Right Pane: Sidebar Controls (Takes 1 column) -->
        <div class="space-y-6">
            
            <!-- Publish Settings Card -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
                <h3 class="font-heading font-bold text-slate-800 text-sm border-b border-slate-50 pb-2">Publish Settings</h3>

                <!-- Active Status Toggle -->
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-slate-700 block">Website Visibility</label>
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" 
                               wire:model="is_active" 
                               class="w-4 h-4 rounded text-[#114b5f] border-slate-300 focus:ring-[#114b5f] focus:ring-2" />
                        <span class="text-xs text-slate-700 font-semibold">Publish immediately (Visible on website)</span>
                    </label>
                </div>

                <div class="border-t border-slate-50 pt-4 flex gap-2">
                    <a href="{{ route('admin.services.index') }}" 
                       class="flex-1 inline-flex items-center justify-center px-4 py-2.5 border border-slate-200 bg-white hover:bg-slate-100 rounded-xl text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-[#114b5f] hover:bg-[#0e3b4b] text-white font-semibold text-xs rounded-xl shadow-md shadow-[#114b5f]/15 active:scale-[0.99] transition-all cursor-pointer">
                        <span wire:loading wire:target="save" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                        <span wire:loading.remove wire:target="save">Save Service</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </button>
                </div>
            </div>

            <!-- Image Upload Card -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
                <h3 class="font-heading font-bold text-slate-800 text-sm border-b border-slate-50 pb-2">Featured Image</h3>
                
                <div class="space-y-3">
                    <div class="relative border-2 border-dashed border-slate-200 rounded-2xl p-4 flex flex-col items-center justify-center hover:border-[#114b5f] transition-colors text-center group cursor-pointer">
                        <input type="file" 
                               wire:model="imageFile" 
                               id="image-upload" 
                               accept="image/*"
                               class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                        
                        <div class="space-y-1.5 py-4">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:text-[#114b5f] transition-colors mx-auto">
                                <i class="ri-upload-cloud-2-line text-xl"></i>
                            </div>
                            <p class="text-xs font-semibold text-slate-600">Click to upload featured image</p>
                            <p class="text-[10px] text-slate-400">PNG, JPG or WEBP (Max 10MB)</p>
                        </div>
                    </div>

                    <!-- Uploading Progress Indicator -->
                    <div wire:loading wire:target="imageFile" class="w-full bg-slate-50 border border-slate-100 p-2.5 rounded-xl text-center flex items-center justify-center gap-2">
                        <span class="w-3.5 h-3.5 border-2 border-[#114b5f] border-t-transparent rounded-full animate-spin"></span>
                        <span class="text-[11px] text-slate-500 font-semibold">Uploading image...</span>
                    </div>

                    @error('imageFile')
                        <span class="text-xs font-medium text-rose-500 flex items-center gap-1 mt-1">
                            <i class="ri-error-warning-line"></i> {{ $message }}
                        </span>
                    @enderror

                    <!-- Preview Container -->
                    @if ($imageFile && !$errors->has('imageFile'))
                        <div class="space-y-2 border border-slate-150 p-2 rounded-xl bg-slate-50">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Image Preview:</span>
                            <div class="aspect-video w-full rounded-lg overflow-hidden border border-slate-200">
                                <img src="{{ $imageFile->temporaryUrl() }}" class="w-full h-full object-cover" alt="Preview" />
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </form>

</div>
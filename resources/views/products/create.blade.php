<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
        }
        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="glass-container shadow-2xl p-8 md:p-12 border border-white/10">
                <div class="text-center mb-12">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-blue-500/20">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <h1 class="text-4xl font-black text-white tracking-tight">Post a Product</h1>
                    <p class="text-blue-300 font-bold mt-2 opacity-80">Sell your items to fellow students easily</p>
                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="product_name" :value="__('Product Name')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                <x-text-input id="product_name" name="product_name" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500" placeholder="e.g. Scientific Calculator" required />
                                <x-input-error class="mt-2" :messages="$errors->get('product_name')" />
                            </div>

                            <div>
                                <x-input-label for="product_type" :value="__('Product Type')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                <select id="product_type" name="product_type" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white" required>
                                    <option value="" disabled selected class="bg-slate-900 text-slate-400">Select Type</option>
                                    <option value="Electronics" class="bg-slate-900">Electronics</option>
                                    <option value="Books" class="bg-slate-900">Books & Notes</option>
                                    <option value="Stationery" class="bg-slate-900">Stationery</option>
                                    <option value="Hoodie" class="bg-slate-900">Hoodie</option>
                                    <option value="Other" class="bg-slate-900">Other</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('product_type')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="price" :value="__('Price (৳)')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                    <x-text-input id="price" name="price" type="number" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500" placeholder="500" required />
                                </div>
                                <div>
                                    <x-input-label for="condition" :value="__('Condition')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                    <select id="condition" name="condition" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white" required>
                                        <option value="New" class="bg-slate-900">New</option>
                                        <option value="Used - Excellent" class="bg-slate-900">Used - Excellent</option>
                                        <option value="Used - Good" class="bg-slate-900">Used - Good</option>
                                        <option value="Used - Fair" class="bg-slate-900">Used - Fair</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="used_for" :value="__('Used For (Duration)')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                <x-text-input id="used_for" name="used_for" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500" placeholder="e.g. 6 months" />
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="description" :value="__('Description')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                <textarea id="description" name="description" rows="4" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500 border-none outline-none focus:ring-1" placeholder="Describe your product..."></textarea>
                            </div>

                            <div>
                                <x-input-label for="contact_number" :value="__('Contact Number')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                <x-text-input id="contact_number" name="contact_number" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white" value="{{ Auth::user()->profile->number ?? '' }}" required />
                            </div>

                            <div>
                                <x-input-label for="product_image" :value="__('Product Image')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                <div class="mt-2 flex items-center justify-center w-full relative">
                                    <label for="product_image" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-white/10 rounded-2xl cursor-pointer bg-white/5 hover:bg-white/10 transition-all overflow-hidden relative group/upload">
                                        <div id="upload-prompt" class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-3 text-blue-400 group-hover/upload:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                                            <p class="text-xs text-blue-300 font-bold">Click to upload image</p>
                                        </div>
                                        <img id="image-preview" src="#" alt="Preview" class="absolute inset-0 w-full h-full object-cover hidden">
                                        <input type="file" id="product_image" name="product_image" class="hidden" onchange="previewProductImage(event)" />
                                    </label>
                                    <button type="button" id="remove-image" onclick="clearImagePreview()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hidden hover:bg-red-600 transition-colors z-20">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-blue-500/20 hover:scale-[1.01] transition-all active:scale-95 btn-glow">
                            Post My Product Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewProductImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('image-preview');
                const prompt = document.getElementById('upload-prompt');
                const removeBtn = document.getElementById('remove-image');
                
                preview.src = reader.result;
                preview.classList.remove('hidden');
                prompt.classList.add('hidden');
                removeBtn.classList.remove('hidden');
            };
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        function clearImagePreview() {
            const input = document.getElementById('product_image');
            const preview = document.getElementById('image-preview');
            const prompt = document.getElementById('upload-prompt');
            const removeBtn = document.getElementById('remove-image');
            
            input.value = '';
            preview.src = '#';
            preview.classList.add('hidden');
            prompt.classList.remove('hidden');
            removeBtn.classList.add('hidden');
        }
    </script>
</x-app-layout>

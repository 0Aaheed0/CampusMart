<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(15px) saturate(160%);
            -webkit-backdrop-filter: blur(15px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 40px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 30px;
        }
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23475569'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
        }
        .btn-glow:hover {
            box-shadow: 0 0 25px rgba(37, 99, 235, 0.5);
            transform: translateY(-2px);
        }
    </style>

    <div class="py-12 bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-200 rounded-full blur-[100px] opacity-30 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-200 rounded-full blur-[100px] opacity-30 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="glass-container shadow-2xl p-8 md:p-12">
                <div class="text-center mb-12">
                    <div class="w-20 h-20 bg-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-blue-500/30">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <h1 class="text-4xl font-black text-blue-900 tracking-tight">Post a Product</h1>
                    <p class="text-blue-600 font-bold mt-2 opacity-70">Sell your items to fellow students easily</p>
                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="product_name" :value="__('Product Name')" class="text-[11px] font-black text-gray-400 uppercase ml-1 tracking-widest" />
                                <x-text-input id="product_name" name="product_name" type="text" class="mt-2 block w-full rounded-2xl border-white/50 bg-white/40 focus:bg-white focus:ring-blue-100 transition-all font-bold text-blue-900" placeholder="e.g. Scientific Calculator" required />
                                <x-input-error class="mt-2" :messages="$errors->get('product_name')" />
                            </div>

                            <div>
                                <x-input-label for="product_type" :value="__('Product Type')" class="text-[11px] font-black text-gray-400 uppercase ml-1 tracking-widest" />
                                <select id="product_type" name="product_type" class="mt-2 block w-full rounded-2xl border-white/50 bg-white/40 focus:bg-white focus:ring-blue-100 transition-all font-bold text-blue-900" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Books">Books & Notes</option>
                                    <option value="Stationery">Stationery</option>
                                    <option value="Hoodie">Hoodie</option>
                                    <option value="Other">Other</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('product_type')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="price" :value="__('Price (৳)')" class="text-[11px] font-black text-gray-400 uppercase ml-1 tracking-widest" />
                                    <x-text-input id="price" name="price" type="number" class="mt-2 block w-full rounded-2xl border-white/50 bg-white/40 focus:bg-white focus:ring-blue-100 transition-all font-bold text-blue-900" placeholder="500" required />
                                </div>
                                <div>
                                    <x-input-label for="condition" :value="__('Condition')" class="text-[11px] font-black text-gray-400 uppercase ml-1 tracking-widest" />
                                    <select id="condition" name="condition" class="mt-2 block w-full rounded-2xl border-white/50 bg-white/40 focus:bg-white focus:ring-blue-100 transition-all font-bold text-blue-900" required>
                                        <option value="New">New</option>
                                        <option value="Used - Excellent">Used - Excellent</option>
                                        <option value="Used - Good">Used - Good</option>
                                        <option value="Used - Fair">Used - Fair</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="used_for" :value="__('Used For (Duration)')" class="text-[11px] font-black text-gray-400 uppercase ml-1 tracking-widest" />
                                <x-text-input id="used_for" name="used_for" type="text" class="mt-2 block w-full rounded-2xl border-white/50 bg-white/40 focus:bg-white focus:ring-blue-100 transition-all font-bold text-blue-900" placeholder="e.g. 6 months" />
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="description" :value="__('Description')" class="text-[11px] font-black text-gray-400 uppercase ml-1 tracking-widest" />
                                <textarea id="description" name="description" rows="4" class="mt-2 block w-full rounded-2xl border-white/50 bg-white/40 focus:bg-white focus:ring-blue-100 transition-all font-bold text-blue-900 border-gray-300" placeholder="Describe your product..."></textarea>
                            </div>

                            <div>
                                <x-input-label for="contact_number" :value="__('Contact Number')" class="text-[11px] font-black text-gray-400 uppercase ml-1 tracking-widest" />
                                <x-text-input id="contact_number" name="contact_number" type="text" class="mt-2 block w-full rounded-2xl border-white/50 bg-white/40 focus:bg-white focus:ring-blue-100 transition-all font-bold text-blue-900" value="{{ Auth::user()->profile->number ?? '' }}" required />
                            </div>

                            <div>
                                <x-input-label for="product_image" :value="__('Product Image')" class="text-[11px] font-black text-gray-400 uppercase ml-1 tracking-widest" />
                                <div class="mt-2 flex items-center justify-center w-full relative">
                                    <label for="product_image" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-blue-200 rounded-2xl cursor-pointer bg-white/30 hover:bg-white/50 transition-all overflow-hidden relative">
                                        <div id="upload-prompt" class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                                            <p class="text-xs text-blue-600 font-bold">Click to upload image</p>
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

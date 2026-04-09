<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
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
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Home
                </a>
                <h1 class="text-4xl font-black text-white mb-2">📋 Submit a Report</h1>
                <p class="text-blue-200">Help us maintain a safe and trustworthy marketplace</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-8 bg-green-500 text-white px-8 py-4 rounded-2xl shadow-2xl shadow-green-500/30 flex items-center space-x-3 animate-bounce">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-black tracking-wide text-lg">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="mb-8 bg-red-500 text-white px-8 py-4 rounded-2xl shadow-2xl shadow-red-500/30 flex items-center space-x-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="font-black tracking-wide text-lg">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Report Form -->
            <div class="glass-container shadow-2xl p-8 md:p-12 border border-white/10">
                <form action="{{ route('reports.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <!-- Report Type Selection -->
                    <div>
                        <x-input-label :value="__('What are you reporting?')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-3" />
                        <div class="grid grid-cols-3 gap-4">
                            <label class="relative">
                                <input type="radio" name="report_type" value="product" class="peer sr-only" onchange="toggleFields()" required/>
                                <div class="peer-checked:bg-blue-600/30 peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-500 bg-white/5 border border-white/10 rounded-2xl p-4 cursor-pointer transition-all text-center hover:border-white/20">
                                    <span class="text-2xl block mb-2">📦</span>
                                    <span class="text-white font-bold text-sm">Product Issue</span>
                                </div>
                            </label>
                            <label class="relative">
                                <input type="radio" name="report_type" value="user" class="peer sr-only" onchange="toggleFields()" />
                                <div class="peer-checked:bg-blue-600/30 peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-500 bg-white/5 border border-white/10 rounded-2xl p-4 cursor-pointer transition-all text-center hover:border-white/20">
                                    <span class="text-2xl block mb-2">👤</span>
                                    <span class="text-white font-bold text-sm">User Behavior</span>
                                </div>
                            </label>
                            <label class="relative">
                                <input type="radio" name="report_type" value="other" class="peer sr-only" onchange="toggleFields()" />
                                <div class="peer-checked:bg-blue-600/30 peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-500 bg-white/5 border border-white/10 rounded-2xl p-4 cursor-pointer transition-all text-center hover:border-white/20">
                                    <span class="text-2xl block mb-2">⚠️</span>
                                    <span class="text-white font-bold text-sm">Other Issue</span>
                                </div>
                            </label>
                        </div>
                        @error('report_type')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Selection (hidden by default) -->
                    <div id="productField" class="hidden">
                        <x-input-label for="product_id" :value="__('Which product?')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                        <select id="product_id" name="product_id" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white">
                            <option value="">Select a product...</option>
                            @foreach($products ?? [] as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->title }} - ${{ $product->price }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- User Selection (hidden by default) -->
                    <div id="userField" class="hidden">
                        <x-input-label for="reported_user_id" :value="__('Which user?')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                        <input type="text" id="userSearchInput" placeholder="Search username or email..." class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500 p-3" />
                        <select id="reported_user_id" name="reported_user_id" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white">
                            <option value="">Select a user...</option>
                            @foreach($users ?? [] as $user)
                                <option value="{{ $user->id }}" {{ old('reported_user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('reported_user_id')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Reason -->
                    <div>
                        <x-input-label for="reason" :value="__('Reason for Report')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                        <select id="reason" name="reason" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white" required>
                            <option value="">Select a reason...</option>
                            <option value="Fake Product" {{ old('reason') == 'Fake Product' ? 'selected' : '' }}>🚫 Fake Product</option>
                            <option value="Damaged Item" {{ old('reason') == 'Damaged Item' ? 'selected' : '' }}>📦 Damaged Item</option>
                            <option value="Incorrect Description" {{ old('reason') == 'Incorrect Description' ? 'selected' : '' }}>📝 Incorrect Description</option>
                            <option value="Fraud" {{ old('reason') == 'Fraud' ? 'selected' : '' }}>💳 Fraud</option>
                            <option value="Spam" {{ old('reason') == 'Spam' ? 'selected' : '' }}>📧 Spam</option>
                            <option value="Harassment" {{ old('reason') == 'Harassment' ? 'selected' : '' }}>😠 Harassment</option>
                            <option value="Inappropriate Content" {{ old('reason') == 'Inappropriate Content' ? 'selected' : '' }}>⚠️ Inappropriate Content</option>
                            <option value="Other" {{ old('reason') == 'Other' ? 'selected' : '' }}>❓ Other</option>
                        </select>
                        @error('reason')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Detailed Description')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                        <textarea id="description" name="description" rows="8" class="mt-2 block w-full rounded-3xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500 border-none outline-none focus:ring-1 p-4" placeholder="Provide as much detail as possible to help us understand the issue..." required>{{ old('description') }}</textarea>
                        <p class="text-gray-400 text-xs mt-2">Max 2000 characters</p>
                        @error('description')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-blue-500/20 hover:scale-[1.01] transition-all active:scale-95 btn-glow flex items-center justify-center">
                            <span>📤 Submit Report</span>
                        </button>
                    </div>
                </form>

                <!-- My Reports Link -->
                <div class="mt-8 pt-8 border-t border-white/10">
                    <p class="text-gray-400 mb-3">Want to check on your previous reports?</p>
                    <a href="{{ route('reports.my-reports') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition font-bold">
                        View My Reports
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const products = @json($products ?? []);
        const users = @json($users ?? []);

        function toggleFields() {
            const reportType = document.querySelector('input[name="report_type"]:checked')?.value;
            document.getElementById('productField').classList.toggle('hidden', reportType !== 'product');
            document.getElementById('userField').classList.toggle('hidden', reportType !== 'user');
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            const reportType = document.querySelector('input[name="report_type"]:checked')?.value;
            if (reportType) toggleFields();
        });

        // User search functionality
        document.getElementById('userSearchInput')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const select = document.getElementById('reported_user_id');
            const options = select.querySelectorAll('option:not(:first-child)');
            
            options.forEach(option => {
                const text = option.textContent.toLowerCase();
                option.hidden = !text.includes(searchTerm);
            });
        });
    </script>
</x-app-layout>

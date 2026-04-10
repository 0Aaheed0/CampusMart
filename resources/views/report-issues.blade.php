<x-app-layout>
    <style>
        .glass-container {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
        }
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%233b5bdb'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
        }
        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(59, 91, 219, 0.4);
            transform: translateY(-2px);
        }
        input::placeholder, textarea::placeholder {
            color: #64748b;
        }
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen flex items-center justify-center p-4">
        <div class="max-w-2xl w-full">
            <div class="glass-container shadow-2xl p-8 md:p-12">
                <!-- Header Section -->
                <div class="text-center mb-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#3b5bdb] to-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-[#3b5bdb]/20">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-black text-white tracking-tight uppercase">Report an Issue</h1>
                    <p class="text-blue-400 font-bold mt-2 opacity-80">Help us keep CampusMart safe</p>
                </div>

                <!-- Form Section -->
                <form method="POST" action="{{ route('reports.store') }}" class="space-y-6">
                    @csrf

                    <!-- Report Type -->
                    <div>
                        <label for="report_type" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest block mb-2">Report Type</label>
                        <select id="report_type" name="report_type" onchange="toggleReportFields()" class="mt-1 block w-full rounded-2xl border-none bg-[#0f172a] focus:ring-2 focus:ring-[#3b5bdb] transition-all font-bold text-white px-4 py-4 cursor-pointer" required>
                            <option value="">-- Select Report Type --</option>
                            <option value="product">Product Issue</option>
                            <option value="user">Report a User</option>
                            <option value="other">Other Issue</option>
                        </select>
                        @error('report_type')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product ID (Visible for product and user types) -->
                    <div id="product_id_container" class="hidden">
                        <label for="product_id" id="product_id_label" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest block mb-2">Product ID</label>
                        <input id="product_id" name="product_id" type="number" class="mt-1 block w-full rounded-2xl border-none bg-[#0f172a] focus:ring-2 focus:ring-[#3b5bdb] transition-all font-bold text-white px-4 py-4" placeholder="Enter Product ID" />
                        <p id="product_id_hint" class="text-xs text-gray-400 mt-1"></p>
                        @error('product_id')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Reason -->
                    <div>
                        <label for="reason" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest block mb-2">Reason/Category</label>
                        <input id="reason" name="reason" type="text" class="mt-1 block w-full rounded-2xl border-none bg-[#0f172a] focus:ring-2 focus:ring-[#3b5bdb] transition-all font-bold text-white px-4 py-4" placeholder="e.g. Fake Product, Spam, Inappropriate Content, Harassment" required />
                        @error('reason')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest block mb-2">Detailed Description</label>
                        <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-3xl border-none bg-[#0f172a] focus:ring-2 focus:ring-[#3b5bdb] transition-all font-bold text-white p-4 outline-none resize-none" placeholder="Please describe the issue in detail..." required></textarea>
                        @error('description')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#3b5bdb] text-white py-5 rounded-2xl font-black text-lg shadow-xl shadow-[#3b5bdb]/20 hover:scale-[1.01] transition-all active:scale-95 btn-glow uppercase tracking-widest">
                            Submit Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleReportFields() {
            const reportType = document.getElementById('report_type').value;
            const productContainer = document.getElementById('product_id_container');
            const productLabel = document.getElementById('product_id_label');
            const productHint = document.getElementById('product_id_hint');
            const productInput = document.getElementById('product_id');

            if (reportType === 'product') {
                productContainer.classList.remove('hidden');
                productLabel.textContent = 'Product ID Being Reported';
                productHint.textContent = 'Enter the ID of the product with an issue';
                productInput.required = true;
            } else if (reportType === 'user') {
                productContainer.classList.remove('hidden');
                productLabel.textContent = 'Product ID (to identify user)';
                productHint.textContent = 'Enter a product ID posted by the user to identify them';
                productInput.required = true;
            } else if (reportType === 'other') {
                productContainer.classList.add('hidden');
                productInput.required = false;
            }
        }

        // Initialize state on load
        document.addEventListener('DOMContentLoaded', toggleReportFields);
    </script>
</x-app-layout>

<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
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
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#3b5bdb] rounded-full blur-[120px] opacity-10 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-10 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-8 bg-green-500/20 border border-green-500/50 text-green-200 px-6 py-4 rounded-2xl flex items-center space-x-3">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="glass-container shadow-2xl p-8 md:p-12 border border-white/10 bg-[#1e293b]/50">
                <div class="text-center mb-10">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#3b5bdb] to-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-[#3b5bdb]/20">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-black text-white tracking-tight">Report an Issue</h1>
                    <p class="text-blue-300 font-bold mt-2 opacity-80">Help us keep CampusMart safe</p>
                </div>

                <form action="{{ route('reports.store') }}" method="POST" class="space-y-6" id="reportForm">
                    @csrf
                    
                    <!-- Report Type -->
                    <div>
                        <x-input-label for="report_type" :value="__('What are you reporting?')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-2" />
                        <select id="report_type" name="report_type" onchange="toggleReportFields()" class="mt-1 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-[#3b5bdb]/50 focus:border-[#3b5bdb] transition-all font-bold text-white px-4 py-3" required>
                            <option value="product" class="bg-[#0f172a]">Product</option>
                            <option value="user" class="bg-[#0f172a]">User</option>
                            <option value="other" class="bg-[#0f172a]">Other</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('report_type')" />
                    </div>

                    <!-- Product ID -->
                    <div id="product_id_container">
                        <x-input-label for="product_id" :value="__('Product ID (if reporting a product)')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-2" />
                        <x-text-input id="product_id" name="product_id" type="text" class="mt-1 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-[#3b5bdb]/50 focus:border-[#3b5bdb] transition-all font-bold text-white placeholder-slate-500 px-4 py-3" :value="old('product_id')" placeholder="Enter Product ID" />
                        <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
                    </div>

                    <!-- Reported User ID -->
                    <div id="user_id_container" class="hidden">
                        <x-input-label for="reported_user_id" :value="__('Reported User ID (if reporting a user)')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-2" />
                        <x-text-input id="reported_user_id" name="reported_user_id" type="text" class="mt-1 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-[#3b5bdb]/50 focus:border-[#3b5bdb] transition-all font-bold text-white placeholder-slate-500 px-4 py-3" :value="old('reported_user_id')" placeholder="Enter User ID" />
                        <x-input-error class="mt-2" :messages="$errors->get('reported_user_id')" />
                    </div>

                    <!-- Reason -->
                    <div>
                        <x-input-label for="reason" :value="__('Reason')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-2" />
                        <x-text-input id="reason" name="reason" type="text" class="mt-1 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-[#3b5bdb]/50 focus:border-[#3b5bdb] transition-all font-bold text-white placeholder-slate-500 px-4 py-3" :value="old('reason')" placeholder="e.g. Fake Product, Spam, Harassment" required />
                        <x-input-error class="mt-2" :messages="$errors->get('reason')" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Detailed Description')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-2" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-3xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-[#3b5bdb]/50 focus:border-[#3b5bdb] transition-all font-bold text-white placeholder-slate-500 p-4 border border-white/10 outline-none" placeholder="Provide as much detail as possible to help us understand the issue..." required>{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" class="w-full bg-gradient-to-r from-[#3b5bdb] to-indigo-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-[#3b5bdb]/20 hover:scale-[1.01] transition-all active:scale-95 btn-glow flex items-center justify-center space-x-2">
                            <span>Submit Report</span>
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
            const userContainer = document.getElementById('user_id_container');
            const productInput = document.getElementById('product_id');
            const userInput = document.getElementById('reported_user_id');

            if (reportType === 'product') {
                productContainer.classList.remove('hidden');
                userContainer.classList.add('hidden');
                productInput.required = true;
                userInput.required = false;
            } else if (reportType === 'user') {
                productContainer.classList.remove('hidden');
                userContainer.classList.add('hidden');
                productInput.required = true;
                productInput.placeholder = 'Enter Product ID to identify the user';
                userInput.required = false;
            } else {
                productContainer.classList.add('hidden');
                userContainer.classList.add('hidden');
                productInput.required = false;
                userInput.required = false;
            }
        }

        // Run once on load to set initial state
        document.addEventListener('DOMContentLoaded', function() {
            toggleReportFields();
            
            // Handle form submission with AJAX
            const form = document.getElementById('reportForm');
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                
                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Show success toast
                        showSuccessToast(data.message);
                        
                        // Reset form
                        form.reset();
                        toggleReportFields();
                        
                        // Clear any previous errors
                        document.querySelectorAll('.text-red-500').forEach(el => {
                            el.textContent = '';
                        });
                    } else {
                        showErrorToast(data.message || 'An error occurred');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showErrorToast('Failed to submit report. Please try again.');
                }
            });
        });
        
        function showSuccessToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-green-500/20 border border-green-500/50 text-green-200 px-6 py-4 rounded-2xl flex items-center space-x-3 z-50';
            toast.innerHTML = `
                <svg class="w-6 h-6 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-bold">${message}</span>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
        
        function showErrorToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-red-500/20 border border-red-500/50 text-red-200 px-6 py-4 rounded-2xl flex items-center space-x-3 z-50';
            toast.innerHTML = `
                <svg class="w-6 h-6 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span class="font-bold">${message}</span>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
    </script>
</x-app-layout>

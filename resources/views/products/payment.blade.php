<x-app-layout>
    <style>
        .page-bg {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
        }

        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: #3b82f6;
            filter: blur(140px);
            opacity: 0.15;
            border-radius: 50%;
            animation: move 20s infinite alternate;
        }

        .blob2 { right: -150px; bottom: -150px; background: #22c55e; }
        .blob3 { left: -150px; top: -150px; background: #60a5fa; }

        @keyframes move {
            from { transform: translate(0, 0) }
            to { transform: translate(80px, 60px) }
        }

        .payment-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .input-group label {
            display: block;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 0.5rem;
        }

        .input-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .input-group textarea:focus {
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            outline: none;
        }

        .payment-option {
            border: 2px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .payment-option.active {
            border-color: #22c55e;
            background: rgba(34, 197, 94, 0.1);
        }

        .payment-option:hover:not(.active) {
            background: rgba(255, 255, 255, 0.08);
        }
    </style>

    <div class="py-12 page-bg min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="mb-8">
                <a href="{{ route('products.available') }}" class="text-white flex items-center hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to products
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Order Summary -->
                <div class="payment-card p-6 h-fit text-white">
                    <h2 class="text-xl font-bold mb-6">Order Summary</h2>
                    
                    <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-white/10">
                        <div class="w-20 h-20 bg-white/10 rounded-lg overflow-hidden flex-shrink-0">
                            @if($product->product_image)
                                <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-500/20">
                                    <svg class="h-8 w-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold">{{ $product->product_name }}</h3>
                            <p class="text-sm text-blue-200">{{ $product->product_type }}</p>
                            <p class="text-green-400 font-bold mt-1 text-lg">৳{{ number_format($product->price) }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between text-blue-100/70">
                            <span>Subtotal</span>
                            <span>৳{{ number_format($product->price) }}</span>
                        </div>
                        <div class="flex justify-between text-blue-100/70">
                            <span>Convenience Fee</span>
                            <span>৳0</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-white/10 text-xl font-black text-white">
                            <span>Total</span>
                            <span>৳{{ number_format($product->price) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Main Action Area: Address & Payment -->
                <div class="payment-card p-6 h-fit text-white">
                    <form id="paymentForm" class="space-y-8">
                        <!-- Address Section -->
                        <div>
                            <h2 class="text-xl font-bold mb-4">Delivery Address</h2>
                            <div class="input-group">
                                <label>Street Address</label>
                                <textarea id="address" rows="3" placeholder="Enter your full address inside or outside campus..." required></textarea>
                            </div>
                        </div>

                                <!-- Mobile Banking (bKash/Nagad) -->
                                <div class="payment-option flex items-center justify-between p-4 border-2 border-white/10 rounded-xl cursor-pointer transition-all hover:bg-white/5" onclick="selectOption(this, 'mobile')">
                                    <div class="flex items-center">
                                        <div class="w-14 h-14 mr-4 bg-gradient-to-tr from-rose-500 via-pink-500 to-orange-400 rounded-2xl flex items-center justify-center text-white shadow-[0_8px_20px_-4px_rgba(244,63,94,0.4)] border border-white/30 relative overflow-hidden group-hover:scale-105 transition-transform">
                                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.4),transparent)] opacity-70"></div>
                                            <svg class="w-8 h-8 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-bold text-white block text-lg">Bkash/Nagad</span>
                                        </div>
                                    </div>
                                    <div class="tick-container w-6 h-6 rounded-full border-2 border-white/20 flex items-center justify-center transition-all">
                                        <svg class="w-4 h-4 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Card Payment -->
                                <div class="payment-option flex items-center justify-between p-4 border-2 border-white/10 rounded-xl cursor-pointer transition-all hover:bg-white/5" onclick="selectOption(this, 'card')">
                                    <div class="flex items-center">
                                        <div class="w-14 h-14 mr-4 bg-gradient-to-tr from-blue-600 via-indigo-600 to-violet-500 rounded-2xl flex items-center justify-center text-white shadow-[0_8px_20px_-4px_rgba(79,70,229,0.4)] border border-white/30 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.4),transparent)] opacity-70"></div>
                                            <svg class="w-8 h-8 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-bold text-white block text-lg">Card Payment</span>
                                        </div>
                                    </div>
                                    <div class="tick-container w-6 h-6 rounded-full border-2 border-white/20 flex items-center justify-center transition-all">
                                        <svg class="w-4 h-4 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Cash on Delivery -->
                                <div class="payment-option flex items-center justify-between p-4 border-2 border-white/10 rounded-xl cursor-pointer transition-all hover:bg-white/5" onclick="selectOption(this, 'cod')">
                                    <div class="flex items-center">
                                        <div class="w-14 h-14 mr-4 bg-gradient-to-tr from-emerald-500 via-teal-500 to-cyan-400 rounded-2xl flex items-center justify-center text-white shadow-[0_8px_20px_-4px_rgba(16,185,129,0.4)] border border-white/30 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.4),transparent)] opacity-70"></div>
                                            <svg class="w-8 h-8 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-bold text-white block text-lg">Cash on Delivery</span>
                                        </div>
                                    </div>
                                    <div class="tick-container w-6 h-6 rounded-full border-2 border-white/20 flex items-center justify-center transition-all">
                                        <svg class="w-4 h-4 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            <button type="submit" id="submitBtn" class="w-full bg-blue-600 text-white font-black py-4 rounded-xl hover:bg-blue-700 transition shadow-lg text-lg flex items-center justify-center">
                                <span id="btnText">Place Order</span>
                                <div id="btnLoader" class="hidden ml-3">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </form>

                    <p class="mt-6 text-xs text-center text-blue-200/50">
                        Secure transaction powered by CampusMart.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Success Modal -->
    <div id="successModal" class="fixed inset-0 z-[100] hidden items-center justify-center px-4">
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
        <div class="payment-card max-w-sm w-full p-8 text-center relative z-10 border-green-500/30">
            <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-[0_0_20px_rgba(34,197,94,0.4)]">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-2xl font-black text-white mb-2">Order Placed!</h3>
            <p class="text-blue-100 mb-8">Your order has been recorded. The seller will contact you shortly.</p>
            <button onclick="window.location.href='{{ route('products.available') }}'" class="w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 transition">
                Return to Shop
            </button>
        </div>
    </div>

    <script>
        function selectOption(element, method) {
            // Update UI
            document.querySelectorAll('.payment-option').forEach(o => {
                o.classList.remove('active');
                o.classList.add('border-white/10');
                o.classList.remove('border-green-500', 'bg-green-500/10');
                const tick = o.querySelector('.tick-container');
                tick.classList.remove('bg-green-500', 'border-green-500');
                tick.classList.add('bg-transparent', 'border-white/20');
                tick.querySelector('svg').classList.add('hidden');
            });

            element.classList.add('active');
            element.classList.remove('border-white/10');
            element.classList.add('border-green-500', 'bg-green-500/10');
            const activeTick = element.querySelector('.tick-container');
            activeTick.classList.remove('bg-transparent', 'border-white/20');
            activeTick.classList.add('bg-green-500', 'border-green-500');
            activeTick.querySelector('svg').classList.remove('hidden');
        }

        document.getElementById('paymentForm').onsubmit = function(e) {
            e.preventDefault();
            const addr = document.getElementById('address').value;
            if(!addr) return;

            const btn = document.getElementById('submitBtn');
            const text = document.getElementById('btnText');
            const loader = document.getElementById('btnLoader');

            // Loading state
            btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed');
            text.innerText = 'Processing...';
            loader.classList.remove('hidden');

            setTimeout(() => {
                document.getElementById('successModal').classList.remove('hidden');
                document.getElementById('successModal').classList.add('flex');
            }, 3000);
        };
    </script>
</x-app-layout>

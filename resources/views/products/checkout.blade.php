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
    </style>

    <div class="py-12 page-bg min-h-screen relative overflow-hidden">
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-4xl font-black text-white tracking-tight">Checkout</h1>
                <p class="text-blue-100 mt-2">Review your items and complete the payment</p>
            </div>

            <!-- Checkout Form -->
            <form action="{{ route('payment.process') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Order Items -->
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20">
                    <h2 class="text-2xl font-black text-white mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        @foreach($products as $product)
                            <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
                            <div class="flex items-center justify-between p-4 bg-white/10 rounded-lg border border-white/10">
                                <div class="flex-1">
                                    <p class="font-bold text-white">{{ $product->product_name }}</p>
                                    <p class="text-blue-100 text-sm">{{ $product->product_type }} • {{ $product->condition }}</p>
                                    <p class="text-xs text-blue-200 mt-1">Seller: {{ $product->user->name ?? 'Admin' }}</p>
                                </div>
                                <p class="font-black text-white text-lg">৳{{ number_format($product->price) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total -->
                    <div class="pt-6 border-t border-white/20">
                        <div class="flex justify-between items-center">
                            <p class="text-blue-100 text-lg">Total Amount</p>
                            <p class="text-4xl font-black text-green-400">৳{{ number_format($totalAmount) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20">
                    <h2 class="text-2xl font-black text-white mb-6">Payment Method</h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-4 bg-white/10 rounded-lg border-2 border-white/30 cursor-pointer hover:border-white/50 transition-all group">
                            <input type="radio" name="payment_method" value="card" checked class="w-5 h-5 text-blue-500 cursor-pointer">
                            <span class="ml-3 text-white font-bold group-hover:text-blue-100 transition-colors">💳 Credit/Debit Card</span>
                        </label>
                        <label class="flex items-center p-4 bg-white/10 rounded-lg border-2 border-white/30 cursor-pointer hover:border-white/50 transition-all group">
                            <input type="radio" name="payment_method" value="mobile_banking" class="w-5 h-5 text-green-500 cursor-pointer">
                            <span class="ml-3 text-white font-bold group-hover:text-blue-100 transition-colors">📱 Mobile Banking (bKash, Nagad, Rocket)</span>
                        </label>
                        <label class="flex items-center p-4 bg-white/10 rounded-lg border-2 border-white/30 cursor-pointer hover:border-white/50 transition-all group">
                            <input type="radio" name="payment_method" value="bank_transfer" class="w-5 h-5 text-purple-500 cursor-pointer">
                            <span class="ml-3 text-white font-bold group-hover:text-blue-100 transition-colors">🏦 Bank Transfer</span>
                        </label>
                    </div>
                </div>

                <!-- Notes (Optional) -->
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20">
                    <h2 class="text-2xl font-black text-white mb-6">Additional Notes</h2>
                    <textarea name="notes" placeholder="Add any special instructions or notes for this order..." 
                              class="w-full bg-white/20 border border-white/30 text-white placeholder-blue-200 rounded-xl py-4 px-4 focus:ring-2 focus:ring-white/50 focus:border-transparent transition-all resize-none"
                              rows="4"></textarea>
                </div>

                <!-- Terms & Conditions -->
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20">
                    <label class="flex items-start gap-4 cursor-pointer group">
                        <input type="checkbox" name="terms" required class="w-6 h-6 mt-1 text-blue-500 cursor-pointer flex-shrink-0">
                        <span class="text-white/80 group-hover:text-white transition-colors">
                            I agree to the <span class="font-bold">Terms & Conditions</span> and confirm that this purchase is legitimate. I understand that CampusMart is not responsible for items after delivery.
                        </span>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <a href="{{ route('products.available') }}" class="flex-1 text-center bg-white/20 text-white px-8 py-4 rounded-2xl font-black hover:bg-white/30 transition-all border border-white/30">
                        ← Continue Shopping
                    </a>
                    <button type="submit" class="flex-1 bg-green-500 text-white px-8 py-4 rounded-2xl font-black hover:bg-green-600 transition-all shadow-lg">
                        Complete Payment →
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

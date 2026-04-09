<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.15);
        }

        .payment-option {
            position: relative;
            transition: all 0.3s ease;
        }

        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .payment-option input[type="radio"]:checked + label {
            background: rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.8);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
        }

        .payment-option label {
            display: block;
            padding: 20px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.04);
        }

        .payment-option label:hover {
            border-color: rgba(59, 130, 246, 0.4);
            background: rgba(255, 255, 255, 0.08);
        }

        .item-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 16px;
            padding: 16px;
            transition: all 0.3s ease;
        }

        .item-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(59, 130, 246, 0.5);
        }

        .terms-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 24px;
            height: 24px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .terms-checkbox:checked {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-color: #3b82f6;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 16px 32px;
            border-radius: 16px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 16px 32px;
            border-radius: 16px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 16px;
            border-radius: 12px;
            font-family: inherit;
            font-size: 16px;
            resize: none;
            transition: all 0.3s ease;
        }

        .textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .textarea:focus {
            outline: none;
            border-color: rgba(59, 130, 246, 0.6);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
        }

        .section-badge {
            display: inline-block;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.4);
            color: #93c5fd;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .total-section {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(99, 102, 241, 0.1));
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 20px;
            padding: 24px;
        }
    </style>

    <div class="py-12 min-h-screen relative overflow-hidden bg-[#0f172a]">
        <!-- Background Effects -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-5xl font-black text-white tracking-tight mb-2">🛒 Checkout</h1>
                <p class="text-blue-200 text-lg">Review your items and complete your payment securely</p>
            </div>

            <!-- Checkout Form -->
            <form action="{{ route('payment.process') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Order Summary -->
                <div class="glass-container shadow-2xl p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="section-badge">📦 ORDER SUMMARY</div>
                    </div>
                    
                    <div class="space-y-4 mb-8">
                        @foreach($products as $product)
                            <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
                            <div class="item-card">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1">
                                        <p class="font-bold text-white text-lg">{{ $product->product_name }}</p>
                                        <p class="text-blue-300 text-sm mt-1">
                                            📦 {{ $product->product_type }} • ⭐ {{ $product->condition }}
                                        </p>
                                        <p class="text-gray-400 text-xs mt-2">👤 Seller: {{ $product->user->name ?? 'Admin' }}</p>
                                    </div>
                                    <p class="font-black text-green-400 text-2xl">৳{{ number_format($product->price) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total Amount -->
                    <div class="total-section">
                        <div class="flex justify-between items-center">
                            <p class="text-blue-200 text-lg font-bold">Total Amount</p>
                            <p class="text-4xl font-black text-green-400">৳{{ number_format($totalAmount) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <div class="glass-container shadow-2xl p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="section-badge">💳 PAYMENT METHOD</div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="payment-option">
                            <input type="radio" id="card" name="payment_method" value="card" checked>
                            <label for="card" class="flex items-center gap-4">
                                <div class="text-2xl">💳</div>
                                <div>
                                    <p class="font-bold text-white text-lg">Credit/Debit Card</p>
                                    <p class="text-blue-300 text-sm">Visa, Mastercard, or American Express</p>
                                </div>
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" id="mobile" name="payment_method" value="mobile_banking">
                            <label for="mobile" class="flex items-center gap-4">
                                <div class="text-2xl">📱</div>
                                <div>
                                    <p class="font-bold text-white text-lg">Mobile Banking</p>
                                    <p class="text-blue-300 text-sm">bKash, Nagad, Rocket, or Upay</p>
                                </div>
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" id="bank" name="payment_method" value="bank_transfer">
                            <label for="bank" class="flex items-center gap-4">
                                <div class="text-2xl">🏦</div>
                                <div>
                                    <p class="font-bold text-white text-lg">Bank Transfer</p>
                                    <p class="text-blue-300 text-sm">Direct bank transfer or cheque</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="glass-container shadow-2xl p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="section-badge">📝 NOTES (OPTIONAL)</div>
                    </div>
                    
                    <textarea name="notes" placeholder="Add any special instructions or delivery notes for this order..." 
                              class="textarea"
                              rows="5"></textarea>
                </div>

                <!-- Terms & Conditions -->
                <div class="glass-container shadow-2xl p-8">
                    <label class="flex items-start gap-4 cursor-pointer group">
                        <input type="checkbox" name="terms" required class="terms-checkbox mt-1">
                        <span class="text-white/90 group-hover:text-white transition-colors leading-relaxed">
                            I agree to the <span class="font-bold text-blue-300">Terms & Conditions</span> and confirm that this purchase is legitimate. I understand that CampusMart is a community marketplace and is not responsible for items after delivery. I will inspect items before confirming receipt.
                        </span>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pb-8">
                    <a href="{{ route('products.available') }}" class="flex-1 text-center btn-secondary">
                        ← Continue Shopping
                    </a>
                    <button type="submit" class="flex-1 btn-primary">
                        Complete Payment →
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

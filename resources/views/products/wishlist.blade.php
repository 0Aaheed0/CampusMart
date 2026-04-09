<x-app-layout>
    <style>
        .glass-bg {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .product-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .product-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
        }

        .badge-Electronics { background: rgba(59, 130, 246, 0.2); color: #93c5fd; border: 1px solid #3b82f6; }
        .badge-Books { background: rgba(16, 185, 129, 0.2); color: #86efac; border: 1px solid #10b981; }
        .badge-Stationery { background: rgba(245, 158, 11, 0.2); color: #fcd34d; border: 1px solid #f59e0b; }
        .badge-Furniture { background: rgba(120, 53, 15, 0.2); color: #f5dab1; border: 1px solid #78350f; }
        .badge-Household { background: rgba(99, 102, 241, 0.2); color: #c7d2fe; border: 1px solid #6366f1; }
        .badge-Musical { background: rgba(236, 72, 153, 0.2); color: #f472b6; border: 1px solid #ec4899; }
        .badge-Fashion { background: rgba(139, 92, 246, 0.2); color: #d8b4fe; border: 1px solid #8b5cf6; }
        .badge-Sports { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid #ef4444; }
        .badge-Other { background: rgba(107, 114, 128, 0.2); color: #d1d5db; border: 1px solid #6b7280; }

        .cond-New { background: rgba(34, 197, 94, 0.1); color: #86efac; border: 1px solid #22c55e; }
        .cond-Excellent { background: rgba(20, 184, 166, 0.1); color: #7ee8c0; border: 1px solid #14b8a6; }
        .cond-Good { background: rgba(59, 130, 246, 0.1); color: #93c5fd; border: 1px solid #3b82f6; }
        .cond-Fair { background: rgba(245, 158, 11, 0.1); color: #fcd34d; border: 1px solid #f59e0b; }
        .cond-Poor { background: rgba(239, 68, 68, 0.1); color: #fca5a5; border: 1px solid #ef4444; }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: 2px solid #ef4444;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.2);
            transform: translateY(-2px);
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 15px;
            padding: 20px;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.1;
        }
    </style>

    <div class="py-12 min-h-screen relative overflow-hidden bg-[#0f172a]">
        <!-- Background Effects -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-12">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-5xl font-black text-white tracking-tight mb-2">❤️ My Wishlist</h1>
                        <p class="text-blue-200 text-lg">Saved items from CampusMart marketplace</p>
                    </div>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mt-6 glass-container shadow-2xl shadow-green-500/20 p-6 border-l-4 border-green-500 flex items-center gap-4">
                        <svg class="w-8 h-8 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-black text-white">{{ session('success') }}</p>
                            <p class="text-green-200 text-sm">Thank you for your purchase!</p>
                        </div>
                    </div>
                @endif
            </div>

            @if($wishlistItems->isEmpty())
                <div class="glass-container shadow-2xl p-20 text-center">
                    <div class="inline-block bg-gradient-to-br from-blue-500/20 to-indigo-500/20 w-24 h-24 rounded-full flex items-center justify-center mb-8 border border-blue-400/30">
                        <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-3">No items in wishlist</h3>
                    <p class="text-blue-200 mb-10 max-w-md mx-auto text-lg">You haven't added any items to your wishlist yet. Start exploring amazing products!</p>
                    <a href="{{ route('products.available') }}" class="inline-block btn-primary px-10 py-4 rounded-xl text-lg transition-all hover:scale-105">
                        🛍️ Browse Products
                    </a>
                </div>
            @else
                <!-- Selected Items Summary -->
                <div id="selectedSummary" class="glass-container shadow-2xl shadow-blue-500/20 p-8 mb-10 border-l-4 border-blue-500 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                        <div>
                            <p class="text-blue-200 text-sm font-bold mb-2 uppercase tracking-wide">Selected Items</p>
                            <p class="text-4xl font-black text-white"><span id="selectedCount">0</span></p>
                        </div>
                        <div class="hidden md:block text-center border-l border-r border-white/10">
                            <p class="text-blue-200 text-sm font-bold mb-2 uppercase tracking-wide">Total Price</p>
                            <p class="text-4xl font-black text-green-400">৳<span id="totalPrice">0</span></p>
                        </div>
                        <div class="md:text-right">
                            <button type="button" onclick="buySelected()" class="w-full btn-success px-8 py-4 rounded-xl font-black text-lg">
                                💳 Proceed to Payment
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @foreach($wishlistItems as $item)
                        @php $product = $item->product; @endphp
                        <div class="product-card" data-product-id="{{ $product->id }}" data-product-price="{{ $product->price }}">
                            <!-- Image Section -->
                            <div class="relative h-64 bg-gradient-to-br from-blue-600/20 to-indigo-600/20 overflow-hidden flex items-center justify-center border-b border-white/10">
                                @if($product->product_image)
                                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-20 h-20 opacity-30 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif

                                <!-- Badges -->
                                <div class="absolute top-4 left-4 badge-{{ str_replace(' ', '', explode(' ', $product->product_type)[0]) }} px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide backdrop-blur-sm">
                                    {{ $product->product_type }}
                                </div>

                                <!-- Checkbox -->
                                <div class="absolute top-4 right-4">
                                    <input type="checkbox" class="w-7 h-7 rounded-lg cursor-pointer product-checkbox accent-blue-500" data-product-id="{{ $product->id }}" data-product-price="{{ $product->price }}" onchange="updateSummary()">
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-6 space-y-4">
                                <div class="flex justify-between items-start gap-3">
                                    <h3 class="font-black text-xl text-white line-clamp-2">{{ $product->product_name }}</h3>
                                    <span class="badge-{{ str_replace(' ', '', $product->condition) }} px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-tight whitespace-nowrap">
                                        {{ $product->condition }}
                                    </span>
                                </div>

                                <div>
                                    <p class="text-4xl font-black text-green-400">৳{{ number_format($product->price) }}</p>
                                </div>

                                @if($product->description)
                                    <p class="text-gray-300 text-sm line-clamp-2">{{ $product->description }}</p>
                                @endif

                                <!-- Seller Info -->
                                <div class="glass-card p-4 border-l-4 border-blue-500">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-white font-black text-sm">
                                            {{ substr($product->user->name ?? 'C', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-white">{{ $product->user->name ?? 'CampusMart Admin' }}</p>
                                            <p class="text-xs text-blue-400 font-bold">👤 SELLER</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-3 pt-4">
                                    <form action="{{ route('payment.buy', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full btn-primary py-3 rounded-lg font-bold transition-all">
                                            🛒 Buy Now
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full btn-danger py-3 rounded-lg font-bold transition-all">
                                            ✕ Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        function updateSummary() {
            const checkboxes = document.querySelectorAll('.product-checkbox:checked');
            const summary = document.getElementById('selectedSummary');
            
            if (checkboxes.length > 0) {
                summary.classList.remove('hidden');
                let total = 0;
                checkboxes.forEach(checkbox => {
                    total += parseInt(checkbox.dataset.productPrice);
                });
                document.getElementById('selectedCount').textContent = checkboxes.length;
                document.getElementById('totalPrice').textContent = total.toLocaleString('en-BD');
            } else {
                summary.classList.add('hidden');
            }
        }

        function buySelected() {
            const checkboxes = document.querySelectorAll('.product-checkbox:checked');
            const productIds = Array.from(checkboxes).map(cb => cb.dataset.productId);

            if (productIds.length === 0) {
                alert('Please select at least one product');
                return;
            }

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("payment.checkout") }}';
            
            form.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                ${productIds.map((id, index) => `<input type="hidden" name="product_ids[${index}]" value="${id}">`).join('')}
            `;
            
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</x-app-layout>

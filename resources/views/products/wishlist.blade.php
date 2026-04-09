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

        .wishlist-card {
            transition: all 0.3s ease;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .wishlist-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }

        .badge-Electronics { background-color: #3b82f6; color: white; }
        .badge-Books { background-color: #10b981; color: white; }
        .badge-Stationery { background-color: #f59e0b; color: #1e3a8a; }
        .badge-Furniture { background-color: #78350f; color: white; }
        .badge-Household { background-color: #6366f1; color: white; }
        .badge-Musical { background-color: #ec4899; color: white; }
        .badge-Fashion { background-color: #8b5cf6; color: white; }
        .badge-Sports { background-color: #ef4444; color: white; }
        .badge-Other { background-color: #6b7280; color: white; }

        .cond-New { color: #059669; background-color: #ecfdf5; border: 1px solid #10b981; }
        .cond-Excellent { color: #0d9488; background-color: #f0fdfa; border: 1px solid #14b8a6; }
        .cond-Good { color: #2563eb; background-color: #eff6ff; border: 1px solid #3b82f6; }
        .cond-Fair { color: #d97706; background-color: #fffbeb; border: 1px solid #f59e0b; }
        .cond-Poor { color: #dc2626; background-color: #fef2f2; border: 1px solid #ef4444; }
    </style>

    @php
        function getCategoryBadgeClass($category) {
            $cat = str_replace(' ', '', explode(' ', $category)[0]);
            return 'badge-' . $cat;
        }

        function getConditionClass($condition) {
            if (str_contains($condition, 'New')) return 'cond-New';
            if (str_contains($condition, 'Excellent')) return 'cond-Excellent';
            if (str_contains($condition, 'Good')) return 'cond-Good';
            if (str_contains($condition, 'Fair')) return 'cond-Fair';
            if (str_contains($condition, 'Poor')) return 'cond-Poor';
            return 'cond-Good';
        }
    @endphp

    <div class="py-12 page-bg min-h-screen relative overflow-hidden">
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                    <div>
                        <h1 class="text-4xl font-black text-white tracking-tight">My Wishlist</h1>
                        <p class="text-blue-100 mt-2">Saved items from CampusMart marketplace</p>
                    </div>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-500 text-white p-6 mb-8 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce">
                        <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-bold">{{ session('success') }}</p>
                            <p class="text-green-100 text-sm">Thank you for your purchase!</p>
                        </div>
                    </div>
                @endif
            </div>

            @if($wishlistItems->isEmpty())
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-16 text-center border border-white/10">
                    <div class="bg-white/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="h-12 w-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">No items in wishlist</h3>
                    <p class="text-blue-100 mb-8 max-w-md mx-auto">You haven't added any items to your wishlist yet. Start exploring products!</p>
                    <a href="{{ route('products.available') }}" class="inline-block bg-white text-blue-700 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition-all">Browse Products</a>
                </div>
            @else
                <!-- Selected Items Summary -->
                <div id="selectedSummary" class="bg-white/10 backdrop-blur-md rounded-3xl p-6 mb-8 border border-white/20 hidden">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="text-white">
                            <p class="text-sm text-blue-100">Selected Items</p>
                            <p class="text-2xl font-black"><span id="selectedCount">0</span> items</p>
                        </div>
                        <div class="text-white text-right">
                            <p class="text-sm text-blue-100">Total Price</p>
                            <p class="text-3xl font-black text-green-400">৳<span id="totalPrice">0</span></p>
                        </div>
                        <button type="button" onclick="buySelected()" class="bg-green-500 text-white px-8 py-4 rounded-xl font-black hover:bg-green-600 transition-all whitespace-nowrap">
                            Proceed to Payment
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($wishlistItems as $item)
                        @php $product = $item->product; @endphp
                        <div class="wishlist-card" data-product-id="{{ $product->id }}" data-product-price="{{ $product->price }}">
                            <div class="relative">
                                <!-- Image -->
                                <div class="h-64 bg-gradient-to-br from-blue-400 to-purple-500 overflow-hidden flex items-center justify-center">
                                    @if($product->product_image)
                                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="h-20 w-20 opacity-50 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    @endif
                                </div>

                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4 {{ getCategoryBadgeClass($product->product_type) }} px-3 py-1 rounded-lg text-xs font-black uppercase tracking-wider shadow-lg">
                                    {{ $product->product_type }}
                                </div>

                                <!-- Checkbox -->
                                <div class="absolute top-4 right-4">
                                    <input type="checkbox" class="w-6 h-6 rounded cursor-pointer product-checkbox" data-product-id="{{ $product->id }}" data-product-price="{{ $product->price }}" onchange="updateSummary()">
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3 gap-2">
                                    <h3 class="font-black text-xl text-gray-900 line-clamp-1">{{ $product->product_name }}</h3>
                                    <span class="whitespace-nowrap px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-tight {{ getConditionClass($product->condition) }}">
                                        {{ $product->condition }}
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <p class="text-3xl font-black text-blue-700">৳{{ number_format($product->price) }}</p>
                                </div>

                                @if($product->description)
                                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                                        {{ $product->description }}
                                    </p>
                                @endif

                                <!-- Seller Info -->
                                <div class="bg-blue-50/50 p-4 rounded-2xl border border-blue-100/50 mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-black text-sm uppercase">
                                            {{ substr($product->user->name ?? 'C', 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-gray-900">{{ $product->user->name ?? 'CampusMart Admin' }}</p>
                                            <p class="text-xs text-blue-600 font-bold">SELLER</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-3">
                                    <form action="{{ route('payment.buy', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full text-center bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">
                                            Buy Now
                                        </button>
                                    </form>
                                    <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-center border-2 border-red-500 text-red-500 font-bold py-2 rounded-lg hover:bg-red-50 transition">
                                            Remove
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

            // Create a hidden form and submit
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

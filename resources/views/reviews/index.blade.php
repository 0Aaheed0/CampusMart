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
        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            font-size: 2rem;
            color: rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: color 0.2s ease-in-out;
            padding: 0 0.2rem;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #fbbf24;
        }
        
        /* Product dropdown styling */
        #product_id {
            background-color: #000000 !important;
            color: #ffffff !important;
            border: 2px solid #3b82f6 !important;
        }
        
        #product_id option {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
            padding: 8px;
        }
        
        #product_id:hover {
            border-color: #60a5fa !important;
        }
        
        #product_id:focus {
            outline: none;
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
        }
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-8 bg-green-500 text-white px-8 py-4 rounded-2xl shadow-2xl shadow-green-500/30 flex items-center space-x-3 animate-bounce">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-black tracking-wide text-lg">{{ session('success') }}</span>
                </div>
            @endif

            <div class="glass-container shadow-2xl p-8 md:p-12 border border-white/10">
                <h1 class="text-4xl font-black text-white mb-2">Share Your Review</h1>
                <p class="text-blue-200 mb-8">Help other students make informed decisions</p>

                @if($purchasedProducts->count() > 0)
                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="space-y-6">
                            <!-- Product Selection -->
                            <div>
                                <x-input-label for="product_id" :value="__('Select Product to Review')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-3" />
                                <select id="product_id" name="product_id" required>
                                    <option value="">📦 Choose a product from your purchases...</option>
                                    @forelse($purchasedProducts as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            📦 {{ $product->title }} (৳{{ $product->price }})
                                        </option>
                                    @empty
                                        <option disabled>No products found</option>
                                    @endforelse
                                </select>
                                @error('product_id')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Rating Selection -->
                            <div>
                                <x-input-label :value="__('Your Rating')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-3" />
                                <div class="star-rating" id="ratingContainer">
                                    <input type="radio" id="star5" name="rating" value="5" required/>
                                    <label for="star5" title="5 stars - Excellent">★</label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label for="star4" title="4 stars - Good">★</label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label for="star3" title="3 stars - Average">★</label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label for="star2" title="2 stars - Poor">★</label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label for="star1" title="1 star - Very Poor">★</label>
                                </div>
                                @error('rating')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Review Title -->
                            <div>
                                <x-input-label for="title" :value="__('Review Title')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                <x-text-input id="title" name="title" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500" placeholder="e.g. Great quality and fast delivery!" required value="{{ old('title') }}" />
                                @error('title')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Review Comment -->
                            <div>
                                <x-input-label for="comment" :value="__('Your Review')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                                <textarea id="comment" name="comment" rows="6" class="mt-2 block w-full rounded-3xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500 border-none outline-none focus:ring-1 p-4" placeholder="Tell us about your experience with this product...">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-blue-500/20 hover:scale-[1.01] transition-all active:scale-95 btn-glow flex items-center justify-center">
                                <span>✨ Post My Review</span>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-gray-400 text-lg font-semibold mb-2">No Purchases Yet</p>
                        <p class="text-gray-500 text-sm mb-6">You need to make a purchase before you can leave a review.</p>
                        <a href="{{ route('products.available') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-6 rounded-2xl font-bold hover:scale-105 transition">
                            <span class="mr-2">🛍️</span>
                            Browse Available Products
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

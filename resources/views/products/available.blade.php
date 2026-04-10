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

        .product-card {
            transition: all 0.3s ease;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }

        .product-image-container {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .placeholder-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }

        /* Color-coded Badges */
        .badge-Electronics { background-color: #3b82f6; color: white; }
        .badge-Books { background-color: #10b981; color: white; }
        .badge-Stationery { background-color: #f59e0b; color: #1e3a8a; }
        .badge-Furniture { background-color: #78350f; color: white; }
        .badge-Household { background-color: #6366f1; color: white; }
        .badge-Musical { background-color: #ec4899; color: white; }
        .badge-Fashion { background-color: #8b5cf6; color: white; }
        .badge-Sports { background-color: #ef4444; color: white; }
        .badge-Other { background-color: #6b7280; color: white; }

        /* Condition Colors */
        .cond-New { color: #059669; background-color: #ecfdf5; border: 1px solid #10b981; }
        .cond-Excellent { color: #0d9488; background-color: #f0fdfa; border: 1px solid #14b8a6; }
        .cond-Good { color: #2563eb; background-color: #eff6ff; border: 1px solid #3b82f6; }
        .cond-Fair { color: #d97706; background-color: #fffbeb; border: 1px solid #f59e0b; }
        .cond-Poor { color: #dc2626; background-color: #fef2f2; border: 1px solid #ef4444; }

        /* Pagination Styles */
        .pagination-container nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pagination-container .relative.z-0 {
            display: inline-flex;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .pagination-container span[aria-current="page"] span {
            background-color: #1e3a8a !important;
            color: white !important;
            border-color: #1e3a8a !important;
        }
        .pagination-container a, .pagination-container span {
            background-color: white;
            color: #1e3a8a;
            border-color: #e5e7eb;
        }
        .pagination-container a:hover {
            background-color: #f3f4f6;
        }
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
        <!-- Background Blobs -->
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                    <div>
                        <h1 class="text-4xl font-black text-white tracking-tight">Marketplace</h1>
                        <p class="text-blue-100 mt-2">Find or sell items within AUST campus</p>
                    </div>
                    <div class="flex gap-4 flex-col sm:flex-row">
                        <a href="{{ route('wishlist.index') }}" class="bg-red-500 text-white px-8 py-4 rounded-2xl font-black hover:bg-red-600 transition-all shadow-xl flex items-center gap-2 transform active:scale-95 text-center">
                            <svg class="w-5 h-5" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                            My Wishlist
                        </a>
                        <a href="{{ route('products.post') }}" class="bg-white text-blue-700 px-8 py-4 rounded-2xl font-black hover:bg-blue-50 transition-all shadow-xl flex items-center gap-2 transform active:scale-95 text-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            Post Product
                        </a>
                    </div>
                </div>

                <!-- Filters & Search Bar -->
                <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20 shadow-2xl mb-8">
                    <form action="{{ route('products.available') }}" method="GET" class="flex flex-col lg:flex-row gap-4">
                        <!-- Search -->
                        <div class="flex-grow relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search for products (e.g. calculator, books...)" 
                                   class="w-full bg-white/20 border-white/30 text-white placeholder-blue-100 rounded-2xl py-4 pl-12 focus:ring-2 focus:ring-white/50 focus:border-transparent transition-all">
                            <svg class="w-6 h-6 absolute left-4 top-1/2 -translate-y-1/2 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="lg:w-48">
                            <select name="sort" onchange="this.form.submit()" 
                                    class="w-full bg-white/20 border-white/30 text-white rounded-2xl py-4 px-4 focus:ring-2 focus:ring-white/50 focus:border-transparent transition-all appearance-none cursor-pointer">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }} class="text-gray-900">Newest First</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }} class="text-gray-900">Price: Low to High</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }} class="text-gray-900">Price: High to Low</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }} class="text-gray-900">Oldest First</option>
                            </select>
                        </div>

                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-500 transition-all shadow-lg lg:hidden">
                            Search
                        </button>
                    </form>
                </div>

                <!-- Category Filters Pills -->
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.available', request()->only(['search', 'sort'])) }}" 
                       class="px-6 py-2.5 rounded-full font-bold transition-all {{ !request('category') || request('category') == 'All' ? 'bg-white text-blue-700 shadow-xl' : 'bg-white/10 text-white border border-white/20 hover:bg-white/20' }}">
                        All Items
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.available', array_merge(request()->only(['search', 'sort']), ['category' => $category])) }}" 
                           class="px-6 py-2.5 rounded-full font-bold transition-all {{ request('category') == $category ? 'bg-white text-blue-700 shadow-xl' : 'bg-white/10 text-white border border-white/20 hover:bg-white/20' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 mb-8 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Results Info -->
            <div class="flex justify-between items-center mb-6 px-2">
                <p class="text-blue-100 font-medium">
                    Showing <span class="font-bold text-white">{{ $products->firstItem() ?? 0 }}</span> - <span class="font-bold text-white">{{ $products->lastItem() ?? 0 }}</span> of <span class="font-bold text-white">{{ $products->total() }}</span> products
                </p>
            </div>

            <!-- No Products -->
            @if($products->isEmpty())
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-16 text-center border border-white/10">
                    <div class="bg-white/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="h-12 w-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">No matching products</h3>
                    <p class="text-blue-100 mb-8 max-w-md mx-auto">We couldn't find any products matching your search or filter. Try a different keyword or category.</p>
                    <a href="{{ route('products.available') }}" class="inline-block bg-white text-blue-700 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition-all">Clear Filters</a>
                </div>
            @else
                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="product-card group">
                            <!-- Image Container -->
                            <div class="product-image-container">
                                @if($product->product_image)
                                    <img src="{{ str_starts_with($product->product_image, 'http') ? $product->product_image : asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="product-image">
                                @else
                                    <div class="placeholder-image">
                                        <svg class="h-16 w-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($product->product_type == 'Electronics')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            @elseif($product->product_type == 'Books')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            @endif
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4 {{ getCategoryBadgeClass($product->product_type) }} px-3 py-1 rounded-lg text-xs font-black uppercase tracking-wider shadow-lg">
                                    {{ $product->product_type }}
                                </div>
                                
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-blue-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex-grow flex flex-col">
                                <div class="flex justify-between items-start mb-2 gap-2">
                                    <h3 class="font-black text-xl text-gray-900 line-clamp-1 group-hover:text-blue-700 transition-colors">{{ $product->product_name }}</h3>
                                    <span class="whitespace-nowrap px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-tight {{ getConditionClass($product->condition) }}">
                                        {{ $product->condition }}
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <p class="text-3xl font-black text-blue-700">৳{{ number_format($product->price) }}</p>
                                </div>

                                @if($product->description)
                                    <p class="text-gray-500 text-sm mb-4 line-clamp-2 leading-relaxed">
                                        {{ $product->description }}
                                    </p>
                                @endif

                                <div class="mt-auto space-y-3">
                                    @if($product->used_for)
                                        <div class="flex items-center gap-2 text-xs text-gray-400 bg-gray-50 p-2 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <span>Used for {{ $product->used_for }}</span>
                                        </div>
                                    @endif

                                    <!-- Seller Card -->
                                    <div class="bg-blue-50/50 p-4 rounded-2xl border border-blue-100/50">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-black text-sm uppercase">
                                                {{ substr($product->user->name ?? 'C', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900 leading-none mb-1 cursor-pointer hover:text-blue-700 transition" onclick="openUserProfile({{ $product->user->id }})">
                                                    {{ $product->user->name ?? 'CampusMart Admin' }}
                                                </p>
                                                <p class="text-[10px] text-blue-600 font-bold uppercase tracking-widest">POSTER</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mt-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-7 h-7 rounded-lg bg-green-100 flex items-center justify-center text-green-700">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                                                </div>
                                                <span class="text-sm font-black text-gray-800">{{ $product->user->phone ?? $product->contact_number }}</span>
                                            </div>
                                            <span class="text-[10px] text-gray-400 font-medium">{{ $product->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Buy Now & Wishlist Buttons -->
                                <div class="mt-4 flex gap-2">
                                    <form action="{{ route('payment.buy', $product->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full text-center bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">
                                            Buy Now
                                        </button>
                                    </form>
                                    <button type="button" 
                                            onclick="addToWishlist({{ $product->id }}, this)"
                                            id="wishlist-btn-{{ $product->id }}"
                                            class="px-4 py-2 border-2 border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition group wishlist-btn"
                                            data-product-id="{{ $product->id }}">
                                        <svg class="w-5 h-5 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="heart-{{ $product->id }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Script for Wishlist -->
                <script>
                    async function addToWishlist(productId, button) {
                        try {
                            const response = await fetch('{{ route("wishlist.add") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ product_id: productId })
                            });

                            if (response.ok) {
                                const heart = document.getElementById(`heart-${productId}`);
                                button.classList.remove('border-gray-200', 'text-gray-600');
                                button.classList.add('border-red-500', 'text-red-500');
                                heart.setAttribute('fill', 'currentColor');
                                showNotification('Added to wishlist!', 'success');
                            } else {
                                const data = await response.json();
                                showNotification(data.message || 'Already in wishlist', 'error');
                            }
                        } catch (error) {
                            showNotification('Error adding to wishlist', 'error');
                            console.error('Error:', error);
                        }
                    }

                    function showNotification(message, type) {
                        const notification = document.createElement('div');
                        notification.className = `fixed bottom-4 right-4 p-4 rounded-lg text-white font-bold z-50 ${
                            type === 'success' ? 'bg-green-500' : 'bg-red-500'
                        } animate-bounce`;
                        notification.textContent = message;
                        document.body.appendChild(notification);
                        setTimeout(() => notification.remove(), 3000);
                    }

                    // Check which products are in wishlist on page load
                    document.addEventListener('DOMContentLoaded', async () => {
                        const buttons = document.querySelectorAll('.wishlist-btn');
                        for (let button of buttons) {
                            const productId = button.dataset.productId;
                            try {
                                const response = await fetch(`{{ route('wishlist.check', ':id') }}`.replace(':id', productId));
                                const data = await response.json();
                                if (data.in_wishlist) {
                                    const heart = document.getElementById(`heart-${productId}`);
                                    button.classList.remove('border-gray-200', 'text-gray-600');
                                    button.classList.add('border-red-500', 'text-red-500');
                                    heart.setAttribute('fill', 'currentColor');
                                }
                            } catch (error) {
                                console.error('Error checking wishlist:', error);
                            }
                        }
                    });

                    // User Profile Modal
                    function openUserProfile(userId) {
                        const modal = document.getElementById('userProfileModal');
                        const content = document.getElementById('userProfileContent');
                        content.innerHTML = '<div class="flex justify-center items-center h-32"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div></div>';
                        modal.classList.remove('hidden');

                        fetch(`/user/${userId}/popup`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    const user = data.user;
                                    content.innerHTML = `
                                        <div class="space-y-4">
                                            <div class="flex items-center gap-4 pb-4 border-b border-gray-200">
                                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-black text-2xl">
                                                    ${user.name.charAt(0).toUpperCase()}
                                                </div>
                                                <div>
                                                    <h3 class="text-2xl font-black text-gray-900">${user.name}</h3>
                                                    <p class="text-sm text-blue-600 font-semibold">${user.email}</p>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="bg-blue-50 p-4 rounded-lg">
                                                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Phone</p>
                                                    <p class="text-lg font-black text-gray-900">${user.phone}</p>
                                                </div>
                                                <div class="bg-green-50 p-4 rounded-lg">
                                                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Department</p>
                                                    <p class="text-lg font-black text-gray-900">${user.department}</p>
                                                </div>
                                                <div class="bg-purple-50 p-4 rounded-lg">
                                                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Year</p>
                                                    <p class="text-lg font-black text-gray-900">${user.year}</p>
                                                </div>
                                                <div class="bg-orange-50 p-4 rounded-lg">
                                                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Semester</p>
                                                    <p class="text-lg font-black text-gray-900">${user.semester}</p>
                                                </div>
                                                <div class="bg-indigo-50 p-4 rounded-lg">
                                                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Student ID</p>
                                                    <p class="text-lg font-black text-gray-900">${user.student_id}</p>
                                                </div>
                                                <div class="bg-pink-50 p-4 rounded-lg">
                                                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Batch</p>
                                                    <p class="text-lg font-black text-gray-900">${user.batch}</p>
                                                </div>
                                                <div class="bg-teal-50 p-4 rounded-lg">
                                                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Gender</p>
                                                    <p class="text-lg font-black text-gray-900">${user.gender}</p>
                                                </div>
                                            </div>

                                            <div class="border-t border-gray-200 pt-4">
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 p-4 rounded-lg text-center">
                                                        <p class="text-xs text-gray-500 font-semibold uppercase">Products Posted</p>
                                                        <p class="text-3xl font-black text-blue-700">${user.products_posted}</p>
                                                    </div>
                                                    <div class="bg-gradient-to-br from-green-100 to-green-50 p-4 rounded-lg text-center">
                                                        <p class="text-xs text-gray-500 font-semibold uppercase">Products Sold</p>
                                                        <p class="text-3xl font-black text-green-700">${user.products_sold}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                } else {
                                    content.innerHTML = '<p class="text-red-600 font-bold">Failed to load user profile</p>';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                content.innerHTML = '<p class="text-red-600 font-bold">Error loading profile</p>';
                            });
                    }

                    function closeUserProfile() {
                        document.getElementById('userProfileModal').classList.add('hidden');
                    }

                    // Close modal when clicking outside
                    document.getElementById('userProfileModal').addEventListener('click', function(e) {
                        if (e.target === this) {
                            closeUserProfile();
                        }
                    });
                </script>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-16 pagination-container">
                        {{ $products->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- User Profile Modal -->
    <div id="userProfileModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-gradient-to-r from-blue-600 to-blue-700 p-6 flex items-center justify-between rounded-t-3xl">
                <h2 class="text-2xl font-black text-white">👤 User Profile</h2>
                <button onclick="closeUserProfile()" class="text-white hover:bg-blue-800 w-10 h-10 rounded-full flex items-center justify-center transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div id="userProfileContent" class="p-8">
                <div class="flex justify-center items-center h-32">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

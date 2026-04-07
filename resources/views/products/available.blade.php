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
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #10b981;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .product-condition {
            display: inline-block;
            background: #e5e7eb;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            color: #374151;
        }
    </style>

    <div class="py-12 page-bg min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                    <div>
                        <h1 class="text-4xl font-black text-white tracking-tight">Available Products</h1>
                        <p class="text-blue-100 mt-2">Browse and find what you need from your fellow AUST students</p>
                    </div>
                    <a href="{{ route('products.post') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg">+ Post Product</a>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-xl">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Category Filters -->
                <div class="flex flex-wrap gap-3 mb-8">
                    <a href="{{ route('products.available') }}" 
                       class="px-5 py-2 rounded-full font-bold transition-all {{ !request('category') || request('category') == 'All' ? 'bg-white text-blue-600 shadow-md' : 'bg-white/10 text-white border border-white/20 hover:bg-white/20' }}">
                        All
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.available', ['category' => $category]) }}" 
                           class="px-5 py-2 rounded-full font-bold transition-all {{ request('category') == $category ? 'bg-white text-blue-600 shadow-md' : 'bg-white/10 text-white border border-white/20 hover:bg-white/20' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- No Products -->
            @if($products->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-white">No products available yet</h3>
                    <p class="mt-2 text-blue-200 mb-6">Be the first to post a product!</p>
                    <a href="{{ route('products.post') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg">Post the First Product</a>
                </div>
            @else
                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="product-card group relative">
                            <!-- Product Image -->
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                @if($product->product_image)
                                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="product-image">
                                @else
                                    <div class="product-image flex items-center justify-center">
                                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="product-badge">{{ $product->product_type }}</div>
                            </div>

                            <!-- Product Details -->
                            <div class="p-5">
                                <!-- Product Name -->
                                <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">{{ $product->product_name }}</h3>

                                <!-- Price & Condition -->
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="text-2xl font-black text-blue-600">৳{{ number_format($product->price) }}</p>
                                    </div>
                                    <span class="product-condition">{{ $product->condition }}</span>
                                </div>

                                <!-- Description -->
                                @if($product->description)
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                                @endif

                                <!-- Used For -->
                                @if($product->used_for)
                                    <p class="text-gray-500 text-xs mb-3">
                                        <span class="font-semibold">Used for:</span> {{ $product->used_for }}
                                    </p>
                                @endif

                                <!-- Seller Info -->
                                <div class="border-t pt-3 mt-3">
                                    <p class="text-gray-700 font-semibold text-sm">{{ $product->user->name ?? 'Anonymous' }}</p>
                                    <p class="text-gray-600 text-sm">📞 {{ $product->contact_number }}</p>
                                    <p class="text-gray-500 text-xs mt-1">Posted {{ $product->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>

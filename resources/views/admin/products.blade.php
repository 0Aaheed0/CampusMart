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
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
        }
        .product-item {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .product-item:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.15);
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        .status-available {
            background: rgba(34, 197, 94, 0.2);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        .status-sold {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .product-table thead {
            background: rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .product-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #bfdbfe;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .product-table td {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #e0e7ff;
            font-size: 0.875rem;
        }
        .product-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }
        .delete-btn {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .delete-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.5);
        }
        .text-truncate {
            max-width: 400px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="text-4xl font-black text-white mb-2">🛍️ Products Management</h1>
                <p class="text-blue-200">View all product posts submitted by users</p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Total Products</p>
                    <p class="text-3xl font-black text-white">{{ $totalProducts }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Available</p>
                    <p class="text-3xl font-black text-green-400">{{ $availableProducts }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Sold</p>
                    <p class="text-3xl font-black text-red-400">{{ $soldProducts }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Today's Products</p>
                    <p class="text-3xl font-black text-white">{{ $todayProducts }}</p>
                </div>
            </div>

            <!-- Products Table -->
            <div class="glass-container p-8 rounded-3xl overflow-x-auto">
                @if($products->count() > 0)
                    <table class="product-table w-full">
                        <thead>
                            <tr>
                                <th style="width: 18%;">Product Name</th>
                                <th style="width: 10%;">Type</th>
                                <th style="width: 9%;">Price</th>
                                <th style="width: 11%;">Condition</th>
                                <th style="width: 11%;">Used For</th>
                                <th style="width: 14%;">Posted By</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 7%;">Posted</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        <div class="font-semibold text-white">{{ $product->product_name }}</div>
                                        @if($product->description)
                                            <p class="text-xs text-gray-400 text-truncate">{{ $product->description }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="bg-blue-900/30 text-blue-300 px-3 py-1 rounded-lg text-xs font-medium">
                                            {{ $product->product_type }}
                                        </span>
                                    </td>
                                    <td class="font-semibold text-green-400">{{ $product->price ? '৳' . number_format($product->price, 0) : 'N/A' }}</td>
                                    <td>
                                        <span class="bg-purple-900/30 text-purple-300 px-3 py-1 rounded-lg text-xs font-medium">
                                            {{ ucfirst($product->condition) }}
                                        </span>
                                    </td>
                                    <td class="text-gray-300">{{ $product->used_for ?? 'Not specified' }}</td>
                                    <td>
                                        <div class="font-semibold text-blue-300">{{ $product->user->name ?? 'Unknown' }}</div>
                                        <p class="text-xs text-gray-500">{{ $product->user->email ?? 'N/A' }}</p>
                                    </td>
                                    <td>
                                        @if($product->status === 'available')
                                            <span class="status-badge status-available">✓ Available</span>
                                        @elseif($product->status === 'sold')
                                            <span class="status-badge status-sold">✕ Sold</span>
                                        @else
                                            <span class="status-badge" style="background: rgba(107, 114, 128, 0.2); color: #d1d5db; border: 1px solid rgba(107, 114, 128, 0.3);">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-gray-400 text-xs">{{ $product->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-12">
                                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-gray-400 text-lg font-semibold">No products found</p>
                                        <p class="text-gray-500 text-sm">Products will appear here as users submit them</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($products instanceof \Illuminate\Pagination\Paginator)
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-gray-400 text-lg font-semibold">No products found</p>
                        <p class="text-gray-500 text-sm">Products will appear here as users submit them</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

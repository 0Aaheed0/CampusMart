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
        .star-display {
            color: #fbbf24;
            font-size: 1.25rem;
            letter-spacing: 2px;
        }
        .review-item {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .review-item:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.15);
        }
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="text-4xl font-black text-white mb-2">📝 Reviews Management</h1>
                <p class="text-blue-200">Monitor customer reviews and ratings</p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Total Reviews</p>
                    <p class="text-3xl font-black text-white">{{ $totalReviews }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Average Rating</p>
                    <p class="text-3xl font-black text-yellow-400">{{ number_format($averageRating, 1) }} ⭐</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">5-Star Reviews</p>
                    <p class="text-3xl font-black text-white">{{ $fiveStarCount }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Today's Reviews</p>
                    <p class="text-3xl font-black text-white">{{ $todayReviews }}</p>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="glass-container p-8 rounded-3xl">
                @if($reviews->count() > 0)
                    <div class="space-y-6">
                        @foreach($reviews as $review)
                            <div class="review-item">
                                <!-- Review Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="star-display">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                                            <h3 class="text-lg font-bold text-white">{{ $review->title }}</h3>
                                        </div>
                                        <p class="text-blue-300 text-sm font-semibold">
                                            By <span class="text-white">{{ $review->user->name ?? 'Unknown User' }}</span>
                                            @if($review->product)
                                                on <span class="text-white">{{ $review->product->title ?? 'Deleted Product' }}</span>
                                            @else
                                                <span class="text-gray-400">(General Review)</span>
                                            @endif
                                        </p>
                                        <p class="text-gray-400 text-xs mt-1">{{ $review->created_at->format('M d, Y • H:i A') }}</p>
                                    </div>
                                </div>

                                <!-- Review Comment -->
                                @if($review->comment)
                                    <div class="bg-black/20 p-4 rounded-xl mb-3 border border-white/5">
                                        <p class="text-gray-200 text-sm leading-relaxed">{{ $review->comment }}</p>
                                    </div>
                                @endif

                                <!-- Meta Info -->
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500">
                                        📧 {{ $review->user->email ?? 'N/A' }}
                                    </span>
                                    @if($review->product)
                                        <span class="text-gray-500">
                                            🛍️ Product ID: {{ $review->product->id }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($reviews instanceof \Illuminate\Pagination\Paginator)
                        <div class="mt-8">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-400 text-lg font-semibold">No reviews yet</p>
                        <p class="text-gray-500 text-sm">Reviews will appear here as customers submit them</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

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
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.15);
        }

        .history-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .history-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
        }

        .status-completed {
            background: rgba(34, 197, 94, 0.1);
            color: #86efac;
            border: 1px solid #22c55e;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #fcd34d;
            border: 1px solid #f59e0b;
        }

        .status-failed {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: 1px solid #ef4444;
        }

        .item-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .item-card:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .stat-box {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 15px;
            padding: 20px;
        }
    </style>

    <div class="py-12 min-h-screen relative overflow-hidden bg-[#0f172a]">
        <!-- Background Effects -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-5xl font-black text-white tracking-tight mb-2">💳 Payment History</h1>
                <p class="text-blue-200 text-lg">View all your purchases and transactions</p>
            </div>

            @if($payments->isEmpty())
                <div class="glass-container shadow-2xl p-20 text-center">
                    <div class="inline-block bg-gradient-to-br from-blue-500/20 to-indigo-500/20 w-24 h-24 rounded-full flex items-center justify-center mb-8 border border-blue-400/30">
                        <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-3">No payment history</h3>
                    <p class="text-blue-200 mb-10 max-w-md mx-auto text-lg">You haven't made any purchases yet. Start shopping now!</p>
                    <a href="{{ route('products.available') }}" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-10 py-4 rounded-xl font-bold text-lg transition-all hover:scale-105">
                        🛍️ Browse Products
                    </a>
                </div>
            @else
                <!-- Payment List -->
                <div class="space-y-6 mb-12">
                    @foreach($payments as $payment)
                        <div class="history-card overflow-hidden">
                            <!-- Header Section -->
                            <div class="p-6 border-b border-white/10 bg-gradient-to-r from-blue-500/5 to-indigo-500/5">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                    <div>
                                        <p class="text-blue-200 text-sm font-bold mb-1">🧾 Payment #{{ $payment->id }}</p>
                                        <p class="text-gray-300 text-sm">{{ $payment->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <span class="status-{{ $payment->payment_status }} px-6 py-2 rounded-lg text-sm font-bold uppercase tracking-wide">
                                        {{ ucfirst($payment->payment_status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Items Section -->
                            <div class="p-6">
                                <h3 class="text-lg font-black text-white mb-4">📦 Items Purchased</h3>
                                <div class="space-y-3">
                                    @foreach($payment->items as $item)
                                        <div class="item-card p-4">
                                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                                <div class="flex-1">
                                                    <p class="font-bold text-white text-lg">{{ $item->product_name }}</p>
                                                    <p class="text-blue-300 text-sm mt-1">👤 From: <span class="font-bold">{{ $item->seller->name ?? 'N/A' }}</span></p>
                                                    @php
                                                        $details = json_decode($item->product_details);
                                                    @endphp
                                                    <p class="text-gray-400 text-xs mt-2">
                                                        📋 Type: <span class="text-gray-300">{{ $details->type ?? 'N/A' }}</span> | 
                                                        ⭐ Condition: <span class="text-gray-300">{{ $details->condition ?? 'N/A' }}</span>
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-black text-green-400 text-2xl">৳{{ number_format($item->price) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Summary Section -->
                            <div class="p-6 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 border-t border-white/10">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                    <div>
                                        <p class="text-blue-200 text-sm font-bold mb-2">💳 Payment Method</p>
                                        <p class="text-white font-black">{{ ucfirst($payment->payment_method) }}</p>
                                        @if($payment->notes)
                                            <p class="text-gray-300 text-sm mt-2">📝 {{ $payment->notes }}</p>
                                        @endif
                                    </div>
                                    <div class="md:text-right">
                                        <p class="text-blue-200 text-sm font-bold mb-2">Total Amount</p>
                                        <p class="text-4xl font-black text-green-400">৳{{ number_format($payment->total_amount) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($payments->hasPages())
                    <div class="mt-12">
                        <div class="glass-container p-6">
                            {{ $payments->links() }}
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>

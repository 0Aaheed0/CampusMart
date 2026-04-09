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

        .history-card {
            transition: all 0.3s ease;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .history-card:hover {
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }

        .badge-completed { background-color: #10b981; color: white; }
        .badge-pending { background-color: #f59e0b; color: white; }
        .badge-failed { background-color: #ef4444; color: white; }
    </style>

    <div class="py-12 page-bg min-h-screen relative overflow-hidden">
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-4xl font-black text-white tracking-tight">Payment History</h1>
                <p class="text-blue-100 mt-2">View all your purchases and transactions</p>
            </div>

            @if($payments->isEmpty())
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-16 text-center border border-white/10">
                    <div class="bg-white/10 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="h-12 w-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">No payment history</h3>
                    <p class="text-blue-100 mb-8 max-w-md mx-auto">You haven't made any purchases yet. Start shopping now!</p>
                    <a href="{{ route('products.available') }}" class="inline-block bg-white text-blue-700 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition-all">Browse Products</a>
                </div>
            @else
                <!-- Payment List -->
                <div class="space-y-6">
                    @foreach($payments as $payment)
                        <div class="history-card">
                            <div class="p-6 border-b border-gray-100">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Payment #{{ $payment->id }}</p>
                                        <p class="text-gray-400 text-sm">{{ $payment->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <span class="badge-{{ $payment->payment_status }} px-4 py-2 rounded-lg text-sm font-bold uppercase">
                                        {{ $payment->payment_status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Items List -->
                            <div class="p-6">
                                <h3 class="text-lg font-black text-gray-900 mb-4">Items Purchased</h3>
                                <div class="space-y-4">
                                    @foreach($payment->items as $item)
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                            <div class="flex-1">
                                                <p class="font-bold text-gray-900">{{ $item->product_name }}</p>
                                                <p class="text-sm text-gray-500">From: {{ $item->seller->name }}</p>
                                                @php
                                                    $details = json_decode($item->product_details);
                                                @endphp
                                                <p class="text-xs text-gray-400 mt-1">
                                                    Type: {{ $details->type ?? 'N/A' }} | Condition: {{ $details->condition ?? 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-black text-blue-700 text-lg">৳{{ number_format($item->price) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Payment Summary -->
                            <div class="p-6 bg-gray-50 border-t border-gray-100">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-600 mb-1">Payment Method: <span class="font-bold text-gray-900">{{ ucfirst($payment->payment_method) }}</span></p>
                                        @if($payment->notes)
                                            <p class="text-gray-600 text-sm">Notes: {{ $payment->notes }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-600 mb-2">Total Amount</p>
                                        <p class="text-3xl font-black text-green-600">৳{{ number_format($payment->total_amount) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($payments->hasPages())
                    <div class="mt-12">
                        {{ $payments->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>

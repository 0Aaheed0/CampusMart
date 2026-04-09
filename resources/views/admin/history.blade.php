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
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .history-card:hover {
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }

        .badge-completed { background-color: #10b981; color: white; }
        .badge-pending { background-color: #f59e0b; color: white; }
        .badge-failed { background-color: #ef4444; color: white; }

        .transaction-header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .transaction-body {
            padding: 20px;
        }

        .buyer-seller-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
            padding: 15px;
            background: #f9fafb;
            border-radius: 10px;
        }

        .info-label {
            font-size: 0.75rem;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 0.95rem;
            color: #1f2937;
            font-weight: 600;
        }

        .items-list {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
        }

        .item-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
            padding: 12px;
            background: #f0fdf4;
            margin-bottom: 10px;
            border-radius: 8px;
            align-items: center;
        }

        .back-button {
            display: inline-block;
            background: white;
            color: #2563eb;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: #f3f4f6;
            transform: translateX(-4px);
        }
    </style>

    <div class="py-12 page-bg min-h-screen relative overflow-hidden">
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-10">
                <a href="{{ route('admin.dashboard') }}" class="back-button">← Back to Dashboard</a>
                <h1 style="color: white; font-size: 2.5rem; font-weight: 800; margin-bottom: 8px;">Transaction History</h1>
                <p style="color: #bfdbfe; font-size: 1.125rem;">View all user transactions - buyers and sellers</p>
            </div>

            @if($payments->isEmpty())
                <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 12px; padding: 40px; text-align: center; border: 1px solid rgba(255, 255, 255, 0.2);">
                    <div style="background: rgba(255, 255, 255, 0.1); width: 96px; height: 96px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                        <svg class="h-12 w-12" style="color: #93c5fd;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 800; color: white; margin-bottom: 8px;">No transactions yet</h3>
                    <p style="color: #bfdbfe; margin-bottom: 20px;">No payment transactions have been made yet.</p>
                </div>
            @else
                <!-- Statistics -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 30px;">
                    <div style="background: rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 20px; border: 1px solid rgba(255, 255, 255, 0.2);">
                        <p style="color: #bfdbfe; font-size: 0.875rem; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Transactions</p>
                        <p style="color: white; font-size: 2.25rem; font-weight: 800;">{{ $payments->total() }}</p>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border-radius: 12px; padding: 20px; border: 1px solid rgba(16, 185, 129, 0.3);">
                        <p style="color: #86efac; font-size: 0.875rem; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Total Revenue</p>
                        <p style="color: #10b981; font-size: 2.25rem; font-weight: 800;">৳{{ number_format($payments->sum('total_amount')) }}</p>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 20px; border: 1px solid rgba(255, 255, 255, 0.2);">
                        <p style="color: #bfdbfe; font-size: 0.875rem; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">Avg Transaction</p>
                        <p style="color: white; font-size: 2.25rem; font-weight: 800;">৳{{ number_format($payments->avg('total_amount')) }}</p>
                    </div>
                </div>

                <!-- Transactions List -->
                <div>
                    @foreach($payments as $payment)
                        <div class="history-card">
                            <!-- Header -->
                            <div class="transaction-header">
                                <div>
                                    <p style="font-size: 0.875rem; margin-bottom: 4px;">Payment #{{ $payment->id }}</p>
                                    <p style="font-size: 1.1rem; font-weight: 800;">{{ $payment->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div style="text-align: right;">
                                    <span class="badge-{{ $payment->payment_status }}" style="padding: 8px 16px; border-radius: 8px; font-weight: 700; text-transform: uppercase; font-size: 0.875rem;">
                                        {{ $payment->payment_status }}
                                    </span>
                                    <p style="margin-top: 8px; font-size: 1.25rem; font-weight: 800;">৳{{ number_format($payment->total_amount) }}</p>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="transaction-body">
                                <!-- Buyer & Seller Info -->
                                <div class="buyer-seller-row">
                                    <div>
                                        <p class="info-label">🛍️ Buyer</p>
                                        <p class="info-value">{{ $payment->buyer->name }}</p>
                                        <p style="font-size: 0.85rem; color: #6b7280; margin-top: 4px;">{{ $payment->buyer->email }}</p>
                                    </div>
                                    <div>
                                        <p class="info-label">💳 Payment Method</p>
                                        <p class="info-value">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</p>
                                        <p style="font-size: 0.85rem; color: #6b7280; margin-top: 4px;">Status: {{ $payment->payment_status }}</p>
                                    </div>
                                </div>

                                <!-- Items Purchased -->
                                <div class="items-list">
                                    <p style="font-weight: 800; color: #1f2937; margin-bottom: 12px; font-size: 1rem;">📦 Items Purchased:</p>
                                    @foreach($payment->items as $item)
                                        <div class="item-row">
                                            <div>
                                                <p style="font-weight: 700; color: #1f2937;">{{ $item->product_name }}</p>
                                                <p style="font-size: 0.85rem; color: #6b7280; margin-top: 4px;">Seller: <strong>{{ $item->seller->name }}</strong></p>
                                            </div>
                                            <div>
                                                <p style="font-size: 0.85rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Price</p>
                                                <p style="font-weight: 800; color: #059669;">৳{{ number_format($item->price) }}</p>
                                            </div>
                                            <div>
                                                <p style="font-size: 0.85rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Details</p>
                                                @php $details = json_decode($item->product_details); @endphp
                                                <p style="font-size: 0.85rem; color: #1f2937;">{{ $details->type ?? 'N/A' }} • {{ $details->condition ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Notes -->
                                @if($payment->notes)
                                    <div style="margin-top: 20px; padding: 12px; background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 4px;">
                                        <p style="font-size: 0.85rem; color: #92400e; font-weight: 600;">📝 Notes: {{ $payment->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($payments->hasPages())
                    <div style="margin-top: 40px; display: flex; justify-content: center;">
                        {{ $payments->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>

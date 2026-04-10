<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }
        .report-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .report-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.15);
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: bold;
        }
        .status-pending {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }
        .status-reviewed {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
        }
        .status-resolved {
            background: rgba(34, 197, 94, 0.2);
            color: #86efac;
        }
        .status-dismissed {
            background: rgba(107, 114, 128, 0.2);
            color: #d1d5db;
        }
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Home
                </a>
                <h1 class="text-4xl font-black text-white mb-2">📋 My Reports</h1>
                <p class="text-blue-200">Track the status of reports you've submitted</p>
            </div>

            <!-- New Report Button -->
            <div class="mb-8">
                <a href="{{ route('reports.create') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-6 rounded-2xl font-bold shadow-lg hover:scale-105 transition">
                    <span class="mr-2">➕</span>
                    Submit New Report
                </a>
            </div>

            <!-- Reports List -->
            <div class="glass-container p-8 rounded-3xl">
                @if($reports->count() > 0)
                    <div class="space-y-6">
                        @foreach($reports as $report)
                            <div class="report-card">
                                <!-- Report Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="status-badge status-{{ $report->status }}">
                                                {{ ucfirst($report->status) }}
                                            </span>
                                            <span class="text-lg font-bold text-white">
                                                @if($report->report_type === 'product')
                                                    📦 Product Report
                                                @elseif($report->report_type === 'user')
                                                    👤 User Report
                                                @else
                                                    ⚠️ Other Report
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-blue-300 text-sm font-semibold">
                                            <span class="text-white">{{ $report->reason }}</span>
                                        </p>
                                        <p class="text-gray-400 text-xs mt-1">{{ $report->created_at->format('M d, Y • H:i A') }}</p>
                                    </div>
                                </div>

                                <!-- Report Details -->
                                <div class="bg-black/20 p-4 rounded-xl mb-4 border border-white/5">
                                    @if($report->product)
                                        <div class="mb-2">
                                            <p class="text-gray-400 text-xs font-bold mb-1">PRODUCT</p>
                                            <p class="text-white font-bold">{{ $report->product->title }}</p>
                                        </div>
                                    @elseif($report->reportedUser)
                                        <div class="mb-2">
                                            <p class="text-gray-400 text-xs font-bold mb-1">REPORTED USER</p>
                                            <p class="text-white font-bold">{{ $report->reportedUser->name }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <p class="text-gray-400 text-xs font-bold mb-2">YOUR DESCRIPTION</p>
                                    <p class="text-gray-200 text-sm leading-relaxed">{{ $report->description }}</p>
                                </div>

                                <!-- Admin Response -->
                                @if($report->admin_notes)
                                    <div class="bg-green-500/10 border border-green-500/20 p-4 rounded-xl">
                                        <p class="text-gray-400 text-xs font-bold mb-2">✅ ADMIN RESPONSE</p>
                                        <p class="text-green-200 text-sm">{{ $report->admin_notes }}</p>
                                    </div>
                                @elseif($report->status !== 'pending')
                                    <div class="bg-blue-500/10 border border-blue-500/20 p-4 rounded-xl">
                                        <p class="text-blue-200 text-sm">Your report has been reviewed. Thank you for helping keep our community safe!</p>
                                    </div>
                                @else
                                    <div class="bg-yellow-500/10 border border-yellow-500/20 p-4 rounded-xl">
                                        <p class="text-yellow-200 text-sm">⏳ Your report is pending review by our moderation team.</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($reports instanceof \Illuminate\Pagination\Paginator)
                        <div class="mt-8">
                            {{ $reports->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-400 text-lg font-semibold">No reports yet</p>
                        <p class="text-gray-500 text-sm mb-4">You haven't submitted any reports</p>
                        <a href="{{ route('reports.create') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition font-bold">
                            Submit Your First Report
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

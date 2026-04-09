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
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .glass-card:hover {
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
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="text-4xl font-black text-white mb-2">📋 Reports Management</h1>
                <p class="text-blue-200">Monitor and manage user reports</p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Total Reports</p>
                    <p class="text-3xl font-black text-white">{{ $totalReports }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Pending Reviews</p>
                    <p class="text-3xl font-black text-yellow-400">{{ $pendingReports }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Resolved</p>
                    <p class="text-3xl font-black text-green-400">{{ $resolvedReports }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Today's Reports</p>
                    <p class="text-3xl font-black text-white">{{ $todayReports }}</p>
                </div>
            </div>

            <!-- Reports List -->
            <div class="glass-container p-8 rounded-3xl">
                @if($reports->count() > 0)
                    <div class="space-y-6">
                        @foreach($reports as $report)
                            <div class="glass-card">
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
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-gray-400 text-xs font-bold mb-1">REPORTED BY</p>
                                            <p class="text-white font-bold">{{ $report->user->name }}</p>
                                            <p class="text-gray-400 text-sm">{{ $report->user->email }}</p>
                                        </div>
                                        @if($report->product)
                                            <div>
                                                <p class="text-gray-400 text-xs font-bold mb-1">PRODUCT</p>
                                                <p class="text-white font-bold">{{ $report->product->title }}</p>
                                                <p class="text-gray-400 text-sm">${{ $report->product->price }}</p>
                                            </div>
                                        @elseif($report->reportedUser)
                                            <div>
                                                <p class="text-gray-400 text-xs font-bold mb-1">REPORTED USER</p>
                                                <p class="text-white font-bold">{{ $report->reportedUser->name }}</p>
                                                <p class="text-gray-400 text-sm">{{ $report->reportedUser->email }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <p class="text-gray-400 text-xs font-bold mb-2">DESCRIPTION</p>
                                    <p class="text-gray-200 text-sm leading-relaxed">{{ $report->description }}</p>
                                </div>

                                <!-- Admin Notes -->
                                @if($report->admin_notes)
                                    <div class="mb-4 bg-blue-500/10 border border-blue-500/20 p-4 rounded-xl">
                                        <p class="text-gray-400 text-xs font-bold mb-2">ADMIN NOTES</p>
                                        <p class="text-blue-200 text-sm">{{ $report->admin_notes }}</p>
                                    </div>
                                @endif

                                <!-- Action Form -->
                                @if($report->status === 'pending')
                                    <form action="{{ route('admin.reports.update', $report->id) }}" method="POST" class="mt-4 p-4 bg-white/5 rounded-xl border border-white/10">
                                        @csrf
                                        @method('PATCH')
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                                            <div>
                                                <select name="status" class="w-full rounded-lg border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 text-white font-bold text-sm p-2" required>
                                                    <option value="reviewed">Mark as Reviewed</option>
                                                    <option value="resolved">Resolve</option>
                                                    <option value="dismissed">Dismiss</option>
                                                </select>
                                            </div>
                                            <div class="md:col-span-2">
                                                <textarea name="admin_notes" placeholder="Add admin notes..." class="w-full rounded-lg border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 text-white font-bold text-sm p-2" rows="1"></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                                            Update Status
                                        </button>
                                    </form>
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
                        <p class="text-gray-500 text-sm">Everything looks good!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

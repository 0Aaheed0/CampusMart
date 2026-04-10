<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .report-table thead {
            background: rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .report-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #bfdbfe;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .report-table td {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #e0e7ff;
            font-size: 0.875rem;
            cursor: pointer;
        }
        .report-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-unsolved {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .status-solved {
            background: rgba(34, 197, 94, 0.2);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        .toggle-status-btn {
            padding: 6px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .toggle-status-btn.unsolved {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .toggle-status-btn.unsolved:hover {
            background: rgba(239, 68, 68, 0.2);
        }
        .toggle-status-btn.solved {
            background: rgba(34, 197, 94, 0.1);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        .toggle-status-btn.solved:hover {
            background: rgba(34, 197, 94, 0.2);
        }
        .filter-btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.05);
            color: #e0e7ff;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .filter-btn.active {
            background: rgba(59, 130, 246, 0.3);
            border-color: rgba(59, 130, 246, 0.5);
            color: #93c5fd;
        }
        .filter-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            z-index: 50;
            animation: fadeIn 0.3s ease;
        }
        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .modal-content {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 32px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
            position: relative;
        }
        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #e0e7ff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            font-size: 20px;
        }
        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .modal-section-title {
            color: #93c5fd;
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            margin-top: 16px;
        }
        .modal-info-item {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 8px;
        }
        .modal-info-label {
            color: #bfdbfe;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .modal-info-value {
            color: #e0e7ff;
            font-size: 0.95rem;
            font-weight: 500;
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
                <h1 class="text-4xl font-black text-white mb-2">📋 Reports Management</h1>
                <p class="text-blue-200">Monitor and manage user reports - Click rows for details</p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Total Reports</p>
                    <p class="text-3xl font-black text-white">{{ $totalReports }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Unsolved</p>
                    <p class="text-3xl font-black text-red-400">{{ $unsolvedReports }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">Solved</p>
                    <p class="text-3xl font-black text-green-400">{{ $solvedReports }}</p>
                </div>
                <div class="glass-container p-6 rounded-2xl">
                    <p class="text-blue-200 text-sm font-bold mb-2">By Type</p>
                    <p class="text-sm text-gray-300">P: {{ $productReports }} | U: {{ $userReports }} | O: {{ $otherReports }}</p>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="mb-6 flex gap-3 flex-wrap">
                <a href="{{ route('admin.reports', ['filter' => 'all']) }}" class="filter-btn {{ $filter === 'all' ? 'active' : '' }}">
                    All Reports
                </a>
                <a href="{{ route('admin.reports', ['filter' => 'product']) }}" class="filter-btn {{ $filter === 'product' ? 'active' : '' }}">
                    📦 Product Issues
                </a>
                <a href="{{ route('admin.reports', ['filter' => 'user']) }}" class="filter-btn {{ $filter === 'user' ? 'active' : '' }}">
                    👤 User Reports
                </a>
                <a href="{{ route('admin.reports', ['filter' => 'other']) }}" class="filter-btn {{ $filter === 'other' ? 'active' : '' }}">
                    ⚠️ Other Issues
                </a>
            </div>

            <!-- Reports Table -->
            <div class="glass-container p-8 rounded-3xl overflow-x-auto">
                @if($reports->count() > 0)
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Reporter</th>
                                <th style="width: 20%;">Type / Target</th>
                                <th style="width: 20%;">Reason</th>
                                <th style="width: 15%;">Status</th>
                                <th style="width: 12%;">Date</th>
                                <th style="width: 8%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                                <tr onclick="openReportModal({{ $report->id }})">
                                    <td>
                                        <div class="font-semibold text-blue-300">{{ $report->user->name }}</div>
                                        <p class="text-xs text-gray-500">{{ $report->user->email }}</p>
                                    </td>
                                    <td>
                                        @if($report->report_type === 'product')
                                            <span class="bg-blue-900/30 text-blue-300 px-2 py-1 rounded text-xs font-medium">📦 Product</span>
                                            <p class="text-xs text-gray-400 mt-1">ID: {{ $report->product_id }}</p>
                                        @elseif($report->report_type === 'user')
                                            <span class="bg-purple-900/30 text-purple-300 px-2 py-1 rounded text-xs font-medium">👤 User</span>
                                            <p class="text-xs text-gray-400 mt-1">ID: {{ $report->reported_user_id }}</p>
                                        @else
                                            <span class="bg-gray-900/30 text-gray-300 px-2 py-1 rounded text-xs font-medium">⚠️ Other</span>
                                        @endif
                                    </td>
                                    <td class="truncate">{{ $report->reason }}</td>
                                    <td>
                                        <span class="status-badge {{ in_array($report->status, ['pending', 'reviewed']) ? 'status-unsolved' : 'status-solved' }}">
                                            {{ in_array($report->status, ['pending', 'reviewed']) ? '🔴 Unsolved' : '✓ Solved' }}
                                        </span>
                                    </td>
                                    <td class="text-gray-400 text-xs">{{ $report->created_at->format('M d') }}</td>
                                    <td onclick="event.stopPropagation();">
                                        <button class="toggle-status-btn {{ in_array($report->status, ['pending', 'reviewed']) ? 'unsolved' : 'solved' }}" onclick="toggleReportStatus({{ $report->id }})">
                                            {{ in_array($report->status, ['pending', 'reviewed']) ? '✓ Resolve' : '↻ Reopen' }}
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12">
                                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-gray-400 text-lg font-semibold">No reports found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($reports instanceof \Illuminate\Pagination\Paginator)
                        <div class="mt-8">
                            {{ $reports->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-400 text-lg font-semibold">No reports found</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Report Details Modal -->
        <div id="reportModal" class="modal-overlay" onclick="if(event.target === this) closeReportModal()">
            <div class="modal-content">
                <button class="modal-close" onclick="closeReportModal()">×</button>
                
                <h2 class="text-2xl font-black text-white mb-4">📋 Report Details</h2>

                <div class="modal-info-item">
                    <div class="modal-info-label">Reporter</div>
                    <div class="modal-info-value" id="reporterName">-</div>
                </div>

                <div class="modal-info-item">
                    <div class="modal-info-label">Reporter Email</div>
                    <div class="modal-info-value" id="reporterEmail">-</div>
                </div>

                <div class="modal-section-title">Report Information</div>

                <div class="modal-info-item">
                    <div class="modal-info-label">Type</div>
                    <div class="modal-info-value" id="reportType">-</div>
                </div>

                <div class="modal-info-item">
                    <div class="modal-info-label">Reason/Category</div>
                    <div class="modal-info-value" id="reportReason">-</div>
                </div>

                <div class="modal-info-item">
                    <div class="modal-info-label">Status</div>
                    <div class="modal-info-value" id="reportStatus">-</div>
                </div>

                <div class="modal-section-title">Target Information</div>

                <div id="productInfo" style="display: none;">
                    <div class="modal-info-item">
                        <div class="modal-info-label">Product ID</div>
                        <div class="modal-info-value" id="targetProductId">-</div>
                    </div>
                    <div class="modal-info-item">
                        <div class="modal-info-label">Product Name</div>
                        <div class="modal-info-value" id="targetProductName">-</div>
                    </div>
                </div>

                <div id="userInfo" style="display: none;">
                    <div class="modal-info-item">
                        <div class="modal-info-label">Reported User ID</div>
                        <div class="modal-info-value" id="targetUserId">-</div>
                    </div>
                    <div class="modal-info-item">
                        <div class="modal-info-label">Reported User Name</div>
                        <div class="modal-info-value" id="targetUserName">-</div>
                    </div>
                </div>

                <div class="modal-section-title">Full Description</div>
                <div class="modal-info-item" style="min-height: 120px;">
                    <div class="modal-info-value" id="reportDescription">-</div>
                </div>

                <div class="modal-section-title">Submitted</div>
                <div class="modal-info-item">
                    <div class="modal-info-value" id="reportDate">-</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openReportModal(reportId) {
            const modal = document.getElementById('reportModal');
            modal.classList.add('active');

            fetch(`/admin/reports/${reportId}/details`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('reporterName').textContent = data.reporter_name;
                    document.getElementById('reporterEmail').textContent = data.reporter_email;
                    document.getElementById('reportType').textContent = data.report_type;
                    document.getElementById('reportReason').textContent = data.reason;
                    document.getElementById('reportStatus').textContent = data.status;
                    document.getElementById('reportDescription').textContent = data.description;
                    document.getElementById('reportDate').textContent = data.created_at;

                    // Show/hide target info based on type
                    if (data.report_type === 'Product') {
                        document.getElementById('productInfo').style.display = 'block';
                        document.getElementById('userInfo').style.display = 'none';
                        document.getElementById('targetProductId').textContent = data.product_id || 'N/A';
                        document.getElementById('targetProductName').textContent = data.product_name || 'N/A';
                    } else if (data.report_type === 'User') {
                        document.getElementById('userInfo').style.display = 'block';
                        document.getElementById('productInfo').style.display = 'none';
                        document.getElementById('targetUserId').textContent = data.reported_user_id || 'N/A';
                        document.getElementById('targetUserName').textContent = data.reported_user_name || 'N/A';
                    } else {
                        document.getElementById('productInfo').style.display = 'none';
                        document.getElementById('userInfo').style.display = 'none';
                    }
                });
        }

        function closeReportModal() {
            document.getElementById('reportModal').classList.remove('active');
        }

        function toggleReportStatus(reportId) {
            fetch(`/admin/reports/${reportId}/toggle-status`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }})
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeReportModal();
            }
        });
    </script>
</x-app-layout>

<x-app-layout>
    <style>
        .admin-page {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            min-h-screen;
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 32px;
        }

        .faq-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .faq-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #93c5fd;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: 1px solid #ef4444;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #fecaca;
        }

        .section-badge {
            display: inline-block;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.4);
            color: #93c5fd;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .alert {
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 24px;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border-color: rgba(34, 197, 94, 0.3);
            color: #86efac;
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
        }

        .empty-icon {
            display: inline-block;
            background: rgba(59, 130, 246, 0.2);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            border: 1px solid rgba(59, 130, 246, 0.4);
        }
    </style>

    <div class="py-12 min-h-screen relative overflow-hidden bg-[#0f172a]">
        <!-- Background Effects -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-5xl font-black text-white tracking-tight mb-2">❓ Manage FAQs</h1>
                <p class="text-blue-200 text-lg">Create, edit, and manage your frequently asked questions</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Action Bar -->
            <div class="glass-container shadow-2xl mb-8 flex justify-between items-center flex-col sm:flex-row gap-4">
                <div>
                    <div class="section-badge">📊 TOTAL FAQs</div>
                    <p class="text-4xl font-black text-white">{{ $faqs->total() }}</p>
                </div>
                <a href="{{ route('admin.faq.create') }}" class="btn-primary">
                    ➕ Create New FAQ
                </a>
            </div>

            <!-- FAQ List -->
            <div class="glass-container shadow-2xl">
                @forelse($faqs as $faq)
                    <div class="faq-card">
                        <!-- Question & Actions -->
                        <div class="flex justify-between items-start gap-4 mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-white mb-2">❓ {{ $faq->title }}</h3>
                                <p class="text-blue-100 line-clamp-2">{{ Str::limit($faq->answer, 150) }}</p>
                            </div>
                            <div class="flex gap-2 flex-shrink-0">
                                <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn-secondary">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Full Answer Preview -->
                        <div class="mt-4 pt-4 border-t border-white/10">
                            <p class="text-gray-300 leading-relaxed">{{ $faq->answer }}</p>
                        </div>

                        <!-- Metadata -->
                        <div class="mt-4 flex justify-between items-center text-xs text-gray-400">
                            <span>Created: {{ $faq->created_at ? $faq->created_at->format('d M Y, H:i') : 'N/A' }}</span>
                            <span>Updated: {{ $faq->updated_at ? $faq->updated_at->format('d M Y, H:i') : 'N/A' }}</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">No FAQs yet</h3>
                        <p class="text-blue-200 mb-8">Start by creating your first FAQ to help users find answers.</p>
                        <a href="{{ route('admin.faq.create') }}" class="btn-primary">
                            ➕ Create Your First FAQ
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($faqs->hasPages())
                <div class="mt-8">
                    <div class="glass-container shadow-xl">
                        {{ $faqs->links() }}
                    </div>
                </div>
            @endif

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="btn-secondary">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <style>
        .faq-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }

        .faq-item {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .faq-item:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
        }

        .faq-item.active {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.8);
        }

        .question-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            font-weight: bold;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .answer-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            font-weight: bold;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .answer-text {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .faq-item.active .answer-text {
            max-height: 500px;
            opacity: 1;
            margin-top: 16px;
        }

        .chevron-icon {
            transition: transform 0.3s ease;
            margin-left: auto;
        }

        .faq-item.active .chevron-icon {
            transform: rotate(180deg);
        }
    </style>

    <div class="py-12 min-h-screen relative overflow-hidden bg-[#0f172a]">
        <!-- Background Effects -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="text-center mb-16">
                <div class="inline-block mb-6 px-6 py-2 bg-gradient-to-r from-blue-500/20 to-indigo-500/20 border border-blue-400/30 rounded-full">
                    <p class="text-blue-300 text-sm font-bold tracking-wide">❓ COMMON QUESTIONS</p>
                </div>
                <h1 class="text-6xl font-black text-white tracking-tight mb-4">📚 Frequently Asked Questions</h1>
                <p class="text-xl text-blue-200 max-w-2xl mx-auto">Find answers to common questions about CampusMart. Click on any question to reveal the answer.</p>
            </div>

            <!-- FAQ Items -->
            <div class="faq-container shadow-2xl">
                @forelse($helpBoards as $index => $item)
                    <div class="faq-item {{ $index === 0 ? 'active' : '' }}" onclick="toggleFAQ(this)">
                        <!-- Question -->
                        <div class="flex items-center gap-4">
                            <div class="question-badge">❓</div>
                            <h3 class="text-lg font-bold text-white flex-1">{{ $item->title }}</h3>
                            <svg class="chevron-icon w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </div>

                        <!-- Answer -->
                        <div class="answer-text">
                            <div class="flex gap-4">
                                <div class="answer-badge">✓</div>
                                <div class="text-blue-100 leading-relaxed">
                                    {{ $item->answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-16 text-center">
                        <div class="inline-block bg-gradient-to-br from-blue-500/20 to-indigo-500/20 w-20 h-20 rounded-full flex items-center justify-center mb-6 border border-blue-400/30">
                            <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">No FAQs yet</h3>
                        <p class="text-blue-200">Check back soon for frequently asked questions!</p>
                    </div>
                @endforelse
            </div>

            <!-- Help CTA -->
            <div class="mt-16 text-center">
                <div class="faq-container p-12">
                    <h3 class="text-2xl font-bold text-white mb-4">Still need help?</h3>
                    <p class="text-blue-200 mb-8">Can't find the answer you're looking for? Contact our support team.</p>
                    <a href="mailto:support@campusmart.com" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all">
                        📧 Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFAQ(element) {
            // Close other items
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== element) {
                    item.classList.remove('active');
                }
            });
            
            // Toggle current item
            element.classList.toggle('active');
        }
    </script>
</x-app-layout>

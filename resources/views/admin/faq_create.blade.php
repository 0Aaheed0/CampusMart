<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 32px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: #e0e7ff;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 16px;
            border-radius: 12px;
            font-family: inherit;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: rgba(59, 130, 246, 0.6);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
        }

        .form-textarea {
            resize: vertical;
            min-height: 200px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #93c5fd;
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .error-message {
            color: #fca5a5;
            font-size: 14px;
            margin-top: 4px;
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

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }
    </style>

    <div class="py-12 min-h-screen relative overflow-hidden bg-[#0f172a]">
        <!-- Background Effects -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-5xl font-black text-white tracking-tight mb-2">➕ Create New FAQ</h1>
                <p class="text-blue-200 text-lg">Add a new frequently asked question to help your users</p>
            </div>

            <!-- Form -->
            <div class="glass-container shadow-2xl">
                <form action="{{ route('admin.faq.store') }}" method="POST">
                    @csrf

                    <!-- Title Field -->
                    <div class="form-group">
                        <div class="section-badge">❓ QUESTION</div>
                        <label class="form-label">FAQ Title/Question</label>
                        <input type="text" 
                               name="title" 
                               class="form-input" 
                               placeholder="e.g., What is CampusMart?" 
                               value="{{ old('title') }}"
                               required>
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Answer Field -->
                    <div class="form-group">
                        <div class="section-badge">✓ ANSWER</div>
                        <label class="form-label">Answer</label>
                        <textarea name="answer" 
                                  class="form-textarea" 
                                  placeholder="Write a detailed answer to help users..." 
                                  required>{{ old('answer') }}</textarea>
                        @error('answer')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="button-group">
                        <button type="submit" class="btn-primary">
                            ✅ Create FAQ
                        </button>
                        <a href="{{ route('admin.faq') }}" class="btn-secondary">
                            ← Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

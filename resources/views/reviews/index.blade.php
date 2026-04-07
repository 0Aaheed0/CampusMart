<x-app-layout>
    <style>
        .glass-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }
        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            font-size: 2rem;
            color: rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: color 0.2s ease-in-out;
            padding: 0 0.2rem;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #fbbf24;
        }
    </style>

    <div class="py-12 bg-[#0f172a] min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[120px] opacity-20 translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20 -translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="glass-container shadow-2xl p-8 md:p-12 border border-white/10">
                <div class="text-center mb-12">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-blue-500/20">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.482-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                    </div>
                    <h1 class="text-4xl font-black text-white tracking-tight">Share Your Experience</h1>
                    <p class="text-blue-300 font-bold mt-2 opacity-80">Your reviews help make CampusMart better for everyone</p>
                </div>

                <form action="#" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="review_title" :value="__('Review Title')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                            <x-text-input id="review_title" name="review_title" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500" placeholder="e.g. Great experience with my first purchase!" required />
                        </div>

                        <div>
                            <x-input-label :value="__('Your Rating')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-2" />
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">★</label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">★</label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">★</label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">★</label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">★</label>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="review_content" :value="__('Your Review')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                            <textarea id="review_content" name="review_content" rows="6" class="mt-2 block w-full rounded-3xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500 border-none outline-none focus:ring-1" placeholder="Tell us about your experience..." required></textarea>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-blue-500/20 hover:scale-[1.01] transition-all active:scale-95 btn-glow">
                            Post My Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

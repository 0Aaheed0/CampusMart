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
                <!-- Popup Notification -->
                <div id="reviewPopup" class="fixed top-10 left-1/2 -translate-x-1/2 z-[100] hidden">
                    <div class="bg-green-500 text-white px-8 py-4 rounded-2xl shadow-2xl shadow-green-500/30 flex items-center space-x-3 transform transition-all animate-bounce">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="font-black tracking-wide text-lg">Review posted</span>
                    </div>
                </div>

                <form id="reviewForm" action="#" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="review_title" :value="__('Review Title')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest" />
                            <x-text-input id="review_title" name="review_title" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white placeholder-slate-500" placeholder="e.g. Great experience with my first purchase!" required />
                        </div>

                        <div>
                            <x-input-label :value="__('Your Rating')" class="text-[11px] font-black text-blue-300/60 uppercase ml-1 tracking-widest mb-2" />
                            <div class="star-rating" id="ratingContainer">
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
                        <button type="submit" id="postBtn" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-blue-500/20 hover:scale-[1.01] transition-all active:scale-95 btn-glow flex items-center justify-center">
                            <span id="btnText">Post My Review</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('postBtn');
            const btnText = document.getElementById('btnText');
            const popup = document.getElementById('reviewPopup');
            const form = this;

            // Loading state
            btn.disabled = true;
            btnText.innerText = 'Posting...';
            btn.classList.add('opacity-50', 'cursor-not-allowed');

            setTimeout(() => {
                // Show popup
                popup.classList.remove('hidden');
                
                // Reset Form
                form.reset();
                
                // Hide popup after 2 seconds
                setTimeout(() => {
                    popup.classList.add('hidden');
                    
                    // Reset Button
                    btn.disabled = false;
                    btnText.innerText = 'Post My Review';
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                }, 2000);

            }, 1000);
        });
    </script>
</x-app-layout>

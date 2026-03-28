<x-app-layout>

<style>

.hero-bg{
background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
}

.blob{
position:absolute;
width:500px;
height:500px;
background:#3b82f6;
filter:blur(140px);
opacity:.15;
border-radius:50%;
animation:move 20s infinite alternate;
}

.blob2{right:-150px;bottom:-150px;background:#22c55e;}
.blob3{left:-150px;top:-150px;background:#60a5fa;}

@keyframes move{
from{transform:translate(0,0)}
to{transform:translate(80px,60px)}
}

.card-hover:hover{
transform:translateY(-6px);
box-shadow:0 20px 40px rgba(0,0,0,0.15);
}

</style>

<!-- HERO SECTION -->

<div class="hero-bg text-white relative overflow-hidden">

<div class="blob blob3"></div>
<div class="blob"></div>
<div class="blob blob2"></div>

<div class="max-w-7xl mx-auto px-4 py-24 relative z-10">

<div x-data="{ 
    activeSlide: 1, 
    totalSlides: 4,
    init() {
        setInterval(() => {
            this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1;
        }, 5000);
    }
}" class="relative">

    <!-- Slide 1 -->
    <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="grid lg:grid-cols-2 gap-12 items-center min-h-[400px]">
        <div>
            <h1 class="text-5xl font-black mb-6 leading-tight">
                Buy & Sell <span class="text-blue-300">Academic Essentials</span>
                Inside Your Campus
            </h1>
            <p class="text-slate-300 text-lg mb-8 max-w-xl">
                CampusMart helps AUST students buy and sell books, calculators,
                notes and stationery easily inside campus.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('products.available') }}" class="bg-blue-600 px-8 py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg">Browse Items</a>
                <a href="{{ route('products.post') }}" class="bg-white text-slate-900 px-8 py-4 rounded-xl font-bold hover:bg-slate-200 transition shadow-lg">Sell an Item</a>
            </div>
        </div>
        <div class="flex justify-center h-full">
            <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=1400" class="rounded-3xl shadow-2xl object-cover w-full h-[400px]"/>
        </div>
    </div>

    <!-- Slide 2: Budget Friendly -->
    <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="grid lg:grid-cols-2 gap-12 items-center min-h-[400px]" style="display: none;">
        <div>
            <h1 class="text-5xl font-black mb-6 leading-tight">
                Student <span class="text-amber-400">Budget Friendly</span> Deals
            </h1>
            <p class="text-slate-300 text-lg mb-8 max-w-xl">
                Don't break the bank! Find high-quality second-hand academic materials at prices students can actually afford.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('products.available') }}" class="bg-amber-500 px-8 py-4 rounded-xl font-bold hover:bg-amber-600 transition shadow-lg">Save Money Now</a>
            </div>
        </div>
        <div class="flex justify-center h-full">
            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=1400" class="rounded-3xl shadow-2xl object-cover w-full h-[400px]"/>
        </div>
    </div>

    <!-- Slide 3 -->
    <div x-show="activeSlide === 3" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="grid lg:grid-cols-2 gap-12 items-center min-h-[400px]" style="display: none;">
        <div>
            <h1 class="text-5xl font-black mb-6 leading-tight">
                Pass on the <span class="text-emerald-300">Knowledge</span>
            </h1>
            <p class="text-slate-300 text-lg mb-8 max-w-xl">
                Finished your semester? Sell your lecture notes and reference books to help the next batch and earn cash.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('products.post') }}" class="bg-emerald-600 px-8 py-4 rounded-xl font-bold hover:bg-emerald-700 transition shadow-lg">Post Your Notes</a>
            </div>
        </div>
        <div class="flex justify-center h-full">
            <img src="https://images.unsplash.com/photo-1456324504439-367cee3b3c32?q=80&w=1400" class="rounded-3xl shadow-2xl object-cover w-full h-[400px]"/>
        </div>
    </div>

    <!-- Slide 4 -->
    <div x-show="activeSlide === 4" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="grid lg:grid-cols-2 gap-12 items-center min-h-[400px]" style="display: none;">
        <div>
            <h1 class="text-5xl font-black mb-6 leading-tight">
                Safe & <span class="text-indigo-300">Secure</span> Trading
            </h1>
            <p class="text-slate-300 text-lg mb-8 max-w-xl">
                Meet inside AUST campus for every transaction. No delivery fees, no middleman, just student-to-student trust.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('register') }}" class="bg-indigo-600 px-8 py-4 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg">Join Community</a>
            </div>
        </div>
        <div class="flex justify-center h-full">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1400" class="rounded-3xl shadow-2xl object-cover w-full h-[400px]"/>
        </div>
    </div>

    <!-- Controls -->
    <div class="absolute top-1/2 -translate-y-1/2 -left-8 -right-8 md:-left-16 md:-right-16 lg:-left-32 lg:-right-32 flex justify-between pointer-events-none">
        <button @click="activeSlide = activeSlide === 1 ? totalSlides : activeSlide - 1" class="pointer-events-auto p-4 rounded-full bg-white/10 hover:bg-white/20 transition-all border border-white/20 backdrop-blur-sm group ml-4">
            <svg class="w-8 h-8 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </button>
        <button @click="activeSlide = activeSlide === totalSlides ? 1 : activeSlide + 1" class="pointer-events-auto p-4 rounded-full bg-white/10 hover:bg-white/20 transition-all border border-white/20 backdrop-blur-sm group mr-4">
            <svg class="w-8 h-8 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>
    </div>
    
    <!-- Dots -->
    <div class="flex justify-center gap-2 mt-12">
        <template x-for="i in totalSlides">
            <button @click="activeSlide = i" :class="activeSlide === i ? 'w-10 bg-blue-500' : 'w-2 bg-white/30'" class="h-2 rounded-full transition-all duration-300"></button>
        </template>
    </div>

</div>

</div>
</div>

<!-- CATEGORIES -->

<div class="bg-slate-50 py-20">

<div class="max-w-7xl mx-auto px-4">

<h2 class="text-3xl font-black text-slate-800 mb-10">
Browse Categories
</h2>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">

<div class="bg-white rounded-2xl p-6 shadow card-hover text-center">
<div class="text-3xl mb-3">📚</div>
<p class="font-bold">Books</p>
</div>

<div class="bg-white rounded-2xl p-6 shadow card-hover text-center">
<div class="text-3xl mb-3">📓</div>
<p class="font-bold">Notes</p>
</div>

<div class="bg-white rounded-2xl p-6 shadow card-hover text-center">
<div class="text-3xl mb-3">🧮</div>
<p class="font-bold">Calculators</p>
</div>

<div class="bg-white rounded-2xl p-6 shadow card-hover text-center">
<div class="text-3xl mb-3">✏️</div>
<p class="font-bold">Stationery</p>
</div>

<div class="bg-white rounded-2xl p-6 shadow card-hover text-center">
<div class="text-3xl mb-3">📐</div>
<p class="font-bold">Drafting</p>
</div>

<div class="bg-white rounded-2xl p-6 shadow card-hover text-center">
<div class="text-3xl mb-3">🔬</div>
<p class="font-bold">Lab Equipment</p>
</div>

</div>

</div>

</div>

<!-- PRODUCTS -->

<div class="bg-white py-20">

<div class="max-w-7xl mx-auto px-4">

<div class="flex justify-between items-end mb-10">

<div>

<h2 class="text-3xl font-black text-slate-900">
Available Products
</h2>

<p class="text-slate-500">
Grab them before they're gone!
</p>

</div>

<a href="{{ route('products.available') }}"
class="text-blue-600 font-bold">
See More →
</a>

</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

<!-- CARD -->

<div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">

<img src="https://images.unsplash.com/photo-1589998059171-988d887df646?q=80&w=500"
class="aspect-square object-cover">

<div class="p-4">

<h4 class="font-bold text-slate-800 text-sm">
Numerical Analysis
</h4>

<p class="text-blue-600 font-black text-lg">
৳250
</p>

</div>

</div>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">

<img src="https://images.unsplash.com/photo-1587141744123-998b1ae525b8?q=80&w=500"
class="aspect-square object-cover">

<div class="p-4">

<h4 class="font-bold text-slate-800 text-sm">
Scientific Calculator
</h4>

<p class="text-blue-600 font-black text-lg">
৳1500
</p>

</div>

</div>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">

<img src="https://images.unsplash.com/photo-1536859355448-76f92eb0a218?q=80&w=500"
class="aspect-square object-cover">

<div class="p-4">

<h4 class="font-bold text-slate-800 text-sm">
Drafting Set
</h4>

<p class="text-blue-600 font-black text-lg">
৳800
</p>

</div>

</div>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">

<img src="https://images.unsplash.com/photo-1603484477859-abe6a73f9366?q=80&w=500"
class="aspect-square object-cover">

<div class="p-4">

<h4 class="font-bold text-slate-800 text-sm">
A4 Paper Bundle
</h4>

<p class="text-blue-600 font-black text-lg">
৳120
</p>

</div>

</div>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">

<img src="https://images.unsplash.com/photo-1456324504439-367cee3b3c32?q=80&w=500"
class="aspect-square object-cover">

<div class="p-4">

<h4 class="font-bold text-slate-800 text-sm">
Lecture Notes
</h4>

<p class="text-blue-600 font-black text-lg">
৳50
</p>

</div>

</div>

</div>

</div>

</div>

<!-- STATS -->

<div class="bg-slate-50 py-20">

<div class="max-w-7xl mx-auto px-4">

<div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">

<div class="bg-white p-8 rounded-3xl shadow-lg">

<h2 class="text-4xl font-black text-slate-900">
1600
</h2>

<p class="text-slate-500 mt-2">
Verified Students
</p>

</div>

<div class="bg-white p-8 rounded-3xl shadow-lg">

<h2 class="text-4xl font-black text-slate-900">
150+
</h2>

<p class="text-slate-500 mt-2">
Active Listings
</p>

</div>

<div class="bg-white p-8 rounded-3xl shadow-lg">

<h2 class="text-4xl font-black text-slate-900">
৳18k
</h2>

<p class="text-slate-500 mt-2">
Saved by Students
</p>

</div>

<div class="bg-white p-8 rounded-3xl shadow-lg">

<h2 class="text-4xl font-black text-slate-900">
4.9
</h2>

<p class="text-slate-500 mt-2">
Trust Score
</p>

</div>

</div>

</div>

</div>

<!-- CTA -->

<div class="bg-gradient-to-r from-blue-600 to-indigo-600 py-20 text-center text-white">

<h2 class="text-4xl font-black mb-6">
Ready to make your first trade?
</h2>

<div class="flex justify-center gap-6">

<a href="{{ route('products.available') }}"
class="bg-white text-slate-900 px-10 py-4 rounded-xl font-bold">
I Want to Buy
</a>

<a href="{{ route('products.post') }}"
class="bg-slate-900 px-10 py-4 rounded-xl font-bold">
I Want to Sell
</a>

</div>

</div>


<!-- MEET THE TEAM SECTION -->
<div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-indigo-950 py-24 px-6">
    <!-- Decorative Background Circles -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-purple-600/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                ✦ The People Behind CampusMart
            </span>
            <h2 class="text-5xl font-black text-white mb-4">
                Meet the <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Team</span>
            </h2>
            <p class="text-slate-400 text-lg max-w-xl mx-auto">
                The passionate minds dedicated to making campus trading easier and more accessible for every student.
            </p>
        </div>

        <!-- Team Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
            <!-- Yousha Shahid -->
            <div class="group relative bg-gradient-to-b from-white/10 to-white/5 backdrop-blur-sm rounded-[2rem] border border-white/10 p-8 text-center transition-all duration-300 hover:border-blue-400/50 hover:from-white/15 hover:to-white/10 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20">
                <div class="relative mx-auto mb-6 w-20 h-20">
                    <div class="absolute inset-0 rounded-full border-2 border-blue-400/50 group-hover:border-blue-400 transition-colors duration-300"></div>
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-3xl shadow-lg shadow-blue-500/30">
                        Y
                    </div>
                </div>
                <h3 class="text-white font-black text-xl mb-1 group-hover:text-blue-300 transition-colors">Yousha Shahid</h3>

                <div class="w-12 h-px bg-gradient-to-r from-transparent via-blue-400/50 to-transparent mx-auto mb-5"></div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-blue-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-slate-500 text-[10px] uppercase tracking-wider block">Phone</span>
                            <span class="text-white/80 text-xs font-medium break-all">01621922735</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-blue-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-slate-500 text-[10px] uppercase tracking-wider block">Email</span>
                            <span class="text-white/80 text-xs font-medium break-all">yousha.cse.20230104097@aust.edu</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aaheed Bin Ashraf -->
            <div class="group relative bg-gradient-to-b from-white/10 to-white/5 backdrop-blur-sm rounded-[2rem] border border-white/10 p-8 text-center transition-all duration-300 hover:border-blue-400/50 hover:from-white/15 hover:to-white/10 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20">
                <div class="relative mx-auto mb-6 w-20 h-20">
                    <div class="absolute inset-0 rounded-full border-2 border-blue-400/50 group-hover:border-blue-400 transition-colors duration-300"></div>
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-3xl shadow-lg shadow-blue-500/30">
                        A
                    </div>
                </div>
                <h3 class="text-white font-black text-xl mb-1 group-hover:text-blue-300 transition-colors">Aaheed Bin Ashraf</h3>

                <div class="w-12 h-px bg-gradient-to-r from-transparent via-blue-400/50 to-transparent mx-auto mb-5"></div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-blue-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-slate-500 text-[10px] uppercase tracking-wider block">Phone</span>
                            <span class="text-white/80 text-xs font-medium break-all">01762533535</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-blue-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-slate-500 text-[10px] uppercase tracking-wider block">Email</span>
                            <span class="text-white/80 text-xs font-medium break-all">aaheed.cse.20230104094@aust.edu</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Abdullah Al Noman -->
            <div class="group relative bg-gradient-to-b from-white/10 to-white/5 backdrop-blur-sm rounded-[2rem] border border-white/10 p-8 text-center transition-all duration-300 hover:border-blue-400/50 hover:from-white/15 hover:to-white/10 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20">
                <div class="relative mx-auto mb-6 w-20 h-20">
                    <div class="absolute inset-0 rounded-full border-2 border-blue-400/50 group-hover:border-blue-400 transition-colors duration-300"></div>
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-3xl shadow-lg shadow-blue-500/30">
                        A
                    </div>
                </div>
                <h3 class="text-white font-black text-xl mb-1 group-hover:text-blue-300 transition-colors">Abdullah Al Noman</h3>

                <div class="w-12 h-px bg-gradient-to-r from-transparent via-blue-400/50 to-transparent mx-auto mb-5"></div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-blue-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-slate-500 text-[10px] uppercase tracking-wider block">Phone</span>
                            <span class="text-white/80 text-xs font-medium break-all">01748606355</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-blue-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-slate-500 text-[10px] uppercase tracking-wider block">Email</span>
                            <span class="text-white/80 text-xs font-medium break-all">noman.cse.20230104088@aust.edu</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Miraz -->
            <div class="group relative bg-gradient-to-b from-white/10 to-white/5 backdrop-blur-sm rounded-[2rem] border border-white/10 p-8 text-center transition-all duration-300 hover:border-blue-400/50 hover:from-white/15 hover:to-white/10 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20">
                <div class="relative mx-auto mb-6 w-20 h-20">
                    <div class="absolute inset-0 rounded-full border-2 border-blue-400/50 group-hover:border-blue-400 transition-colors duration-300"></div>
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-3xl shadow-lg shadow-blue-500/30">
                        M
                    </div>
                </div>
                <h3 class="text-white font-black text-xl mb-1 group-hover:text-blue-300 transition-colors">GR Miraz</h3>
                <div class="w-12 h-px bg-gradient-to-r from-transparent via-blue-400/50 to-transparent mx-auto mb-5"></div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0 opacity-50">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-blue-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-slate-500 text-[10px] uppercase tracking-wider block">Phone</span>
                            <span class="text-white/40 text-xs font-medium italic">01616561269</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-left">
                        <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 text-blue-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-slate-500 text-[10px] uppercase tracking-wider block">Email</span>
                            <span class="text-white/80 text-xs font-medium break-all">miraz.cse.20230104092@aust.edu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-16 pt-8 border-t border-white/10 text-center text-slate-500 text-sm">
            © 2025 CampusMart · Built with ❤️ by AUST CSE Students
        </div>
    </div>
</div>

</x-app-layout>
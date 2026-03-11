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

</x-app-layout>
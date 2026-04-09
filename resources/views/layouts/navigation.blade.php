<div x-data="{ sidebarOpen: false, profileDropdownOpen: false }">
    <nav
        class="sticky top-0 z-50 bg-gradient-to-r from-blue-700 via-indigo-600 to-blue-700 text-white shadow-xl backdrop-blur-md bg-opacity-95"
    >
        <!-- Main Navigation Bar -->
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 relative">
                
                <!-- Left: Sidebar Toggle -->
                <div class="flex items-center z-10">
                    <button
                        @click="sidebarOpen = true"
                        class="p-2 rounded-xl bg-white/10 hover:bg-white/20 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/50 group"
                        aria-label="Open Menu"
                    >
                        <svg class="h-6 w-6 transform group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Middle: Logo and Name (Centered) -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group pointer-events-auto">
                        <div class="p-1.5 bg-white rounded-xl shadow-lg transform group-hover:rotate-6 transition-transform duration-300">
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="CampusMart Logo"
                                class="h-8 w-auto"
                            />
                        </div>
                        <span class="font-monsta tracking-[0.1em] text-3xl md:text-4xl text-white drop-shadow-[0_4px_8px_rgba(0,0,0,0.5)] hidden sm:block font-black italic">
                            CampusMart
                        </span>
                    </a>
                </div>

                <!-- Right: Profile Icon Dropdown -->
                <div class="flex items-center gap-4 z-10">
                    <div class="relative" @click.away="profileDropdownOpen = false">
                        <button
                            @click="profileDropdownOpen = !profileDropdownOpen"
                            class="flex items-center gap-2 focus:outline-none group"
                        >
                            <div class="h-11 w-11 rounded-2xl border-2 border-white/50 bg-white/10 backdrop-blur-sm flex items-center justify-center font-black text-white group-hover:border-white group-hover:bg-white/20 transition-all duration-300 shadow-xl overflow-hidden">
                                @if(Auth::user() && Auth::user()->profile && Auth::user()->profile->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}" alt="Avatar" class="h-full w-full object-cover">
                                @elseif(Auth::check())
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                @endif
                            </div>
                        </button>

                        <!-- Profile Dropdown -->
                        @auth
                        <div
                            x-show="profileDropdownOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                            class="absolute right-0 mt-4 w-56 rounded-3xl bg-white text-gray-800 shadow-2xl ring-1 ring-blue-500/10 z-50 overflow-hidden"
                            style="display: none;"
                        >
                            <div class="px-5 py-4 bg-gradient-to-br from-blue-50 to-indigo-50 border-b border-blue-100">
                                <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em] mb-1">User Account</p>
                                <p class="text-sm font-bold truncate text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="p-2">
                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-700 rounded-2xl hover:bg-blue-50 hover:text-blue-600 transition-all group"
                                >
                                    <div class="p-2 rounded-xl bg-blue-100/50 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    My Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 rounded-2xl hover:bg-red-50 transition-all group"
                                    >
                                        <div class="p-2 rounded-xl bg-red-100/50 group-hover:bg-red-600 group-hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                        </div>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <div
                            x-show="profileDropdownOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            class="absolute right-0 mt-4 w-48 rounded-3xl bg-white text-gray-800 shadow-2xl z-50 overflow-hidden p-2"
                            style="display: none;"
                        >
                            <a href="{{ route('login') }}" class="block px-4 py-3 text-sm font-bold hover:bg-blue-50 rounded-2xl">Login</a>
                            <a href="{{ route('register') }}" class="block px-4 py-3 text-sm font-bold hover:bg-blue-50 rounded-2xl">Sign Up</a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar Overlay -->
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition opacity-0 duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition opacity-100 duration-400"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-blue-900/40 backdrop-blur-md z-[100]"
        @click="sidebarOpen = false"
        style="display: none;"
    ></div>

    <!-- Sidebar Menu -->
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition transform duration-500 cubic-bezier(0.4, 0, 0.2, 1)"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform duration-500"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 h-screen w-80 bg-[#0f172a] text-slate-200 shadow-[20px_0_60px_-15px_rgba(0,0,0,0.5)] z-[110] overflow-y-auto flex flex-col border-r border-slate-800"
        style="display: none;"
    >
        <!-- Sidebar Header -->
        <div class="p-8 bg-gradient-to-b from-blue-600/20 to-transparent relative overflow-hidden shrink-0">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="flex items-center justify-between relative z-10">
                <div class="flex items-center gap-3">
                    <div>
                        <span class="font-monsta text-2xl tracking-[0.2em] block font-black">MENU</span>
                        <div class="h-1 w-12 bg-blue-500 rounded-full mt-1"></div>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="p-2 hover:bg-white/10 rounded-xl transition-all active:scale-90 text-slate-400 hover:text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>

        <!-- Sidebar Navigation Items -->
        <div class="px-4 py-2 space-y-2 flex-grow overflow-y-auto">
            @php
                $navItems = [
                    ['key' => 'home', 'label' => 'Home', 'href' => route('home'), 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['key' => 'available', 'label' => 'Available Products', 'href' => route('products.available'), 'icon' => 'M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z'],
                    ['key' => 'post', 'label' => 'Post Product', 'href' => route('products.post'), 'icon' => 'M12 4v16m8-8H4'],
                    ['key' => 'wishlist', 'label' => 'Wishlist', 'href' => route('wishlist.index'), 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                    ['key' => 'reviews', 'label' => 'Reviews', 'href' => route('reviews.index'), 'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.482-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
                    ['key' => 'report', 'label' => 'Report Issues', 'href' => route('issues.report'), 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                    ['key' => 'help', 'label' => 'Help Board', 'href' => route('help.board'), 'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['key' => 'history', 'label' => 'Payment History', 'href' => route('payment.history'), 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            @endphp

            @foreach($navItems as $item)
                @php
                    $isActive = Request::url() === $item['href'];
                @endphp
                <a
                    href="{{ $item['href'] }}"
                    class="flex items-center gap-4 px-5 py-4 rounded-[2rem] font-bold transition-all duration-300 group {{ $isActive ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                >
                    <div class="p-2 rounded-xl {{ $isActive ? 'bg-white/20' : 'bg-slate-800 group-hover:bg-blue-600/20' }} transition-colors shrink-0">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                        </svg>
                    </div>
                    <span class="tracking-wide">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>

        @auth
        <!-- Logout at bottom -->
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-5 py-4 rounded-[2rem] font-bold text-red-400 hover:bg-red-500/10 transition-all group">
                    <div class="p-2 rounded-xl bg-red-500/10 group-hover:bg-red-500 group-hover:text-white transition-all shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    </div>
                    Logout
                </button>
            </form>
        </div>
        @endauth
    </div>
</div>

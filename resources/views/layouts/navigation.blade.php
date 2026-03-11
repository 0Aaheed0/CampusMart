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
                        <span class="font-monsta tracking-[0.25em] text-2xl text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.3)] hidden sm:block">
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
        class="fixed top-0 left-0 h-screen w-80 bg-white text-gray-800 shadow-[20px_0_60px_-15px_rgba(0,0,0,0.3)] z-[110] overflow-y-auto flex flex-col"
        style="display: none;"
    >
        <!-- Sidebar Header -->
        <div class="p-6 bg-gradient-to-br from-blue-700 to-indigo-800 text-white relative overflow-hidden shrink-0">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
            <div class="flex items-center justify-between mb-6 relative z-10">
                <div class="flex items-center gap-3">
                    <div class="p-1.5 bg-white rounded-xl shadow-lg">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6">
                    </div>
                    <span class="font-monsta text-lg tracking-[0.2em]">MENU</span>
                </div>
                <button @click="sidebarOpen = false" class="p-2 hover:bg-white/20 rounded-xl transition-all active:scale-90">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            
            <div class="flex items-center gap-4 relative z-10">
                <div class="h-12 w-12 rounded-2xl bg-white/20 border-2 border-white/50 flex items-center justify-center font-black text-xl shadow-xl overflow-hidden shrink-0">
                    @auth
                        @if(Auth::user()->profile && Auth::user()->profile->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}" alt="Avatar" class="h-full w-full object-cover">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    @endauth
                </div>
                <div class="min-w-0">
                    @auth
                        <p class="font-black text-base truncate w-40 tracking-tight">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-blue-100 font-bold uppercase tracking-widest opacity-80 truncate w-40">{{ Auth::user()->email }}</p>
                    @else
                        <p class="font-black text-base tracking-tight">Guest User</p>
                        <p class="text-[10px] text-blue-100 font-bold uppercase tracking-widest opacity-80">Welcome</p>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Sidebar Navigation Items -->
        <div class="p-4 space-y-1 flex-grow overflow-y-auto">
            @php
                $navItems = [
                    ['key' => 'home', 'label' => 'Home', 'href' => route('home'), 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['key' => 'available', 'label' => 'Available Products', 'href' => route('products.available'), 'icon' => 'M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z'],
                    ['key' => 'post', 'label' => 'Post Product', 'href' => route('products.post'), 'icon' => 'M12 4v16m8-8H4'],
                    ['key' => 'report', 'label' => 'Report Issues', 'href' => route('issues.report'), 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                    ['key' => 'help', 'label' => 'Help Board', 'href' => route('help.board'), 'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            @endphp

            @foreach($navItems as $item)
                @php
                    $isActive = Request::url() === $item['href'];
                @endphp
                <a
                    href="{{ $item['href'] }}"
                    class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-black transition-all duration-300 group {{ $isActive ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20' : 'text-gray-500 hover:bg-blue-50 hover:text-blue-700' }}"
                >
                    <div class="p-2 rounded-xl {{ $isActive ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-blue-100' }} transition-colors shrink-0">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                        </svg>
                    </div>
                    <span class="tracking-tight">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

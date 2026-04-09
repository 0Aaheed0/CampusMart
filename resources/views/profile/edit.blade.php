<x-app-layout>
    <style>
        .page-bg {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
        }

        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: #3b82f6;
            filter: blur(140px);
            opacity: 0.15;
            border-radius: 50%;
            animation: move 20s infinite alternate;
        }

        .blob2 { right: -150px; bottom: -150px; background: #22c55e; }
        .blob3 { left: -150px; top: -150px; background: #60a5fa; }

        @keyframes move {
            from { transform: translate(0, 0) }
            to { transform: translate(80px, 60px) }
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(25px) saturate(160%);
            -webkit-backdrop-filter: blur(25px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
        }
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23cbd5e1'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
        }
        /* Glowing Button Effect */
        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.5);
            transform: translateY(-2px);
        }
        .btn-glow-indigo:hover {
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.5);
            transform: translateY(-2px);
        }
    </style>

    <div x-data="{ showConfirmModal: false }" class="py-12 page-bg min-h-screen relative overflow-hidden">
        <!-- Background Blobs -->
        <div class="blob blob3"></div>
        <div class="blob"></div>
        <div class="blob blob2"></div>

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">
            
            <!-- Profile Header Glass Box -->
            <div class="glass-container shadow-2xl overflow-hidden transition-all duration-500 hover:shadow-blue-500/20">
                <div class="h-32 bg-gradient-to-r from-blue-500/40 to-indigo-600/40 relative">
                    <div class="absolute inset-0 bg-white/5 backdrop-blur-sm"></div>
                </div>
                <div class="px-8 pb-8 flex flex-col md:flex-row items-center gap-8 -mt-16 relative z-10">
                    <div class="relative group">
                        <img id="preview" src="{{ $profile->profile_picture ? asset('storage/' . $profile->profile_picture) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=EBF4FF&color=2563EB&size=256' }}" 
                             class="h-36 w-36 rounded-[2rem] object-cover border-4 border-white shadow-2xl bg-white group-hover:scale-105 transition-transform duration-300">
                        <label for="profile_picture" class="absolute -bottom-2 -right-2 bg-blue-600 p-3 rounded-2xl text-white cursor-pointer hover:bg-blue-700 shadow-lg transition active:scale-90 border-2 border-white btn-glow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </label>
                    </div>
                    
                    <div class="text-center md:text-left pt-12 md:pt-16 flex-1">
                        <h1 class="text-4xl font-black text-white tracking-tight">{{ $user->name }}</h1>
                        <p class="text-blue-100 font-bold text-lg mt-1 opacity-90">{{ $user->email }}</p>
                        <div class="mt-5 flex flex-wrap justify-center md:justify-start gap-3">
                            @if($profile->department)
                                <span class="px-5 py-2 bg-white/10 backdrop-blur-md text-white text-xs font-black rounded-2xl border border-white/20 shadow-sm uppercase tracking-widest">{{ $profile->department }}</span>
                            @endif
                            @if($profile->student_id)
                                <span class="px-5 py-2 bg-white/10 backdrop-blur-md text-white text-xs font-black rounded-2xl border border-white/20 shadow-sm uppercase tracking-widest">ID: {{ $profile->student_id }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <form id="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" autocomplete="off" class="space-y-8">
                @csrf
                @method('patch')
                <input type="file" id="profile_picture" name="profile_picture" class="hidden" onchange="previewImage(event)">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Basic Info Box -->
                    <div class="lg:col-span-1 space-y-8">
                        <div class="p-8 glass-card shadow-xl ring-1 ring-white/10">
                            <h3 class="text-xs font-black text-blue-300 uppercase tracking-[0.3em] mb-8 flex items-center gap-3">
                                <div class="p-2 rounded-xl bg-blue-500/20 text-blue-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                Basic Info
                            </h3>
                            <div class="space-y-5">
                                <div>
                                    <x-input-label for="name" :value="__('Full Name')" class="text-[10px] font-black text-slate-400 uppercase ml-1 tracking-widest" />
                                    <x-text-input id="name" name="name" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white" :value="old('name', $user->name)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Email Address')" class="text-[10px] font-black text-slate-400 uppercase ml-1 tracking-widest" />
                                    <x-text-input id="email" name="email" type="email" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white" :value="old('email', $user->email)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                            </div>
                        </div>

                        <!-- Security Box -->
                        <div class="p-8 glass-card shadow-xl ring-1 ring-white/10">
                            <h3 class="text-xs font-black text-red-400 uppercase tracking-[0.3em] mb-8 flex items-center gap-3">
                                <div class="p-2 rounded-xl bg-red-500/20 text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                </div>
                                Security
                            </h3>
                            <div class="space-y-5">
                                <div>
                                    <x-input-label for="current_password" :value="__('Current Password')" class="text-[10px] font-black text-slate-400 uppercase ml-1 tracking-widest" />
                                    <x-text-input id="current_password" name="current_password" type="password" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 transition-all text-white placeholder:text-slate-600" placeholder="Enter current to save" />
                                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="password" :value="__('New Password')" class="text-[10px] font-black text-slate-400 uppercase ml-1 tracking-widest" />
                                    <x-text-input id="password" name="password" type="password" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 transition-all text-white placeholder:text-slate-600" placeholder="Min 8 characters" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-[10px] font-black text-slate-400 uppercase ml-1 tracking-widest" />
                                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 transition-all text-white" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Info Box -->
                    <div class="lg:col-span-2 p-10 glass-card shadow-xl ring-1 ring-white/10 flex flex-col">
                        <h3 class="text-xs font-black text-indigo-300 uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                            <div class="p-2.5 rounded-xl bg-indigo-500/20 text-indigo-300 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                            Academic Profile
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 flex-grow">
                            <div class="md:col-span-2">
                                <x-input-label for="student_id" :value="__('Student ID')" class="text-[11px] font-black text-slate-400 uppercase ml-1 tracking-[0.2em]" />
                                <x-text-input id="student_id" name="student_id" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 transition-all font-bold text-white placeholder:text-slate-600" :value="old('student_id', $profile->student_id)" placeholder="e.g. 210104001" />
                                <x-input-error class="mt-2" :messages="$errors->get('student_id')" />
                            </div>
                            
                            <div>
                                <x-input-label for="department" :value="__('Department')" class="text-[11px] font-black text-slate-400 uppercase ml-1 tracking-[0.2em]" />
                                <select id="department" name="department" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white">
                                    <option value="" disabled {{ !old('department', $profile->department) ? 'selected' : '' }}>Select Department</option>
                                    @foreach(['CSE', 'EEE', 'CE', 'ME', 'IPE', 'BBA', 'ARCHITECTURE', 'TE'] as $dept)
                                        <option value="{{ $dept }}" class="bg-slate-800" {{ old('department', $profile->department) == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('department')" />
                            </div>

                            <div>
                                <x-input-label for="batch" :value="__('Batch Number')" class="text-[11px] font-black text-slate-400 uppercase ml-1 tracking-[0.2em]" />
                                <x-text-input id="batch" name="batch" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 transition-all font-bold text-white placeholder:text-slate-600" :value="old('batch', $profile->batch)" placeholder="e.g. 48th" />
                                <x-input-error class="mt-2" :messages="$errors->get('batch')" />
                            </div>

                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <x-input-label for="year" :value="__('Year')" class="text-[11px] font-black text-slate-400 uppercase ml-1 tracking-[0.2em]" />
                                    <select id="year" name="year" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white">
                                        <option value="" disabled {{ !old('year', $profile->year) ? 'selected' : '' }}>Year</option>
                                        @foreach(['1st', '2nd', '3rd', '4th', '5th'] as $y)
                                            <option value="{{ $y }}" class="bg-slate-800" {{ old('year', $profile->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="semester" :value="__('Semester')" class="text-[11px] font-black text-slate-400 uppercase ml-1 tracking-[0.2em]" />
                                    <select id="semester" name="semester" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white">
                                        <option value="" disabled {{ !old('semester', $profile->semester) ? 'selected' : '' }}>Sem</option>
                                        @foreach(['1st', '2nd'] as $s)
                                            <option value="{{ $s }}" class="bg-slate-800" {{ old('semester', $profile->semester) == $s ? 'selected' : '' }}>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="gender" :value="__('Gender')" class="text-[11px] font-black text-slate-400 uppercase ml-1 tracking-[0.2em]" />
                                <select id="gender" name="gender" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 focus:ring-blue-500/20 transition-all font-bold text-white">
                                    <option value="Male" class="bg-slate-800" {{ old('gender', $profile->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" class="bg-slate-800" {{ old('gender', $profile->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" class="bg-slate-800" {{ old('gender', $profile->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="number" :value="__('Contact Number')" class="text-[11px] font-black text-slate-400 uppercase ml-1 tracking-[0.2em]" />
                                <x-text-input id="number" name="number" type="text" class="mt-2 block w-full rounded-2xl border-white/10 bg-white/5 focus:bg-white/10 transition-all font-bold text-white placeholder:text-slate-600" :value="old('number', $profile->number)" placeholder="+8801XXXXXXXXX" />
                                <x-input-error class="mt-2" :messages="$errors->get('number')" />
                            </div>
                        </div>

                        <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-6 p-8 bg-blue-500/10 rounded-[2rem] border border-white/10">
                            <p class="text-sm text-blue-100 font-bold opacity-70 text-center sm:text-left">Ensure your academic details are accurate for verification.</p>
                            <button 
                                type="button" 
                                @click="showConfirmModal = true"
                                class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-blue-500/20 hover:scale-[1.02] transition-all active:scale-95 flex items-center justify-center gap-3 btn-glow"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Save Profile Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Confirmation Modal -->
            <div 
                x-show="showConfirmModal" 
                class="fixed inset-0 z-[150] flex items-center justify-center p-4"
                style="display: none;"
            >
                <div @click="showConfirmModal = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-md"></div>
                <div class="relative glass-card p-10 max-w-md w-full shadow-2xl text-center border-white/20">
                    <div class="w-20 h-20 bg-blue-500/20 rounded-3xl flex items-center justify-center mx-auto mb-6 text-blue-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">Confirm Updates</h3>
                    <p class="text-slate-300 font-bold mb-8">Are you sure you want to update your profile information and security settings?</p>
                    <div class="flex gap-4">
                        <button @click="showConfirmModal = false" class="flex-1 px-6 py-4 bg-white/10 text-white rounded-2xl font-black hover:bg-white/20 transition-all">Cancel</button>
                        <button onclick="document.getElementById('profile-form').submit()" class="flex-1 px-6 py-4 bg-blue-600 text-white rounded-2xl font-black shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all btn-glow">Confirm</button>
                    </div>
                </div>
            </div>

            @if (session('status') === 'profile-updated')
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    class="fixed bottom-10 right-10 bg-white/10 backdrop-blur-xl text-blue-300 px-8 py-5 rounded-3xl shadow-2xl border border-white/20 font-black flex items-center gap-4 z-[100]"
                >
                    <div class="bg-blue-500/20 p-2 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    Changes Saved Successfully
                </div>
            @endif

        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>

<x-app-layout>
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-slate-900 mb-2">Help Board</h1>
                <p class="text-lg text-slate-600">Frequently Asked Questions</p>
            </div>

            <div class="bg-white rounded-[2.5rem] p-10 mt-10 shadow-sm">
                @foreach($helpBoards as $item)
                    <div class="bg-slate-50 rounded-2xl p-6 mb-4 last:mb-0">
                        <div class="flex items-start gap-4 mb-4">
                            <span class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                Q
                            </span>
                            <h3 class="text-xl font-bold text-slate-800 pt-0.5">
                                {{ $item->title }}
                            </h3>
                        </div>

                        <div class="flex items-start gap-4">
                            <span class="bg-emerald-500 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                A
                            </span>
                            <div class="text-slate-600 text-lg leading-relaxed pt-0.5">
                                {{ $item->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

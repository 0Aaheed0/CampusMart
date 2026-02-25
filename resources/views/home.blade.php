<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-blue-200">
                    <h3 class="text-2xl font-bold text-blue-800">Welcome to your CampusMart Home!</h3>
                    <p class="mt-4 text-gray-600">Here you can find all the resources you need.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

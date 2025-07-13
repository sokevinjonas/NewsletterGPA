<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-100 p-6 rounded shadow">
                            <div class="text-2xl font-bold">{{ $subscribers_count ?? 0 }}</div>
                            <div class="text-gray-700">Abonnés</div>
                        </div>
                        <div class="bg-green-100 p-6 rounded shadow">
                            <div class="text-2xl font-bold">{{ $templates_count ?? 0 }}</div>
                            <div class="text-gray-700">Templates</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a8 8 0 11-16 0 8 8 0 0116 0zm-8 0v4m0-4V8" /></svg>
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-green-50 min-h-[80vh]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center hover:scale-105 transition-transform duration-200 border-t-4 border-blue-400">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-block bg-blue-100 text-blue-600 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a8 8 0 11-16 0 8 8 0 0116 0zm-8 0v4m0-4V8" /></svg>
                        </span>
                        <span class="text-4xl font-extrabold text-blue-700">{{ $subscribers_count ?? 0 }}</span>
                    </div>
                    <div class="text-lg text-gray-700 font-semibold">Abonnés</div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center hover:scale-105 transition-transform duration-200 border-t-4 border-green-400">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-block bg-green-100 text-green-600 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4m0 0V7a4 4 0 00-4-4H7a4 4 0 00-4 4v10a4 4 0 004 4h4" /></svg>
                        </span>
                        <span class="text-4xl font-extrabold text-green-700">{{ $templates_count ?? 0 }}</span>
                    </div>
                    <div class="text-lg text-gray-700 font-semibold">Modèles</div>
                </div>
            </div>
            <div class="mt-12 flex flex-col md:flex-row gap-6 justify-center items-center">
                <a href="{{ route('subscribers.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg shadow transition-all duration-200 text-lg">Gérer les abonnés</a>
                <a href="{{ route('templates.index') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg shadow transition-all duration-200 text-lg">Gérer les modèles</a>
                <a href="{{ route('newsletter.send.form') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 px-8 rounded-lg shadow transition-all duration-200 text-lg">Envoyer une newsletter</a>
            </div>
        </div>
    </div>
</x-app-layout>

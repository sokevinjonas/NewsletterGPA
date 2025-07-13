<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Créer un modèle
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-50 to-blue-50 min-h-[80vh]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form method="POST" action="{{ route('templates.store') }}">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Titre</label>
                        <input type="text" name="title" class="auth-input" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Contenu HTML</label>
                        <textarea name="content" rows="6" class="auth-input" required></textarea>
                    </div>
                    <button type="submit" class="auth-button">Créer</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un template') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('templates.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Titre</label>
                            <input type="text" name="title" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Contenu HTML</label>
                            <textarea name="content" rows="6" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required></textarea>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

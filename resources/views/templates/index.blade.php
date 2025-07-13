<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h4m0 0V7a4 4 0 00-4-4H7a4 4 0 00-4 4v10a4 4 0 004 4h4" /></svg>
            Modèles
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-50 to-blue-50 min-h-[80vh]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('templates.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow card-hover">Créer un nouveau modèle</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aperçu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($templates as $template)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $template->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{!! Str::limit(strip_tags($template->content), 50) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

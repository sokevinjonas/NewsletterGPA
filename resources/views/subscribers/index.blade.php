<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a8 8 0 11-16 0 8 8 0 0116 0zm-8 0v4m0-4V8" /></svg>
            Abonnés
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-green-50 min-h-[80vh]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="mb-4 flex justify-end">
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow card-hover">Ajouter un abonné</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'inscription</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $subscriber->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $subscriber->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $subscriber->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

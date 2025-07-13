<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a8 8 0 11-16 0 8 8 0 0116 0zm-8 0v4m0-4V8" /></svg>
            Envoyer une newsletter
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-50 to-blue-50 min-h-[80vh]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('newsletter.send') }}">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Sélectionner un modèle</label>
                        <select name="template_id" class="auth-input" required>
                            <option value="">-- Choisir --</option>
                            @foreach($templates as $template)
                                <option value="{{ $template->id }}">{{ $template->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="auth-button">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

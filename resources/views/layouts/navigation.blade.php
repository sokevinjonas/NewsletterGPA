<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('subscribers.index')" :active="request()->routeIs('subscribers.index')">
                        Abonnés
                    </x-nav-link>
                    <x-nav-link :href="route('templates.index')" :active="request()->routeIs('templates.index')">
                        Templates
                    </x-nav-link>
                    <div x-data="newsletterMenu()" class="relative">
                        <button @click="open = !open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            Envoyer un mail
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute z-50 mt-2 w-80 bg-white border border-gray-200 rounded shadow-lg">
                            <div class="flex justify-between items-center px-4 py-2 border-b">
                                <span class="font-semibold">Newsletters envoyées</span>
                                <button @click="showModal = true" class="bg-blue-500 hover:bg-blue-700 text-white text-xs px-2 py-1 rounded">Envoyer nouveau mail</button>
                            </div>
                            <div class="max-h-60 overflow-y-auto">
                                <template x-for="mail in paginatedMails()" :key="mail.id">
                                    <div class="px-4 py-2 border-b text-sm">
                                        <span class="font-bold" x-text="mail.title"></span>
                                        <span class="text-gray-500 ml-2" x-text="mail.date"></span>
                                    </div>
                                </template>
                            </div>
                            <div class="flex justify-between items-center px-4 py-2">
                                <button @click="prevPage" :disabled="page === 1" class="text-xs text-gray-500">Précédent</button>
                                <span class="text-xs">Page <span x-text="page"></span></span>
                                <button @click="nextPage" :disabled="page === totalPages()" class="text-xs text-gray-500">Suivant</button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                                <button @click="showModal = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">&times;</button>
                                <h3 class="text-lg font-semibold mb-4">Envoyer une newsletter</h3>
                                <form @submit.prevent="sendNewsletter">
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Sélectionner un template</label>
                                        <select x-model="selectedTemplate" @change="updateTemplateContent" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                                            <option value="">-- Choisir --</option>
                                            <template x-for="template in templates" :key="template.id">
                                                <option :value="template.id" x-text="template.title"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Aperçu du contenu</label>
                                        <div class="border rounded p-2 bg-gray-50 min-h-[80px]" x-html="templateContent"></div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Envoyer à</label>
                                        <select x-model="sendTo" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                                            <option value="all">Tout le monde</option>
                                            <option value="week">Inscrits cette semaine</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Envoyer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

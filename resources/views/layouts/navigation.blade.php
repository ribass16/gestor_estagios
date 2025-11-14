<nav x-data="{ open: false }" class="relative z-50 bg-gradient-to-r from-gray-800/50 via-gray-800/40 to-gray-800/50 dark:from-gray-800/50 dark:via-gray-800/40 dark:to-gray-800/50 backdrop-blur-lg border-b border-gray-700/40 shadow-2xl shadow-gray-900/50">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="
                        @if(Auth::user()->user_type === 'admin')
                            {{ route('admin.dashboard') }}
                        @elseif(Auth::user()->user_type === 'aluno')
                            {{ route('aluno.dashboard') }}
                        @elseif(Auth::user()->user_type === 'empresa')
                            {{ route('empresa.dashboard') }}
                        @elseif(Auth::user()->user_type === 'orientador')
                            {{ route('orientador.dashboard') }}
                        @endif
                    ">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link
                        :href="
                            Auth::user()->user_type === 'admin' ? route('admin.dashboard') :
                            (Auth::user()->user_type === 'aluno' ? route('aluno.dashboard') :
                            (Auth::user()->user_type === 'empresa' ? route('empresa.dashboard') :
                            route('orientador.dashboard')))
                        "
                        :active="request()->routeIs('*.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- LINKS DO ALUNO --}}
                    @if(Auth::user()->user_type === 'aluno')
                        <x-nav-link :href="route('vagas.index')" :active="request()->routeIs('vagas.*')">
                            {{ __('Vagas Disponíveis') }}
                        </x-nav-link>

                        <x-nav-link :href="route('candidaturas.index')" :active="request()->routeIs('candidaturas.index')">
                            {{ __('As Minhas Candidaturas') }}
                        </x-nav-link>
                    @endif

                    {{-- LINKS DA EMPRESA --}}
                    @if(Auth::user()->user_type === 'empresa')
                        <x-nav-link :href="route('vagas.index')" :active="request()->routeIs('vagas.index')">
                            {{ __('Minhas Vagas') }}
                        </x-nav-link>

                        <x-nav-link :href="route('vagas.create')" :active="request()->routeIs('vagas.create')">
                            {{ __('Criar Nova Vaga') }}
                        </x-nav-link>

                        <x-nav-link :href="route('empresa.candidaturas.index')" :active="request()->routeIs('empresa.candidaturas.index')">
                            {{ __('Candidaturas Recebidas') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side (Dropdown + Logout Button) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- User Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @php
                                $tipo = Auth::user()->user_type;
                            @endphp

                            {{-- Link para o perfil conforme o tipo --}}
                            @if ($tipo === 'aluno')
                                <x-dropdown-link :href="route('aluno.perfil')">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>
                            @elseif ($tipo === 'empresa')
                                <x-dropdown-link :href="route('empresa.perfil')">
                                    {{ __('Perfil da Empresa') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('empresa.responsavel')">
                                    {{ __('Perfil do Responsável') }}
                                </x-dropdown-link>
                            @elseif ($tipo === 'orientador')
                                <x-dropdown-link :href="route('orientador.perfil')">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>
                            @elseif ($tipo === 'admin')
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    {{ __('Perfil (Admin)') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>

                            <!-- Botão para sair -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link
                :href="
                    Auth::user()->user_type === 'admin' ? route('admin.dashboard') :
                    (Auth::user()->user_type === 'aluno' ? route('aluno.dashboard') :
                    (Auth::user()->user_type === 'empresa' ? route('empresa.dashboard') :
                    route('orientador.dashboard')))
                "
                :active="request()->routeIs('*.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->user_type === 'aluno')
                <x-responsive-nav-link :href="route('vagas.index')" :active="request()->routeIs('vagas.*')">
                    {{ __('Vagas Disponíveis') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('candidaturas.index')" :active="request()->routeIs('candidaturas.index')">
                    {{ __('As Minhas Candidaturas') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Sair') }}
                </x-responsive-nav-link>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>

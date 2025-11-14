<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 text-transparent bg-clip-text font-bold leading-tight">
                Vagas Disponíveis
            </h2>
            <p class="text-gray-400 mt-2">Descobre oportunidades de estágio nas melhores empresas</p>
        </div>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- Mensagens --}}
            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-300 p-4 mb-6 rounded-xl flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500/20 border border-red-500/50 text-red-300 p-4 mb-6 rounded-xl flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-500/20 border border-yellow-500/50 text-yellow-300 p-4 mb-6 rounded-xl flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('warning') }}
                </div>
            @endif

            {{-- Header com estatísticas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Total de Vagas -->
                <div class="group relative p-6 bg-gradient-to-br from-blue-800/30 to-blue-900/30 rounded-xl border border-blue-700/40 hover:border-blue-500/60 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-blue-300 uppercase tracking-wide">Total de Vagas</span>
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4v10M7 12v10m6-10v10"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $vagas->count() }}</p>
                    </div>
                </div>

                <!-- Vagas Recentes -->
                <div class="group relative p-6 bg-gradient-to-br from-purple-800/30 to-purple-900/30 rounded-xl border border-purple-700/40 hover:border-purple-500/60 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-purple-300 uppercase tracking-wide">Publicadas Esta Semana</span>
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $vagas->filter(fn($v) => $v->created_at->diffInDays() <= 7)->count() }}</p>
                    </div>
                </div>

                <!-- Empresas -->
                <div class="group relative p-6 bg-gradient-to-br from-indigo-800/30 to-indigo-900/30 rounded-xl border border-indigo-700/40 hover:border-indigo-500/60 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-indigo-300 uppercase tracking-wide">Empresas Parceiras</span>
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.582a2 2 0 00-1.9 1.1M5 21H3m2 0h5.582a2 2 0 011.9 1.1M5 21v-16m0 0h10"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $vagas->pluck('empresa_id')->unique()->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Lista de vagas --}}
            <div class="space-y-6">
                @forelse ($vagas as $vaga)
                    <div class="group relative p-8 bg-gradient-to-br from-gray-800/50 to-gray-900/50 rounded-2xl border border-gray-700/40 hover:border-indigo-500/50 transition-all duration-300 backdrop-blur-xl shadow-xl hover:shadow-indigo-500/10">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <div class="relative">
                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                                <!-- Conteúdo Principal -->
                                <div class="flex-1 min-w-0">
                                    <!-- Empresa e Badge -->
                                    <div class="flex items-center gap-3 mb-4 flex-wrap">
                                        <span class="px-4 py-1.5 bg-indigo-500/20 border border-indigo-500/40 text-indigo-300 text-xs font-bold rounded-full uppercase tracking-wider">
                                            {{ $vaga->empresa->nome ?? $vaga->empresa->user->name ?? 'Empresa' }}
                                        </span>
                                        <span class="px-3 py-1.5 bg-green-500/20 border border-green-500/40 text-green-300 text-xs font-bold rounded-full uppercase">
                                            Aberta
                                        </span>
                                    </div>

                                    <!-- Título -->
                                    <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-indigo-300 transition-colors">
                                        {{ $vaga->titulo }}
                                    </h3>

                                    <!-- Descrição -->
                                    <p class="text-gray-300 mb-4 line-clamp-2">
                                        {{ $vaga->descricao }}
                                    </p>

                                    <!-- Detalhes -->
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                        @if($vaga->localizacao)
                                            <div class="flex items-center gap-2 text-sm text-gray-400">
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span class="font-medium">{{ $vaga->localizacao }}</span>
                                            </div>
                                        @endif

                                        @if($vaga->tipo_contrato)
                                            <div class="flex items-center gap-2 text-sm text-gray-400">
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <span class="font-medium capitalize">{{ $vaga->tipo_contrato }}</span>
                                            </div>
                                        @endif

                                        <div class="flex items-center gap-2 text-sm text-gray-400">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="font-medium">{{ $vaga->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botões Ação -->
                                <div class="flex flex-col gap-3 lg:min-w-fit">
                                    @if ($user && $user->user_type === 'aluno')
                                        @if(in_array($vaga->id, $candidaturasIds ?? []))
                                            <div class="flex items-center gap-2 px-5 py-2.5 bg-gray-700/50 border border-gray-600/40 text-gray-300 font-semibold rounded-lg">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Candidato
                                            </div>
                                        @else
                                            <form action="{{ route('candidaturas.store', $vaga->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold px-6 py-2.5 rounded-lg transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-indigo-500/50 flex items-center justify-center gap-2">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                    </svg>
                                                    Candidatar-me
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                    @if ($user && $user->user_type === 'admin')
                                        <a href="{{ route('vagas.show', $vaga->id) }}"
                                           class="w-full bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white font-bold px-6 py-2.5 rounded-lg transition-all duration-300 hover:scale-105 flex items-center justify-center gap-2 shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Ver Detalhes
                                        </a>
                                    @endif

                                    <a href="{{ route('vagas.show', $vaga->id) }}"
                                       class="w-full bg-gray-700/50 hover:bg-gray-600/50 text-gray-300 hover:text-white font-semibold px-6 py-2.5 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 border border-gray-600/40">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Mais Info
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="relative p-16 bg-gradient-to-br from-gray-800/50 to-gray-900/50 rounded-2xl border border-gray-700/40 backdrop-blur text-center">
                        <div class="flex justify-center mb-6">
                            <div class="p-4 bg-gray-700/30 rounded-full">
                                <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xl font-semibold text-gray-300 mb-2">
                            Não há vagas disponíveis no momento
                        </p>
                        <p class="text-gray-400">
                            Volta mais tarde para ver novas oportunidades de estágio.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

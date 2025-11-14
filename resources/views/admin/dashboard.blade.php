<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                <svg class="w-7 h-7 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Dashboard Administrativo
            </h2>
            <p class="text-sm text-gray-400 mt-1">Visão geral do sistema de gestão de estágios</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-7">

            {{-- Cards de Estatísticas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">

                {{-- Card Alunos --}}
                <a href="{{ route('admin.alunos.index') }}" class="group relative bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-300 hover:-translate-y-1.5 border border-gray-700/50 hover:border-indigo-400 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-500/5 rounded-full blur-2xl group-hover:bg-indigo-500/10 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-indigo-500/10 rounded-xl group-hover:bg-indigo-500/20 transition-colors ring-1 ring-indigo-400/20">
                                <svg class="w-6 h-6 text-indigo-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-white mb-1.5 group-hover:text-indigo-300 transition-colors">{{ $alunosTotal }}</div>
                        <div class="text-sm text-gray-400 font-semibold tracking-wide">Alunos Registados</div>
                    </div>
                </a>

                {{-- Card Empresas --}}
                <a href="{{ route('admin.empresas.index') }}" class="group relative bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 hover:-translate-y-1.5 border border-gray-700/50 hover:border-blue-400 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/5 rounded-full blur-2xl group-hover:bg-blue-500/10 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-blue-500/10 rounded-xl group-hover:bg-blue-500/20 transition-colors ring-1 ring-blue-400/20">
                                <svg class="w-6 h-6 text-blue-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            @if(($empresasPendentes ?? 0) > 0)
                                <span class="px-2.5 py-1 bg-amber-500/20 text-amber-300 text-xs font-bold rounded-full ring-1 ring-amber-400/30 animate-pulse">
                                    {{ $empresasPendentes }}
                                </span>
                            @endif
                        </div>
                        <div class="text-3xl font-bold text-white mb-1.5 group-hover:text-blue-300 transition-colors">{{ $empresasTotal }}</div>
                        <div class="text-sm text-gray-400 font-semibold tracking-wide">Empresas Parceiras</div>
                        @if(($empresasPendentes ?? 0) > 0)
                            <div class="text-xs text-amber-400 mt-2 font-medium flex items-center">
                                <span class="w-1.5 h-1.5 bg-amber-400 rounded-full mr-1.5 animate-pulse"></span>
                                {{ $empresasPendentes }} aguardando aprovação
                            </div>
                        @endif
                    </div>
                </a>

                {{-- Card Orientadores --}}
                <a href="{{ route('admin.orientadores.index') }}" class="group relative bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-300 hover:-translate-y-1.5 border border-gray-700/50 hover:border-purple-400 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500/5 rounded-full blur-2xl group-hover:bg-purple-500/10 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-purple-500/10 rounded-xl group-hover:bg-purple-500/20 transition-colors ring-1 ring-purple-400/20">
                                <svg class="w-6 h-6 text-purple-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            @if(($orientadoresPendentes ?? 0) > 0)
                                <span class="px-2.5 py-1 bg-amber-500/20 text-amber-300 text-xs font-bold rounded-full ring-1 ring-amber-400/30 animate-pulse">
                                    {{ $orientadoresPendentes }}
                                </span>
                            @endif
                        </div>
                        <div class="text-3xl font-bold text-white mb-1.5 group-hover:text-purple-300 transition-colors">{{ $orientadoresTotal }}</div>
                        <div class="text-sm text-gray-400 font-semibold tracking-wide">Orientadores</div>
                        @if(($orientadoresPendentes ?? 0) > 0)
                            <div class="text-xs text-amber-400 mt-2 font-medium flex items-center">
                                <span class="w-1.5 h-1.5 bg-amber-400 rounded-full mr-1.5 animate-pulse"></span>
                                {{ $orientadoresPendentes }} aguardando aprovação
                            </div>
                        @endif
                    </div>
                </a>

                {{-- Card Vagas --}}
                <a href="{{ route('admin.vagas.index') }}" class="group relative bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-green-500/10 transition-all duration-300 hover:-translate-y-1.5 border border-gray-700/50 hover:border-green-400 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-green-500/5 rounded-full blur-2xl group-hover:bg-green-500/10 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-green-500/10 rounded-xl group-hover:bg-green-500/20 transition-colors ring-1 ring-green-400/20">
                                <svg class="w-6 h-6 text-green-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-white mb-1.5 group-hover:text-green-300 transition-colors">{{ $vagasAbertas }}</div>
                        <div class="text-sm text-gray-400 font-semibold tracking-wide">Vagas Disponíveis</div>
                    </div>
                </a>

                {{-- Card Estágios --}}
                <a href="{{ route('admin.estagios.index') }}" class="group relative bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-cyan-500/10 transition-all duration-300 hover:-translate-y-1.5 border border-gray-700/50 hover:border-cyan-400 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-500/5 rounded-full blur-2xl group-hover:bg-cyan-500/10 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-cyan-500/10 rounded-xl group-hover:bg-cyan-500/20 transition-colors ring-1 ring-cyan-400/20">
                                <svg class="w-6 h-6 text-cyan-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-white mb-1.5 group-hover:text-cyan-300 transition-colors">{{ $estagiosAtivos }}</div>
                        <div class="text-sm text-gray-400 font-semibold tracking-wide">Estágios em Curso</div>
                    </div>
                </a>

            </div>

            {{-- Últimas Candidaturas --}}
            @if(($ultimasCandidaturas ?? collect())->count() > 0)
                <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 rounded-2xl shadow-xl border border-gray-700/50 overflow-hidden">
                    <div class="p-6 border-b border-gray-700/70 bg-gradient-to-r from-gray-800/50 to-transparent">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <div class="p-2 bg-indigo-500/10 rounded-lg mr-3 ring-1 ring-indigo-400/20">
                                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span>Atividade Recente</span>
                            </h3>
                            <span class="text-sm text-gray-400 font-medium bg-gray-700/50 px-3 py-1 rounded-full">Últimas 5 candidaturas</span>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-700/50">
                        @foreach($ultimasCandidaturas as $candidatura)
                            <div class="p-6 hover:bg-gray-800/60 transition-all duration-200 group">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-3">
                                            <div class="relative">
                                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-xl flex items-center justify-center mr-4 ring-1 ring-indigo-400/30 group-hover:ring-indigo-400/50 transition-all">
                                                    @php
                                                        $nomeAluno = $candidatura->aluno?->user?->name ?? '??';
                                                        $iniciais  = strtoupper(substr($nomeAluno, 0, 2));
                                                    @endphp
                                                    <span class="text-indigo-300 font-bold text-base">{{ $iniciais }}</span>
                                                </div>
                                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-gray-800"></div>
                                            </div>
                                            <div>
                                                <div class="text-white font-semibold text-base group-hover:text-indigo-300 transition-colors">
                                                    {{ $nomeAluno }}
                                                </div>
                                                <div class="text-sm text-gray-400 flex items-center mt-0.5">
                                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $candidatura->aluno?->user?->email ?? '—' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ml-16 bg-gray-900/50 rounded-lg p-3 border border-gray-700/50">
                                            <div class="text-sm text-gray-300 flex items-start">
                                                <svg class="w-4 h-4 text-indigo-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <div>
                                                    <span class="text-gray-400">Candidatura para</span>
                                                    <span class="text-white font-semibold mx-1">{{ $candidatura->vaga?->titulo ?? '—' }}</span>
                                                    <div class="flex items-center mt-1 text-xs text-gray-500">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                        </svg>
                                                        {{ $candidatura->vaga?->empresa?->nome ?? '—' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end space-y-2">
                                        @php
                                            $estadoConfig = [
                                                'pendente'  => ['bg' => 'bg-amber-500/15', 'text' => 'text-amber-300', 'ring' => 'ring-amber-400/30', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Pendente'],
                                                'aceite'    => ['bg' => 'bg-green-500/15', 'text' => 'text-green-300', 'ring' => 'ring-green-400/30', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Aceite'],
                                                'rejeitada' => ['bg' => 'bg-red-500/15', 'text' => 'text-red-300', 'ring' => 'ring-red-400/30', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Rejeitada'],
                                            ];
                                            $config = $estadoConfig[$candidatura->estado] ?? $estadoConfig['pendente'];
                                        @endphp
                                        <span class="px-3.5 py-1.5 {{ $config['bg'] }} {{ $config['text'] }} text-xs font-bold rounded-lg ring-1 {{ $config['ring'] }} flex items-center">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                                            </svg>
                                            {{ $config['label'] }}
                                        </span>
                                        <span class="text-xs text-gray-500 font-medium flex items-center bg-gray-800/50 px-2 py-1 rounded">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ optional($candidatura->created_at)->diffForHumans() ?? '—' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

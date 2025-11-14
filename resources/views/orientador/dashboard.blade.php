<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl bg-gradient-to-r from-purple-400 via-pink-400 to-red-400 text-transparent bg-clip-text font-bold leading-tight">
                Dashboard do Orientador
            </h2>
            <p class="text-gray-400 mt-2">Acompanha o progresso dos teus alunos em estágio</p>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- Bem-vindo --}}
            <div class="mb-8 bg-gradient-to-r from-purple-600/20 via-pink-600/20 to-red-600/20 border border-purple-500/30 rounded-2xl shadow-xl p-8 text-gray-100 backdrop-blur-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">Bem-vindo, {{ $orientador->user->name }}! 👋</h3>
                        <p class="text-gray-300">Acompanha os teus alunos em estágio e orienta-os na sua jornada profissional.</p>
                    </div>
                    <div class="hidden lg:block p-4 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full opacity-10">
                        <svg class="w-16 h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.596 6.753 2.668 7.542 2 12c.668 4.458 4.596 5.247 10 5.747m0-13c5.404.5 9.332 1.289 10 5.747m0 0c-.668 4.458-4.596 5.247-10 5.747"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Estatísticas --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <!-- Total Alunos -->
                <div class="group relative p-6 bg-gradient-to-br from-blue-800/30 to-blue-900/30 rounded-xl border border-blue-700/40 hover:border-blue-500/60 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-blue-300 uppercase tracking-wide">Total de Alunos</span>
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $candidaturas->count() }}</p>
                        <p class="text-xs text-blue-300 mt-2">Atribuições ativas</p>
                    </div>
                </div>

                <!-- Em Progresso -->
                <div class="group relative p-6 bg-gradient-to-br from-green-800/30 to-green-900/30 rounded-xl border border-green-700/40 hover:border-green-500/60 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-green-300 uppercase tracking-wide">Em Progresso</span>
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $candidaturas->where('estado', 'em_progresso')->count() }}</p>
                        <p class="text-xs text-green-300 mt-2">Estágios ativos</p>
                    </div>
                </div>

                <!-- Concluídos -->
                <div class="group relative p-6 bg-gradient-to-br from-indigo-800/30 to-indigo-900/30 rounded-xl border border-indigo-700/40 hover:border-indigo-500/60 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-indigo-300 uppercase tracking-wide">Concluídos</span>
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $candidaturas->where('estado', 'concluido')->count() }}</p>
                        <p class="text-xs text-indigo-300 mt-2">Estágios finalizados</p>
                    </div>
                </div>

                <!-- Taxa de Sucesso -->
                <div class="group relative p-6 bg-gradient-to-br from-purple-800/30 to-purple-900/30 rounded-xl border border-purple-700/40 hover:border-purple-500/60 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-purple-300 uppercase tracking-wide">Taxa de Sucesso</span>
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        @php
                            $taxa = $candidaturas->count() > 0
                                ? round(($candidaturas->where('estado', 'concluido')->count() / $candidaturas->count()) * 100)
                                : 0;
                        @endphp
                        <p class="text-3xl font-bold text-white">{{ $taxa }}%</p>
                        <p class="text-xs text-purple-300 mt-2">Taxa de conclusão</p>
                    </div>
                </div>
            </div>

            {{-- Lista de Alunos em Estágio --}}
            <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 border border-gray-700/40 rounded-2xl backdrop-blur-xl shadow-xl overflow-hidden">
                {{-- Header --}}
                <div class="px-6 py-6 border-b border-gray-700/40">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-white">Alunos em Estágio</h3>
                        </div>
                        <span class="px-3 py-1 bg-purple-500/20 border border-purple-500/40 text-purple-300 text-sm font-semibold rounded-full">
                            {{ $candidaturas->count() }}
                        </span>
                    </div>
                </div>

                {{-- Conteúdo --}}
                @if($candidaturas->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <div class="flex justify-center mb-6">
                            <div class="p-4 bg-gray-700/30 rounded-full">
                                <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-lg font-semibold text-gray-300 mb-2">Ainda não tens alunos atribuídos</p>
                        <p class="text-gray-400">Os alunos que escolherem a tua orientação aparecerão aqui.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-700/40">
                        @foreach($candidaturas as $candidatura)
                            <div class="p-6 hover:bg-gray-800/50 transition-colors duration-200 group">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                    {{-- Info do Aluno --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-4 mb-3">
                                            {{-- Avatar --}}
                                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 via-pink-500 to-red-500 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0 shadow-lg">
                                                {{ substr($candidatura->aluno->user->name ?? 'A', 0, 1) }}
                                            </div>

                                            {{-- Detalhes --}}
                                            <div class="min-w-0">
                                                <h4 class="text-white font-bold text-lg group-hover:text-purple-300 transition-colors truncate">
                                                    {{ $candidatura->aluno->user->name ?? 'N/A' }}
                                                </h4>
                                                <p class="text-sm text-gray-400 truncate">
                                                    {{ $candidatura->aluno->user->email ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Vaga e Empresa --}}
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3 ml-16">
                                            <div>
                                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Vaga</span>
                                                <p class="text-sm text-gray-300 font-medium">{{ $candidatura->vaga->titulo ?? 'N/A' }}</p>
                                            </div>
                                            <div>
                                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Empresa</span>
                                                <p class="text-sm text-gray-300 font-medium">{{ $candidatura->vaga->empresa->nome ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Status e Ação --}}
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 lg:min-w-fit">
                                        {{-- Badge de Estado --}}
                                        @php
                                            $statusMap = [
                                                'pendente' => ['bg' => 'bg-yellow-500/20', 'border' => 'border-yellow-500/40', 'text' => 'text-yellow-300', 'label' => 'Pendente'],
                                                'em_progresso' => ['bg' => 'bg-green-500/20', 'border' => 'border-green-500/40', 'text' => 'text-green-300', 'label' => 'Em Progresso'],
                                                'concluido' => ['bg' => 'bg-blue-500/20', 'border' => 'border-blue-500/40', 'text' => 'text-blue-300', 'label' => 'Concluído'],
                                                'interrompido' => ['bg' => 'bg-red-500/20', 'border' => 'border-red-500/40', 'text' => 'text-red-300', 'label' => 'Interrompido'],
                                            ];
                                            $status = $statusMap[$candidatura->estado] ?? $statusMap['pendente'];
                                        @endphp

                                        <span class="px-4 py-2 {{ $status['bg'] }} border {{ $status['border'] }} {{ $status['text'] }} text-xs font-bold rounded-full uppercase tracking-wider">
                                            {{ $status['label'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

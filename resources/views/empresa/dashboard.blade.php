<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-3xl bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 text-transparent bg-clip-text">
                    Painel da Empresa
                </h2>
                <p class="text-gray-400 text-sm mt-1">Bem-vindo, {{ $empresa->nome }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Card -->
            <div class="mb-8 p-8 bg-gradient-to-r from-gray-800/40 to-gray-800/20 backdrop-blur-lg rounded-lg border border-gray-700/40">
                <h3 class="text-xl font-semibold text-white mb-2">Olá, {{ $empresa->nome }}! 👋</h3>
                <p class="text-gray-400">Gerencie suas vagas, acompanhe candidaturas e conecte-se com os melhores talentos.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total de Vagas -->
                <div class="group relative p-6 bg-gradient-to-br from-gray-800/50 to-gray-900/50 rounded-lg border border-gray-700/40 hover:border-indigo-500/40 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-indigo-500/5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-sm font-semibold text-gray-400">Total de Vagas</h4>
                            <div class="w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.581m0 0H9m5.581 0a2 2 0 100-4 2 2 0 000 4zM9 7h.01M9 3h.01M15 21h.01M15 3h.01" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $totalVagas ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">Vagas publicadas no sistema</p>
                    </div>
                </div>

                <!-- Candidaturas Pendentes -->
                <div class="group relative p-6 bg-gradient-to-br from-gray-800/50 to-gray-900/50 rounded-lg border border-gray-700/40 hover:border-blue-500/40 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-blue-500/5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-sm font-semibold text-gray-400">Candidaturas Pendentes</h4>
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $candidaurasPendentes ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">Aguardando revisão</p>
                    </div>
                </div>

                <!-- Candidatos Aceites -->
                <div class="group relative p-6 bg-gradient-to-br from-gray-800/50 to-gray-900/50 rounded-lg border border-gray-700/40 hover:border-green-500/40 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-green-500/5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-sm font-semibold text-gray-400">Candidatos Aceites</h4>
                            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $candidatosAceites ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">Estágios confirmados</p>
                    </div>
                </div>

                <!-- Candidatos Rejeitados -->
                <div class="group relative p-6 bg-gradient-to-br from-gray-800/50 to-gray-900/50 rounded-lg border border-gray-700/40 hover:border-red-500/40 transition-all duration-300 backdrop-blur">
                    <div class="absolute inset-0 bg-red-500/5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-sm font-semibold text-gray-400">Candidatos Rejeitados</h4>
                            <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l5.5-5.5M5.5 10L11 5.5" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-white">{{ $candidatosRejeitados ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">Não prosseguiram</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-white mb-4">Ações Rápidas</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('vagas.create') }}" class="p-6 bg-gradient-to-br from-indigo-500/20 to-indigo-600/10 border border-indigo-500/40 rounded-lg hover:border-indigo-400/60 transition-all duration-300 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-white font-semibold mb-1">Publicar Vaga</h4>
                                <p class="text-sm text-gray-400">Crie uma nova vaga de estágio</p>
                            </div>
                            <svg class="w-8 h-8 text-indigo-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('empresa.candidaturas.index') }}" class="p-6 bg-gradient-to-br from-blue-500/20 to-blue-600/10 border border-blue-500/40 rounded-lg hover:border-blue-400/60 transition-all duration-300 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-white font-semibold mb-1">Ver Candidaturas</h4>
                                <p class="text-sm text-gray-400">Revise as candidaturas recebidas</p>
                            </div>
                            <svg class="w-8 h-8 text-blue-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('vagas.index') }}" class="p-6 bg-gradient-to-br from-purple-500/20 to-purple-600/10 border border-purple-500/40 rounded-lg hover:border-purple-400/60 transition-all duration-300 group">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-white font-semibold mb-1">Minhas Vagas</h4>
                                <p class="text-sm text-gray-400">Gerencie suas vagas publicadas</p>
                            </div>
                            <svg class="w-8 h-8 text-purple-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Info Section -->
            <div class="p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                <h3 class="text-lg font-semibold text-white mb-4">Informações da Empresa</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Nome da Empresa</p>
                        <p class="text-white font-semibold">{{ $empresa->nome ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Email</p>
                        <p class="text-white font-semibold">{{ $empresa->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Telefone</p>
                        <p class="text-white font-semibold">{{ $empresa->telefone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Localização</p>
                        <p class="text-white font-semibold">{{ $empresa->localizacao ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

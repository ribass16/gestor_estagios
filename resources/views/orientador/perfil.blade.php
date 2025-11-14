<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-3xl bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 text-transparent bg-clip-text">
                    Perfil do Orientador
                </h2>
                <p class="text-gray-400 text-sm mt-1">Gerencie suas informações profissionais</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Profile Header Card -->
            <div class="mb-8 p-8 bg-gradient-to-r from-gray-800/40 to-gray-800/20 backdrop-blur-lg rounded-lg border border-gray-700/40">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <!-- Avatar -->
                    <div class="relative group">
                        <div class="w-32 h-32 bg-gradient-to-br from-purple-500 via-pink-500 to-red-500 rounded-full flex items-center justify-center text-4xl font-bold text-white shadow-lg group-hover:shadow-purple-500/50 transition-shadow">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        @php
                            $estado = $orientador->estado ?? 'pendente';
                            $corStatus = match($estado) {
                                'aprovado' => 'bg-green-500',
                                'rejeitado' => 'bg-red-500',
                                default => 'bg-yellow-500'
                            };
                        @endphp
                        <div class="absolute -bottom-1 -right-1 {{ $corStatus }} w-4 h-4 rounded-full border-2 border-gray-900"></div>
                    </div>
                    <!-- Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $user->name }}</h1>
                        <p class="text-purple-400 font-semibold mb-1">{{ $user->email }}</p>
                        <p class="text-gray-400 text-sm mb-4">Orientador ISTEC</p>
                        <div class="flex flex-col md:flex-row gap-3 items-center md:items-start">
                            @php
                                $estadoTexto = match($estado) {
                                    'aprovado' => 'Aprovado',
                                    'rejeitado' => 'Rejeitado',
                                    default => 'Pendente'
                                };
                                $badgeClass = match($estado) {
                                    'aprovado' => 'bg-green-500/20 text-green-400 border-green-500/40',
                                    'rejeitado' => 'bg-red-500/20 text-red-400 border-red-500/40',
                                    default => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/40'
                                };
                            @endphp
                            <span class="px-3 py-1 {{ $badgeClass }} rounded-full text-sm font-semibold border">{{ $estadoTexto }}</span>
                            <a href="{{ route('orientador.perfil.editar') }}" class="inline-flex items-center px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Editar Perfil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Informações Pessoais -->
                <div class="p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Informações Pessoais</h3>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Nome</p>
                            <p class="text-white font-semibold">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Email</p>
                            <p class="text-white font-semibold">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Telemóvel</p>
                            <p class="text-white font-semibold">{{ $orientador->telemovel ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Estado da Conta -->
                <div class="p-6 bg-gradient-to-br from-gray-800/30 to-gray-900/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-pink-500/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Estado da Conta</h3>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Estado</p>
                            <p class="text-white font-semibold {{ $badgeClass }}">{{ $estadoTexto }}</p>
                        </div>
                        <div class="mt-4 p-3 bg-gray-900/50 rounded border border-gray-700/40">
                            <p class="text-sm text-gray-400">{{ match($estado) {
                                'aprovado' => '✓ Sua conta foi aprovada e você pode orientar estágios.',
                                'rejeitado' => '✗ Sua conta foi rejeitada. Entre em contato para mais informações.',
                                default => '⏳ Sua conta está pendente de aprovação.'
                            } }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descrição -->
            <div class="p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Descrição Profissional</h3>
                </div>
                <div class="bg-gray-900/50 p-4 rounded-lg border border-gray-700/40">
                    @if(!empty($orientador->descricao))
                        <p class="text-gray-300 leading-relaxed">{{ $orientador->descricao }}</p>
                    @else
                        <p class="text-gray-400 italic">Ainda não adicionaste uma descrição profissional.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

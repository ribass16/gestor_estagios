<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-3xl bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 text-transparent bg-clip-text">
                    Perfil do Aluno
                </h2>
                <p class="text-gray-400 text-sm mt-1">Gerencie suas informações académicas</p>
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
                        <div class="w-32 h-32 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center text-4xl font-bold text-white shadow-lg group-hover:shadow-indigo-500/50 transition-shadow">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 bg-green-500 w-4 h-4 rounded-full border-2 border-gray-900"></div>
                    </div>
                    <!-- Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $user->name }}</h1>
                        <p class="text-indigo-400 font-semibold mb-1">{{ $user->email }}</p>
                        <p class="text-gray-400 text-sm mb-4">Aluno ISTEC</p>
                        <a href="{{ route('aluno.perfil.editar') }}" class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar Perfil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Informações Pessoais -->
                <div class="p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    </div>
                </div>

                <!-- Informações Académicas -->
                <div class="p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Informações Académicas</h3>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Curso</p>
                            <p class="text-white font-semibold">{{ $aluno->curso ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Ano Letivo</p>
                            <p class="text-white font-semibold">{{ $aluno->ano_letivo ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Nº de Estudante</p>
                            <p class="text-white font-semibold">{{ $aluno->numero_estudante ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descrição -->
            <div class="mb-8 p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Descrição Pessoal</h3>
                </div>
                <div class="bg-gray-900/50 p-4 rounded-lg border border-gray-700/40">
                    @if(!empty($aluno->descricao))
                        <p class="text-gray-300 leading-relaxed">{{ $aluno->descricao }}</p>
                    @else
                        <p class="text-gray-400 italic">Ainda não adicionaste uma descrição pessoal.</p>
                    @endif
                </div>
            </div>

            <!-- CV -->
            <div class="p-6 bg-gradient-to-r from-green-500/10 to-emerald-500/10 backdrop-blur-lg rounded-lg border border-green-500/30 hover:border-green-500/50 transition-all">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Currículo (CV)</h3>
                </div>
                @if ($aluno->cv_path)
                    <p class="text-gray-300 mb-4">✓ Tens um CV carregado com sucesso</p>
                    <a href="{{ asset('storage/' . $aluno->cv_path) }}" target="_blank" class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Descarregar CV
                    </a>
                @else
                    <p class="text-gray-400 italic">Ainda não adicionaste o teu CV.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

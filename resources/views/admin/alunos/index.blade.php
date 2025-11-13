<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                <svg class="w-7 h-7 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Gestão de Alunos
            </h2>
            <p class="text-sm text-gray-400 mt-1">Administre todos os alunos registados no sistema</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if(session('status'))
            <div class="p-4 bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-500/50 rounded-xl text-green-300 font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('status') }}
            </div>
        @endif

        {{-- Cards de Estatísticas --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="group relative bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-blue-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-blue-100 uppercase tracking-wider mb-2">Total de Alunos</div>
                        <div class="text-4xl font-bold text-white">{{ $totalCount }}</div>
                    </div>
                    <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-purple-600 via-purple-500 to-purple-700 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-purple-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-purple-100 uppercase tracking-wider mb-2">Com Candidaturas</div>
                        <div class="text-4xl font-bold text-white">{{ $comCandidaturas }}</div>
                    </div>
                    <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-indigo-600 via-indigo-500 to-blue-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-indigo-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-indigo-100 uppercase tracking-wider mb-2">Estágio Ativo</div>
                        <div class="text-4xl font-bold text-white">{{ $comEstagioAtivo }}</div>
                    </div>
                    <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Barra de Pesquisa e Ações --}}
        <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl p-6 shadow-xl">
            <form method="GET" class="flex flex-col sm:flex-row items-center gap-4">
                <div class="relative flex-1 w-full">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="q" value="{{ $q }}"
                           placeholder="Procurar por nome, email, nº estudante, curso, ano letivo…"
                           class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-900 border-2 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"/>
                </div>

                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Procurar
                </button>

                @if($q !== '')
                    <a href="{{ route('admin.alunos.index') }}" class="px-4 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-xl transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Limpar
                    </a>
                @endif

                <a href="{{ route('admin.alunos.create') }}"
                   class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-500 hover:to-purple-600 text-white font-bold rounded-xl shadow-lg hover:shadow-purple-500/30 transition-all duration-300 hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Novo Aluno
                </a>
            </form>
        </div>

        {{-- Tabela Moderna --}}
        <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600/20 via-purple-600/20 to-indigo-600/20 border-b border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-bold text-blue-300 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-300 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-300 uppercase tracking-wider">Nº Estudante</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-blue-300 uppercase tracking-wider">Curso</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-300 uppercase tracking-wider">Ano Letivo</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-300 uppercase tracking-wider">Candidaturas</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-blue-300 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                        @forelse ($alunos as $a)
                            @php
                                $temEstagioAtivo = ($a->estagios_ativos_count ?? 0) > 0;
                            @endphp
                            <tr class="hover:bg-gray-800/60 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-xl flex items-center justify-center mr-3 ring-1 ring-blue-400/30">
                                            <span class="text-blue-300 font-bold text-sm">
                                                {{ strtoupper(substr($a->user->name ?? '?', 0, 2)) }}
                                            </span>
                                        </div>
                                        <span class="text-white font-semibold">{{ $a->user->name ?? '—' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-300">{{ $a->user->email ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-indigo-500/20 text-indigo-300 rounded-lg text-sm font-medium">
                                        {{ $a->numero_estudante ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-300">{{ $a->curso ?? '—' }}</td>
                                <td class="px-6 py-4 text-gray-300">{{ $a->ano_letivo ?? '—' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-purple-500/20 text-purple-300 rounded-lg font-bold ring-1 ring-purple-400/30">
                                        {{ $a->candidaturas_count ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.alunos.edit', $a) }}"
                                           class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg hover:shadow-blue-500/30">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Editar
                                        </a>

                                        <form class="inline" method="POST"
                                              action="{{ route('admin.alunos.destroy', $a) }}"
                                              onsubmit="return confirm('Apagar este aluno e a conta associada?');">
                                            @csrf @method('DELETE')
                                            <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg hover:shadow-red-500/30">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Apagar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg font-medium">Nenhum aluno encontrado</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $alunos->links() }}
        </div>
    </div>
</x-app-layout>

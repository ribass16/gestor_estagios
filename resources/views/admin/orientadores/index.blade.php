<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                <svg class="w-7 h-7 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Gestão de Orientadores
            </h2>
            <p class="text-sm text-gray-400 mt-1">Administre todos os orientadores registados no sistema</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Cards de Estatísticas --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="group relative bg-gradient-to-br from-yellow-600 via-yellow-500 to-amber-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-yellow-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-yellow-100 uppercase tracking-wider mb-2">Pendentes</div>
                        <div class="text-4xl font-bold text-white">{{ $pendentesCount }}</div>
                    </div>
                    <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-green-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-green-100 uppercase tracking-wider mb-2">Aprovados</div>
                        <div class="text-4xl font-bold text-white">{{ $aprovadosCount }}</div>
                    </div>
                    <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-red-600 via-red-500 to-pink-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-red-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-red-100 uppercase tracking-wider mb-2">Rejeitados</div>
                        <div class="text-4xl font-bold text-white">{{ $rejeitadosCount }}</div>
                    </div>
                    <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
                           placeholder="Procurar por nome, email, telemóvel ou departamento…"
                           class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-900 border-2 border-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all"/>
                </div>

                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Procurar
                </button>

                @if($q !== '')
                    <a href="{{ route('admin.orientadores.index') }}" class="px-4 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-xl transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Limpar
                    </a>
                @endif

                <a href="{{ route('admin.orientadores.create') }}"
                   class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold rounded-xl shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Novo Orientador
                </a>
            </form>
        </div>

        {{-- Tabela Moderna --}}
        <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-600/20 via-blue-600/20 to-cyan-600/20 border-b border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-300 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-blue-300 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-cyan-300 uppercase tracking-wider">Departamento</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-300 uppercase tracking-wider">Telemóvel</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-blue-300 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-cyan-300 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                        @forelse ($orientadores as $o)
                            <tr class="hover:bg-gray-800/60 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500/20 to-cyan-500/20 rounded-xl flex items-center justify-center mr-3 ring-1 ring-indigo-400/30">
                                            <span class="text-indigo-300 font-bold text-sm">
                                                {{ strtoupper(substr($o->user->name ?? '?', 0, 2)) }}
                                            </span>
                                        </div>
                                        <span class="text-white font-semibold">{{ $o->user->name ?? '—' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-300">{{ $o->user->email ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-cyan-500/20 text-cyan-300 rounded-lg text-sm font-medium">
                                        {{ $o->departamento ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-300">{{ $o->telemovel ?? '—' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $badge = [
                                            'pendente'  => 'bg-yellow-500/20 text-yellow-300 ring-yellow-400/30',
                                            'aprovado'  => 'bg-green-500/20 text-green-300 ring-green-400/30',
                                            'rejeitado' => 'bg-red-500/20 text-red-300 ring-red-400/30',
                                        ][$o->estado] ?? 'bg-gray-500/20 text-gray-300 ring-gray-400/30';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold ring-1 {{ $badge }}">
                                        {{ ucfirst($o->estado) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        @if($o->estado === 'pendente')
                                            <form class="inline" method="POST" action="{{ route('admin.orientadores.aprovar', $o) }}">
                                                @csrf
                                                <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-green-600 to-green-700 hover:from-green-500 hover:to-green-600 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg hover:shadow-green-500/30">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Aprovar
                                                </button>
                                            </form>

                                            <form class="inline" method="POST" action="{{ route('admin.orientadores.rejeitar', $o) }}">
                                                @csrf
                                                <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg hover:shadow-red-500/30">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Rejeitar
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('admin.orientadores.edit', $o) }}"
                                           class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg hover:shadow-blue-500/30">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Editar
                                        </a>

                                        <form class="inline" method="POST"
                                              action="{{ route('admin.orientadores.destroy', $o) }}"
                                              onsubmit="return confirm('Apagar este orientador?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg">
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
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg font-medium">Nenhum orientador encontrado</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginação --}}
        <div class="mt-4">
            {{ $orientadores->links() }}
        </div>
    </div>
</x-app-layout>

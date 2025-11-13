<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                <svg class="w-7 h-7 mr-3 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Gestão de Vagas
            </h2>
            <p class="text-sm text-gray-400 mt-1">Administre todas as vagas de estágio disponíveis</p>
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
            <div class="group relative bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-green-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-green-100 uppercase tracking-wider mb-2">Abertas</div>
                        <div class="text-4xl font-bold text-white">{{ $abertas }}</div>
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
                        <div class="text-sm font-semibold text-red-100 uppercase tracking-wider mb-2">Fechadas</div>
                        <div class="text-4xl font-bold text-white">{{ $fechadas }}</div>
                    </div>
                    <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-blue-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-blue-100 uppercase tracking-wider mb-2">Total</div>
                        <div class="text-4xl font-bold text-white">{{ $total }}</div>
                    </div>
                    <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Barra de Pesquisa e Filtros --}}
        <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl p-6 shadow-xl">
            <form method="GET" class="flex flex-col gap-4">
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative flex-1 w-full">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input
                            type="text"
                            name="q"
                            value="{{ $q }}"
                            placeholder="Procurar por título ou nome da empresa…"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-900 border-2 border-gray-700 text-white placeholder-gray-500 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all"
                        />
                    </div>

                    <select name="estado" class="px-4 py-3 rounded-xl bg-gray-900 border-2 border-gray-700 text-white focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all">
                        <option value="">Todos os estados</option>
                        <option value="aberta"  @selected($estado==='aberta')>Aberta</option>
                        <option value="fechada" @selected($estado==='fechada')>Fechada</option>
                    </select>

                    <select name="per_page" class="px-4 py-3 rounded-xl bg-gray-900 border-2 border-gray-700 text-white focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all">
                        @foreach([10,12,15,25,50] as $n)
                            <option value="{{ $n }}" @selected($perPage===$n)>{{ $n }}/página</option>
                        @endforeach
                    </select>

                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Procurar
                    </button>

                    @if($q !== '' || $estado !== '')
                        <a href="{{ route('admin.vagas.index') }}" class="px-4 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-xl transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Limpar
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Tabela Moderna --}}
        <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-cyan-600/20 via-blue-600/20 to-purple-600/20 border-b border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-bold text-cyan-300 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-blue-300 uppercase tracking-wider">Título</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-300 uppercase tracking-wider">Empresa</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-cyan-300 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-blue-300 uppercase tracking-wider">Criada em</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-purple-300 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                        @forelse ($vagas as $vaga)
                            <tr class="hover:bg-gray-800/60 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-cyan-500/20 text-cyan-300 rounded-lg text-sm font-medium">
                                        #{{ $vaga->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-white font-semibold">{{ $vaga->titulo }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-300">
                                    {{ $vaga->empresa->nome ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $badge = $vaga->estado === 'aberta'
                                            ? 'bg-green-500/20 text-green-300 ring-green-400/30'
                                            : 'bg-red-500/20 text-red-300 ring-red-400/30';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold ring-1 {{ $badge }}">
                                        {{ ucfirst($vaga->estado) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-sm">
                                    {{ optional($vaga->created_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.vagas.show', $vaga) }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Ver
                                        </a>
                                        @if ($vaga->estado === 'aberta')
                                            <form class="inline" method="POST" action="{{ route('admin.vagas.fechar', $vaga) }}">
                                                @csrf
                                                <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg hover:shadow-amber-500/30">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                    </svg>
                                                    Fechar
                                                </button>
                                            </form>
                                        @else
                                            <form class="inline" method="POST" action="{{ route('admin.vagas.abrir', $vaga) }}">
                                                @csrf
                                                <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-green-600 to-green-700 hover:from-green-500 hover:to-green-600 text-white text-sm font-semibold transition-all hover:scale-105 flex items-center gap-1.5 shadow-lg hover:shadow-green-500/30">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                                    </svg>
                                                    Abrir
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-400 text-lg font-medium">Nenhuma vaga encontrada</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $vagas->links() }}
        </div>

        @if(session('status'))
            <div class="p-3 bg-green-100 text-green-800 rounded">
                {{ session('status') }}
            </div>
        @endif
    </div>
</x-app-layout>

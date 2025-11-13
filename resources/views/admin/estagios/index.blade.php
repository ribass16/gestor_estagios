<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                <svg class="w-7 h-7 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Gestão de Estágios
            </h2>
            <p class="text-sm text-gray-400 mt-1">Administre todos os estágios atribuídos no sistema</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Cards de Estatísticas --}}
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-5">
            <div class="group relative bg-gradient-to-br from-yellow-600 via-yellow-500 to-amber-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-yellow-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-yellow-100 uppercase tracking-wider mb-1">Pendentes</div>
                        <div class="text-3xl font-bold text-white">{{ $pendentes }}</div>
                    </div>
                    <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-indigo-600 via-indigo-500 to-purple-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-indigo-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-indigo-100 uppercase tracking-wider mb-1">Ativos</div>
                        <div class="text-3xl font-bold text-white">{{ $ativos }}</div>
                    </div>
                    <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-green-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-green-100 uppercase tracking-wider mb-1">Concluídos</div>
                        <div class="text-3xl font-bold text-white">{{ $concluidos }}</div>
                    </div>
                    <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-red-600 via-red-500 to-pink-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-red-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-red-100 uppercase tracking-wider mb-1">Cancelados</div>
                        <div class="text-3xl font-bold text-white">{{ $cancelados }}</div>
                    </div>
                    <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-blue-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold text-blue-100 uppercase tracking-wider mb-1">Total</div>
                        <div class="text-3xl font-bold text-white">{{ $total }}</div>
                    </div>
                    <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <input type="text" name="q" value="{{ $q }}"
                               placeholder="Procurar por aluno, empresa ou orientador…"
                               class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-900 border-2 border-gray-700 text-white placeholder-gray-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"/>
                    </div>

                    <select name="estado" class="px-4 py-3 rounded-xl bg-gray-900 border-2 border-gray-700 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                        <option value="" @selected($estado==='')>Todos os estados</option>
                        <option value="pendente"  @selected($estado==='pendente')>Pendente</option>
                        <option value="ativo"     @selected($estado==='ativo')>Ativo</option>
                        <option value="concluido" @selected($estado==='concluido')>Concluído</option>
                        <option value="cancelado" @selected($estado==='cancelado')>Cancelado</option>
                    </select>

                    <select name="per_page" class="px-4 py-3 rounded-xl bg-gray-900 border-2 border-gray-700 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
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

                    @if($q!=='' || $estado!=='')
                        <a href="{{ route('admin.estagios.index') }}" class="px-4 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-xl transition-all flex items-center gap-2">
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
                        <tr class="bg-gradient-to-r from-blue-600/20 via-purple-600/20 to-indigo-600/20 border-b border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-bold text-blue-300 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-300 uppercase tracking-wider">Aluno</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-300 uppercase tracking-wider">Empresa</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-blue-300 uppercase tracking-wider">Orientador</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-300 uppercase tracking-wider">Vaga</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-300 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-blue-300 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                    @forelse($estagios as $e)
                        @php
                            $aluno      = $e->aluno->user->name        ?? '—';
                            $empresa    = $e->vaga->empresa->nome      ?? ($e->vaga->empresa->user->name ?? '—');
                            $orientador = $e->orientador->user->name   ?? '—';
                            $vagaTitulo = $e->vaga->titulo             ?? '—';
                            $badge = [
                                'pendente'  => 'bg-yellow-500/20 text-yellow-300 ring-yellow-400/30',
                                'ativo'     => 'bg-indigo-500/20 text-indigo-300 ring-indigo-400/30',
                                'concluido' => 'bg-green-500/20 text-green-300 ring-green-400/30',
                                'cancelado' => 'bg-red-500/20 text-red-300 ring-red-400/30',
                            ][$e->estado] ?? 'bg-gray-500/20 text-gray-300 ring-gray-400/30';
                        @endphp
                        <tr class="hover:bg-gray-800/60 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-lg text-sm font-medium">
                                    #{{ $e->id }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-white font-semibold">{{ $aluno }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-300">{{ $empresa }}</td>
                            <td class="px-6 py-4 text-gray-300">{{ $orientador }}</td>
                            <td class="px-6 py-4 text-gray-300">{{ $vagaTitulo }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold ring-1 {{ $badge }}">
                                    {{ ucfirst($e->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.estagios.show', $e) }}"
                                       class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white text-xs font-semibold transition-all hover:scale-105 flex items-center gap-1 shadow-lg">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Ver
                                    </a>

                                    @if($e->estado === 'pendente')
                                        <form class="inline" method="POST" action="{{ route('admin.estagios.ativar', $e) }}">
                                            @csrf
                                            <button class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white text-xs font-semibold transition-all hover:scale-105 shadow-lg hover:shadow-indigo-500/30">
                                                Ativar
                                            </button>
                                        </form>
                                    @endif

                                    @if(in_array($e->estado, ['pendente','ativo']))
                                        <form class="inline" method="POST" action="{{ route('admin.estagios.concluir', $e) }}">
                                            @csrf
                                            <button class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-green-600 to-green-700 hover:from-green-500 hover:to-green-600 text-white text-xs font-semibold transition-all hover:scale-105 shadow-lg hover:shadow-green-500/30">
                                                Concluir
                                            </button>
                                        </form>

                                        <form class="inline" method="POST" action="{{ route('admin.estagios.cancelar', $e) }}">
                                            @csrf
                                            <button class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white text-xs font-semibold transition-all hover:scale-105 shadow-lg hover:shadow-red-500/30">
                                                Cancelar
                                            </button>
                                        </form>
                                    @endif

                                    @if(in_array($e->estado, ['concluido','cancelado']))
                                        <form class="inline" method="POST" action="{{ route('admin.estagios.reabrir', $e) }}">
                                            @csrf
                                            <button class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white text-xs font-semibold transition-all hover:scale-105 shadow-lg hover:shadow-indigo-500/30">
                                                Reabrir
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                <p class="text-gray-400 text-lg font-medium">Nenhum estágio encontrado</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $estagios->links() }}
        </div>
    </div>
</x-app-layout>

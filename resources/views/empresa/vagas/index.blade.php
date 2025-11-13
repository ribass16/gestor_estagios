<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                <svg class="w-7 h-7 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Minhas Vagas de Estágio
            </h2>
            <p class="text-sm text-gray-400 mt-1">Gerencie todas as vagas de estágio da sua empresa</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        {{-- Aviso se a empresa ainda está pendente --}}
        @if (!empty($pendente) && $pendente === true)
            <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-yellow-500/50 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-yellow-500/20 rounded-full mb-4">
                        <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-yellow-300 mb-3">Registo em Análise</h3>
                    <p class="text-gray-300 leading-relaxed max-w-2xl mx-auto">
                        O registo da tua empresa foi submetido e encontra-se em análise pela coordenação de estágios.
                        Assim que for aprovada, poderás aceder ao painel completo e criar ofertas de estágio.
                    </p>
                </div>
            </div>
        @else
            {{-- Cards de Estatísticas --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="group relative bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-blue-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-blue-100 uppercase tracking-wider mb-2">Total de Vagas</div>
                            <div class="text-4xl font-bold text-white">{{ $vagas->count() }}</div>
                        </div>
                        <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="group relative bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-2xl p-6 shadow-xl hover:shadow-2xl hover:shadow-green-500/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-green-100 uppercase tracking-wider mb-2">Vagas Abertas</div>
                            <div class="text-4xl font-bold text-white">{{ $vagas->where('estado', 'aberta')->count() }}</div>
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
                            <div class="text-sm font-semibold text-red-100 uppercase tracking-wider mb-2">Vagas Fechadas</div>
                            <div class="text-4xl font-bold text-white">{{ $vagas->where('estado', 'fechada')->count() }}</div>
                        </div>
                        <div class="p-4 bg-white/20 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Botão Criar Nova Vaga --}}
            <div class="flex justify-end">
                <a href="{{ route('vagas.create') }}"
                   class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-500 hover:to-purple-600 text-white font-bold rounded-xl shadow-lg hover:shadow-purple-500/30 transition-all duration-300 hover:scale-105 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Criar Nova Vaga
                </a>
            </div>

            {{-- Lista de vagas --}}
            @if($vagas->isEmpty())
                <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl shadow-xl p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-400 mb-2">Nenhuma vaga criada</h3>
                    <p class="text-gray-500 mb-6">Comece a atrair talentos criando a sua primeira vaga de estágio!</p>
                    <a href="{{ route('vagas.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-500 hover:to-purple-600 text-white font-bold rounded-xl shadow-lg hover:shadow-purple-500/30 transition-all duration-300 hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Criar Primeira Vaga
                    </a>
                </div>
            @else
                <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl shadow-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-purple-600/20 via-pink-600/20 to-purple-600/20 border-b border-gray-700">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-purple-300 uppercase tracking-wider">Título da Vaga</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-pink-300 uppercase tracking-wider">Descrição</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-purple-300 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-pink-300 uppercase tracking-wider">Criada em</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-purple-300 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700/50">
                                @foreach($vagas as $vaga)
                                    <tr class="hover:bg-gray-800/60 transition-colors group">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-xl flex items-center justify-center mr-3 ring-1 ring-purple-400/30">
                                                    <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-white font-semibold">{{ $vaga->titulo }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-300 text-sm line-clamp-2">{{ Str::limit($vaga->descricao, 80) }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($vaga->estado === 'aberta')
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-green-500/20 text-green-300 ring-1 ring-green-400/30">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Aberta
                                                </span>
                                            @elseif($vaga->estado === 'fechada')
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-red-500/20 text-red-300 ring-1 ring-red-400/30">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                    </svg>
                                                    Fechada
                                                </span>
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2 text-gray-400 text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $vaga->created_at?->format('d/m/Y H:i') ?? '—' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('vagas.show', $vaga) }}"
                                                   class="px-3 py-2 rounded-lg bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white text-xs font-semibold transition-all hover:scale-105 flex items-center gap-1 shadow-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    Ver
                                                </a>
                                                <a href="{{ route('vagas.edit', $vaga) }}"
                                                   class="px-3 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white text-xs font-semibold transition-all hover:scale-105 flex items-center gap-1 shadow-lg hover:shadow-blue-500/30">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Editar
                                                </a>
                                                <form action="{{ route('vagas.destroy', $vaga) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta vaga?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                       class="px-3 py-2 rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white text-xs font-semibold transition-all hover:scale-105 flex items-center gap-1 shadow-lg hover:shadow-red-500/30">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Apagar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>

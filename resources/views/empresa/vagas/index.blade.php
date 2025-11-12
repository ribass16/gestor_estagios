<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Minhas Vagas
            </h2>

            @if (empty($pendente) || $pendente === false)
                {{-- Empresa aprovada → pode criar vagas --}}
                <a href="{{ route('vagas.create') }}"
                   class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                    Criar Nova Vaga
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Aviso se a empresa ainda está pendente --}}
        @if (!empty($pendente) && $pendente === true)
            <div class="bg-yellow-100 text-yellow-800 border border-yellow-300 rounded p-4">
                O registo da tua empresa foi submetido e encontra-se em análise pela coordenação de estágios.
                Assim que for aprovada, poderás aceder ao painel completo e criar ofertas de estágio.
            </div>
        @else
            {{-- Lista de vagas --}}
            @if($vagas->isEmpty())
                <div class="bg-gray-800 text-gray-300 p-4 rounded">
                    Ainda não criaste nenhuma vaga.
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-2 text-left">Título</th>
                                <th class="px-3 py-2 text-left">Estado</th>
                                <th class="px-3 py-2 text-left">Criada em</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vagas as $vaga)
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    <td class="px-3 py-2 text-gray-900 dark:text-gray-100">
                                        {{ $vaga->titulo }}
                                    </td>
                                    <td class="px-3 py-2">
                                        @if($vaga->estado === 'aberta')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-emerald-600 text-white">
                                                Aberta
                                            </span>
                                        @elseif($vaga->estado === 'fechada')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-gray-600 text-white">
                                                Fechada
                                            </span>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 text-gray-600 dark:text-gray-300">
                                        {{ $vaga->created_at?->format('d/m/Y H:i') ?? '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>

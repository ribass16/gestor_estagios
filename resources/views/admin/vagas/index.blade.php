<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Vagas</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Cards de contagem --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Abertas</div>
                <div class="text-2xl font-semibold text-white">{{ $abertas }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Fechadas</div>
                <div class="text-2xl font-semibold text-white">{{ $fechadas }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Total</div>
                <div class="text-2xl font-semibold text-white">{{ $total }}</div>
            </div>
        </div>


        {{-- Filtros / procura --}}
        <form method="GET" class="bg-gray-900 border border-gray-800 rounded-lg p-4 flex flex-col gap-3 sm:flex-row sm:items-center">
            <input
                type="text"
                name="q"
                value="{{ $q }}"
                placeholder="Procurar por título ou nome da empresa…"
                class="w-full rounded-md bg-gray-800 border-gray-700 text-gray-200"
            />

            <select name="estado" class="rounded-md bg-gray-800 border-gray-700 text-gray-200">
                <option value="">Todos os estados</option>
                <option value="aberta"  @selected($estado==='aberta')>aberta</option>
                <option value="fechada" @selected($estado==='fechada')>fechada</option>
            </select>

            <select name="per_page" class="rounded-md bg-gray-800 border-gray-700 text-gray-200">
                @foreach([10,12,15,25,50] as $n)
                    <option value="{{ $n }}" @selected($perPage===$n)>{{ $n }}/página</option>
                @endforeach
            </select>

            <x-primary-button>Procurar</x-primary-button>

            @if($q !== '' || $estado !== '')
                <a href="{{ route('admin.vagas.index') }}" class="text-sm text-gray-300 underline">limpar</a>
            @endif
        </form>

        {{-- Tabela --}}
        <div class="bg-gray-900 border border-gray-800 rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-200">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Título</th>
                        <th class="px-4 py-2 text-left">Empresa</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left">Criada em</th>
                        <th class="px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($vagas as $vaga)
                        <tr>
                            <td class="px-4 py-2 text-gray-400">#{{ $vaga->id }}</td>
                            <td class="px-4 py-2 font-medium">{{ $vaga->titulo }}</td>
                            <td class="px-4 py-2">
                                {{ $vaga->empresa->nome ?? '—' }}
                            </td>
                            <td class="px-4 py-2">
                                @php $badge = $vaga->estado === 'aberta' ? 'bg-green-600' : 'bg-red-600'; @endphp
                                <span class="px-2 py-0.5 rounded text-xs text-white {{ $badge }}">{{ $vaga->estado }}</span>
                            </td>
                            <td class="px-4 py-2 text-gray-400">
                                {{ optional($vaga->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.vagas.show', $vaga) }}" class="px-3 py-1 rounded bg-gray-700 hover:bg-gray-800 text-white text-xs">Ver</a>
                                @if ($vaga->estado === 'aberta')
                                    <form class="inline" method="POST" action="{{ route('admin.vagas.fechar', $vaga) }}">
                                        @csrf
                                        <button class="px-3 py-1 rounded bg-amber-600 hover:bg-amber-700 text-white text-xs">
                                            Fechar
                                        </button>
                                    </form>
                                @else
                                    <form class="inline" method="POST" action="{{ route('admin.vagas.abrir', $vaga) }}">
                                        @csrf
                                        <button class="px-3 py-1 rounded bg-green-600 hover:bg-green-700 text-white text-xs">
                                            Abrir
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400">Sem registos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

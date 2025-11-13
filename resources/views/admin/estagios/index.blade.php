<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Estágios</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Pendentes</div>
                <div class="text-2xl font-semibold text-white">{{ $pendentes }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Ativos</div>
                <div class="text-2xl font-semibold text-white">{{ $ativos }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Concluídos</div>
                <div class="text-2xl font-semibold text-white">{{ $concluidos }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Cancelados</div>
                <div class="text-2xl font-semibold text-white">{{ $cancelados }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Total</div>
                <div class="text-2xl font-semibold text-white">{{ $total }}</div>
            </div>
        </div>

        {{-- Filtro / procurar --}}
        <form method="GET" class="bg-gray-900 border border-gray-800 rounded-lg p-4 flex flex-col gap-3 sm:flex-row sm:items-center">
            <input type="text" name="q" value="{{ $q }}"
                   placeholder="Procurar por aluno, empresa ou orientador…"
                   class="w-full rounded-md bg-gray-800 border-gray-700 text-gray-200"/>

            <select name="estado" class="rounded-md bg-gray-800 border-gray-700 text-gray-200">
                <option value="" @selected($estado==='')>Todos os estados</option>
                <option value="pendente"  @selected($estado==='pendente')>pendente</option>
                <option value="ativo"     @selected($estado==='ativo')>ativo</option>
                <option value="concluido" @selected($estado==='concluido')>concluído</option>
                <option value="cancelado" @selected($estado==='cancelado')>cancelado</option>
            </select>

            <select name="per_page" class="rounded-md bg-gray-800 border-gray-700 text-gray-200">
                @foreach([10,12,15,25,50] as $n)
                    <option value="{{ $n }}" @selected($perPage===$n)>{{ $n }}/página</option>
                @endforeach
            </select>

            <x-primary-button>Procurar</x-primary-button>

            @if($q!=='' || $estado!=='')
                <a href="{{ route('admin.estagios.index') }}" class="text-sm text-gray-300 underline sm:ml-2">limpar</a>
            @endif
        </form>

        {{-- Tabela --}}
        <div class="bg-gray-900 border border-gray-800 rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-200">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="px-3 py-2 text-left">#</th>
                        <th class="px-3 py-2 text-left">Aluno</th>
                        <th class="px-3 py-2 text-left">Empresa</th>
                        <th class="px-3 py-2 text-left">Orientador</th>
                        <th class="px-3 py-2 text-left">Vaga</th>
                        <th class="px-3 py-2 text-left">Estado</th>
                        <th class="px-3 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                @forelse($estagios as $e)
                    @php
                        $aluno      = $e->aluno->user->name        ?? '—';
                        $empresa    = $e->vaga->empresa->nome      ?? ($e->vaga->empresa->user->name ?? '—');
                        $orientador = $e->orientador->user->name   ?? '—';
                        $vagaTitulo = $e->vaga->titulo             ?? '—';
                        $badge = [
                            'pendente'  => 'bg-yellow-600',
                            'ativo'     => 'bg-indigo-600',
                            'concluido' => 'bg-green-600',
                            'cancelado' => 'bg-red-600',
                        ][$e->estado] ?? 'bg-gray-600';
                    @endphp
                    <tr>
                        <td class="px-3 py-2">#{{ $e->id }}</td>
                        <td class="px-3 py-2">{{ $aluno }}</td>
                        <td class="px-3 py-2">{{ $empresa }}</td>
                        <td class="px-3 py-2">{{ $orientador }}</td>
                        <td class="px-3 py-2">{{ $vagaTitulo }}</td>
                        <td class="px-3 py-2">
                            <span class="px-2 py-0.5 rounded text-xs text-white {{ $badge }}">{{ ucfirst($e->estado) }}</span>
                        </td>
                        <td class="px-3 py-2 space-x-2">
                            <a href="{{ route('admin.estagios.show', $e) }}"
                               class="px-3 py-1 rounded bg-gray-700 hover:bg-gray-800 text-white text-xs">Ver</a>

                            @if($e->estado === 'pendente')
                                <form class="inline" method="POST" action="{{ route('admin.estagios.ativar', $e) }}">
                                    @csrf
                                    <button class="px-3 py-1 rounded bg-indigo-600 hover:bg-indigo-700 text-white text-xs">Ativar</button>
                                </form>
                            @endif

                            @if(in_array($e->estado, ['pendente','ativo']))
                                <form class="inline" method="POST" action="{{ route('admin.estagios.concluir', $e) }}">
                                    @csrf
                                    <button class="px-3 py-1 rounded bg-green-600 hover:bg-green-700 text-white text-xs">Concluir</button>
                                </form>

                                <form class="inline" method="POST" action="{{ route('admin.estagios.cancelar', $e) }}">
                                    @csrf
                                    <button class="px-3 py-1 rounded bg-red-600 hover:bg-red-700 text-white text-xs">Cancelar</button>
                                </form>
                            @endif

                            @if(in_array($e->estado, ['concluido','cancelado']))
                                <form class="inline" method="POST" action="{{ route('admin.estagios.reabrir', $e) }}">
                                    @csrf
                                    <button class="px-3 py-1 rounded bg-indigo-600 hover:bg-indigo-700 text-white text-xs">Reabrir</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-6 text-center text-gray-400">Sem registos.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $estagios->links() }}
        </div>
    </div>
</x-app-layout>

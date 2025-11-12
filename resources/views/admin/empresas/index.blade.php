<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Empresas</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if(session('status'))
            <div class="bg-emerald-600/20 border border-emerald-600 text-emerald-200 px-4 py-2 rounded">
                {{ session('status') }}
            </div>
        @endif

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Pendentes</div>
                <div class="text-2xl font-semibold text-white">{{ $pendentesCount }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Aprovadas</div>
                <div class="text-2xl font-semibold text-white">{{ $aprovadasCount }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Rejeitadas</div>
                <div class="text-2xl font-semibold text-white">{{ $rejeitadasCount }}</div>
            </div>
        </div>

        {{-- Filtro + Novo --}}
        <form method="GET"
              class="bg-gray-900 border border-gray-800 rounded-lg p-4 flex items-center gap-3">
            <input type="text" name="q" value="{{ $q }}"
                   placeholder="Procurar por nome, email ou NIF…"
                   class="w-full rounded-md bg-gray-800 border-gray-700 text-gray-200"/>

            <x-primary-button>Procurar</x-primary-button>

            @if($q !== '')
                <a href="{{ route('admin.empresas.index') }}" class="text-sm text-gray-300 underline">limpar</a>
            @endif

            <a href="{{ route('admin.empresas.create') }}"
               class="ml-auto inline-flex items-center gap-2 px-4 py-2 rounded-md
                      bg-indigo-600 text-white hover:bg-indigo-700">
                <span class="text-lg leading-none">+</span>
                <span>Novo</span>
            </a>
        </form>

        {{-- Tabela --}}
        <div class="bg-gray-900 border border-gray-800 rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-200">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="px-4 py-2 text-left">Nome</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">NIF</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($empresas as $e)
                        <tr>
                            <td class="px-4 py-2">{{ $e->nome }}</td>
                            <td class="px-4 py-2">{{ $e->email }}</td>
                            <td class="px-4 py-2">{{ $e->nif ?? '—' }}</td>
                            <td class="px-4 py-2">
                                @php
                                    $badge = [
                                        'pendente'  => 'bg-yellow-600',
                                        'aprovada'  => 'bg-green-600',
                                        'rejeitada' => 'bg-red-600',
                                    ][$e->estado] ?? 'bg-gray-600';
                                @endphp
                                <span class="px-2 py-0.5 rounded text-xs text-white {{ $badge }}">
                                    {{ ucfirst($e->estado) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                @if($e->estado === 'pendente')
                                    <form class="inline" method="POST" action="{{ route('admin.empresas.aprovar', $e) }}">
                                        @csrf
                                        <button class="px-3 py-1 rounded bg-green-600 hover:bg-green-700 text-white text-xs">
                                            Aprovar
                                        </button>
                                    </form>
                                    <form class="inline" method="POST" action="{{ route('admin.empresas.rejeitar', $e) }}">
                                        @csrf
                                        <button class="px-3 py-1 rounded bg-red-600 hover:bg-red-700 text-white text-xs">
                                            Rejeitar
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.empresas.edit', $e) }}"
                                   class="px-3 py-1 rounded bg-indigo-600 hover:bg-indigo-700 text-white text-xs">
                                    Editar
                                </a>

                                <form class="inline" method="POST"
                                      action="{{ route('admin.empresas.destroy', $e) }}"
                                      onsubmit="return confirm('Apagar esta empresa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 rounded bg-gray-700 hover:bg-gray-800 text-white text-xs">
                                        Apagar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Sem registos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $empresas->links() }}
        </div>
    </div>
</x-app-layout>

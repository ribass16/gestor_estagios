<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Alunos</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if(session('status'))
            <div class="p-3 bg-green-100 text-green-800 rounded">
                {{ session('status') }}
            </div>
        @endif

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Total</div>
                <div class="text-2xl font-semibold text-white">{{ $totalCount }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Com Candidaturas</div>
                <div class="text-2xl font-semibold text-white">{{ $comCandidaturas }}</div>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-4 text-center">
                <div class="text-xs uppercase text-gray-400">Com Estágio Ativo</div>
                <div class="text-2xl font-semibold text-white">{{ $comEstagioAtivo }}</div>
            </div>
        </div>

        {{-- Filtro / procurar + botão Novo --}}
        <form method="GET" class="bg-gray-900 border border-gray-800 rounded-lg p-4 flex items-center gap-3">
            <input type="text" name="q" value="{{ $q }}"
                   placeholder="Procurar por nome, email, nº estudante, curso, ano letivo…"
                   class="w-full rounded-md bg-gray-800 border-gray-700 text-gray-200"/>

            <x-primary-button>Procurar</x-primary-button>

            @if($q !== '')
                <a href="{{ route('admin.alunos.index') }}" class="text-sm text-gray-300 underline">limpar</a>
            @endif

            <a href="{{ route('admin.alunos.create') }}"
               class="ml-auto inline-flex items-center gap-2 px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
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
                        <th class="px-4 py-2 text-left">Nº Estudante</th>
                        <th class="px-4 py-2 text-left">Curso</th>
                        <th class="px-4 py-2 text-left">Ano Letivo</th>
                        <th class="px-4 py-2 text-left">Cands.</th>
                        <th class="px-4 py-2 text-left">Estágio Ativo</th>
                        <th class="px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($alunos as $a)
                        @php
                            $temEstagioAtivo = ($a->estagios_ativos_count ?? 0) > 0;
                        @endphp
                        <tr>
                            <td class="px-4 py-2">{{ $a->user->name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $a->user->email ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $a->numero_estudante ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $a->curso ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $a->ano_letivo ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $a->candidaturas_count ?? 0 }}</td>
                            <td class="px-4 py-2">
                                @if($temEstagioAtivo)
                                    <span class="px-2 py-0.5 rounded text-xs text-white bg-emerald-600">sim</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-xs text-white bg-gray-600">não</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.alunos.edit', $a) }}"
                                   class="px-3 py-1 rounded bg-indigo-600 hover:bg-indigo-700 text-white text-xs">Editar</a>

                                <form class="inline" method="POST"
                                      action="{{ route('admin.alunos.destroy', $a) }}"
                                      onsubmit="return confirm('Apagar este aluno e a conta associada?');">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 rounded bg-gray-700 hover:bg-gray-800 text-white text-xs">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-4 py-6 text-center text-gray-400">Sem registos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $alunos->links() }}
        </div>
    </div>
</x-app-layout>

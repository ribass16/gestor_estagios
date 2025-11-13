<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            As Minhas Candidaturas
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Alertas --}}
        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-300 p-4 mb-6 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500/20 border border-red-500/50 text-red-300 p-4 mb-6 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-lg rounded-xl">

            @if($candidaturas->isEmpty())
                <div class="p-12 text-center">
                    <p class="text-gray-400 text-lg">
                        Ainda não te candidataste a nenhuma vaga.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-900 border-b border-gray-700">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Título da Vaga</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Descrição</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Estado</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Orientador</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Data</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-300">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-700">
                            @foreach($candidaturas as $candidatura)
                                @php
                                    $estagio        = $candidatura->estagio;
                                    $orientador     = $estagio?->orientador;
                                    $orientadorUser = $orientador?->user;
                                @endphp

                                <tr class="hover:bg-gray-800/50 transition-colors">
                                    {{-- Título --}}
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $candidatura->vaga->titulo ?? '-' }}
                                    </td>

                                    {{-- Descrição (curta) --}}
                                    <td class="px-6 py-4 text-gray-300">
                                        {{ \Illuminate\Support\Str::limit($candidatura->vaga->descricao ?? '-', 80) }}
                                    </td>

                                    {{-- Estado --}}
                                    <td class="px-6 py-4">
                                        @if($candidatura->estado === 'pendente')
                                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-300 rounded-lg text-sm font-semibold">
                                                Pendente
                                            </span>

                                        @elseif($candidatura->estado === 'aceite' && !$estagio)
                                            <span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-lg text-sm font-semibold">
                                                Aceite
                                            </span>

                                        @elseif($estagio && $orientadorUser)
                                            <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-lg text-sm font-semibold">
                                                Confirmado
                                            </span>

                                        @elseif($candidatura->estado === 'recusada')
                                            <span class="px-3 py-1 bg-red-500/20 text-red-300 rounded-lg text-sm font-semibold">
                                                Recusada
                                            </span>

                                        @else
                                            <span class="text-gray-400">
                                                {{ ucfirst($candidatura->estado) }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Orientador --}}
                                    <td class="px-6 py-4 text-gray-300">
                                        @if($estagio && $orientadorUser)
                                            {{ $orientadorUser->name }}
                                        @elseif($candidatura->estado === 'aceite' && !$estagio)
                                            <span class="text-gray-400 italic text-sm">
                                                Por escolher
                                            </span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>

                                    {{-- Data --}}
                                    <td class="px-6 py-4 text-gray-400 text-sm">
                                        {{ $candidatura->created_at?->format('d/m/Y H:i') ?? '-' }}
                                    </td>

                                    {{-- Ações --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($candidatura->estado === 'pendente')
                                            <form method="POST"
                                                  action="{{ route('candidaturas.destroy', $candidatura->id) }}"
                                                  onsubmit="return confirm('Tens a certeza que queres cancelar esta candidatura?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                                                    Cancelar
                                                </button>
                                            </form>

                                        @elseif($candidatura->estado === 'aceite' && !$estagio)
                                            <a href="{{ route('aluno.candidaturas.orientador.create', $candidatura->id) }}"
                                               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                                                Escolher Orientador
                                            </a>

                                        @elseif($estagio && $orientadorUser)
                                            <span class="px-3 py-1 bg-gray-700 text-gray-300 rounded-lg text-xs">
                                                Orientador escolhido
                                            </span>

                                        @else
                                            <span class="px-3 py-1 bg-gray-700 text-gray-400 rounded-lg text-xs">
                                                {{ ucfirst($candidatura->estado) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

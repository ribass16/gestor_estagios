<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            As Minhas Candidaturas
        </h2>
    </x-slot>

    {{-- Alertas --}}
    @if(session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="max-w-4xl mx-auto mt-4 p-4 rounded-md bg-green-100 text-green-800 border border-green-300 text-center shadow-md">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="max-w-4xl mx-auto mt-4 p-4 rounded-md bg-red-100 text-red-800 border border-red-300 text-center shadow-md">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if($candidaturas->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">
                        Ainda não te candidataste a nenhuma vaga.
                    </p>
                @else
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gray-900/70 text-gray-100">
                                <th class="px-6 py-3 text-left text-sm font-medium">Título da Vaga</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Descrição</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Estado</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Orientador</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Data de Candidatura</th>
                                <th class="px-6 py-3 text-center text-sm font-medium">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($candidaturas as $candidatura)
                                @php
                                    $estagio        = $candidatura->estagio;
                                    $orientador     = $estagio?->orientador;
                                    $orientadorUser = $orientador?->user;
                                @endphp

                                <tr class="bg-gray-900/40 text-gray-100">
                                    {{-- Título --}}
                                    <td class="px-6 py-4">
                                        {{ $candidatura->vaga->titulo ?? '-' }}
                                    </td>

                                    {{-- Descrição (curta) --}}
                                    <td class="px-6 py-4">
                                        {{ \Illuminate\Support\Str::limit($candidatura->vaga->descricao ?? '-', 80) }}
                                    </td>

                                    {{-- Estado --}}
                                    <td class="px-6 py-4">
                                        @if($candidatura->estado === 'pendente')
                                            <span class="text-yellow-400 font-semibold">
                                                Pendente
                                            </span>

                                        @elseif($candidatura->estado === 'aceite' && !$estagio)
                                            <span class="text-green-400 font-semibold">
                                                Aceite pela empresa
                                            </span>

                                        @elseif($estagio && $orientadorUser)
                                            <span class="text-emerald-400 font-semibold">
                                                Estágio confirmado
                                            </span>

                                        @elseif($candidatura->estado === 'recusada')
                                            <span class="text-red-500 font-semibold">
                                                Recusada
                                            </span>

                                        @else
                                            <span class="text-gray-300">
                                                {{ ucfirst($candidatura->estado) }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Orientador --}}
                                    <td class="px-6 py-4">
                                        @if($estagio && $orientadorUser)
                                            {{ $orientadorUser->name }}
                                        @elseif($candidatura->estado === 'aceite' && !$estagio)
                                            <span class="text-xs text-gray-400 italic">
                                                Por escolher
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    {{-- Data --}}
                                    <td class="px-6 py-4">
                                        {{ $candidatura->created_at?->format('d/m/Y H:i') ?? '-' }}
                                    </td>

                                    {{-- Ações --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($candidatura->estado === 'pendente')
                                            {{-- Pode cancelar enquanto está pendente --}}
                                            <form method="POST"
                                                  action="{{ route('candidaturas.destroy', $candidatura->id) }}"
                                                  onsubmit="return confirm('Tens a certeza que queres cancelar esta candidatura?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded text-sm">
                                                    Cancelar
                                                </button>
                                            </form>

                                        @elseif($candidatura->estado === 'aceite' && !$estagio)
                                            {{-- Empresa aceitou e ainda não há estágio → pode escolher orientador --}}
                                            <a href="{{ route('aluno.candidaturas.orientador.create', $candidatura->id) }}"
                                               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-4 rounded text-sm">
                                                Escolher Orientador
                                            </a>

                                        @elseif($estagio && $orientadorUser)
                                            {{-- Já existe estágio → não pode mudar --}}
                                            <span class="px-3 py-1 bg-gray-700 text-white rounded text-xs">
                                                Orientador escolhido
                                            </span>

                                        @else
                                            <span class="px-3 py-1 bg-gray-600 text-white rounded text-xs">
                                                {{ ucfirst($candidatura->estado) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

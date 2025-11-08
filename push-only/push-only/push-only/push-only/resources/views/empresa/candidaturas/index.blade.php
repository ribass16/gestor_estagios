<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Candidaturas Recebidas') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Mensagens de sucesso / erro --}}
                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500 text-white p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Caso não haja candidaturas --}}
                @if ($candidaturas->isEmpty())
                    <p class="text-gray-400 text-center">Ainda não recebeste nenhuma candidatura.</p>
                @else
                    <table class="w-full text-sm text-gray-300">
                        <thead class="uppercase bg-gray-700 text-gray-300">
                            <tr>
                                <th class="px-6 py-3 text-left">Aluno</th>
                                <th class="px-6 py-3 text-left">Vaga</th>
                                <th class="px-6 py-3 text-left">Estado</th>
                                <th class="px-6 py-3 text-left">Data</th>
                                <th class="px-6 py-3 text-left">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-700">
                            @foreach ($candidaturas as $candidatura)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-200">
                                        {{ $candidatura->aluno->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $candidatura->vaga->titulo }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($candidatura->estado === 'pendente')
                                            <span class="bg-yellow-500 text-black px-2 py-1 rounded text-xs font-semibold">Pendente</span>
                                        @elseif ($candidatura->estado === 'aceite')
                                            <span class="bg-green-600 text-white px-2 py-1 rounded text-xs font-semibold">Aceite</span>
                                        @elseif ($candidatura->estado === 'recusada')
                                            <span class="bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold">Recusada</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-gray-400">
                                        {{ $candidatura->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="px-6 py-4 flex gap-2">
                                        @if ($candidatura->estado === 'pendente')
                                            <form method="POST" action="{{ route('empresa.candidaturas.aceitar', $candidatura->id) }}">
                                                @csrf
                                                <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                                    Aceitar
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('empresa.candidaturas.recusar', $candidatura->id) }}">
                                                @csrf
                                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                    Recusar
                                                </button>
                                            </form>
                                        @else
                                            <span class="italic text-gray-500">Ação concluída</span>
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Candidaturas Recebidas
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Mensagens --}}
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-300 p-4 mb-6 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500/20 border border-red-500/50 text-red-300 p-4 mb-6 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-lg rounded-xl">
            @if ($candidaturas->isEmpty())
                <div class="p-12 text-center">
                    <p class="text-gray-400 text-lg">
                        Ainda não recebeste nenhuma candidatura.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-900 border-b border-gray-700">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Aluno</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Vaga</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Estado</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Data</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-300">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-700">
                            @foreach ($candidaturas as $candidatura)
                                <tr class="hover:bg-gray-800/50 transition-colors">
                                    <td class="px-6 py-4 text-white font-medium">
                                        @if($candidatura->aluno && $candidatura->aluno->user)
                                            {{ $candidatura->aluno->user->name }}
                                        @else
                                            <span class="text-gray-400 italic">Aluno não associado</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-gray-300">
                                        {{ $candidatura->vaga->titulo }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($candidatura->estado === 'pendente')
                                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-300 rounded-lg text-sm font-semibold">
                                                Pendente
                                            </span>
                                        @elseif ($candidatura->estado === 'aceite')
                                            <span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-lg text-sm font-semibold">
                                                Aceite
                                            </span>
                                        @elseif ($candidatura->estado === 'recusada')
                                            <span class="px-3 py-1 bg-red-500/20 text-red-300 rounded-lg text-sm font-semibold">
                                                Recusada
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-gray-400 text-sm">
                                        {{ $candidatura->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($candidatura->estado === 'pendente')
                                            <div class="flex items-center justify-center gap-2">
                                                <form method="POST" action="{{ route('empresa.candidaturas.aceitar', $candidatura->id) }}">
                                                    @csrf
                                                    <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg text-sm transition">
                                                        Aceitar
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('empresa.candidaturas.recusar', $candidatura->id) }}">
                                                    @csrf
                                                    <button class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg text-sm transition">
                                                        Recusar
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <span class="text-gray-500 italic text-sm">Ação concluída</span>
                                            </div>
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

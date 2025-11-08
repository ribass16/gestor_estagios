<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            As Minhas Candidaturas
        </h2>
    </x-slot>

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($candidaturas->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">Ainda não te candidataste a nenhuma vaga.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                <th class="px-6 py-3 text-left text-sm font-medium">Título da Vaga</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Descrição</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Estado</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Data de Candidatura</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($candidaturas as $c)
                                <tr>
                                    <td class="px-6 py-4">{{ $c->vaga->titulo }}</td>
                                    <td class="px-6 py-4">{{ $c->vaga->descricao }}</td>
                                    <td class="px-6 py-4">
                                        @if($c->estado === 'pendente')
                                            <span class="text-yellow-500 font-semibold">Pendente</span>
                                        @elseif($c->estado === 'aceite')
                                            <span class="text-green-500 font-semibold">Aceite</span>
                                        @else
                                            <span class="text-red-500 font-semibold">Recusada</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $c->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('candidaturas.destroy', $c->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded text-sm transition ease-in-out duration-150"
                                                onclick="return confirm('Tens a certeza que queres cancelar esta candidatura?')">
                                                Cancelar
                                            </button>
                                        </form>
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

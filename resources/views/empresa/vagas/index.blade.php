<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Minhas Vagas
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($vagas->isEmpty())
            <div class="bg-gray-800 text-gray-300 p-4 rounded">
                Não há vagas disponíveis no momento.
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
                            <tr class="border-t border-gray-700">
                                <td class="px-3 py-2">{{ $vaga->titulo }}</td>
                                <td class="px-3 py-2">{{ $vaga->estado ?? '—' }}</td>
                                <td class="px-3 py-2">{{ $vaga->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>

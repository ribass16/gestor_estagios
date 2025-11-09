<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Orientador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

                @if($candidaturas->isEmpty())
                    <p class="text-gray-500">Ainda não tens alunos atribuídos.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aluno</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Vaga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Empresa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($candidaturas as $candidatura)
                                <tr>
                                    <td class="px-6 py-4 text-sm">
                                        {{ $candidatura->aluno->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {{ $candidatura->vaga->titulo ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {{ $candidatura->vaga->empresa->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {{ $candidatura->estado ?? 'Pendente' }}
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

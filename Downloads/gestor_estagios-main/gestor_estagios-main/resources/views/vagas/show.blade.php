<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $vaga->titulo }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <p class="text-gray-700 dark:text-gray-300 mb-4">
                <strong>Descrição:</strong><br>
                {{ $vaga->descricao }}
            </p>

            <p class="text-gray-700 dark:text-gray-300 mb-4">
                <strong>Estado:</strong> {{ ucfirst($vaga->estado) }}
            </p>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('vagas.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Voltar</a>

                @if (Auth::user()->user_type === 'empresa' && Auth::user()->empresa->id === $vaga->empresa_id)
                    <a href="{{ route('vagas.edit', $vaga) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">Editar</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

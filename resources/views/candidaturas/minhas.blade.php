<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Minhas Candidaturas
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            @forelse ($candidaturas as $cand)
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700 pb-3">
                    <p class="text-lg text-gray-900 dark:text-gray-100 font-semibold">
                        {{ $cand->vaga->titulo }}
                    </p>
                    <p class="text-gray-600 dark:text-gray-400">
                        Estado: <span class="font-medium">{{ ucfirst($cand->estado) }}</span>
                    </p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">Ainda não te candidataste a nenhuma vaga.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

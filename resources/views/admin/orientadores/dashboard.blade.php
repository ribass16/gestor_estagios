<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Painel do Orientador
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-700">
                Bem-vindo, {{ $orientador->user->name }}.
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Aqui vais ver os alunos que te forem atribuídos e os respetivos estágios.
            </p>
        </div>
    </div>
</x-app-layout>

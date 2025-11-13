<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Painel da Empresa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">
                    Bem-vindo, {{ $empresa->nome }}
                </h2>
                <p class="text-gray-600">
                    Área reservada da Empresa — aqui podes gerir as tuas vagas e candidaturas.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>

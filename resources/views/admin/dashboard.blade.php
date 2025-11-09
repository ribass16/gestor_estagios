<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bem-vindo, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <p class="text-center text-gray-500 mb-8">Painel do Administrador</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            {{-- Gestão de Empresas --}}
            <a href="{{ route('admin.empresas.index') }}"
               class="block bg-indigo-600 hover:bg-indigo-700 text-white text-center py-4 rounded-lg shadow">
                Gestão de Empresas
            </a>

            {{-- Gestão de Orientadores (só funciona se já tiveres as rotas criadas) --}}
            <a href="{{ route('admin.orientadores.index') }}"
               class="block bg-teal-600 hover:bg-teal-700 text-white text-center py-4 rounded-lg shadow">
                Gestão de Orientadores
            </a>

        </div>
    </div>
</x-app-layout>

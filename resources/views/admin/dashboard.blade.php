<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Painel do Administrador
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- Cartões principais --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            {{-- Alunos (só contagem) --}}
            <a href="{{ route('admin.alunos.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Alunos</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $alunosTotal }}</div>
            </a>

            {{-- Empresas (link certo) --}}
            <a href="{{ route('admin.empresas.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Empresas</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $empresasTotal }}</div>
                <div class="text-xs text-amber-300 mt-1">{{ $empresasPendentes }} pendentes</div>
            </a>

            {{-- Orientadores (link certo) --}}
            <a href="{{ route('admin.orientadores.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Orientadores</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $orientadoresTotal }}</div>
                <div class="text-xs text-amber-300 mt-1">{{ $orientadoresPendentes }} pendentes</div>
            </a>

            {{-- Vagas Abertas --}}
            <a href="{{ route('admin.vagas.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Vagas Abertas</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $vagasAbertas }}</div>
            </a>

            {{-- Estágios  --}}
            <a href="{{ route('admin.estagios.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Estágios Ativos</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $estagiosAtivos }}</div>
            </a>

        </div>



    </div>
</x-app-layout>

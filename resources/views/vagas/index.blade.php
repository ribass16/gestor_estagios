<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Vagas Disponíveis
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            {{-- Mensagens --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-3 mb-4 rounded">
                    {{ session('warning') }}
                </div>
            @endif

            {{-- Lista de vagas abertas --}}
            @forelse ($vagas as $vaga)
                <div class="bg-gray-50 dark:bg-gray-900 p-5 rounded-lg shadow mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ $vaga->titulo }}
                    </h3>

                    <p class="text-gray-700 dark:text-gray-400 mt-1">
                        {{ $vaga->descricao }}
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        Empresa:
                        <span class="font-medium">
                            {{ $vaga->empresa->nome
                                ?? $vaga->empresa->user->name
                                ?? 'Desconhecida' }}
                        </span>
                    </p>

                    <div class="mt-4 flex items-center gap-3">
                        {{-- ALUNO: pode candidatar --}}
                        @if ($user && $user->user_type === 'aluno')
                            <form action="{{ route('candidaturas.store', $vaga->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md">
                                    Candidatar-me
                                </button>
                            </form>
                        @endif

                        {{-- (Opcional) ADMIN: ver detalhes --}}
                        @if ($user && $user->user_type === 'admin')
                            <a href="{{ route('vagas.show', $vaga->id) }}"
                               class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-md">
                                Ver detalhes
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-400">
                    Não há vagas disponíveis no momento.
                </p>
            @endforelse
        </div>
    </div>
</x-app-layout>

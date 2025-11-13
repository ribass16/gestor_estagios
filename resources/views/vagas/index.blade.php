<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Vagas Disponíveis
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
    @endphp

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Mensagens --}}
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-300 p-4 mb-6 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500/20 border border-red-500/50 text-red-300 p-4 mb-6 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-500/20 border border-yellow-500/50 text-yellow-300 p-4 mb-6 rounded-xl">
                {{ session('warning') }}
            </div>
        @endif

        {{-- Lista de vagas --}}
        @forelse ($vagas as $vaga)
            <div class="bg-gray-800 border border-gray-700 p-6 rounded-xl shadow-lg mb-4 hover:border-indigo-500/50 transition-colors">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-2">
                            {{ $vaga->titulo }}
                        </h3>

                        <p class="text-gray-300 mb-3">
                            {{ $vaga->descricao }}
                        </p>

                        <p class="text-sm text-gray-400">
                            <span class="font-semibold text-indigo-400">Empresa:</span>
                            {{ $vaga->empresa->nome ?? $vaga->empresa->user->name ?? 'Desconhecida' }}
                        </p>
                    </div>

                    <div class="ml-4">
                        @if ($user && $user->user_type === 'aluno')
                            @if(in_array($vaga->id, $candidaturasIds ?? []))
                                <span class="bg-gray-600 text-gray-300 font-semibold px-5 py-2.5 rounded-lg inline-block">
                                    Já te candidataste
                                </span>
                            @else
                                <form action="{{ route('candidaturas.store', $vaga->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-lg transition">
                                        Candidatar-me
                                    </button>
                                </form>
                            @endif
                        @endif

                        @if ($user && $user->user_type === 'admin')
                            <a href="{{ route('vagas.show', $vaga->id) }}"
                               class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-5 py-2.5 rounded-lg transition inline-block">
                                Ver detalhes
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-gray-800 border border-gray-700 p-12 rounded-xl text-center">
                <p class="text-gray-400 text-lg">
                    Não há vagas disponíveis no momento.
                </p>
            </div>
        @endforelse
    </div>
</x-app-layout>

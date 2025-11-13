<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-200">
            Perfil da Empresa
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-6xl w-full bg-gray-800 text-gray-200 shadow-lg rounded-xl p-8 relative">

            <!-- Botão Editar -->
            <div class="absolute top-6 right-6">
                <a href="{{ route('empresa.perfil.editar') }}"
                   class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm transition">
                   Editar Perfil
                </a>
            </div>

            <!-- Cabeçalho -->
            <div class="flex items-center mb-6">
                @if($empresa->logo_path)
                    <img src="{{ asset($empresa->logo_path) }}" alt="Logo da empresa"
                         class="h-20 w-20 rounded-full object-cover border border-gray-700">
                @else
                    <div class="h-20 w-20 bg-indigo-600 flex items-center justify-center rounded-full text-2xl font-bold uppercase">
                        {{ substr($empresa->nome ?? $user->name, 0, 1) }}
                    </div>
                @endif

                <div class="ml-4">
                    <h3 class="text-2xl font-semibold">{{ $empresa->nome ?? 'Nome da Empresa' }}</h3>
                    <p class="text-gray-400">{{ $empresa->email ?? $user->email }}</p>
                </div>
            </div>

            <hr class="border-gray-700 my-4">

            <!-- Layout em 2 Colunas -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Coluna Esquerda: Informações -->
                <div>
                    <h4 class="text-lg font-semibold text-indigo-400 mb-4">Informações da Empresa</h4>
                    <div class="bg-gray-900 p-4 rounded-lg space-y-3">
                        <p><span class="font-semibold text-gray-300">Nome:</span> {{ $empresa->nome ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-300">Telemóvel:</span> {{ $empresa->telemovel ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-300">Morada:</span> {{ $empresa->morada ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-300">Website:</span>
                            @if(!empty($empresa->website))
                                <a href="{{ $empresa->website }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 underline">
                                    {{ $empresa->website }}
                                </a>
                            @else
                                -
                            @endif
                        </p>
                        @if(!empty($empresa->setor))
                        <p><span class="font-semibold text-gray-300">Setor:</span> {{ $empresa->setor }}</p>
                        @endif
                        @if(!empty($empresa->nif))
                        <p><span class="font-semibold text-gray-300">NIF:</span> {{ $empresa->nif }}</p>
                        @endif
                        <p>
                            <span class="font-semibold text-gray-300">Estado:</span>
                            <span class="{{ $empresa->estado === 'aprovada' ? 'text-green-400' : ($empresa->estado === 'rejeitada' ? 'text-red-400' : 'text-yellow-400') }}">
                                {{ ucfirst($empresa->estado) }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Coluna Direita: Descrição -->
                <div>
                    <h4 class="text-lg font-semibold text-indigo-400 mb-4">Descrição</h4>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        @if(!empty($empresa->descricao))
                            <p class="text-gray-300">{{ $empresa->descricao }}</p>
                        @else
                            <p class="italic text-gray-400">Ainda não adicionaste uma descrição para a tua empresa.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-200">
            Perfil do Orientador
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-4xl w-full bg-gray-800 text-gray-200 shadow-lg rounded-xl p-8">

            <!-- Botão Editar -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('orientador.perfil.editar') }}"
                   class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm transition">
                   Editar Perfil
                </a>
            </div>

            <!-- Cabeçalho -->
            <div class="flex items-center mb-6">
                <div class="h-20 w-20 bg-indigo-600 flex items-center justify-center rounded-full text-2xl font-bold uppercase">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold">{{ $user->name }}</h3>
                    <p class="text-gray-400">{{ $user->email }}</p>
                </div>
            </div>

            <hr class="border-gray-700 my-4">

            <!-- Secções -->
            <div class="space-y-6">

                <!-- Informações Pessoais -->
                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Informações Pessoais</h4>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <p><span class="font-semibold text-gray-300">Nome:</span> {{ $user->name }}</p>
                        <p><span class="font-semibold text-gray-300">Email:</span> {{ $user->email }}</p>
                        <p><span class="font-semibold text-gray-300">Telemóvel:</span> {{ $orientador->telemovel ?? '-' }}</p>
                    </div>
                </div>

                <!-- Estado -->
                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Estado da Conta</h4>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        @php
                            $estado = $orientador->estado ?? 'pendente';
                            $cor = match($estado) {
                                'aprovado' => 'text-green-400',
                                'rejeitado' => 'text-red-400',
                                default => 'text-yellow-400'
                            };
                        @endphp
                        <p><span class="font-semibold text-gray-300">Estado:</span> <span class="{{ $cor }}">{{ ucfirst($estado) }}</span></p>
                    </div>
                </div>

                <!-- Descrição -->
                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Descrição</h4>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        @if(!empty($orientador->descricao))
                            <p class="text-gray-300">{{ $orientador->descricao }}</p>
                        @else
                            <p class="text-gray-400 italic">Ainda não adicionaste uma descrição pessoal.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

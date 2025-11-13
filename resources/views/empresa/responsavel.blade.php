<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-200">
            Perfil do Responsável
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-3xl w-full bg-gray-800 text-gray-200 shadow-lg rounded-xl p-8 relative">

            <!-- Botão Editar -->
            <div class="absolute top-6 right-6">
                <a href="{{ route('empresa.responsavel.editar') }}"
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

            <!-- Informações do Responsável -->
            <div class="space-y-6">

                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Informações do Responsável</h4>
                    <div class="bg-gray-900 p-4 rounded-lg space-y-2">
                        <p><span class="font-semibold text-gray-300">Nome:</span> {{ $user->name }}</p>
                        <p><span class="font-semibold text-gray-300">Email:</span> {{ $user->email }}</p>
                        <p><span class="font-semibold text-gray-300">Tipo de utilizador:</span> {{ ucfirst($user->user_type) }}</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Ligação à Empresa</h4>
                    <div class="bg-gray-900 p-4 rounded-lg space-y-2">
                        <p><span class="font-semibold text-gray-300">Empresa Associada:</span> {{ $empresa->nome ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-300">Estado da Empresa:</span>
                            <span class="{{ $empresa->estado === 'aprovada' ? 'text-green-400' : ($empresa->estado === 'rejeitada' ? 'text-red-400' : 'text-yellow-400') }}">
                                {{ ucfirst($empresa->estado) }}
                            </span>
                        </p>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Último Acesso</h4>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <p><span class="font-semibold text-gray-300">Último login:</span>
                            {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Ainda não registado' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

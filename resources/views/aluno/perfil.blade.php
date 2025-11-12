<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-200">
            Perfil do Aluno
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-4xl w-full bg-gray-800 text-gray-200 shadow-lg rounded-xl p-8">

            <!-- Botão Editar -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('aluno.perfil.editar') }}"
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
                    </div>
                </div>

                <!-- Informações Académicas -->
                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Informações Académicas</h4>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <p><span class="font-semibold text-gray-300">Curso:</span> {{ $aluno->curso ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-300">Ano Letivo:</span> {{ $aluno->ano_letivo ?? '-' }}</p>
                        <p><span class="font-semibold text-gray-300">Número de Estudante:</span> {{ $aluno->numero_estudante ?? '-' }}</p>
                    </div>
                </div>

                <!-- Descrição -->
                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Descrição</h4>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        @if(!empty($aluno->descricao))
                            <p class="text-gray-300">{{ $aluno->descricao }}</p>
                        @else
                            <p class="text-gray-400 italic">Ainda não adicionaste uma descrição pessoal.</p>
                        @endif
                    </div>
                </div>

                <!-- CV -->
                <div>
                    <h4 class="text-lg font-semibold mb-2 text-indigo-400">Currículo (CV)</h4>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        @if ($aluno->cv_path)
                            <p class="text-gray-300 mb-2">Tens um CV carregado.</p>
                            <a href="{{ asset('storage/' . $aluno->cv_path) }}" target="_blank"
                               class="inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-md text-white text-sm transition">
                                Ver CV
                            </a>
                        @else
                            <p class="text-gray-400 italic">Ainda não adicionaste o teu CV.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

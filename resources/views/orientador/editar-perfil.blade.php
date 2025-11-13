<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-200">
            Editar Perfil do Orientador
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-3xl w-full bg-gray-800 text-gray-200 shadow-lg rounded-xl p-8">
            <form action="{{ route('orientador.perfil.atualizar') }}" method="POST">
                @csrf

                <!-- Nome -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="name">Nome</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700
                               focus:border-indigo-500 focus:ring focus:ring-indigo-500
                               focus:ring-opacity-30 text-gray-200">
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="password">Nova Password</label>
                    <input type="password" name="password" id="password"
                        placeholder="Deixa em branco se não quiseres mudar"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700
                               focus:border-indigo-500 focus:ring focus:ring-indigo-500
                               focus:ring-opacity-30 text-gray-200">
                </div>

                <!-- Confirmar Password -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="password_confirmation">Confirmar Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700
                               focus:border-indigo-500 focus:ring focus:ring-indigo-500
                               focus:ring-opacity-30 text-gray-200">
                </div>

                <!-- Telemóvel -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="telemovel">Telemóvel</label>
                    <input type="text" name="telemovel" id="telemovel"
                        value="{{ old('telemovel', $orientador->telemovel) }}"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700
                               focus:border-indigo-500 focus:ring focus:ring-indigo-500
                               focus:ring-opacity-30 text-gray-200"
                        placeholder="Ex: 912345678">
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="5"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700
                               focus:border-indigo-500 focus:ring focus:ring-indigo-500
                               focus:ring-opacity-30 text-gray-200"
                        placeholder="Fala um pouco sobre a tua experiência...">{{ old('descricao', $orientador->descricao) }}</textarea>
                </div>

                <!-- Botões -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('orientador.perfil') }}"
                        class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-md transition">
                        Cancelar
                    </a>

                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
                        Guardar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

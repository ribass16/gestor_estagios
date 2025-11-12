<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-200">
            Editar Perfil da Empresa
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-3xl w-full bg-gray-800 text-gray-200 shadow-lg rounded-xl p-8">
            <form action="{{ route('empresa.perfil.atualizar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nome -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="name">Nome</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700 focus:border-indigo-500 focus:ring focus:ring-indigo-500 text-gray-200">
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="password">Nova Password</label>
                    <input type="password" name="password" id="password"
                        placeholder="Deixa em branco se não quiseres mudar"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700 text-gray-200">
                </div>

                <!-- Confirmar Password -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="password_confirmation">Confirmar Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700 text-gray-200">
                </div>

                <!-- Telemóvel -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="telemovel">Telemóvel</label>
                    <input type="text" name="telemovel" id="telemovel" value="{{ old('telemovel', $empresa->telemovel) }}"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700 focus:border-indigo-500 text-gray-200">
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="4"
                        class="w-full p-3 rounded-md bg-gray-900 border border-gray-700 focus:border-indigo-500 text-gray-200"
                        placeholder="Escreve algo sobre a empresa...">{{ old('descricao', $empresa->descricao) }}</textarea>
                </div>

                <!-- Logótipo -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" for="logo">Logótipo</label>
                    <input type="file" name="logo" id="logo" accept=".jpg,.jpeg,.png"
                        class="w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                    @if($empresa->logo_path)
                        <p class="mt-2 text-sm text-gray-400">
                            Logótipo atual:
                            <a href="{{ asset($empresa->logo_path) }}" target="_blank" class="underline text-indigo-400 hover:text-indigo-300">Ver imagem</a>
                        </p>
                    @endif
                </div>

                <!-- Botões -->
                <div class="flex justify-between">
                    <a href="{{ route('empresa.perfil') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-md transition">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition">
                        Guardar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

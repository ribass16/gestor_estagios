<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-gray-800 text-white rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-4">Editar Vaga</h1>

        <form method="POST" action="{{ route('vagas.update', $vaga->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium">Título</label>
                <input type="text" name="titulo" id="titulo"
                       class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white"
                       value="{{ old('titulo', $vaga->titulo) }}" required>
            </div>

            <div class="mb-4">
                <label for="descricao" class="block text-sm font-medium">Descrição</label>
                <textarea name="descricao" id="descricao" rows="4"
                          class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white"
                          required>{{ old('descricao', $vaga->descricao) }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('vagas.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md mr-2">Cancelar</a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>

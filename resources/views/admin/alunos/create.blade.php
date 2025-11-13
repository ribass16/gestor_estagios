<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Novo Aluno</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-4">
            <form method="POST" action="{{ route('admin.alunos.store') }}">
                @csrf

                <div>
                    <label class="block text-sm text-gray-300">Nome</label>
                    <input name="nome" value="{{ old('nome') }}"
                           class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                    @error('nome') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-300">Email</label>
                        <input name="email" value="{{ old('email') }}"
                               class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                        @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Nº Estudante</label>
                        <input name="numero_estudante" value="{{ old('numero_estudante') }}"
                               class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                        @error('numero_estudante') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-300">Curso</label>
                        <input name="curso" value="{{ old('curso') }}"
                               class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                        @error('curso') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Ano Letivo</label>
                        <input name="ano_letivo" value="{{ old('ano_letivo') }}"
                               class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                        @error('ano_letivo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-300">Password</label>
                        <input type="password" name="password"
                               class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                        @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Confirmar Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="{{ route('admin.alunos.index') }}" class="px-4 py-2 rounded bg-gray-700 text-white">Cancelar</a>
                    <x-primary-button>Guardar</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

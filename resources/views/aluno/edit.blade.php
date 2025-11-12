<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Editar Aluno
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white/5 border border-white/10 rounded-lg p-6">
            <form method="POST" action="{{ route('admin.alunos.update', $aluno) }}" class="space-y-4">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm text-gray-300 mb-1">Nome</label>
                    <input name="name" value="{{ old('name', $aluno->user->name ?? '') }}"
                           class="w-full rounded bg-white/5 border border-white/10 text-gray-200 px-3 py-2">
                    @error('name') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-1">Email</label>
                    <input name="email" type="email" value="{{ old('email', $aluno->user->email ?? '') }}"
                           class="w-full rounded bg-white/5 border border-white/10 text-gray-200 px-3 py-2">
                    @error('email') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Curso</label>
                        <input name="curso" value="{{ old('curso', $aluno->curso) }}"
                               class="w-full rounded bg-white/5 border border-white/10 text-gray-200 px-3 py-2">
                        @error('curso') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Ano letivo</label>
                        <input name="ano_letivo" value="{{ old('ano_letivo', $aluno->ano_letivo) }}"
                               class="w-full rounded bg-white/5 border border-white/10 text-gray-200 px-3 py-2">
                        @error('ano_letivo') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Nº estudante</label>
                        <input name="numero_estudante" value="{{ old('numero_estudante', $aluno->numero_estudante) }}"
                               class="w-full rounded bg-white/5 border border-white/10 text-gray-200 px-3 py-2">
                        @error('numero_estudante') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <x-primary-button>Guardar</x-primary-button>
                    <a href="{{ route('admin.alunos.index') }}" class="text-gray-300 hover:underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

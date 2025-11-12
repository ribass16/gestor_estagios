<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Editar Orientador — {{ $orientador->user->name }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
            <form method="POST" action="{{ route('admin.orientadores.update', $orientador) }}" class="space-y-4">
                @csrf @method('PUT')

                <div>
                    <x-input-label for="nome" value="Nome" />
                    <x-text-input id="nome" name="nome" type="text" class="mt-1 w-full"
                                  value="{{ old('nome', $orientador->user->name) }}" required />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 w-full"
                                  value="{{ old('email', $orientador->user->email) }}" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="departamento" value="Departamento" />
                    <x-text-input id="departamento" name="departamento" type="text" class="mt-1 w-full"
                                  value="{{ old('departamento', $orientador->departamento) }}" />
                </div>

                <div>
                    <x-input-label for="telemovel" value="Telemóvel" />
                    <x-text-input id="telemovel" name="telemovel" type="text" class="mt-1 w-full"
                                  value="{{ old('telemovel', $orientador->telemovel) }}" />
                </div>

                <div>
                    <x-input-label for="estado" value="Estado" />
                    <select id="estado" name="estado" class="mt-1 w-full rounded-md bg-gray-800 border-gray-700 text-gray-200" required>
                        @foreach (['pendente'=>'Pendente','aprovado'=>'Aprovado','rejeitado'=>'Rejeitado'] as $k=>$label)
                            <option value="{{ $k }}" @selected(old('estado', $orientador->estado)===$k)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                </div>

                <div class="pt-4">
                    <x-primary-button>Guardar</x-primary-button>
                    <a href="{{ route('admin.orientadores.index') }}" class="ml-3 text-gray-300 underline">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

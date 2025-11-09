<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Orientador
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('admin.orientadores.store') }}">
                @csrf

                <div>
                    <x-input-label for="nome" value="Nome" />
                    <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="departamento" value="Departamento (opcional)" />
                    <x-text-input id="departamento" name="departamento" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('departamento')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="telemovel" value="Telemóvel (opcional)" />
                    <x-text-input id="telemovel" name="telemovel" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('telemovel')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" value="Confirmar Password" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.orientadores.index') }}"
                       class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                        Cancelar
                    </a>
                    <x-primary-button>Guardar</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Novo Orientador</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
            <form method="POST" action="{{ route('admin.orientadores.store') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="nome" value="Nome" />
                    <x-text-input id="nome" name="nome" type="text" class="mt-1 w-full" required />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 w-full" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password_confirmation" value="Confirmar Password" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 w-full" required />
                    </div>
                </div>

                <div>
                    <x-input-label for="departamento" value="Departamento" />
                    <x-text-input id="departamento" name="departamento" type="text" class="mt-1 w-full" />
                </div>

                <div>
                    <x-input-label for="telemovel" value="Telemóvel" />
                    <x-text-input id="telemovel" name="telemovel" type="text" class="mt-1 w-full" />
                </div>

                <div class="pt-4">
                    <x-primary-button>Criar</x-primary-button>
                    <a href="{{ route('admin.orientadores.index') }}" class="ml-3 text-gray-300 underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

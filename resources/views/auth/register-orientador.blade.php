<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Registo de professor orientador ISTEC. O acesso será ativado após validação pela coordenação.
    </div>

    <form method="POST" action="{{ route('orientador.register.store') }}">
        @csrf

        <div>
            <x-input-label for="nome" value="Nome" />
            <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" required autofocus />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email institucional" />
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
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                Já tens conta?
            </a>
            <x-primary-button class="ml-3">
                Registar Orientador
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

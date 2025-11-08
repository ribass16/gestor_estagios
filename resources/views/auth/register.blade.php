<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Nome -->
    <div>
        <x-input-label for="name" :value="__('Nome')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Palavra-passe')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirmar Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirmar Palavra-passe')" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <!-- Tipo de Utilizador -->
    <div class="mt-4">
        <x-input-label for="user_type" :value="__('Tipo de Utilizador')" />
        <select id="user_type" name="user_type" class="block mt-1 w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white">
            <option value="aluno">Aluno</option>
            <option value="orientador">Orientador</option>
            <option value="empresa">Empresa</option>
        </select>
        <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
    </div>

    <!-- Botão -->
    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4">
            {{ __('Registar') }}
        </x-primary-button>
    </div>
</form>

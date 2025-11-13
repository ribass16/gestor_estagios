<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nome --}}
        <div>
            <x-input-label for="name" value="Nome" />
            <x-text-input id="name" class="block mt-1 w-full" type="text"
                          name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email institucional --}}
        <div class="mt-4">
            <x-input-label for="email" value="Email institucional" />
            <x-text-input id="email" class="block mt-1 w-full" type="email"
                          name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirmar Password --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        {{-- Campos específicos do aluno --}}
        <div class="mt-6">
            <x-input-label for="curso" value="Curso" />
            <x-text-input id="curso" class="block mt-1 w-full" type="text"
                          name="curso" :value="old('curso')" required />
            <x-input-error :messages="$errors->get('curso')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="ano_letivo" value="Ano letivo" />
            <x-text-input id="ano_letivo" class="block mt-1 w-full" type="text"
                          name="ano_letivo" :value="old('ano_letivo')" required />
            <x-input-error :messages="$errors->get('ano_letivo')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="numero_estudante" value="Número de estudante" />
            <x-text-input id="numero_estudante" class="block mt-1 w-full" type="text"
                          name="numero_estudante" :value="old('numero_estudante')" required />
            <x-input-error :messages="$errors->get('numero_estudante')" class="mt-2" />
        </div>

        {{-- Tipo de utilizador: este formulário é só para alunos --}}
        <input type="hidden" name="user_type" value="aluno">

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('login') }}">
                Já tens conta?
            </a>

            <x-primary-button class="ml-3">
                Registar Aluno
            </x-primary-button>
        </div>
    </form>

    {{-- Link empresa --}}
    <div class="mt-8 p-4 border rounded-md bg-gray-50 text-sm text-gray-700">
        És uma empresa parceira?
        <a href="{{ route('empresa.register.create') }}"
           class="font-semibold text-indigo-600 hover:underline ml-1">
            Regista a tua empresa aqui
        </a>
    </div>

    {{-- Link orientador --}}
    <div class="mt-6 text-sm text-gray-700">
        És docente/orientador?
        <a href="{{ route('orientador.register.create') }}"
           class="text-indigo-600 font-semibold hover:underline">
            Regista-te como orientador aqui
        </a>
    </div>
</x-guest-layout>

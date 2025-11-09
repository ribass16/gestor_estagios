<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Registo de empresa parceira ISTEC. O acesso será ativado após validação pela coordenação.
    </div>

    <form method="POST" action="{{ route('empresa.register.store') }}">
        @csrf

        <div>
            <x-input-label for="nome_empresa" value="Nome da Empresa" />
            <x-text-input id="nome_empresa" name="nome_empresa" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('nome_empresa')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="nif" value="NIF (opcional)" />
            <x-text-input id="nif" name="nif" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('nif')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telemovel" value="Telemóvel (opcional)" />
            <x-text-input id="telemovel" name="telemovel" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('telemovel')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="morada" value="Morada (opcional)" />
            <x-text-input id="morada" name="morada" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('morada')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="website" value="Website (opcional)" />
            <x-text-input id="website" name="website" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('website')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="setor" value="Setor (opcional)" />
            <x-text-input id="setor" name="setor" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('setor')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="descricao" value="Descrição (opcional)" />
            <textarea id="descricao" name="descricao" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
        </div>

        <hr class="my-6">

        <div class="mt-4">
            <x-input-label for="contacto_nome" value="Nome do Responsável" />
            <x-text-input id="contacto_nome" name="contacto_nome" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('contacto_nome')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="contacto_email" value="Email de Acesso" />
            <x-text-input id="contacto_email" name="contacto_email" type="email" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('contacto_email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="contacto_telefone" value="Telefone" />
            <x-text-input id="contacto_telefone" name="contacto_telefone" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('contacto_telefone')" class="mt-2" />
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
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                Já tens conta?
            </a>

            <x-primary-button class="ml-4">
                Registar Empresa
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

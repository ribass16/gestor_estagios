<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Nova Empresa</h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-6">
            <form method="POST" action="{{ route('admin.empresas.store') }}">
                @csrf

                {{-- CONTA (LOGIN) - RESPONSÁVEL --}}
                <div class="space-y-4">
                    <h3 class="text-gray-300 font-semibold">Conta (login) — Responsável</h3>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300">Nome do responsável</label>
                            <input name="responsavel_nome" value="{{ old('responsavel_nome') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('responsavel_nome') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">Email (login)</label>
                            <input name="responsavel_email" value="{{ old('responsavel_email') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('responsavel_email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
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
                </div>

                {{-- DADOS DA EMPRESA --}}
                <div class="space-y-4 pt-6 border-t border-gray-800">
                    <h3 class="text-gray-300 font-semibold">Dados da Empresa</h3>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300">Nome da Empresa</label>
                            <input name="nome" value="{{ old('nome') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('nome') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">NIF (opcional)</label>
                            <input name="nif" value="{{ old('nif') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('nif') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300">Email de contacto</label>
                            <input name="email_contacto" value="{{ old('email_contacto') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('email_contacto') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">Telemóvel</label>
                            <input name="telemovel" value="{{ old('telemovel') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('telemovel') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300">Website</label>
                            <input name="website" value="{{ old('website') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('website') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300">Setor</label>
                            <input name="setor" value="{{ old('setor') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('setor') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300">Morada</label>
                        <input name="morada" value="{{ old('morada') }}"
                               class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-300">Descrição</label>
                        <textarea name="descricao" rows="3"
                                  class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded">{{ old('descricao') }}</textarea>
                    </div>

                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="aceita_estagios" value="1" {{ old('aceita_estagios') ? 'checked' : '' }}
                               class="rounded border-gray-600 bg-gray-800">
                        <span class="text-gray-300 text-sm">Aceita estágios</span>
                    </label>
                </div>

                {{-- RESPONSÁVEL (dados extra) --}}
                <div class="space-y-4 pt-6 border-t border-gray-800">
                    <h3 class="text-gray-300 font-semibold">Responsável (dados adicionais)</h3>

                    <div class="grid sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300">Telemóvel do responsável</label>
                            <input name="responsavel_telemovel" value="{{ old('responsavel_telemovel') }}"
                                   class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded"/>
                            @error('responsavel_telemovel') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- ESTADO --}}
                <div class="space-y-2 pt-6 border-t border-gray-800">
                    <label class="block text-sm text-gray-300">Estado</label>
                    <select name="estado" class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded">
                        <option value="pendente"  {{ old('estado')==='pendente'?'selected':'' }}>pendente</option>
                        <option value="aprovada"  {{ old('estado','aprovada')==='aprovada'?'selected':'' }}>aprovada</option>
                        <option value="rejeitada" {{ old('estado')==='rejeitada'?'selected':'' }}>rejeitada</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-6">
                    <a href="{{ route('admin.empresas.index') }}" class="px-4 py-2 rounded bg-gray-700 text-white">Cancelar</a>
                    <x-primary-button>Guardar</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

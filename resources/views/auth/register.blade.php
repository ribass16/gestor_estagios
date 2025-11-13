<x-guest-layout>
    <div class="p-4">
        {{-- Header --}}
        <div class="text-center mb-2">
            <h2 class="text-lg font-bold text-white">Registar como Aluno</h2>
            <p class="text-xs text-gray-400">Crie a sua conta de estudante</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-3">
            @csrf
            <input type="hidden" name="user_type" value="aluno">

            {{-- Grid 2 colunas --}}
            <div class="grid grid-cols-2 gap-3">
                {{-- Nome (span 2) --}}
                <div class="col-span-2">
                    <label for="name" class="block text-xs font-semibold text-blue-300 mb-0.5">Nome Completo *</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-2 py-1.5 bg-gray-900 border border-gray-700 text-white text-xs rounded focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                           placeholder="João Silva"/>
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-span-2">
                    <label for="email" class="block text-xs font-semibold text-purple-300 mb-0.5">Email Institucional *</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-2 py-1.5 bg-gray-900 border border-gray-700 text-white text-xs rounded focus:border-purple-500 focus:ring-1 focus:ring-purple-500/20 transition-all placeholder-gray-500"
                           placeholder="aluno@istec.pt"/>
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Número --}}
                <div>
                    <label for="numero_estudante" class="block text-xs font-semibold text-indigo-300 mb-0.5">Nº Estudante *</label>
                    <input id="numero_estudante" type="text" name="numero_estudante" value="{{ old('numero_estudante') }}" required
                           class="w-full px-2 py-1.5 bg-gray-900 border border-gray-700 text-white text-xs rounded focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/20 transition-all placeholder-gray-500"
                           placeholder="202301234"/>
                    @error('numero_estudante')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ano --}}
                <div>
                    <label for="ano_letivo" class="block text-xs font-semibold text-blue-300 mb-0.5">Ano Letivo *</label>
                    <input id="ano_letivo" type="text" name="ano_letivo" value="{{ old('ano_letivo') }}" required
                           class="w-full px-2 py-1.5 bg-gray-900 border border-gray-700 text-white text-xs rounded focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                           placeholder="2024/2025"/>
                    @error('ano_letivo')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Curso (span 2) --}}
                <div class="col-span-2">
                    <label for="curso" class="block text-xs font-semibold text-purple-300 mb-0.5">Curso *</label>
                    <input id="curso" type="text" name="curso" value="{{ old('curso') }}" required
                           class="w-full px-2 py-1.5 bg-gray-900 border border-gray-700 text-white text-xs rounded focus:border-purple-500 focus:ring-1 focus:ring-purple-500/20 transition-all placeholder-gray-500"
                           placeholder="Engenharia Informática"/>
                    @error('curso')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-semibold text-indigo-300 mb-0.5">Password *</label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-2 py-1.5 bg-gray-900 border border-gray-700 text-white text-xs rounded focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/20 transition-all placeholder-gray-500"
                           placeholder="Min. 8 caracteres"/>
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmar --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-blue-300 mb-0.5">Confirmar *</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="w-full px-2 py-1.5 bg-gray-900 border border-gray-700 text-white text-xs rounded focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                           placeholder="Repita a password"/>
                </div>
            </div>

            {{-- Botão --}}
            <button type="submit"
                    class="w-full px-3 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-500 hover:to-blue-500 text-white text-xs font-bold rounded shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 flex items-center justify-center gap-1.5">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Criar Conta
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-xs text-gray-400 hover:text-white transition-colors">
                    Já tem conta? <span class="text-blue-400 font-semibold">Entre aqui</span>
                </a>
            </div>
        </form>

        {{-- Footer --}}
        <div class="mt-3 pt-3 border-t border-gray-700/50">
            <p class="text-xs text-gray-500 text-center mb-1.5">Ou registe-se como:</p>
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('empresa.register.create') }}"
                   class="px-2 py-1 bg-purple-600/10 hover:bg-purple-600/20 border border-purple-500/30 text-purple-300 text-xs font-semibold rounded transition-all text-center">
                    Empresa
                </a>
                <a href="{{ route('orientador.register.create') }}"
                   class="px-2 py-1 bg-blue-600/10 hover:bg-blue-600/20 border border-blue-500/30 text-blue-300 text-xs font-semibold rounded transition-all text-center">
                    Orientador
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

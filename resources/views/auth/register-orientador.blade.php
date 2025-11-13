<x-guest-layout>
    <div class="p-6">
        {{-- Header --}}
        <div class="text-center mb-4">
            <h2 class="text-xl font-bold text-white">Registar Orientador</h2>
            <p class="text-xs text-gray-400 mt-1">Acesso ativado após validação</p>
        </div>

        <form method="POST" action="{{ route('orientador.register.store') }}" class="space-y-4">
            @csrf

            {{-- Grid 2 colunas --}}
            <div class="grid grid-cols-2 gap-4">
                {{-- Nome (span 2) --}}
                <div class="col-span-2">
                    <label for="nome" class="block text-xs font-semibold text-blue-300 mb-1">Nome Completo *</label>
                    <input id="nome" name="nome" type="text" required autofocus
                           class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-white text-sm rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                           placeholder="Prof. João Silva"/>
                    @error('nome')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email (span 2) --}}
                <div class="col-span-2">
                    <label for="email" class="block text-xs font-semibold text-purple-300 mb-1">Email Institucional *</label>
                    <input id="email" name="email" type="email" required
                           class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-white text-sm rounded-lg focus:border-purple-500 focus:ring-1 focus:ring-purple-500/20 transition-all placeholder-gray-500"
                           placeholder="orientador@istec.pt"/>
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Departamento --}}
                <div>
                    <label for="departamento" class="block text-xs font-semibold text-indigo-300 mb-1">Departamento</label>
                    <input id="departamento" name="departamento" type="text"
                           class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-white text-sm rounded-lg focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/20 transition-all placeholder-gray-500"
                           placeholder="Informática"/>
                    @error('departamento')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Telemóvel --}}
                <div>
                    <label for="telemovel" class="block text-xs font-semibold text-blue-300 mb-1">Telemóvel</label>
                    <input id="telemovel" name="telemovel" type="text" maxlength="9" pattern="[0-9]{9}"
                           class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-white text-sm rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                           placeholder="912345678"/>
                    @error('telemovel')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-semibold text-purple-300 mb-1">Password *</label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-white text-sm rounded-lg focus:border-purple-500 focus:ring-1 focus:ring-purple-500/20 transition-all placeholder-gray-500"
                           placeholder="Min. 8 caracteres"/>
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmar --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-blue-300 mb-1">Confirmar *</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full px-3 py-2 bg-gray-900 border border-gray-700 text-white text-sm rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                           placeholder="Repita a password"/>
                </div>
            </div>

            {{-- Botão --}}
            <button type="submit"
                    class="w-full px-4 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-blue-500/30 transition-all duration-300 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
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
        <div class="mt-4 pt-4 border-t border-gray-700/50">
            <p class="text-xs text-gray-500 text-center mb-2">Ou registe-se como:</p>
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('register') }}"
                   class="px-2 py-1.5 bg-indigo-600/10 hover:bg-indigo-600/20 border border-indigo-500/30 text-indigo-300 text-xs font-semibold rounded-lg transition-all text-center">
                    Aluno
                </a>
                <a href="{{ route('empresa.register.create') }}"
                   class="px-2 py-1.5 bg-purple-600/10 hover:bg-purple-600/20 border border-purple-500/30 text-purple-300 text-xs font-semibold rounded-lg transition-all text-center">
                    Empresa
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

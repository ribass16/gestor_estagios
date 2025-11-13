<x-guest-layout>
    <div class="p-8">
        {{-- Header --}}
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center justify-center">
                <svg class="w-7 h-7 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Registar Empresa
            </h2>
            <p class="text-sm text-gray-400 mt-2">O acesso será ativado após validação pela coordenação</p>
        </div>

        <form method="POST" action="{{ route('empresa.register.store') }}" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label for="nome_empresa" class="block text-sm font-semibold text-purple-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Nome da Empresa *
                </label>
                <input id="nome_empresa" name="nome_empresa" type="text" required
                       class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all placeholder-gray-500"
                       placeholder="Empresa Exemplo Lda"/>
                @error('nome_empresa')
                    <p class="text-red-400 text-sm flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                @enderror
            </div>

            {{-- Grid de Informações da Empresa --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="nif" class="block text-sm font-semibold text-indigo-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                        </svg>
                        NIF
                    </label>
                    <input id="nif" name="nif" type="text" maxlength="9" pattern="[0-9]{9}"
                           class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder-gray-500 text-sm"
                           placeholder="123456789"/>
                    @error('nif')
                        <p class="text-red-400 text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="telemovel" class="block text-sm font-semibold text-blue-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Telemóvel
                    </label>
                    <input id="telemovel" name="telemovel" type="text" maxlength="9" pattern="[0-9]{9}"
                           class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-gray-500 text-sm"
                           placeholder="912345678"/>
                    @error('telemovel')
                        <p class="text-red-400 text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Morada --}}
            <div class="space-y-2">
                <label for="morada" class="block text-sm font-semibold text-purple-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Morada
                </label>
                <input id="morada" name="morada" type="text"
                       class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all placeholder-gray-500"
                       placeholder="Rua Example, nº 123, Lisboa"/>
                @error('morada')
                    <p class="text-red-400 text-sm flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                @enderror
            </div>

            {{-- Website e Setor --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="website" class="block text-sm font-semibold text-indigo-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        Website
                    </label>
                    <input id="website" name="website" type="text"
                           class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder-gray-500 text-sm"
                           placeholder="www.empresa.pt"/>
                    @error('website')
                        <p class="text-red-400 text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="setor" class="block text-sm font-semibold text-blue-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Setor
                    </label>
                    <input id="setor" name="setor" type="text"
                           class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-gray-500 text-sm"
                           placeholder="Tecnologia"/>
                    @error('setor')
                        <p class="text-red-400 text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Descrição --}}
            <div class="space-y-2">
                <label for="descricao" class="block text-sm font-semibold text-purple-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                    Descrição da Empresa
                </label>
                <textarea id="descricao" name="descricao" rows="3"
                          class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all placeholder-gray-500 resize-none"
                          placeholder="Breve descrição sobre a empresa e atividades..."></textarea>
                @error('descricao')
                    <p class="text-red-400 text-sm flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                @enderror
            </div>

            {{-- Separador --}}
            <div class="border-t border-gray-700 pt-6">
                <h4 class="text-lg font-bold text-white flex items-center mb-4">
                    <div class="p-2 bg-indigo-500/20 rounded-lg mr-3 ring-1 ring-indigo-400/30">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    Dados do Responsável
                </h4>

                {{-- Nome do Responsável --}}
                <div class="space-y-2 mb-5">
                    <label for="contacto_nome" class="block text-sm font-semibold text-indigo-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Nome do Responsável *
                    </label>
                    <input id="contacto_nome" name="contacto_nome" type="text" required
                           class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder-gray-500"
                           placeholder="João Silva"/>
                    @error('contacto_nome')
                        <p class="text-red-400 text-sm flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email e Telefone --}}
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div class="space-y-2">
                        <label for="contacto_email" class="block text-sm font-semibold text-blue-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email de Acesso *
                        </label>
                        <input id="contacto_email" name="contacto_email" type="email" required
                               class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-gray-500 text-sm"
                               placeholder="contacto@empresa.pt"/>
                        @error('contacto_email')
                            <p class="text-red-400 text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="contacto_telefone" class="block text-sm font-semibold text-purple-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Telefone *
                        </label>
                        <input id="contacto_telefone" name="contacto_telefone" type="text" maxlength="9" pattern="[0-9]{9}" required
                               class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all placeholder-gray-500 text-sm"
                               placeholder="912345678"/>
                        @error('contacto_telefone')
                            <p class="text-red-400 text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Passwords --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-indigo-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            Password *
                        </label>
                        <input id="password" name="password" type="password" required
                               class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder-gray-500 text-sm"
                               placeholder="Min. 8 caracteres"/>
                        @error('password')
                            <p class="text-red-400 text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-semibold text-blue-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Confirmar *
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-gray-500 text-sm"
                               placeholder="Repita a password"/>
                    </div>
                </div>
            </div>

            {{-- Botões --}}
            <div class="flex flex-col gap-3 pt-4">
                <button type="submit"
                        class="w-full px-6 py-3.5 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-bold rounded-xl shadow-lg hover:shadow-purple-500/30 transition-all duration-300 hover:scale-[1.02] flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Criar Conta de Empresa
                </button>

                <a href="{{ route('login') }}"
                   class="text-center text-sm text-gray-400 hover:text-white transition-colors">
                    Já tem conta? <span class="text-purple-400 font-semibold">Entre aqui</span>
                </a>
            </div>
        </form>

        {{-- Outros Tipos de Registro --}}
        <div class="mt-6 pt-6 border-t border-gray-700/50 space-y-3">
            <p class="text-xs text-gray-500 text-center mb-3">Ou registe-se como:</p>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('register') }}"
                   class="px-3 py-2 bg-indigo-600/10 hover:bg-indigo-600/20 border border-indigo-500/30 text-indigo-300 text-xs font-semibold rounded-lg transition-all text-center">
                    Aluno
                </a>
                <a href="{{ route('orientador.register.create') }}"
                   class="px-3 py-2 bg-blue-600/10 hover:bg-blue-600/20 border border-blue-500/30 text-blue-300 text-xs font-semibold rounded-lg transition-all text-center">
                    Orientador
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

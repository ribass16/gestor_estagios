<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.alunos.index') }}" class="mr-4 p-2 hover:bg-gray-700 rounded-lg transition-colors">
                <svg class="w-6 h-6 text-gray-400 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                    <svg class="w-7 h-7 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Registar Novo Aluno
                </h2>
                <p class="text-sm text-gray-400 mt-1">Preencha os dados do aluno para criar uma nova conta</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl shadow-2xl overflow-hidden">

            {{-- Header do Formulário --}}
            <div class="bg-gradient-to-r from-blue-600/20 via-purple-600/20 to-indigo-600/20 border-b border-gray-700/50 px-8 py-6">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <div class="p-2 bg-purple-500/20 rounded-lg mr-3 ring-1 ring-purple-400/30">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    Informações do Aluno
                </h3>
                <p class="text-sm text-gray-400 mt-1 ml-14">Todos os campos marcados com * são obrigatórios</p>
            </div>

            {{-- Formulário --}}
            <form method="POST" action="{{ route('admin.alunos.store') }}" class="p-8 space-y-6">
                @csrf

                {{-- Nome Completo --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-blue-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Nome Completo *
                    </label>
                    <input type="text" name="nome" value="{{ old('nome') }}" required
                           class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                           placeholder="Ex: João Silva Santos"/>
                    @error('nome')
                        <p class="text-red-400 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email e Nº Estudante --}}
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-purple-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email Institucional *
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all placeholder-gray-500"
                               placeholder="aluno@istec.pt"/>
                        @error('email')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-indigo-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            Número de Estudante
                        </label>
                        <input type="text" name="numero_estudante" value="{{ old('numero_estudante') }}"
                               class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder-gray-500"
                               placeholder="Ex: 202301234"/>
                        @error('numero_estudante')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Curso e Ano Letivo --}}
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-blue-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Curso
                        </label>
                        <input type="text" name="curso" value="{{ old('curso') }}"
                               class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                               placeholder="Ex: Engenharia Informática"/>
                        @error('curso')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-purple-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Ano Letivo
                        </label>
                        <input type="text" name="ano_letivo" value="{{ old('ano_letivo') }}"
                               class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all placeholder-gray-500"
                               placeholder="Ex: 2024/2025"/>
                        @error('ano_letivo')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Separador --}}
                <div class="border-t border-gray-700 pt-6">
                    <h4 class="text-lg font-bold text-white flex items-center mb-4">
                        <div class="p-2 bg-indigo-500/20 rounded-lg mr-3 ring-1 ring-indigo-400/30">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        Credenciais de Acesso
                    </h4>

                    {{-- Passwords --}}
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-indigo-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                                Password *
                            </label>
                            <input type="password" name="password" required
                                   class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder-gray-500"
                                   placeholder="Mínimo 8 caracteres"/>
                            @error('password')
                                <p class="text-red-400 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-blue-300 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Confirmar Password *
                            </label>
                            <input type="password" name="password_confirmation" required
                                   class="w-full px-4 py-3 bg-gray-900 border-2 border-gray-700 text-white rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all placeholder-gray-500"
                                   placeholder="Repita a password"/>
                        </div>
                    </div>
                </div>

                {{-- Botões de Ação --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-700">
                    <a href="{{ route('admin.alunos.index') }}"
                       class="flex-1 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-xl transition-all text-center flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancelar
                    </a>
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-500 hover:to-purple-600 text-white font-bold rounded-xl shadow-lg hover:shadow-purple-500/30 transition-all duration-300 hover:scale-105 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Criar Aluno
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

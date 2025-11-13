<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                <svg class="w-7 h-7 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Criar Nova Vaga de Estágio
            </h2>
            <p class="text-sm text-gray-400 mt-1">Preencha as informações para criar uma nova oportunidade de estágio</p>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-gray-800/90 via-gray-800 to-gray-900 border border-gray-700/50 rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header do Formulário -->
            <div class="bg-gradient-to-r from-purple-600/20 via-pink-600/20 to-purple-600/20 border-b border-gray-700/50 px-8 py-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500/30 to-pink-500/30 rounded-xl flex items-center justify-center mr-4 ring-2 ring-purple-400/30">
                        <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Detalhes da Vaga</h3>
                        <p class="text-sm text-gray-400">Todos os campos são obrigatórios</p>
                    </div>
                </div>
            </div>

            <!-- Formulário -->
            <form method="POST" action="{{ route('vagas.store') }}" class="p-8">
                @csrf

                <div class="space-y-6">
                    <!-- Título -->
                    <div class="group">
                        <label class="flex items-center text-gray-300 font-semibold mb-3 text-sm uppercase tracking-wider">
                            <svg class="w-5 h-5 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Título da Vaga
                        </label>
                        <input type="text"
                               name="titulo"
                               class="w-full px-4 py-3 bg-gray-900/50 border-2 border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all duration-300 group-hover:border-gray-600"
                               placeholder="Ex: Estágio em Desenvolvimento Web"
                               value="{{ old('titulo') }}"
                               required>
                        @error('titulo')
                            <div class="flex items-center mt-2 text-red-400 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Descrição -->
                    <div class="group">
                        <label class="flex items-center text-gray-300 font-semibold mb-3 text-sm uppercase tracking-wider">
                            <svg class="w-5 h-5 mr-2 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            Descrição da Vaga
                        </label>
                        <textarea name="descricao"
                                  rows="8"
                                  class="w-full px-4 py-3 bg-gray-900/50 border-2 border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/20 transition-all duration-300 group-hover:border-gray-600 resize-none"
                                  placeholder="Descreva as responsabilidades, requisitos, competências desejadas e benefícios oferecidos..."
                                  required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="flex items-center mt-2 text-red-400 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Seja claro e detalhado para atrair os melhores candidatos
                        </p>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-700/50">
                    <a href="{{ route('vagas.index') }}"
                       class="px-6 py-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 flex items-center gap-2 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-purple-600 via-pink-600 to-purple-600 hover:from-purple-500 hover:via-pink-500 hover:to-purple-500 text-white font-bold rounded-xl transition-all duration-300 hover:scale-105 flex items-center gap-2 shadow-xl hover:shadow-purple-500/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Criar Vaga
                    </button>
                </div>
            </form>
        </div>

        <!-- Card de Ajuda -->
        <div class="mt-6 bg-gradient-to-br from-blue-900/30 via-blue-800/20 to-purple-900/30 border border-blue-700/30 rounded-xl p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm font-bold text-blue-300 mb-2">Dicas para uma boa vaga</h4>
                    <ul class="text-sm text-gray-400 space-y-1">
                        <li class="flex items-start">
                            <span class="text-blue-400 mr-2">•</span>
                            Use um título claro e objetivo que descreva a área de atuação
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-400 mr-2">•</span>
                            Especifique as competências técnicas e comportamentais desejadas
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-400 mr-2">•</span>
                            Mencione os benefícios e oportunidades de aprendizagem oferecidos
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

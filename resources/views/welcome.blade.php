<!DOCTYPE html>
<html lang="pt" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Estágios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950">
    <div class="fixed inset-0 -z-20 overflow-hidden pointer-events-none">
        <div class="absolute top-0 -right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 -left-40 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-50 bg-gradient-to-r from-gray-800/50 via-gray-800/40 to-gray-800/50 backdrop-blur-lg border-b border-gray-700/40 shadow-2xl shadow-gray-900/50">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 text-transparent bg-clip-text">
                        ISTEC
                    </span>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-300 hover:text-white transition">Funcionalidades</a>
                    <a href="#about" class="text-gray-300 hover:text-white transition">Sobre</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-indigo-400 hover:text-indigo-300 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition">Entrar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                                    Registar
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden p-2 text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-4xl mx-auto">
            <!-- Main Title -->
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                Sistema de Gestão de
                <span class="block bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 text-transparent bg-clip-text">
                    Estágios
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto">
                Conecte alunos, empresas e orientadores em uma plataforma moderna e eficiente
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition transform hover:scale-105">
                        Ir para Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition transform hover:scale-105">
                        Entrar no Sistema
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gray-800/50 hover:bg-gray-700/50 text-white rounded-lg font-semibold border border-gray-700 transition transform hover:scale-105">
                            Criar Conta
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                <div class="p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                    <div class="text-3xl font-bold bg-gradient-to-r from-indigo-400 to-purple-400 text-transparent bg-clip-text">100+</div>
                    <div class="text-gray-400 text-sm mt-2">Empresas Parceiras</div>
                </div>
                <div class="p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                    <div class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 text-transparent bg-clip-text">1000+</div>
                    <div class="text-gray-400 text-sm mt-2">Alunos Registados</div>
                </div>
                <div class="p-6 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                    <div class="text-3xl font-bold bg-gradient-to-r from-pink-400 to-indigo-400 text-transparent bg-clip-text">500+</div>
                    <div class="text-gray-400 text-sm mt-2">Estágios Ativos</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="relative py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Funcionalidades Principais
                </h2>
                <p class="text-xl text-gray-400">Tudo que você precisa para gerenciar estágios de forma eficiente</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Para Alunos -->
                <div class="p-8 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40 hover:border-indigo-500/40 transition">
                    <div class="w-12 h-12 bg-indigo-500/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Para Alunos</h3>
                    <p class="text-gray-400">
                        Encontre oportunidades de estágio, candidate-se a vagas e acompanhe seu progresso em tempo real
                    </p>
                </div>

                <!-- Para Empresas -->
                <div class="p-8 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40 hover:border-purple-500/40 transition">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.581m0 0H9m5.581 0a2 2 0 100-4 2 2 0 000 4zM9 7h.01M9 3h.01M15 21h.01M15 3h.01" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Para Empresas</h3>
                    <p class="text-gray-400">
                        Publique vagas, revise candidaturas e gerencie estagiários de forma centralizada
                    </p>
                </div>

                <!-- Para Orientadores -->
                <div class="p-8 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40 hover:border-pink-500/40 transition">
                    <div class="w-12 h-12 bg-pink-500/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Para Orientadores</h3>
                    <p class="text-gray-400">
                        Supervisione estágios, forneça feedback e acompanhe o desenvolvimento dos alunos
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="about" class="relative py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Por que escolher nosso sistema?
                    </h2>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-indigo-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">Plataforma Centralizada</h3>
                                <p class="text-gray-400 mt-1">Todas as informações de estágios num único local</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-purple-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">Fácil de Usar</h3>
                                <p class="text-gray-400 mt-1">Interface intuitiva para todos os utilizadores</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-pink-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">Tempo Real</h3>
                                <p class="text-gray-400 mt-1">Notificações e atualizações instantâneas</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">Seguro</h3>
                                <p class="text-gray-400 mt-1">Dados protegidos e autenticação segura</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 rounded-lg blur-2xl"></div>
                    <div class="relative p-8 bg-gray-800/30 backdrop-blur-lg rounded-lg border border-gray-700/40">
                        <div class="space-y-4">
                            <div class="h-3 bg-gray-700/50 rounded w-full"></div>
                            <div class="h-3 bg-gray-700/50 rounded w-5/6"></div>
                            <div class="h-3 bg-indigo-500/30 rounded w-4/6"></div>
                        </div>
                        <div class="mt-8 space-y-4">
                            <div class="h-3 bg-gray-700/50 rounded w-full"></div>
                            <div class="h-3 bg-gray-700/50 rounded w-5/6"></div>
                            <div class="h-3 bg-purple-500/30 rounded w-4/6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="p-12 bg-gradient-to-r from-gray-800/40 to-gray-800/20 backdrop-blur-xl rounded-lg border border-gray-700/40 text-center">
                <h2 class="text-4xl font-bold text-white mb-4">Pronto para começar?</h2>
                <p class="text-xl text-gray-300 mb-8">Junte-se a centenas de alunos, empresas e orientadores na nossa plataforma</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition transform hover:scale-105">
                            Ir para Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition transform hover:scale-105">
                            Registar Agora
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-gray-800/50 hover:bg-gray-700/50 text-white rounded-lg font-semibold border border-gray-700 transition transform hover:scale-105">
                            Já tem conta? Entre
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative border-t border-gray-700/40 py-12 px-4 sm:px-6 lg:px-8 bg-gray-800/20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <span class="text-xl font-bold bg-gradient-to-r from-indigo-400 to-purple-400 text-transparent bg-clip-text">
                        ISTEC
                    </span>
                    <p class="text-gray-400 text-sm mt-4">Sistema de Gestão de Estágios</p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Produto</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#features" class="hover:text-white transition">Funcionalidades</a></li>
                        <li><a href="#about" class="hover:text-white transition">Sobre</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Para Usar</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="hover:text-white transition">Entrar</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}" class="hover:text-white transition">Registar</a></li>
                            @endif
                        @endif
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Contacte-nos</h3>
                    <p class="text-gray-400 text-sm">info@istec.pt</p>
                </div>
            </div>
            <div class="border-t border-gray-700/40 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2025 ISTEC - Sistema de Gestão de Estágios. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>

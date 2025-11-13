<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Painel do Administrador
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- Cartões principais --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            {{-- Alunos (só contagem) --}}
            <a href="{{ route('admin.alunos.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Alunos</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $alunosTotal }}</div>
            </a>
 
            {{-- Empresas (link certo) --}}
            <a href="{{ route('admin.empresas.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Empresas</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $empresasTotal }}</div>
                <div class="text-xs text-amber-300 mt-1">{{ $empresasPendentes }} pendentes</div>
            </a>

            {{-- Orientadores (link certo) --}}
            <a href="{{ route('admin.orientadores.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Orientadores</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $orientadoresTotal }}</div>
                <div class="text-xs text-amber-300 mt-1">{{ $orientadoresPendentes }} pendentes</div>
            </a>

            {{-- Vagas Abertas (se não tens uma página admin de vagas, aponta para a lista pública) --}}
            <a href="{{ route('vagas.index') }}" class="bg-gray-800 rounded-lg p-5 shadow block hover:ring-2 ring-indigo-500">
                <div class="text-sm text-gray-400">Vagas Abertas</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $vagasAbertas }}</div>
            </a>

            {{-- Estágios Ativos (se criares uma página admin de estágios, troca esta rota) --}}
            <div class="bg-gray-800 rounded-lg p-5 shadow">
                <div class="text-sm text-gray-400">Estágios Ativos</div>
                <div class="text-3xl font-semibold text-white mt-1">{{ $estagiosAtivos }}</div>
            </div>
        </div>

        {{-- Últimas candidaturas --}}
        <div class="bg-gray-800 rounded-lg p-6 shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-100 font-semibold">Últimas candidaturas</h3>
                {{-- Se mais tarde criares uma página admin de candidaturas, mete aqui a rota --}}
                {{-- <a href="{{ route('admin.candidaturas.index') }}" class="text-indigo-400 text-sm hover:underline">ver tudo</a> --}}
            </div>

            @if($ultimasCandidaturas->isEmpty())
                <p class="text-gray-400">Sem registos.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                        <tr class="text-gray-400">
                            <th class="text-left py-2">Aluno</th>
                            <th class="text-left py-2">Vaga</th>
                            <th class="text-left py-2">Empresa</th>
                            <th class="text-left py-2">Estado</th>
                            <th class="text-left py-2">Data</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-300">
                        @foreach($ultimasCandidaturas as $cand)
                            <tr class="border-t border-gray-700">
                                <td class="py-2">
                                    {{ $cand->aluno?->user?->name ?? '—' }}
                                </td>
                                <td class="py-2">
                                    {{ $cand->vaga?->titulo ?? '—' }}
                                </td>
                                <td class="py-2">
                                    {{ $cand->vaga?->empresa?->nome ?? '—' }}
                                </td>
                                <td class="py-2">
                                    <span class="px-2 py-0.5 rounded text-xs
                                        @if($cand->estado==='pendente') bg-yellow-600 @elseif($cand->estado==='aceite') bg-green-600 @elseif($cand->estado==='recusada') bg-red-600 @else bg-gray-600 @endif">
                                        {{ ucfirst($cand->estado) }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    {{ $cand->created_at?->format('d/m/Y H:i') ?? '—' }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

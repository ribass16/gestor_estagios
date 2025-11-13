<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Vaga #{{ $vaga->id }} — {{ $vaga->titulo }}</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if (session('status'))
            <div class="rounded bg-green-700/20 border border-green-700 text-green-200 px-4 py-2">
                {{ session('status') }}
            </div>
        @endif

        {{-- topo: estado + ações rápidas --}}
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                @php
                    $badge = $vaga->estado === 'aberta' ? 'bg-green-600' : 'bg-gray-600';
                @endphp
                <span class="px-2 py-0.5 rounded text-xs text-white {{ $badge }}">{{ $vaga->estado }}</span>
                <span class="text-sm text-gray-400">Criada em {{ $vaga->created_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="flex items-center gap-2">
                @if($vaga->estado === 'aberta')
                    <form method="POST" action="{{ route('admin.vagas.fechar', $vaga) }}">
                        @csrf
                        <button class="px-3 py-1 rounded bg-amber-600 hover:bg-amber-700 text-white text-sm">Fechar</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.vagas.abrir', $vaga) }}">
                        @csrf
                        <button class="px-3 py-1 rounded bg-green-600 hover:bg-green-700 text-white text-sm">Reabrir</button>
                    </form>
                @endif

                <a href="{{ route('admin.vagas.index') }}" class="px-3 py-1 rounded bg-gray-700 hover:bg-gray-800 text-white text-sm">Voltar</a>
            </div>
        </div>

        {{-- Detalhes da vaga --}}
        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-4">
                <h3 class="font-semibold text-gray-100">Detalhes</h3>
                <div class="space-y-2 text-gray-300">
                    <div><span class="text-gray-400 text-sm">Título:</span> {{ $vaga->titulo }}</div>
                    <div><span class="text-gray-400 text-sm">Descrição:</span>
                        <div class="mt-1 whitespace-pre-line text-gray-200">{{ $vaga->descricao }}</div>
                    </div>
                </div>
            </div>

            {{-- Empresa --}}
            <div class="bg-gray-900 border border-gray-800 rounded-lg p-6 space-y-3">
                <h3 class="font-semibold text-gray-100">Empresa</h3>
                @if($vaga->empresa)
                    <div class="text-gray-300">
                        <div class="mb-1">{{ $vaga->empresa->nome ?? '—' }}</div>
                        <div class="text-sm text-gray-400">Email (login): {{ $vaga->empresa->user->email ?? '—' }}</div>
                        <div class="text-sm text-gray-400">Email contacto: {{ $vaga->empresa->email_contacto ?? '—' }}</div>
                        <div class="text-sm text-gray-400">NIF: {{ $vaga->empresa->nif ?? '—' }}</div>
                        <div class="text-sm text-gray-400">Telemóvel: {{ $vaga->empresa->telemovel ?? '—' }}</div>
                        <div class="text-sm text-gray-400">Website: {{ $vaga->empresa->website ?? '—' }}</div>
                        <div class="text-sm text-gray-400">Setor: {{ $vaga->empresa->setor ?? '—' }}</div>
                        <div class="text-sm text-gray-400">Morada: {{ $vaga->empresa->morada ?? '—' }}</div>
                        <div class="text-sm text-gray-400 mt-2">Estado Empresa:
                            <span class="px-2 py-0.5 rounded text-xs
                            {{ $vaga->empresa->estado === 'aprovada' ? 'bg-green-600' : ($vaga->empresa->estado === 'rejeitada' ? 'bg-red-600' : 'bg-yellow-600') }} text-white">
                                {{ $vaga->empresa->estado }}
                            </span>
                        </div>
                    </div>
                @else
                    <div class="text-sm text-gray-400">—</div>
                @endif
            </div>
        </div>

        {{-- Candidaturas --}}
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-100">Candidaturas</h3>
                <span class="text-sm text-gray-400">{{ $vaga->candidaturas->count() }} registo(s)</span>
            </div>

            @if($vaga->candidaturas->isEmpty())
                <p class="text-gray-400 mt-3">Sem candidaturas para esta vaga.</p>
            @else
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-200">
                        <thead class="bg-gray-800 text-gray-300">
                            <tr>
                                <th class="px-4 py-2 text-left">Aluno</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Estado</th>
                                <th class="px-4 py-2 text-left">Data</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @foreach ($vaga->candidaturas as $c)
                                <tr>
                                    <td class="px-4 py-2">{{ $c->aluno->user->name ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $c->aluno->user->email ?? '—' }}</td>
                                    <td class="px-4 py-2">
                                        @php
                                            $map = ['pendente'=>'bg-yellow-600','aceite'=>'bg-green-600','recusada'=>'bg-red-600'];
                                            $cls = $map[$c->estado] ?? 'bg-gray-600';
                                        @endphp
                                        <span class="px-2 py-0.5 rounded text-xs text-white {{ $cls }}">{{ $c->estado }}</span>
                                    </td>
                                    <td class="px-4 py-2">{{ $c->created_at?->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestão de Orientadores
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        @if(session('status'))
            <div class="p-3 bg-green-100 text-green-800 rounded">
                {{ session('status') }}
            </div>
        @endif

        {{-- Botão criar orientador (admin cria já aprovado) --}}
        <div>
            <a href="{{ route('admin.orientadores.create') }}"
               class="inline-flex px-4 py-2 bg-indigo-600 text-white text-sm rounded-md">
                + Adicionar Orientador
            </a>
        </div>

        {{-- Cards com contagens --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-xs uppercase text-gray-500">Pendentes</div>
                <div class="text-2xl font-semibold">{{ $pendentes->count() }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-xs uppercase text-gray-500">Aprovados</div>
                <div class="text-2xl font-semibold">{{ $aprovados->count() }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-xs uppercase text-gray-500">Rejeitados</div>
                <div class="text-2xl font-semibold">{{ $rejeitados->count() }}</div>
            </div>
        </div>

        {{-- Pendentes --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-3">Pendentes</h3>
            @if($pendentes->isEmpty())
                <p class="text-sm text-gray-500">Nenhum orientador pendente.</p>
            @else
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left">Nome</th>
                            <th class="px-3 py-2 text-left">Email</th>
                            <th class="px-3 py-2 text-left">Departamento</th>
                            <th class="px-3 py-2 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendentes as $o)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $o->user->name }}</td>
                                <td class="px-3 py-2">{{ $o->user->email }}</td>
                                <td class="px-3 py-2">{{ $o->departamento ?? '-' }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    <form method="POST" action="{{ route('admin.orientadores.aprovar', $o) }}" class="inline">
                                        @csrf
                                        <x-primary-button type="submit">Aprovar</x-primary-button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.orientadores.rejeitar', $o) }}" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent
                                                       rounded-md font-semibold text-xs text-white uppercase tracking-widest
                                                       hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500
                                                       focus:ring-offset-2 transition ease-in-out duration-150">
                                            Rejeitar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Aprovados --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-3">Aprovados</h3>
            @if($aprovados->isEmpty())
                <p class="text-sm text-gray-500">Nenhum orientador aprovado.</p>
            @else
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left">Nome</th>
                            <th class="px-3 py-2 text-left">Email</th>
                            <th class="px-3 py-2 text-left">Departamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aprovados as $o)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $o->user->name }}</td>
                                <td class="px-3 py-2">{{ $o->user->email }}</td>
                                <td class="px-3 py-2">{{ $o->departamento ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Rejeitados --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-3">Rejeitados</h3>
            @if($rejeitados->isEmpty())
                <p class="text-sm text-gray-500">Nenhum orientador rejeitado.</p>
            @else
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left">Nome</th>
                            <th class="px-3 py-2 text-left">Email</th>
                            <th class="px-3 py-2 text-left">Departamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rejeitados as $o)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $o->user->name }}</td>
                                <td class="px-3 py-2">{{ $o->user->email }}</td>
                                <td class="px-3 py-2">{{ $o->departamento ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</x-app-layout>

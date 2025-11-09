<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestão de Empresas
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        @if(session('status'))
            <div class="p-3 bg-green-100 text-green-800 rounded">
                {{ session('status') }}
            </div>
        @endif

        {{-- Cards com contagens --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-xs uppercase text-gray-500">Pendentes</div>
                <div class="text-2xl font-semibold">{{ $pendentes->count() }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-xs uppercase text-gray-500">Aprovadas</div>
                <div class="text-2xl font-semibold">{{ $aprovadas->count() }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-xs uppercase text-gray-500">Rejeitadas</div>
                <div class="text-2xl font-semibold">{{ $rejeitadas->count() }}</div>
            </div>
        </div>

        {{-- Pendentes --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-3">Pendentes</h3>
            @if($pendentes->isEmpty())
                <p class="text-sm text-gray-500">Nenhuma empresa pendente.</p>
            @else
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left">Nome</th>
                            <th class="px-3 py-2 text-left">Email</th>
                            <th class="px-3 py-2 text-left">NIF</th>
                            <th class="px-3 py-2 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendentes as $empresa)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $empresa->nome }}</td>
                                <td class="px-3 py-2">{{ $empresa->email }}</td>
                                <td class="px-3 py-2">{{ $empresa->nif ?? '-' }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    <form method="POST" action="{{ route('admin.empresas.aprovar', $empresa) }}" class="inline">
                                        @csrf
                                        <x-primary-button type="submit">Aprovar</x-primary-button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.empresas.rejeitar', $empresa) }}" class="inline">
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

        {{-- Aprovadas --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-3">Aprovadas</h3>
            @if($aprovadas->isEmpty())
                <p class="text-sm text-gray-500">Nenhuma empresa aprovada.</p>
            @else
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left">Nome</th>
                            <th class="px-3 py-2 text-left">Email</th>
                            <th class="px-3 py-2 text-left">NIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aprovadas as $empresa)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $empresa->nome }}</td>
                                <td class="px-3 py-2">{{ $empresa->email }}</td>
                                <td class="px-3 py-2">{{ $empresa->nif ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Rejeitadas --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-3">Rejeitadas</h3>
            @if($rejeitadas->isEmpty())
                <p class="text-sm text-gray-500">Nenhuma empresa rejeitada.</p>
            @else
                <table class="min-w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left">Nome</th>
                            <th class="px-3 py-2 text-left">Email</th>
                            <th class="px-3 py-2 text-left">NIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rejeitadas as $empresa)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $empresa->nome }}</td>
                                <td class="px-3 py-2">{{ $empresa->email }}</td>
                                <td class="px-3 py-2">{{ $empresa->nif ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</x-app-layout>

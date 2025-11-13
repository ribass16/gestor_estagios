<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Alunos
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(session('status'))
            <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <form method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ $q }}" placeholder="Pesquisar por nome, email, nº estudante, curso"
                   class="w-full rounded bg-white/5 border border-white/10 text-gray-200 px-3 py-2"
            >
            <x-primary-button>Pesquisar</x-primary-button>
        </form>

        <div class="bg-white/5 border border-white/10 rounded-lg p-6">
            @if($alunos->isEmpty())
                <p class="text-sm text-gray-400">Sem alunos.</p>
            @else
                <table class="min-w-full text-sm text-gray-200">
                    <thead class="text-gray-400">
                        <tr>
                            <th class="px-3 py-2 text-left">Nome</th>
                            <th class="px-3 py-2 text-left">Email</th>
                            <th class="px-3 py-2 text-left">Nº Estudante</th>
                            <th class="px-3 py-2 text-left">Curso</th>
                            <th class="px-3 py-2 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alunos as $aluno)
                            <tr class="border-t border-white/10">
                                <td class="px-3 py-2">{{ $aluno->user->name ?? '-' }}</td>
                                <td class="px-3 py-2">{{ $aluno->user->email ?? '-' }}</td>
                                <td class="px-3 py-2">{{ $aluno->numero_estudante ?? '-' }}</td>
                                <td class="px-3 py-2">{{ $aluno->curso ?? '-' }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    <a href="{{ route('admin.alunos.edit', $aluno) }}"
                                       class="px-3 py-1 rounded bg-yellow-600 hover:bg-yellow-700 text-white">
                                        Editar
                                    </a>
                                    <form class="inline" method="POST"
                                          action="{{ route('admin.alunos.destroy', $aluno) }}"
                                          onsubmit="return confirm('Apagar este aluno?');">
                                        @csrf @method('DELETE')
                                        <button class="px-3 py-1 rounded bg-red-600 hover:bg-red-700 text-white">
                                            Apagar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">{{ $alunos->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Escolher Orientador
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="mb-4 text-gray-700">
                Vaga: <strong>{{ $candidatura->vaga->titulo }}</strong> na empresa
                <strong>{{ $candidatura->vaga->empresa->nome }}</strong>
            </p>

            @if($orientadores->isEmpty())
                <p class="text-sm text-red-600">
                    De momento não existem orientadores disponíveis (todos atingiram o limite de 5 alunos).
                    Contacta a coordenação de estágios.
                </p>
            @else
                <form method="POST" action="{{ route('aluno.candidaturas.orientador.store', $candidatura) }}">
                    @csrf

                    <label for="orientador_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Seleciona o orientador:
                    </label>

                    <select id="orientador_id" name="orientador_id"
                            class="block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach($orientadores as $o)
                            <option value="{{ $o->id }}">
                                {{ $o->user->name }}
                                ({{ $o->departamento ?? 'sem departamento' }})
                                — {{ $o->estagios_count }}/5 alunos
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('orientador_id')" class="mt-2" />

                    <div class="mt-6">
                        <x-primary-button type="submit">
                            Confirmar Orientador
                        </x-primary-button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>

<tbody>
@foreach($candidaturas as $candidatura)
    <tr>
        <td>{{ $candidatura->vaga->titulo }}</td>
        <td>{{ $candidatura->vaga->descricao }}</td>
        <td>{{ ucfirst($candidatura->estado) }}</td>

        {{-- AÇÕES --}}
        <td class="text-center">
            @if($candidatura->estado === 'pendente')
                <form method="POST" action="{{ route('candidaturas.destroy', $candidatura->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">
                        Cancelar
                    </button>
                </form>

            @elseif($candidatura->estado === 'aceite')
                <a href="{{ route('aluno.candidaturas.orientador.create', $candidatura->id) }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded">
                    Escolher Orientador
                </a>

            @elseif($candidatura->estado === 'confirmada')
                <span class="px-3 py-1 bg-green-600 text-white rounded text-xs">
                    Estágio confirmado
                </span>
            @else
                <span class="px-3 py-1 bg-gray-500 text-white rounded text-xs">
                    {{ ucfirst($candidatura->estado) }}
                </span>
            @endif
        </td>
    </tr>
@endforeach
</tbody>

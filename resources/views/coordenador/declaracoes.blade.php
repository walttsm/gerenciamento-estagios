@extends('layouts.common')

@section('content')
    <h1 style="font-size: 1.85em; font-weight:bold">Gerar declarações</h1>
    <!--<p>{{ $alunos }}</p>-->
    <form action="gerar_declaracoes" method="post" id="selecao_alunos">
        @csrf
        <button type="submit" style="border: 1px solid black; border-radius: 5%; background-color: lightgray;">Gerar declarações</button>
        <table width=100% class="text-center" center>
            <tr>
                <th></th>
            <th>Nome</th>
            <th>Turma</th>
            <th>Curso</th>
            <th>Atividades</th>
            <th>Horas</th>
            <th>Orientador</th>
            </th>
            @foreach ($alunos as $aluno)
            <tr>
                <td>
                    <input type="checkbox" name="data[]" id="{{ $aluno['id'] }}" value="{{ $aluno }}">
                </td>
                <td>{{ $aluno['nome_aluno'] }}</td>
                <td>{{ $aluno['turma_id'] }}</td>
                <td>{{ $aluno['curso'] }}</td>
                <td>ok</td>
                <td>0/80</td>
                <td>{{ $aluno['orientador'] }}</td>
            </tr>
            @endforeach
        </table>

    </form>

    <script>
        function enviar_dados() {
            location
        }
    </script>
@endsection

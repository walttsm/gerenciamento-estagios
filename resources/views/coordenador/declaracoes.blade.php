<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <title>Document</title>
    <style>
        td {
            text-align: center;
        }
    </style>
</head>

<body class="antialiased">
    <h1 style="font-size: 1.85em; font-weight:bold">Gerar declarações</h1>
    <!--<p>{{ $alunos }}</p>-->
    <form method="post" id="selecao_alunos">
        @csrf
        <button onclick="enviar_dados()">Gerar declarações</button>
        <table width=100% center>
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
                    <input type="checkbox" name="{{ $aluno['id'] }}" id="{{ $aluno['id'] }}" value="{{ $aluno }}">
                </td>    
                <td center>{{ $aluno['nome_aluno'] }}</td>
                <td center>{{ $aluno['turma_id'] }}</td>
                <td center>{{ $aluno['curso'] }}</td>
                <td center>ok</td>
                <td center>0/80</td>
                <td center>{{ $aluno['orientador_id'] }}</td>
            </tr>
            @endforeach
        </table>
        
    </form>

    <script>
        function enviar_dados() {
            console.log(document.getElementById("selecao_alunos").innerText)
        }
    </script>
</body>

</html>
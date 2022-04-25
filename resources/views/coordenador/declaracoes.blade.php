<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body class="antialiased">
    <h1>Gerar declarações</h1>
    <p>{{ $alunos }}</p>-->
    <div class="flex">
        <p>Nome</p>
        <p>Turma</p>
        <p>Curso</p>
        <p>Atividades</p>
        <p>Horas</p>
        <p>Orientador</p>
    </div>
        @foreach ($alunos as $aluno) 
        <div class="flex">
            <p>{{ $aluno['nome_aluno'] }}</p>
            <p>{{ $aluno['turma_id'] }}</p>
            <p>{{ $aluno['curso'] }}</p>
            <p>ok</p>
            <p>0/80</p>
            <p>{{ $aluno['orientador_id'] }}</p>
        </div>
        @endforeach
        
</body>
</html>
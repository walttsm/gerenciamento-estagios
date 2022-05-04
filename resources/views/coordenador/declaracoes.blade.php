<?php
use Spatie\Browsershot\Browsershot;
?>

@extends('layouts.common')

@section('content')
    <h1 class="m-8" style="font-size: 1.85em; font-weight:bold">Gerar declarações</h1>
    <hr>
    <!--<p>{{ $alunos }}</p>-->

    <form action="" method="post" id="selecao_alunos">
        @csrf
        <div class=" p-4 align-middle flex w-full">
            <input type="text" placeholder="Nome" name="filtro-nome" id="filtro-nome"
                class="min-w-[2rem] max-w-xs h-6 mx-8 my-auto" onchange="filtro_nome()" />
            <input type="text" placeholder="Turma" name="filtro-turma" id="filtro-turma"
                class="min-w-[2rem] max-w-xs h-6 mx-8 my-auto" onchange="filtro_turma()">
            <div class="flex-1">
                <button type="submit" class="default-button float-right bg-blue" onclick="">
                    Gerar declarações
                </button>
            </div>
        </div>

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
                    <input type="checkbox" name="data[]" id="{{ $aluno['id'] }}" value="{{ $aluno['id'] }}">
                </td>
                <td>{{ $aluno['nome_aluno'] }}</td>
                <td>{{ $aluno['turma_id'] }}</td>
                <td>{{ $aluno['curso'] }}</td>
                <td>ok</td>
                <td>0/80</td>
                <td>{{ $aluno['orientador'] }}</td>
                <td>
                    <a href="/coordenador/modelo_declaracao/{{ $aluno['id'] }}"> gerar</a>
                </td>
            </tr>
            @endforeach
        </table>

    </form>

    <script>

    </script>
@endsection

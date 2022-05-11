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
                    class="min-w-[2rem] max-w-xs h-6 mx-8 my-auto" onchange="filtro_nome($alunos, $)" />
                <input type="text" placeholder="Turma" name="filtro-turma" id="filtro-turma"
                    class="min-w-[2rem] max-w-xs h-6 mx-8 my-auto" onchange="filtro_turma()">
            <div class="flex-1">
                <button type="submit" class="default-button float-right bg-blue-700 hover:bg-blue-600 transition-colors" onclick="">
                    Gerar declarações
                </button>
            </div>
        </div>

        <table width=100% class="text-center" center>
            <thead>
                <th></th>
                <th>@sortablelink('nome_aluno', 'Nome')</th>
                <th>@sortablelink('turma_id', 'Turma')</th>
                <th>@sortablelink('curso', 'Curso')</th>
                <th>Atividades</th>
                <th>Horas</th>
                <th>Orientador</th>
                </th>
            </thead>
            @foreach ($alunos as $aluno)
            <td>
                <input type="checkbox" name="data[]" id="{{ $aluno['id'] }}" value="{{ $aluno['id'] }}">
            </td>
            <td>{{ $aluno->nome_aluno }}</td>
            <td>{{ $aluno->turma->ano }}</td>
            <td>{{ $aluno->curso }}</td>
            <td>ok</td>
            <td>0/80</td>
            <td>{{ $aluno->orientador->nome }}</td>
            <td>
                <button class="bg-blue-700 hover:bg-blue-600 p-2 rounded-full">
                    <a href="/coordenador/modelo_declaracao/{{ $aluno['id'] }}" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/file-download</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                            <path d="M12 17v-6"></path>
                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                         </svg>
                    </a>
                </button>
            </td>
            </tr>
            @endforeach
        </table>

        {{-- <div class="mt-8">
            {{ $alunos->links() }}
        </div> --}}

    </form>

    <script>
        var input_nome = document.getElementById('filtro-nome');
        var table_data = $alunos;
    </script>
@endsection

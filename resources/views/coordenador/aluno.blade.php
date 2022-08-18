@extends('layouts.common')

@section('content')
    <div class="mx-8">
        <div class="align-middle my-12 text-3xl font-bold">
            <h1>
                {{ $aluno->nome_aluno }}
            </h1>
        </div>
        <h2>RPODS</h2>
        <p class="text-lg">Total de horas realizadas: <b>{{ $aluno->rpods->sum('horas_mes') }} horas</b></p>
        <div class="grid grid-cols-6 gap-x-4">
            @foreach ($aluno->rpods as $rpod)
                <div
                    class="flex flex-col items-center bg-orange-100 my-4 px-8 py-4 border-solid border-[5px] border-orange-600 rounded-3xl">
                    <h3>RPOD {{ $rpod->mes }}</h3>
                    <b class="mt-2">{{ $rpod->horas_mes }} horas</b>
                    <p class="mt-2">{{ $rpod->rpod_title ? $rpod->rpod_title : 'Título não definido' }}</p>
                    <a href="{{ route('rpodpage.download', $rpod->id) }}" class="mt-4 md:text-xs">
                        <button type="button" class="flex default-button rounded text-white items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 icon icon-tabler icon-tabler-file-download"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M12 17v-6"></path>
                                <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                            </svg>
                            <span>
                                Baixar RPOD
                            </span>
                        </button>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mx-8 mt-8">
        <h2>Orientações</h2>
        <div class="flex items-center justify-around">
            <div>
                <p class="text-lg">Número de orientações: <b>{{ count($aluno->registros) . ' orientações' }}</b></p>
                <p class="text-lg">Faltas em orientações: <b>{{ $faltas == 1 ? '1 falta' : $faltas . ' faltas' }}</b></p>
            </div>
            <div class="ml-4">
                <form action="{{ route('alunos.show', $aluno->id) }}" method="get">
                    {!! Form::select(
                        'filtro_registros',
                        ['Todos', 'Presenças', 'Faltas'],
                        $filtro_registros ? $filtro_registros : 0,
                        ['class' => ''],
                    ) !!}
                    {!! Form::label('filtro_data_inicio', 'Data de Inicio:', ['class' => '']) !!}
                    {!! Form::date('filtro_data_inicio', $filtro_data_inicio ? $filtro_data_inicio : null, ['class' => '']) !!}
                    {!! Form::label('filtro_data_fim', 'Data de Fim:', ['class' => '']) !!}
                    {!! Form::date('filtro_data_fim', $filtro_data_fim ? $filtro_data_fim : null, ['class' => '']) !!}
                    <button type="submit" class="default-button rounded-full w-fit ml-8 p-2 text-white align-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/search</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="10" cy="10" r="7"></circle>
                            <line x1="21" y1="21" x2="15" y2="15"></line>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @foreach ($registros as $registro)
            @switch($filtro_registros)
                @case(1)
                    @if ($registro->presenca == 1)
                        <div class="bg-orange-100 my-4 px-8 py-4 border-solid border-[5px] border-orange-600 rounded-3xl">
                            <h3>Data: {{ date('d/m/Y  H:i:s', strtotime($registro->data_orientacao)) }}</h3>
                            <p>Assunto: {{ $registro->assunto }}</p>
                            <p>Próxima orientação: {{ $registro->prox_assunto }}</p>
                            <p>Observações: {{ $registro->observacao }}</p>
                            <p>Aluno Presente? {{ $registro->presenca == 1 ? 'Sim' : 'Não' }}</p>
                        </div>
                    @endif
                @break

                @case(2)
                    @if ($registro->presenca == 0)
                        <div class="bg-orange-100 my-4 px-8 py-4 border-solid border-[5px] border-orange-600 rounded-3xl">
                            <h3>Data: {{ date('d/m/Y H:i:s', strtotime($registro->data_orientacao)) }}</h3>
                            <p>Assunto: {{ $registro->assunto }}</p>
                            <p>Próxima orientação: {{ $registro->prox_assunto }}</p>
                            <p>Observações: {{ $registro->observacao }}</p>
                            <p>Aluno Presente? {{ $registro->presenca == 1 ? 'Sim' : 'Não' }}</p>
                        </div>
                    @endif
                @break

                @default
                    <div class="bg-orange-100 my-4 px-8 py-4 border-solid border-[5px] border-orange-600 rounded-3xl">
                        <h3>Data: {{ date('d/m/Y  H:i:s', strtotime($registro->data_orientacao)) }}</h3>
                        <p>Assunto: {{ $registro->assunto }}</p>
                        <p>Próxima orientação: {{ $registro->prox_assunto }}</p>
                        <p>Observações: {{ $registro->observacao }}</p>
                        <p>Aluno Presente? {{ $registro->presenca == 1 ? 'Sim' : 'Não' }}</p>
                    </div>
            @endswitch
            {{-- <div class="bg-orange-100 my-4 px-8 py-4 border-solid border-[5px] border-orange-600 rounded-3xl">
                <h3>Data: {{ date('d/m/Y', strtotime($registro->data_orientacao)) }}</h3>
                <p>Assunto: {{ $registro->assunto }}</p>
                <p>Próxima orientação: {{ $registro->prox_assunto }}</p>
                <p>Observações: {{ $registro->observacao }}</p>
                <p>Aluno Presente? {{ $registro->presenca == 1 ? 'Sim' : 'Não' }}</p>
            </div> --}}
        @endforeach
    </div>
@endsection

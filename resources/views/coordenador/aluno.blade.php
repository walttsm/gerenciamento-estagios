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
                    <a href="{{ route('rpodpage.download', $rpod->id) }}" class="mt-4">
                        <button type="button" class="flex default-button rounded text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 icon icon-tabler icon-tabler-file-download"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M12 17v-6"></path>
                                <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                            </svg>
                            Baixar RPOD
                        </button>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mx-8 mt-8">
        <h2>Orientações</h2>
        @foreach ($aluno->registros as $registro)
            <div class="bg-orange-100 my-4 px-8 py-4 border-solid border-[5px] border-orange-600 rounded-3xl">
                <h3>Registro</h3>
                <p>Data: {{ $registro->data_orientacao }}</p>
                <p>Assunto: {{ $registro->assunto }}</p>
                <p>Próxima orientação: {{ $registro->prox_assunto }}</p>
                <p>Observações: {{ $registro->observacao }}</p>
                <p>Aluno Presente? {{ $registro->presenca == 1 ? 'Sim' : 'Não' }}</p>
            </div>
        @endforeach
    </div>
@endsection

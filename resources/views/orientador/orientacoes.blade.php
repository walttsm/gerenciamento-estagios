@extends('layouts.common')

@section('content')
    <h1 class="mx-8 my-4">Orientações</h1>
    <hr>

    <div class="mx-auto flex flex-col item-center justify-center">
        <h2 class="mx-auto my-4">Horários:</h2>

        <div class="mx-auto grid grid-cols-3 gap-x-24 font-bold">
            <p>Dia</p>
            <p>Horário</p>
            <p>Aluno</p>
        </div>

        <div id="{{ 'horarios' . $orientador['id'] }}" class="mx-auto mb-8">
            @if (count($orientador->horarios_orientacao))
                @foreach ($orientador->horarios_orientacao as $horario)
                    <div class="mx-auto my-4 flex justify-evenly">
                        {!! Form::select(
                            'dia[]',
                            ['2' => 'segunda', '3' => 'terça', '4' => 'quarta', '5' => 'quinta', '6' => 'sexta', '7' => 'sabado'],
                            $horario->dia,
                            [
                                'placeholder' => 'Dia da semana',
                                'form' => 'formHorariosEdit' . $orientador['id'],
                                'class' => 'mx-4',
                                'required',
                                'disabled',
                            ],
                        ) !!}
                        {!! Form::time('hora[]', $horario->hora, [
                            'placeholder' => 'Hora',
                            'form' => 'formHorariosEdit' . $orientador['id'],
                            'class' => 'mx-4',
                            'required',
                            'disabled',
                        ]) !!}

                        {!! Form::text('aluno', $horario->aluno->nome_aluno, [
                            'id' => 'nome' . $horario->id,
                            'required',
                        ]) !!}
                    </div>
                @endforeach
            @endif
        </div>

        <x-calendario :horarios="$orientador->horarios_orientacao" />
    @endsection

@extends('layouts.common')

@section('content')

    <h1 class="h1 my-8">Orientador: {{ $orientador->nome }}</h1>

    @include('layouts.messages')

    <div class="mx-auto flex flex-col item-center justify-center">
        <h2 class="mx-auto">Horários:</h2>

        <div class="mx-auto grid grid-cols-3 gap-x-3">
            <p>Dia</p>
            <p>Horário</p>
            <p>Aluno</p>
        </div>

        <form id="{{ 'formHorariosEdit' . $orientador['id'] }}" action="{{ route('orientacoes.store') }}" method="POST"
            class="mx-auto">
            @csrf
            @method('POST')

            {!! Form::hidden('orientador_id', $orientador->id, []) !!}

            <div id="{{ 'horarios' . $orientador['id'] }}">
                @if (count($orientador->horarios_orientacao))
                    @foreach ($orientador->horarios_orientacao as $horario)
                        {{-- {{ dd($alunos) }} --}}
                        <div class="mx-auto my-4 flex justify-evenly">
                            {!! Form::hidden('id[]', $horario->id, ['form' => 'formHorariosEdit' . $orientador['id'], 'class' => 'mx-4']) !!}
                            {!! Form::select(
                                'dia[]',
                                ['2' => 'segunda', '3' => 'terça', '4' => 'quarta', '5' => 'quinta', '6' => 'sexta', '7' => 'sabado'],
                                $horario->dia,
                                ['placeholder' => 'Dia da semana', 'form' => 'formHorariosEdit' . $orientador['id'], 'class' => 'mx-4'],
                            ) !!}
                            {!! Form::time('hora[]', $horario->hora, [
                                'placeholder' => 'Hora',
                                'form' => 'formHorariosEdit' . $orientador['id'],
                                'class' => 'mx-4',
                            ]) !!}
                            {!! Form::select(
                                'aluno[]',
                                array_combine($alunos, $alunos),
                                $horario->aluno ? $horario->aluno->nome_aluno : '',
                                [
                                    'id' => 'nome' . $horario->id,
                                ],
                            ) !!}
                            <button id="deletarHorario" type="button" title="Deletar Horário" class="align-middle w-6 mx-4"
                                onclick=" /*document.getElementById('#{{ 'deleteInput' . $horario->id }}').value = 'true';*/ removeTime(this.parentNode);">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-trash text-red-500 hover:brightness-125"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>

            <div id="buttons" class="my-8 flex justify-center">
                <button class="default-button add_button flex" type="button"
                    onclick="newTime('#{{ 'horarios' . $orientador->id }}')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span class="ml-1">
                        Adicionar horário
                    </span>
                </button>
                <button type="submit" class="default-button mx-4 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                        <circle cx="12" cy="14" r="2"></circle>
                        <polyline points="14 4 14 8 8 8 8 4"></polyline>
                    </svg>
                    <span class="ml-2">
                        Salvar
                    </span>
                </button>
            </div>

        </form>

        <h2 class="mx-auto">Orientações semanais:</h2>

        <x-calendario :horarios="$orientador->horarios_orientacao" />
    </div>

    <div class="align-middle mx-12 my-8 text-2xl font-bold">
        <h2>Registros de orientação</h2>
    </div>

    <div class="mx-12">
        @foreach ($orientador->alunos as $aluno)
            <h3>Aluno: {{ $aluno->nome_aluno }}</h3>
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
        @endforeach
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function newTime(id) {
            $(id).append(`
            <div class="mx-auto my-4 flex justify-evenly">
                {!! Form::hidden('id[]', null, ['form' => 'formHorariosEdit' . $orientador['id'], 'class' => 'mx-4']) !!}
                {!! Form::select(
                    'dia[]',
                    ['2' => 'segunda', '3' => 'terça', '4' => 'quarta', '5' => 'quinta', '6' => 'sexta', '7' => 'sabado'],
                    null,
                    ['placeholder' => 'Dia da semana', 'form' => 'formHorariosEdit' . $orientador['id'], 'class' => 'mx-4'],
                ) !!}
                {!! Form::time('hora[]', null, [
                    'placeholder' => 'Hora',
                    'form' => 'formHorariosEdit' . $orientador['id'],
                    'class' => 'mx-4',
                ]) !!}
                {!! Form::select('aluno[]', array_combine($alunos, $alunos), null, []) !!}

                <button onclick="removeTime(this.parentNode)" class="align-middle w-6 mx-4">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-trash text-red-500 hover:brightness-125" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="4" y1="7" x2="20" y2="7"></line>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                    </svg>
                </button>
            </div>
        `);
        }

        function removeTime(element) {
            $(element).remove();
        }

        function setForDelete(id) {
            var e = document.getElementById(id);
            e.value = 'true';
        }

        function hideMessage(id) {
            $('#message' + id).addClass('hidden');
        }
    </script>
@endpush

<div class="modal hidden" id={{ 'containerHorariosEdit' . $orientador->id }}>

    <h1 class="my-8">Editar Orientações</h1>
    <p class="h4 my-4">Orientador: {{ $orientador->nome }}</p>

    <div class="grid grid-cols-3 gap-x-3">
        <label for="dia[]">Dia</label>
        <label for="hora[]" class="col-span-2">Horário</label>
    </div>

    <form id="{{ 'formHorariosEdit' . $orientador['id'] }}" action="{{ route('orientacoes.store') }}" method="POST">
        @csrf
        @method('POST')

        {!! Form::hidden('orientador_id', $orientador->id, []) !!}

        <div id="{{ 'horarios' . $orientador['id'] }}" class="field_wrapper">
            @if (count($orientador->horarios_orientacao))
                @foreach ($orientador->horarios_orientacao as $horario)
                    <div class="my-4 grid grid-cols-3 gap-x-4">
                        {!! Form::hidden('id[]', $horario->id, ['form' => 'formHorariosEdit' . $orientador['id']]) !!}
                        {!! Form::select('dia[]', ['2' => 'segunda', '3' => 'terça', '4' => 'quarta', '5' => 'quinta', '6' => 'sexta', '7' => 'sabado'], $horario->dia, ['placeholder' => 'Dia da semana', 'form' => 'formHorariosEdit' . $orientador['id']]) !!}
                        {!! Form::time('hora[]', $horario->hora, ['placeholder' => 'Hora', 'form' => 'formHorariosEdit' . $orientador['id']]) !!}

                        <button id="deletarHorario" type="button" title="Deletar Horário" class="align-middle"
                            onclick="removeTime(this.parentNode)">
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



        <div id="buttons" class="my-8 flex justify-end">
            <button class="default-button add_button" type="button"
                onclick="newTime('#{{ 'horarios' . $orientador->id }}')">
                Adicionar horário
            </button>
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>

    </form>

</div>

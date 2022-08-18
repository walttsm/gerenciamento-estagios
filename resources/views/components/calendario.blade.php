<div class="grid grid-cols-6 gap-x-4">

    <div id="segunda" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Segunda</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="2-{{ $i }}h">

            </div>
        @endfor
    </div>
    <div id="terca" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Terça</h3>

        @for ($i = 8; $i <= 23; $i++)
            <div id="3-{{ $i }}h">

            </div>
        @endfor
    </div>
    <div id="quarta" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Quarta</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="4-{{ $i }}h">

            </div>
        @endfor
    </div>
    <div id="quinta" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Quinta</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="5-{{ $i }}h">

            </div>
        @endfor
    </div>
    <div id="sexta" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Sexta</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="6-{{ $i }}h">

            </div>
        @endfor
    </div>
    <div id="sabado" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Sábado</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="7-{{ $i }}h">

            </div>
        @endfor
    </div>

    @foreach ($horarios as $horario)
        <script>
            $('#' + '{{ $horario->dia . '-' . date_format(new DateTime($horario->hora), 'H') . 'h' }}').append(`
                <div
                    class="orientacao-card">
                    <a href="{{ route('alunos.show', $horario->aluno_id) }}" class="hover:underline hover:cursor-pointer">
                        <p>{{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . ($horario->aluno ? $horario->aluno->nome_aluno : 'reservado') }}</p>
                    </a>
                </div>
                `);
        </script>
    @endforeach

</div>

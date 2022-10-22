<div class="grid grid-cols-6 gap-x-4">

    <div id="segunda" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Segunda</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="2-{{ $i }}h">

            </div>
        @endfor
        {{-- @foreach ($horarios as $horario)
            @if ($horario->dia == 2)
                <div
                    class="orientacao-card bg-orange-400 rounded-md row-[{{ date_format(new DateTime($horario->hora), 'H') - 6 }}]">
                    <p>{{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . $horario->aluno->nome_aluno }}
                    </p>
                </div>
            @endif
        @endforeach --}}
    </div>
    <div id="terca" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Terça</h3>

        @for ($i = 8; $i <= 23; $i++)
            <div id="3-{{ $i }}h">

            </div>
        @endfor
        {{-- @foreach ($horarios as $horario)
            @if ($horario->dia == 3)
                <div
                    class="orientacao-card bg-orange-400 rounded-md row-[{{ date_format(new DateTime($horario->hora), 'H') - 6 }}]">
                    <p>{{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . $horario->aluno->nome_aluno }}
                    </p>
                </div>
            @endif
        @endforeach --}}
    </div>
    <div id="quarta" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Quarta</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="4-{{ $i }}h">

            </div>
        @endfor
        {{-- @foreach ($horarios as $horario)
            @if ($horario->dia == 4)
                <div
                    class="orientacao-card bg-orange-400 rounded-md row-[{{ date_format(new DateTime($horario->hora), 'H') - 6 }}]">
                    <p>{{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . $horario->aluno->nome_aluno }}
                    </p>
                </div>
            @endif
        @endforeach --}}
    </div>
    <div id="quinta" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Quinta</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="5-{{ $i }}h">

            </div>
        @endfor
        {{-- @foreach ($horarios as $horario)
            @if ($horario->dia == 5)
                <div
                    class="orientacao-card bg-orange-400 rounded-md row-[{{ date_format(new DateTime($horario->hora), 'H') - 6 }}]">
                    <p>{{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . $horario->aluno->nome_aluno }}
                    </p>
                </div>
            @endif
        @endforeach --}}
    </div>
    <div id="sexta" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Sexta</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="6-{{ $i }}h">

            </div>
        @endfor
        {{-- @foreach ($horarios as $horario)
            @if ($horario->dia == 6)
                <div
                    class="orientacao-card bg-orange-400 rounded-md row-[{{ date_format(new DateTime($horario->hora), 'H') - 6 }}]">
                    <p>{{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . $horario->aluno->nome_aluno }}
                    </p>
                </div>
            @endif
        @endforeach --}}
    </div>
    <div id="sabado" class="border rounded-md shadow-md p-4 ">
        <h3 class="text-center">Sábado</h3>
        @for ($i = 8; $i <= 23; $i++)
            <div id="7-{{ $i }}h">

            </div>
        @endfor
        {{-- @foreach ($horarios as $horario)
            @if ($horario->dia == 7)
                <div
                    class="orientacao-card bg-orange-400 rounded-md p-4 row-[{{ date_format(new DateTime($horario->hora), 'H') - 6 }}]">
                    <p>{{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . $horario->aluno->nome_aluno }}
                    </p>
                </div>
            @endif
        @endforeach --}}
    </div>

    @foreach ($horarios as $horario)
        <script>
            $('#' + '{{ $horario->dia . '-' . date_format(new DateTime($horario->hora), 'H') . 'h' }}').append(`
                <div
                    class="orientacao-card">
                    <p>{{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . ($horario->aluno ? $horario->aluno->nome_aluno : 'reservado') }}
                    </p>
                </div>
                `);
        </script>
    @endforeach

</div>

@push('scripts')
    <script type="text/javascript">
        function insertTime(id) {

        }
    </script>
@endpush

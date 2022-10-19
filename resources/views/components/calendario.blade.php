<div class="grid grid-cols-6 gap-x-4">

    @for ($dia = 2; $dia <= 7; $dia++)
        <div class="border rounded-md shadow-md p-4 ">
            <h3 class="text-center">
                @switch($dia)
                    @case(2)
                        Segunda
                    @break

                    @case(3)
                        Terça
                    @break

                    @case(4)
                        Quarta
                    @break

                    @case(5)
                        Quinta
                    @break

                    @case(6)
                        Sexta
                    @break

                    @case(7)
                        Sábado
                    @break
                @endswitch
            </h3>
            @foreach ($horarios as $horario)
                @if ($horario->dia == $dia)
                    <a class="" href="{{ route('alunos.show', $horario->aluno->id) }}">
                        <div
                            class="orientacao-card bg-orange-400 rounded-md p-4 row-[{{ date_format(new DateTime($horario->hora), 'H') - 6 }}] hover:underline hover:cursor-pointer hover:text-black transition-colors">
                            <p>
                                Aluno:
                                {{ date_format(new DateTime($horario->hora), 'H:i') . ' - ' . $horario->aluno->nome_aluno }}
                            </p>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    @endfor

</div>

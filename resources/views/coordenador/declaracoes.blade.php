@extends('layouts.common')

@section('content')
    <h1 class="mx-8 my-12 text-3xl font-bold">Gerar declarações</h1>

    <hr>

    <div class="p-4 align-middle flex justify-between w-full">
        <form action="{{ route('declaracoes') }}" method="GET">
            <span id="filters">
                <input type="text" placeholder="Nome" name="filtro_nome" class="bg-white max-w-2xl h-10 mx-8 my-auto"
                    value="{{ $filtro_nome ? $filtro_nome : '' }}">
                {!! Form::select('filtro_turma', array_combine($turmas, $turmas), $filtro_turma, ['class' => '']) !!}
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
            </span>
        </form>
        <div class="flex items-center">
            <div class="text-middle">
                {!! Form::label('banca1', 'Banca estágio 1', []) !!}
                {!! Form::radio('banca', 1, false, ['class' => '', 'form' => 'selecao_alunos', 'id' => 'banca1']) !!}
                {!! Form::label('banca2', 'Banca estágio 2', ['class' => 'ml-4']) !!}
                {!! Form::radio('banca', 2, false, ['class' => '', 'form' => 'selecao_alunos', 'id' => 'banca2']) !!}
            </div>
            <button type="submit" class=" ml-4 inline-flex gerar default-button float-right font-bold"
                form="selecao_alunos">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <desc>Download more icon variants from https://tabler-icons.io/i/check</desc>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l5 5l10 -10"></path>
                </svg>
                <span class="ml-2">
                    Gerar declarações
                </span>
            </button>
        </div>
    </div>

    <form action="" method="post" id="selecao_alunos">
        @csrf
        <div x-data="selectAllData()">
            <table width=100% class="text-center" center>
                <thead>
                    <th><input @click="toggleAllCheckboxes()" type="checkbox" class="form-checkbox"></th>
                    <th>@sortablelink('nome_aluno', 'Nome')</th>
                    <th>@sortablelink('turma_id', 'Turma')</th>
                    <th>@sortablelink('curso', 'Curso')</th>
                    <th>Atividades</th>
                    <th>Horas</th>
                    <th>@sortablelink('orientador_id', 'Orientador')</th>
                    <th>Banca 1/Banca 2</th>
                    </th>
                </thead>
                <tbody id="table-body">
                    @foreach ($alunos as $aluno)
                        <tr class="odd:bg-orange-200">
                            <td>
                                <input type="checkbox" name="data[]" id="checkbox{{ $aluno['id'] }}"
                                    value="{{ $aluno['id'] }}">
                            </td>
                            <td><a class="hover:underline hover:cursor-pointer hover:text-orange-500 transition-colors"
                                    href="{{ route('alunos.show', $aluno->id) }}"> {{ $aluno->nome_aluno }} </a></td>
                            <td>{{ $aluno->turma->ano }}</td>
                            <td>{{ $aluno->curso }}</td>
                            <td>ok</td>
                            <td>{{ $aluno->rpods->sum('horas_mes') }}/200</td>
                            <td>{{ $aluno->orientador->nome }}</td>
                            <td>
                                <a href="/coordenador/modelo_declaracao/{{ $aluno->id }}/1" class="text-white mx-2">
                                    <button type="button"
                                        class="bg-orange-600 hover:bg-orange-500 transition-all my-1 p-2 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-download" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <desc>Download more icon variants from
                                                https://tabler-icons.io/i/file-download
                                            </desc>
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M12 17v-6"></path>
                                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                                        </svg>
                                    </button>
                                </a>
                                <a href="/coordenador/modelo_declaracao/{{ $aluno->id }}/2" class="text-white mx-2">
                                    <button type="button"
                                        class="bg-orange-600 hover:bg-orange-500 transition-all my-1 p-2 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-download" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <desc>Download more icon variants from
                                                https://tabler-icons.io/i/file-download
                                            </desc>
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M12 17v-6"></path>
                                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                                        </svg>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function selectAllData() {
            return {
                selectall: false,

                toggleAllCheckboxes() {
                    this.selectall = !this.selectall

                    checkboxes = document.querySelectorAll('[id^=checkbox]');
                    [...checkboxes].map((el) => {
                        el.checked = this.selectall;
                    })
                }
            }
        }
    </script>
@endpush

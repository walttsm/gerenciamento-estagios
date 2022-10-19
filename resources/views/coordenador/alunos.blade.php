@extends('layouts.common')

@section('content')
    <div class="align-middle mx-8 my-12 text-3xl font-bold">
        <h1>Alunos</h1>
    </div>
    <hr>

    <x-message-card />

    <div>
        <div class="p-4 align-middle flex w-full justify-between">
            <form action="{{ route('alunos.index') }}" method="GET">
                <span id="filters">
                    <input type="text" placeholder="Nome" name="filtro_nome" value="{{ $filtro_nome ? $filtro_nome : '' }}"
                        class="bg-white max-w-2xl h-10 mx-8 my-auto">
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

            <div class="flex">
                <button type="button" class="default-button mx-4 min-w-fit inline-flex"
                    onclick="openModal('#upload_csv_modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table-import" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M4 13.5v-7.5a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-6m-8 -10h16m-10 -6v11.5m-8 3.5h7m-3 -3l3 3l-3 3">
                        </path>
                    </svg>
                    <span class="ml-2 font-bold">
                        Adicionar via CSV
                    </span>
                </button>
                <button type="button" class="default-button mx-4 min-w-fit inline-flex" onclick="openModal('#turmaModal')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <desc>Download more icon variants from https://tabler-icons.io/i/plus</desc>
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span class="ml-2 font-bold">
                        Nova turma
                    </span>
                </button>
                <button type="button" class="default-button mx-4 min-w-fit inline-flex"
                    onclick="openModal('#createModal')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <desc>Download more icon variants from https://tabler-icons.io/i/plus</desc>
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span class="ml-2 font-bold">
                        Adicionar Alunos
                    </span>
                </button>
            </div>
        </div>

        <x-csv_upload_form />
        <x-add-turma-modal />
        <x-create-aluno-modal :turmas="$turmas" :orientadores="$orientadores" />

        <table class="table-auto text-center w-full">
            <thead>
                <tr>
                    <th>@sortablelink('nome_aluno', 'Nome')</th>
                    <th>@sortablelink('turma.ano', 'Turma')</th>
                    <th>@sortablelink('curso', 'Curso')</th>
                    <th>@sortablelink('orientador_id', 'Orientador')</th>
                    <th>Opções</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($alunos as $aluno)
                    <x-edit-aluno-modal :aluno="$aluno" turma="{{ $aluno->turma->ano }}" :turmas="$turmas"
                        orientador="{{ $aluno->orientador ? $aluno->orientador->nome : '' }}"
                        banca1="{{ $aluno->banca1 ? $aluno->banca1->nome : '' }}"
                        banca2="{{ $aluno->banca2 ? $aluno->banca2->nome : '' }}" :orientadores="$orientadores" />
                    <tr class="odd:bg-orange-200">
                        <td><a class="hover:underline hover:cursor-pointer hover:text-orange-500 transition-colors"
                                href="{{ route('alunos.show', $aluno->id) }}">{{ $aluno->nome_aluno }}</a></td>
                        <td>{{ $aluno->turma->ano }}</td>
                        <td>{{ $aluno->curso }}</td>
                        <td>{{ $aluno->orientador ? $aluno->orientador->nome : '-' }}</td>
                        <td class="flex justify-center items-center">
                            <button id="editarUsuario" type="button"
                                onclick="openModal({{ 'editModal' . $aluno->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-edit text-orange-600 hover:brightness-125"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <desc>Download more icon variants from https://tabler-icons.io/i/edit</desc>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                    </path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                            </button>
                            <form action="{{ route('alunos.destroy', [$aluno->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button id="deletarUsuario" type="submit" class="align-middle">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-trash text-red-500 hover:brightness-125"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function openModal(id) {
            $(id).removeClass('hidden');
        }

        function closeModal(id) {
            $(id).addClass('hidden');
        }

        function hideMessage(id) {
            $('#message' + id).addClass('hidden');
        }
    </script>
@endpush

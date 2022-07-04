@extends('layouts.common')

@section('content')
    <div class="align-middle mx-8 my-12 text-3xl font-bold">
        <h1>Orientadores</h1>

    </div>
    <hr>

    @if ($message = Session::get('message'))
        <div class={{ 'message-' . Session::get('type') }} id="messageSuccess">
            <p>{{ $message }}</p>
            <button type="button" class="self-end" onclick="hideMessage('Success')">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <desc>Download more icon variants from https://tabler-icons.io/i/x</desc>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="message-error" id="messageError">
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="self-middle" onclick="hideMessage('Error')">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <desc>Download more icon variants from https://tabler-icons.io/i/x</desc>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
    @endif


    <div>
        <div class="p-4 align-middle flex w-full justify-between">
            <form action="{{ route('orientadores.index') }}" method="GET">
                <span id="filters">
                    <input type="text" placeholder="Nome" name="filtro_nome"
                        class="bg-white max-w-2xl h-10 mx-8 my-auto">
                    <button type="submit" class="default-button rounded-full w-fit p-2 text-white align-middle">
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

            <div>
                <button type="button" class="default-button openModal mx-4 min-w-fit inline-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <desc>Download more icon variants from https://tabler-icons.io/i/plus</desc>
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span class="ml-2 font-bold">
                        Novo orientador
                    </span>
                </button>
            </div>
        </div>

        <x-add-orientador-modal />
        {{-- <x-create-orientador-modal :orientadores="$orientadores" /> --}}

        <table class="table-auto text-center w-full">
            <thead>
                <tr>
                    <th>@sortablelink('nome', 'Nome')</th>
                    <th>@sortablelink('email', 'Email')</th>
                    <th>@sortablelink('curso', 'Curso')</th>
                    <th>Opções</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orientadores as $orientador)
                    <x-edit-orientador-modal :orientador="$orientador" />
                    <tr class="odd:bg-orange-200">
                        <td>{{ $orientador->nome }}</td>
                        <td>{{ $orientador->email }}</td>
                        <td>{{ $orientador->curso }}</td>
                        <td class="flex justify-center">
                            <button id="editarUsuario" type="button" onclick="openModal({{ $orientador->id }})">
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
                            <div>
                                <form action="{{ route('orientadores.destroy', [$orientador->id]) }}" method="POST">
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
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.openModal').on('click', function(e) {
                $('#addModal').removeClass('hidden');
                $('.modal-container').removeClass('hidden')
            });
            $('.closeAddModal').on('click', function(e) {
                $('#addModal').addClass('hidden');
            });
        });
    </script>
    <script type="text/javascript">
        function openModal(id) {
            $('#editModal' + id).removeClass('hidden');
        }

        function closeModal(id) {
            $('#editModal' + id).addClass('hidden');
        }

        function hideMessage(id) {
            $('#message' + id).addClass('hidden');
        }

        function newTime(id) {
            $('#containerHorarios' + id).append(`
                <div class="my-4 grid grid-cols-3 gap-x-4">
                    <select name="diaDisponivel">
                        <option value="segunda">Segunda</option>
                        <option value="terca">Terça</option>
                        <option value="quarta">Quarta</option>
                        <option value="quinta">Quinta</option>
                        <option value="sexta">Sexta</option>
                        <option value="sabado">Sábado</option>
                    </select>

                    <input type="time" name="horaDisponível">
                    <button onclick="removeTime(this.parentNode)">
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
    </script>
@endpush

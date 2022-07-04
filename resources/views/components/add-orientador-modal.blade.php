<div class="modal hidden fixed z-10 inset-0 overflow-y-auto w-8/12 h-fit mx-auto my-auto px-16" id="addModal">

    <h1 class="my-8">Novo orientador</h1>

    <form id="createForm" action="{{ route('orientadores.store') }}" method="POST">
        @csrf
        <div class="my-8 grid grid-cols-2">
            <div class="mx-auto">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="inputNomeOrientador">
            </div>
            <div class="mx-auto">
                <label for="curso">Curso</label>
                <input type="text" name="curso" id="inputCurso">
            </div>
        </div>
        <div class="my-8 grid grid-cols-2">
            <div class="mx-auto">
                <label for="email">Email</label>
                <input type="email" name="email" id="inputEmail">
            </div>
            <div class="mx-auto">
                <button class="default-button mx-auto" onclick="newTime('Add')" type="button">
                    Adicionar horário
                </button>
            </div>
        </div>

        <p class="font-bold text-lg text-slate-500">Horários disponíveis:</p>
        <div class="grid grid-cols-3 gap-x-3">
            <p>Dia</p>
            <p class="col-span-2">Horário</p>
        </div>

        <div id="containerHorariosAdd">
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
                <button id="deletarUsuario" type="button" onclick="removeTime(this.parentNode)">
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

        </div>

        <div id="buttons" class="my-8 flex justify-end">
            <button type="button" class="cancel-button closeAddModal mx-4" onclick="">Descartar</button>
            {{-- <button type="reset"  class="default-button mx-4">Salvar/add outro</button> --}}
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>
    </form>
</div>
</div>

@push('scripts')
@endpush

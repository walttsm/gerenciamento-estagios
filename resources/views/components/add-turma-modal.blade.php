<div>
    <div class=" bg-modal-purple hidden fixed z-10 inset-0 overflow-y-auto w-8/12 h-fit mx-auto my-auto px-16"
        id="turmaModal">

        <h1 class="my-8">Editar aluno</h1>

        <form action="{{ route('turma.store') }}" method="POST">
            @csrf

            <div id="inputs" class="flex justify-around">

                <div>
                    <label for="ano">Ano</label>
                    <input type="number" min="2000" max="{{ date('Y') }}" value="{{ date('Y') }}" name="ano"
                        id="ano">
                </div>

                <div>
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo">
                </div>
            </div>

            <div id="buttons" class="my-8 flex justify-end">
                <button type="button" class="cancel-button mx-4 closeTurmaModal">Descartar</button>
                {{-- <button type="reset"  class="default-button mx-4">Salvar/add outro</button> --}}
                <button type="submit" class="default-button mx-4">Salvar</button>
            </div>

        </form>

    </div>



</div>

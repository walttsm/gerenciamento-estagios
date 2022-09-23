    <div class="modal hidden" id="turmaModal">

        <h1 class="my-8">Editar aluno</h1>

        <form id="createTurmaForm" action="{{ route('turma.store') }}" method="POST">
            @csrf

            <div id="inputs" class="flex justify-around md:flex-col">

                <div>
                    <label for="ano">Ano</label>
                    <br>
                    <input required type="number" min="2000" max="{{ date('Y') }}" value="{{ date('Y') }}"
                        name="ano" id="ano">
                </div>

                <div>
                    <label for="codigo">Código</label>
                    <br>
                    <input required type="text" name="codigo" id="codigo">
                </div>
            </div>

            <div id="buttons" class="my-8 flex justify-end md:justify-center">
                <button type="button" class="cancel-button mx-4"
                    onclick="document.getElementById('createTurmaForm').reset(); closeModal('#turmaModal')">Descartar</button>
                <button type="submit" class="default-button mx-4">Salvar</button>
            </div>
        </form>

    </div>

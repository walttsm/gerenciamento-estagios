<div class="modal hidden fixed z-10 inset-0 overflow-y-auto w-8/12 h-fit mx-auto my-auto px-16" id="addModal">

    <h1 class="my-8">Novo orientador</h1>

    <form id="createForm" action="{{ route('orientadores.store') }}" method="POST">
        @csrf
        <div class="my-8 grid grid-cols-3 md:grid-cols-1">
            <div>
                <label for="nome">Nome</label>
                <br>
                <input required type="text" name="nome" id="inputNomeOrientador">
            </div>
            <div>
                <label for="curso">Curso</label>
                <br>
                <input required type="text" name="curso" id="inputCurso">
            </div>
            <div>
                <label for="email">Email</label>
                <br>
                <input required type="email" name="email" id="inputEmail">
            </div>
        </div>

        <div id="buttons" class="my-8 flex justify-end md:justify-center">
            <button type="button" class="cancel-button mx-4"
                onclick="document.getElementById('createForm').reset(); closeModal('#addModal')">Descartar</button>
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>
    </form>
</div>

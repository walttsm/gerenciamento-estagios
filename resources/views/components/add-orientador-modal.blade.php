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
        </div>

        <div id="buttons" class="my-8 flex justify-end">
            <button type="button" class="cancel-button closeAddModal mx-4" onclick="">Descartar</button>
            {{-- <button type="reset"  class="default-button mx-4">Salvar/add outro</button> --}}
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>
    </form>
</div>

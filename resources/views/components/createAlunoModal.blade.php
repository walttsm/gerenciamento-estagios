<div class=" bg-modal-purple fixed z-10 inset-0 overflow-y-auto w-8/12 h-fit mx-auto my-auto px-16" id="interestModal">

    <h1 class="my-8">Adicionar aluno</h1>

    <form action="{{ route('alunos.store') }}" method="POST">
        @csrf
        <div class="my-8 flex justify-between">
            <div>
                <label for="nome_aluno">Nome</label>
                <input type="text" name="nome_aluno" id="nome_aluno">
            </div>
            <div>
                <label for="turma">Turma</label>
                <input type="number" min="2000" max="{{ date('Y') }}" value="{{ date('Y') }}" name="turma" id="turma">
            </div>
            <div>
                <label for="Curso">Curso</label>
                <input type="text" name="curso" id="curso">
            </div>
        </div>
        <div class="my-8 flex justify-between">
            <div>
                <label for="orientador">Orientador</label>
                {{-- <input type="text" name="orientador" id="orientador"> --}}
                {!! Form::select("orientador", $orientadores, null, ['class'     => 'form-control']) !!}

            </div>
            <div>
                <label for="titulo">Título do trabalho</label>
                <input type="text" name="titulo" id="titulo">
            </div>
        </div>
        <div class="my-8 flex justify-between">
            <div class="w-2/5">
                <label for="banca1">Banca 1</label>
                <input type="text" name="banca1" id="banca1">
            </div>
            <div class="w-3/5 justify-items-stretch ">
                <label for="banca2">Banca 2</label>
                <input type="text" name="banca2" id="banca2">
            </div>
        </div>

        <div id="buttons" class="my-8 flex justify-end">
            <button type="button" class="cancel-button closeModal mx-4">Descartar</button>
            <button type="reset"  class="default-button mx-4">Salvar/add outro</button>
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>
    </form>

</div>

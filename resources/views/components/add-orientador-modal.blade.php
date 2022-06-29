<div class=" bg-modal-purple hidden fixed z-10 inset-0 overflow-y-auto w-8/12 h-fit mx-auto my-auto px-16"
        id="turmaModal">

        <h1 class="my-8">Novo orientador</h1>

        <form id="createForm" action="{{ route('orientadores.store') }}" method="POST">
            @csrf
            <div class="my-8 flex justify-between">
                <div class="mx-auto">
                    <label for="nome_aluno">Nome</label>
                    <input type="text" name="nome_aluno" id="nome_aluno">
                </div>
            </div>
            <div class="my-8 flex justify-between">
                <div class="mx-auto">
                    <label for="matricula">Matrícula</label>
                    <input type="text" name="matricula" id="input-matricula">
                </div>
            </div>
            <div class="my-8 flex justify-between items-center">
                <div class="mx-auto">
                    {!! Form::label("orientador", "Orientador") !!}
                    {!! Form::select("orientador", array_combine($orientadores, $orientadores), null, ['class'     => 'form-control']) !!}
                </div>
            </div>
            <div class="my-8 flex justify-between">

            </div>

            <div id="buttons" class="my-8 flex justify-end">
                <button type="button" class="cancel-button closeAlunoModal mx-4" onclick="document.getElementById('createForm').reset()">Descartar</button>
                {{-- <button type="reset"  class="default-button mx-4">Salvar/add outro</button> --}}
                <button type="submit" class="default-button mx-4">Salvar</button>
            </div>
        </form>
    </div>



</div>

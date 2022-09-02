<div class="modal hidden" id="createModal">

    <h1 class="my-8">Adicionar aluno</h1>

    <form id="createForm" action="{{ route('alunos.store') }}" method="POST">
        @csrf
        <div class="my-8 flex justify-between">
            <div class="mx-auto">
                <label for="nome_aluno">Nome</label>
                <input type="text" name="nome_aluno" id="nome_aluno" required>
            </div>
            <div class="mx-auto">
                <label for="turma">Turma</label>
                <input type="number" min="2000" max="{{ date('Y') }}" value="{{ date('Y') }}" required
                    name="turma" id="turma">
            </div>
            <div class="mx-auto">
                <label for="Curso">Curso</label>
                <input type="text" name="curso" id="curso" required>
            </div>
        </div>
        <div class="my-8 flex justify-between">
            <div class="mx-auto">
                <label for="matricula">Matrícula</label>
                <input type="text" name="matricula" id="input-matricula" required>
            </div>
            <div class="mx-auto">
                <label for="email">Email</label>
                <input type="text" name="email" id="input-email" required>
            </div>
            <div class="mx-auto">
                <label for="titulo">Título do trabalho</label>
                <input type="text" name="titulo" id="titulo">
            </div>
        </div>
        <div class="my-8 flex justify-between items-center">
            <div class="mx-auto">
                {!! Form::label('orientador', 'Orientador') !!}
                {!! Form::select('orientador', array_combine($orientadores, $orientadores), null, ['class' => 'form-control']) !!}
            </div>
            <div class="mx-auto">
                {{-- <label for="banca1">Banca 1</label>
                <input type="text" name="banca1" id="banca1" value="{{ $aluno->banca1->nome }}"> --}}
                {!! Form::label('banca1', 'Banca 1') !!}
                {!! Form::select('banca1', array_combine($orientadores, $orientadores), null, ['class' => 'form-control']) !!}
            </div>
            <div class="mx-auto">
                {{-- <label for="banca2">Banca 2</label>
                <input type="text" name="banca2" id="banca2" value="{{ $aluno->banca2->nome }}"> --}}
                {!! Form::label('banca2', 'Banca 2') !!}
                {!! Form::select('banca2', array_combine($orientadores, $orientadores), null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div id="buttons" class="my-8 flex justify-end">
            <button type="button" class="cancel-button mx-4"
                onclick="document.getElementById('createForm').reset(); closeModal('#createModal')">Descartar</button>
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>
    </form>

</div>

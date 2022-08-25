<div class="modal hidden" id="{{ 'editModal' . $aluno['id'] }}">

    <h1 class="my-8">Editar aluno</h1>

    <form id="{{ 'editForm' . $aluno['id'] }} " action="{{ route('alunos.update', $aluno['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="my-8 flex justify-between">
            <div class="mx-auto">
                <label for="nome_aluno">Nome</label>
                <input type="text" name="nome_aluno" id="nome_aluno" value="{{ $aluno['nome_aluno'] }}">
            </div>
            <div class="mx-auto">
                <label for="turma">Turma</label>
                <input type="number" min="2000" max="{{ date('Y') }}" value="{{ $turma }}"
                    name="turma" id="turma">
            </div>
            <div class="mx-auto">
                <label for="Curso">Curso</label>
                <input type="text" name="curso" id="curso" value="{{ $aluno['curso'] }}">
            </div>
        </div>
        <div class="my-8 flex justify-between">
            <div class="mx-auto">
                <label for="matricula">Matrícula</label>
                <input type="text" name="matricula" id="input-matricula" value="{{ $aluno['matricula'] }}">
            </div>
            <div class="mx-auto">
                <label for="email">Email</label>
                <input type="text" name="email" id="input-email" value="{{ $aluno['email'] }}">
            </div>
            <div class="mx-auto">
                <label for="titulo">Título do trabalho</label>
                <input type="text" name="titulo" id="titulo" value="{{ $aluno['nome_trabalho'] }}">
            </div>
        </div>
        <div class="my-8 flex justify-between items-center">
            <div class="mx-auto">
                {!! Form::label('orientador', 'Orientador') !!}
                {!! Form::select('orientador', array_combine($orientadores, $orientadores), $orientador, [
                    'class' => 'form-control',
                ]) !!}
            </div>
            <div class="mx-auto">
                {{-- <label for="banca1">Banca 1</label>
                    <input type="text" name="banca1" id="banca1" value="{{ $aluno->banca1->nome }}"> --}}
                {!! Form::label('banca1', 'Banca 1') !!}
                {!! Form::select('banca1', array_combine($orientadores, $orientadores), $banca1, ['class' => 'form-control']) !!}
            </div>
            <div class="mx-auto">
                {{-- <label for="banca2">Banca 2</label>
                    <input type="text" name="banca2" id="banca2" value="{{ $aluno->banca2->nome }}"> --}}
                {!! Form::label('banca2', 'Banca 2') !!}
                {!! Form::select('banca2', array_combine($orientadores, $orientadores), $banca2, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="my-8 flex justify-between">

        </div>

        <div id="buttons" class="my-8 flex justify-end">
            <button type="button" class="cancel-button mx-4"
                onclick="closeModal({{ 'editModal' . $aluno['id'] }})">Descartar</button>
            {{-- <button type="reset"  class="default-button mx-4">Salvar/add outro</button> --}}
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>
    </form>

</div>

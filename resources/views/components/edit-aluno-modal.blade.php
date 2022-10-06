<div class="modal hidden" id="{{ 'editModal' . $aluno['id'] }}">

    <h1 class="my-8">Editar aluno</h1>

    <form id="{{ 'editForm' . $aluno['id'] }}" action="{{ route('alunos.update', $aluno['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="my-8 grid grid-cols-3 gap-y-4 justify-start">
            <div>
                <label for="nome_aluno">Nome</label>
                <br>
                <input required type="text" name="nome_aluno" id="nome_aluno" value="{{ $aluno['nome_aluno'] }}">
            </div>
            <div>
                <label for="turma">Turma</label>
                <br>
                <input required type="number" min="2000" max="{{ date('Y') }}" value="{{ $turma }}"
                    name="turma" id="turma">
            </div>
            <div>
                <label for="Curso">Curso</label>
                <br>
                <input required type="text" name="curso" id="curso" value="{{ $aluno['curso'] }}">
            </div>
            <div>
                <label for="matricula">Matrícula</label>
                <br>
                <input required type="text" name="matricula" id="input-matricula" value="{{ $aluno['matricula'] }}">
            </div>
            <div>
                <label for="email">Email</label>
                <br>
                <input required type="text" name="email" id="input-email" value="{{ $aluno['email'] }}">
            </div>
            <div>
                <label for="titulo">Título do trabalho</label>
                <br>
                <input type="text" name="titulo" id="titulo" value="{{ $aluno['nome_trabalho'] }}">
            </div>
            <div>
                {!! Form::label('orientador', 'Orientador') !!}
                <br>
                {!! Form::select('orientador', array_combine($orientadores, $orientadores), $orientador, [
                    'class' => 'form-control',
                ]) !!}
            </div>
            <div>
                {!! Form::label('banca1', 'Banca 1') !!}
                <br>
                {!! Form::select('banca1', array_combine($orientadores, $orientadores), $banca1, ['class' => 'form-control']) !!}
            </div>
            <div>
                {!! Form::label('banca2', 'Banca 2') !!}
                <br>
                {!! Form::select('banca2', array_combine($orientadores, $orientadores), $banca2, ['class' => 'form-control']) !!}
            </div>

            <div id="buttons" class="mt-8 flex col-span-3 justify-end md:justify-center">
                <button type="button" class="cancel-button mx-4"
                    onclick="document.getElementById('{{ 'editForm' . $aluno['id'] }}').reset();
                closeModal({{ 'editModal' . $aluno['id'] }})">Descartar</button>
                <button type="submit" class="default-button mx-4">Salvar</button>
            </div>
        </div>
    </form>

</div>

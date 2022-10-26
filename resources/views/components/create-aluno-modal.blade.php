<div class="modal hidden" id="createModal">

    <h1 class="my-8">Adicionar aluno</h1>

    <form id="createForm" action="{{ route('alunos.store') }}" method="POST">
        @csrf
        <div class="my-8 grid grid-cols-3 gap-y-4 justify-evenly align-middle">
            <div class="">
                <label for="nome_aluno">Nome</label>
                <br>
                <input type="text" name="nome_aluno" id="nome_aluno" required>
            </div>
            <div class="">
                <label for="turma">Turma</label>
                <br>
                <input type="number" min="{{ end($turmas) }}" max="{{ date('Y') }}" value="{{ date('Y') }}"
                    required name="turma" id="turma">
            </div>
            <div class="">
                <label for="Curso">Curso</label>
                <br>
                <input type="text" name="curso" id="curso" required>
            </div>
            <div class="">
                <label for="matricula">Matrícula</label>
                <br>
                <input type="text" name="matricula" id="input-matricula" required>
            </div>
            <div class="">
                <label for="email">Email</label>
                <br>
                <input type="text" name="email" id="input-email" required>
            </div>
            <div class="">
                <label for="titulo">Trabalho</label>
                <br>
                <input type="text" name="titulo" id="titulo">
            </div>
            <div class="items-center">
                {!! Form::label('orientador', 'Orientador') !!}
                <br>
                {!! Form::select('orientador', array_combine($orientadores, $orientadores), null, ['class' => 'form-control']) !!}
            </div>
            <div class="items-center">
                {!! Form::label('banca1', 'Banca 1') !!}
                <br>
                {!! Form::select('banca1', array_combine($orientadores, $orientadores), null, ['class' => 'form-control']) !!}
            </div>
            <div class="items-center">
                {!! Form::label('banca2', 'Banca 2') !!}
                <br>
                {!! Form::select('banca2', array_combine($orientadores, $orientadores), null, ['class' => 'form-control']) !!}
            </div>

            <div id="buttons" class="mt-8 flex col-span-3 justify-end  md:justify-center">
                <button type="button" class="cancel-button mx-4"
                    onclick="document.getElementById('createForm').reset(); closeModal('#createModal')">Descartar</button>
                <button type="submit" class="default-button mx-4">Salvar</button>
            </div>
        </div>
    </form>
</div>

<div class="modal hidden" id="{{ 'editModal' . $orientador['id'] }}">

    <h1 class="my-8">Editar Orientador</h1>

<<<<<<< HEAD
    <form id="{{ 'editForm' . $orientador['id'] }} " action="{{ route('orientadores.update', $orientador['id']) }}"
        method="POST">
        @csrf
        @method('PUT')
        <div class="my-8 grid grid-cols-2">
            <div class="mx-auto">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nomeInput" value="{{ $orientador['nome'] }}">
            </div>
            <div class="mx-auto">
                <label for="curso">Curso</label>
                <input type="text" name="curso" id="cursoInput" value="{{ $orientador['curso'] }}">
            </div>
        </div>
        <div class="my-8 grid grid-cols-2">
            <div class="mx-auto">
                <label for="email">Email</label>
                <input type="email" name="email" id="emailInput" value="{{ $orientador['email'] }}">
            </div>
        </div>

        <div id="buttons" class="my-8 flex justify-end">
            <button type="button" class="cancel-button mx-4"
                onclick="closeModal('{{ '#editModal' . $orientador['id'] }}')">Descartar</button>
            {{-- <button type="reset"  class="default-button mx-4">Salvar/add outro</button> --}}
=======
    <form id="{{ 'editForm' . $orientador['id'] }}" action="{{ route('orientadores.update', $orientador['id']) }}"
        method="POST">
        @csrf
        @method('PUT')
        <div class="my-8 grid gap-4 lg:grid-cols-3 md:grid-cols-1">
            <div>
                <label for="nome">Nome</label>
                <input required type="text" name="nome" id="nomeInput" value="{{ $orientador['nome'] }}">
            </div>
            <div>
                <label for="curso">Curso</label>
                <input required type="text" name="curso" id="cursoInput" value="{{ $orientador['curso'] }}">
            </div>
            <div>
                <label for="email">Email</label>
                <input required type="email" name="email" id="emailInput" value="{{ $orientador['email'] }}">
            </div>
        </div>

        <div id="buttons" class="my-8 flex justify-end md:justify-center">
            <button type="button" class="cancel-button mx-4"
                onclick="document.getElementById('{{ 'editForm' . $orientador['id'] }}').reset(); closeModal('{{ '#editModal' . $orientador['id'] }}')">Descartar</button>
>>>>>>> a5e80c227b249e93c98b64fa60df52e6c7e2f46d
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>
    </form>

</div>

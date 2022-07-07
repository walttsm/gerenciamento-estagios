<div class="modal hidden" id="{{ 'editModal' . $orientador['id'] }}">

    <h1 class="my-8">Editar Orientador</h1>

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

        <p class="font-bold text-lg text-slate-500">Horários disponíveis:</p>
        <div class="grid grid-cols-3 gap-x-3">
            <p>Dia</p>
            <p class="col-span-2">Horário</p>
        </div>

        <div id="buttons" class="my-8 flex justify-end">
            <button type="button" class="cancel-button mx-4"
                onclick="closeModal('{{ '#editModal' . $orientador['id'] }}')">Descartar</button>
            {{-- <button type="reset"  class="default-button mx-4">Salvar/add outro</button> --}}
            <button type="submit" class="default-button mx-4">Salvar</button>
        </div>
    </form>

</div>

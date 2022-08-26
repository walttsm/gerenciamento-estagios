<div class="modal hidden" id="upload_csv_modal">
    <h1 class="my-8">Adicionar alunos via CSV</h1>


    {{-- <form action="{{ Route('alunos_csv') }}" id="csv_form" method="POST"> --}}
    {!! Form::open(['url' => Route('alunos_csv'), 'files' => 'true', 'id' => 'csv_form']) !!}
    @csrf
    @method('post')
    {!! Form::file('arquivo') !!}

    <div class="my-8 flex justify-end">
        <button type="button" class="cancel-button mx-4"
            onclick="document.getElementById('csv_form').reset(); closeModal('#upload_csv_modal')">Descartar</button>
        <button type="submit" class="default-button mx-4">
            Enviar
        </button>
    </div>
    {!! Form::close() !!}
    {{-- </form> --}}
</div>

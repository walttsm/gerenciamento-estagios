<div class="modal hidden" id="upload_csv_modal">
    <h1 class="my-8">Adicionar {{ Route::currentRouteName() == 'alunos.index' ? 'alunos' : 'orientadores' }} via CSV
    </h1>


    {{-- <form action="{{ Route('alunos_csv') }}" id="csv_form" method="POST"> --}}
    {!! Form::open([
        'url' => Route::currentRouteName() == 'alunos.index' ? Route('alunos_csv') : Route('orientadores_csv'),
        'files' => 'true',
        'id' => 'csv_form',
    ]) !!}
    @csrf
    @method('post')
    {!! Form::file('arquivo') !!}

    <div class="my-8 flex justify-end">
        <a href="{{ Storage::url(Route::currentRouteName() == 'alunos.index' ? 'assets/alunos-teste.csv' : 'assets/orientadores-teste.csv') }}"
            target="_blank" class="default-button flex hover:cursor-pointer" download="arquivo.csv">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                <polyline points="7 11 12 16 17 11"></polyline>
                <line x1="12" y1="4" x2="12" y2="16"></line>
            </svg>
            <span class="ml-2">
                Baixar arquivo padrão
            </span>
        </a>
        <button type="button" class="cancel-button mx-4"
            onclick="document.getElementById('csv_form').reset(); closeModal('#upload_csv_modal')">Descartar</button>
        <button type="submit" class="default-button mx-4">
            Enviar
        </button>
    </div>
    {!! Form::close() !!}
    {{-- </form> --}}
</div>

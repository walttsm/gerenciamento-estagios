@extends('layouts.common')

@section('content')
    <div class="align-middle mx-8 mt-12 mb-8 text-3xl font-bold">
        <h1>{{ $orientador->nome }}</h1>
    </div>
    <div class="align-middle mx-12 my-8 text-2xl font-bold">
        <h2>Registros de orientação</h2>
    </div>

    <div class="mx-12">
        @foreach ($registros as $registro)
        <div class="bg-orange-100 my-4 px-8 py-4 border-solid border-[5px] border-orange-600 rounded-3xl">
            <h3>Registro</h3>
            <p>{{ $registro->data_orientacao }}</p>
            <p>{{ $registro->assunto }}</p>
            <p>{{ $registro->prox_assunto }}</p>
            <p>{{ $registro->observacao }}</p>
            <p>{{ $registro->presenca }}</p>
        </div>
        @endforeach
    </div>
@endsection

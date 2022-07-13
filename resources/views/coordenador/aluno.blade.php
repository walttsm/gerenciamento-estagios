@extends('layouts.common')

@section('content')
    <div>
        <h2>RPODS</h2>
        <p>Horas: {{ $aluno->rpods->sum('horas_mes') }}</p>
        @foreach ($aluno->rpods as $rpod)
            <b>RPOD {{$rpod->mes}}</b>
            <p>Total de horas: {{ $rpod->horas_mes }}</p>
            <p>{{ $rpod->rpod_title }}</p>
        @endforeach
    </div>
@endsection

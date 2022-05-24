@extends('layouts.common')


@section('content')

<div>CRIAR RPODS</div>

<div>
    <form action="/rpodpage" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="local_arquivo">Arquivo RPOD: </label>
            <input type="file" id="local_arquivo" name="local_arquivo" class="from-control-file">
        </div>
        <div class="form-group">
            <label for="mes">Mes:   </label> 
            <input type="number" class="form-control" id="mes" name="mes">
        </div>
        <div class="form-group">
            <label for="horas_mes">Horas:   </label> 
            <input type="number" class="form-control" id="horas_mes" name="horas_mes">
        </div>
        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $e)
                <li class="error">{{$e}}</li>
            @endforeach
        </ul>
        @endif
        <input type="submit">
    </form>
</div>
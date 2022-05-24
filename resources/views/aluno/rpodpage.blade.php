@extends('layouts.common')


@section('content')
    <div class="justify-start ml-8 display-flex">
        {{-- <div class="inline-block border-solid border-x-blue-900">
            <a class="text-3xl font-bold m-1" href="" >Atividades</a>
        </div> --}}
        <div>
            <a class="text-3xl font-bold">RPODs</a>
        </div>
    </div>

    <div class="flex justify-end mt-3">
        <h3>{{ $rpod_h }}h</h3>
    </div>

    <hr> 
            
    
        <a href="/rpodpage/adicionar" class="default-button">
            <button>CRIAR RPOD</button>
        </a>
  

    @foreach($rpods as $r)
        <br><br><br>
        <div class="w-8/10 ml-5 border-solid border-blue-300">
            <div class="bg-slate-300 rounded-m ml-5">
                <h3>Entrega do RPOD do mês {{$r['mes']}} - {{$r['horas_mes']}}h</h3>
            </div>
            <div class="flex justify-end mt-3 ">
                <a href="{{ route('rpodpage.download', $r->id) }}">
                    <button class="bg-blue">{{$r['rpod_title']}} +</button>
                </a>
                <a href="{{ route('rpodpage.delete', $r->id) }}">
                    <button class="bg-blue">delete</button>
                </a>
                
            </div>
        </div>
    @endforeach

@endsection
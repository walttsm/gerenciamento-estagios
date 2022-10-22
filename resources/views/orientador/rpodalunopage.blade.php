@extends('layouts.common')

@section('content')

    <div class="grid grid-cols-9 mt-5 mb-5">
        <div class="border-solid border-2 col-span-2 border-y-white border-x-orange-400 text-center">
            <a class="text-3xl font-bold m-1" href="" >RPODs</a>
        </div>
        <div class="col-span-2 text-center">
            <a class="text-3xl font-bold m-1" href="{{route('orientador.atividadePage', $aluno->id)}}" >Atividades</a>
        </div> 
    </div>
    
        <h3 class="text-right">{{ $aluno['nome_aluno'] }}</h3> 
        <br>
    <hr> 

    <br>
       <h3 class="text-right">{{ $rpod_h }}h</h3>
    <br>
    
    @foreach($rpods as $r)
        <br><br>
        <div class="flex justify-center">
             
            <div class="rounded-lg shadow-lg bg-white text-left w-5/6">

                <div class="p-6 pt-0 ">
                    <h3 class="text-gray-900 text-xl leading-tight font-medium mb-2">Entrega do RPOD do mês {{$r['mes']}} - {{$r['horas_mes']}}h</h3>        
                </div>
                
                <div class="pb-3 pr-3 flex justify-end ">
                    <div class="text-gray-700 text-base mr-1.5 inline-block">
                        {{$r['rpod_title']}}
                    </div>  
                    <a href="{{ route('rpodpage.download', $r->id) }}">
                        <button class="inline-block rounded-full bg-orange-600 text-white hover:bg-orange-500 w-7 h-7">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="28" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/download</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                <polyline points="7 11 12 16 17 11"></polyline>
                                <line x1="12" y1="4" x2="12" y2="16"></line>
                             </svg>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    
    

@endsection
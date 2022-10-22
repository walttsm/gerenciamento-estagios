@extends('layouts.common')

@section('content')

    <h1>
        Avisos
    </h1>
    
    <hr> 
            
    <br>
    
    @foreach($avisos as $i => $a)
    <br><br>
    <div class="flex justify-center">    
        <div class="rounded-lg shadow-lg bg-white text-left w-5/6">
            <div class="pr-2 pt-2 flex justify-end">
                
            </div> 
            <br>
            
            <div class="p-6 pt-0 ">
                <span class="text-xs">{{ date('d-m-Y', strtotime($a->updated_at))}} - </span>
                <span class="text-xs">
                    {{$orientador[$i]['nome']}}
                </span>
                <h3 class="text-gray-900 text-xl leading-tight font-medium">{{$a['aviso_titulo']}}</h3>
                <br>
                <h5 class="ml-4 mr-4 whitespace-pre">{{$a['aviso_conteudo']}}</h5>     
            </div>
        
        </div>
    </div>
    @endforeach
    <br><br>

    
    

@endsection
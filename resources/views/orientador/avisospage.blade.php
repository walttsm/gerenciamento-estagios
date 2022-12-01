
@extends('layouts.common')

@section('content')

    <h1>
        Avisos
    </h1>
    
    <hr> 
            
    <br>
    <div class="flex justify-end">
        <a href="{{route('aviso.create')}}" class="default-button">
            <button>+ Avisos</button>
        </a>
    </div>
    
    @foreach($avisos as $i => $a)
    <br><br>
    <div class="flex justify-center">    
        <div class="rounded-lg shadow-lg bg-white text-left w-5/6">
            <div class="pr-2 pt-2 flex justify-end">
                @include('orientador._partials.modalButtonAviso')
                {{-- <a href="{{ route('aviso.delete', $a->id) }}">
                    <button class="bg-orange-600 rounded-sm bg-silverblue text-white w-5 h-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/x</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg>
                    </button>
                </a> --}}
                
            </div> 
            <br>
            
            <div class="p-6 pt-0 ">
                <span class="text-xs">{{ date('d-m-Y', strtotime($a->updated_at))}} - </span>
                <span class="text-xs">
                @foreach($alunos[$i] as $aluno)
                    / {{$aluno['nome_aluno']}}
                @endforeach
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
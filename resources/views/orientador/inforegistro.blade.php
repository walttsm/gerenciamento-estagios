@extends('layouts.common')


@section('content')
    <div class="grid grid-cols-9 mt-5 mb-5">
        <div class="border-solid border-2 col-span-2 border-x-orange-400 border-y-white text-center">
            <a class="text-3xl font-bold m-1" href="{{route('orientador_registrospage')}}">Registro</a>
        </div> 
    </div>
    <br>
    <hr>            
    <br>

    <div class="flex justify-center">
        
        <div class="block p-6 rounded-lg shadow-lg bg-white w-5/6">
            <div class="flex justify-end pt-4 pr-4">
                <div>
                    <h6 class="text-sm">{{$registro['updated_at']}}</h6>
                </div>
            </div>

            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">
                <div class="flex justify-start pr-4">
                    <strong>{{$aluno['nome_aluno']}}</strong>
                    <div>
                        @if($registro['presenca'] == 1)
                            <svg xmlns="http://www.w3.org/2000/svg" class="align-center pl-2 pb-2 icon icon-tabler icon-tabler-check" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        @else   
                        @endif
                    </div>
                </div>
            </h5>
            <h6 class="ml-5">
                {{$aluno['nome_trabalho']}}
                
            </h6>
            <br>
            <hr>
            <br>
            
            <p class="text-gray-700 text-base mb-4">
                <b class="">Data: </b> 
                <br>
                <span class="ml-5">
                    {{$registro['data_orientacao']}}
                </span>
            </p>
            <p class="text-gray-700 text-base mb-4">
                <b class="">Assunto discutido: </b> 
                <br>
                <span class="whitespace-pre">{{$registro['assunto']}}</span>
            </p>
            <p class="text-gray-700 text-base mb-4">
                <b class="">Próxima orientação: </b> 
                <br>
                <span class=" whitespace-pre">{{$registro['prox_assunto']}}</span>
            </p>
            <p class="text-gray-700 text-base mb-4">
                <b class="">Observação: </b> 
                <br>
                <span class="whitespace-pre">{{$registro['observacao']}}</span>
            </p>
            
            
        </div>
    </div>

@endsection
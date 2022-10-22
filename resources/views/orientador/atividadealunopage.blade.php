@extends('layouts.common')


@section('content')
    <div class="grid grid-cols-9 mt-5 mb-5">
        <div class="col-span-2 text-center">
            <a class="text-3xl font-bold m-1" href="{{route('orientador.rpodPages', $aluno->id)}}" >RPODs</a>
        </div>
        <div class="border-solid border-2 col-span-2 border-x-orange-400 border-y-white text-center">
            <a class="text-3xl font-bold m-1" href="" >Atividades</a>
        </div> 
    </div>
    <h3 class="text-right">{{ $aluno['nome_aluno'] }}</h3> 
    <br>
    <hr>            
    <br>

    @foreach ($atv as $i=>$atv)
        
    
    <div class="flex justify-center">
        <div 
            @foreach ($envio as $e)
                @if($e->atividade_id == $atv->id)
                    class="border-2 border-green-400 block p-6 rounded-lg shadow-lg bg-white w-5/6"
                    @break
                @endif
                    class="border-2 border-red-500 block p-6 rounded-lg shadow-lg bg-white w-5/6"     
                @endforeach>

            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">
                {{$atv['nome_atividade']}}
            </h5>

            

            <div class="text-right">
                <a href="{{route('orientador.infoAtividadeAluno', [$atv->id, $aluno->id])}}" class="">
                    <button type="button" class="inline-block px-6 py-2.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-800 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <br><br>
    @endforeach
    <br>
@endsection
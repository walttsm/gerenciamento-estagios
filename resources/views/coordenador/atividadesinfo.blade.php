@extends('layouts.common')


@section('content')
    <div class="grid grid-cols-9 mt-5 mb-5">
        <div class="border-solid border-2 col-span-2 border-x-orange-400 border-y-white text-center">
            <a class="text-3xl font-bold m-1" href="{{route('coordenador_atividades')}}">Atividades</a>
        </div> 
    </div>

    <hr>            
    <br>

    <div class="flex justify-center">
        
        <div class="block p-6 rounded-lg shadow-lg bg-white w-5/6">
            <div class="flex justify-end pt-4 pr-4">
                <div x-data="{ open: false }" class="right-0">
                    <button
                        x-on:click="open = true"
                        class="flex items-center bg-white focus:bg-gray-400 text-gray-700 focus:text-gray-900 font-semibold rounded-full focus:outline-none focus:shadow-inner py-2 px-4"
                        type="button"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="12" cy="19" r="1"></circle>
                            <circle cx="12" cy="5" r="1"></circle>
                        </svg>
                    </button>
                    <ul 
                    x-show="open"
                    x-on:click.away="open = false"
                    class="bg-white text-gray-700 rounded-md shadow-lg absolute py-2 mt-2"
                    style="min-width:15rem"
                    >
                        <li class="flex justify-start">
                            <a href="{{ route('atividades.edit', $atv->id) }}" class="flex p-2 font-medium 
                            text-gray-600 rounded-md
                            hover:bg-gray-100 hover:text-black">
                                <button>
                                    Editar
                                </button>
                            </a>
                        </li>
                        @include('coordenador._partials.modalButtonAtividade')
                        {{-- <li>
                            <a href="{{ route('atividades.delete', $atv->id) }}" class="flex p-2 font-medium 
                            text-gray-600 rounded-md
                            hover:bg-gray-100 hover:text-black">
                            Deletar
                            </a>
                        </li>  --}}
                    </ul>
                </div>
            </div>

            
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">
                {{$atv['nome_atividade']}}
            </h5>
            <hr>
            <br>
            <p class="whitespace-pre text-gray-700 text-base mb-4">{{$atv['descricao']}}</p>
        </div>
        {{-- <div class="">
            <p class="">Entrega Alunos</p>
            @foreach($alunos as $a)
                
            @endforeach
        </div> --}}
        <br><br>
    </div>

@endsection
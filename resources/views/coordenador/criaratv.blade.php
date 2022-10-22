@extends('layouts.common')


@section('content')
    
    <div class="flex justify-start p-5">
    </div>
    <hr> 
    <br>

    <div class="flex justify-center">
        <div class="rounded-lg shadow-lg bg-white text-center max-w-xl">
            <div class="flex justify-end pt-4 pr-4">
                <a href="/coordenador/atividades">
                    <button class="w-5 h-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/x</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg>
                    </button>
                </a>
            </div>
            
            <h3 class="pt-6">
                Atividade
            </h3>
            <form action="{{route('atividades.criarAtividades')}}" method="POST" enctype="multipart/form-data" class="p-9">
                @csrf
                
                <div class="form-group p-3 mb-1">
                    <label for="nome_atividade" class="form-label inline-block mb-2">Nome da atividade:   </label> 
                    <input type="text" class="form-control w-full px-2 py-1 font-normal bg-white border border-solid border-gray-300 rounded m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600" name="nome_atividade">
                </div>
                <div class="form-group p-3 mb-3">
                    <label for="descricao" class="form-label inline-block mb-2"></label> 
                    <textarea type="text" class="form-control w-full px-2 py-1 font-normal bg-white border border-solid border-gray-300 rounded m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600" name="doc_nome"></textarea>
                </div>

                @if ($errors->any())
                <ul>
                    @foreach($errors->all() as $e)
                        <li class="error">{{$e}}</li>
                    @endforeach
                </ul>
                <br>
                @endif
                <input class="default-button" type="submit" class="mr-10">
            
            </form>               
            
        </div>
    </div>

@endsection
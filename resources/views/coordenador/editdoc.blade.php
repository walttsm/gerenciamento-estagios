@extends('layouts.common')

@section('content')

    <div class="flex justify-start p-5"></div>
    <hr> 
    <br>
    <div class="flex justify-center">
        <div class="rounded-lg shadow-lg bg-white text-center max-w-xl">
            <div class="flex justify-end pt-4 pr-4">
                <a href="/coordenador/documentos">
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
                EDITAR DOCUMENTO
            </h3>
            <form action="{{route('documentos.editDoc', $doc->id)}}" method="POST" enctype="multipart/form-data" class="p-9">
                @csrf
                    
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label for="doc_nome" class="form-label inline-block mb-2">Nome do documento:   </label> 
                    <input type="text" 
                        class="form-control w-full px-2 py-1 font-normal bg-white border border-solid border-gray-300 rounded m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600" 
                        name="doc_nome"
                        value="{{$doc['doc_nome']}}" required>
                </div>
                <div class="form-group mb-5">
                    <div class="form-group mb-8">
                    <label class="form-label inline-block mb-2" for="local_arquivo">Arquivo: </label>
                    <br>
                    <input id="local_arquivo" name="local_arquivo" class="block w-80 text-sm rounded-lg border" id="file_input" type="file">
                        
                </div>

                @if ($errors->any())
                <ul>
                    @foreach($errors->all() as $e)
                        <li class="error">{{$e}}</li>
                    @endforeach
                </ul>
                <br>
                @endif
                <input name="form1" class="default-button" type="submit">
            </form>
        </div>
    </div>
    

@endsection
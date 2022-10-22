@extends('layouts.common')


@section('content')
    <div class="grid grid-cols-9 mt-5 mb-5">
        <div class="border-solid border-2 col-span-2 border-x-orange-400 border-y-white text-center">
            <a class="text-3xl font-bold m-1" href="{{route('aluno_atividades')}}" >Atividades</a>
        </div> 
    </div>

    <hr>            
    <br>

    <div class="flex justify-center">
        <div class="block p-6 rounded-lg shadow-lg bg-white w-5/6">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">
                {{$atv['nome_atividade']}}
            </h5>
            <hr>
            
            <br>
            @if($entrega != null)
                <span class="justify-end flex">{{ date('d-m-Y', strtotime($entrega->created_at))}}</span>
            @endif
            <div class="ml-3">
                <p class="whitespace-pre text-gray-700 text-base mb-4">{{$atv['descricao']}}</p>
            </div>
        

            @if($entrega == null)
                <div class="flex justify-end relative">
                    <form action="{{route('atividades.enviarAtividade',  $atv->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="press flex justify-center increment">
                            <div class="mb-3 xl:w-96">
                                <div class="input-group relative flex flex-wrap items-stretch mb-4">
                                    <input name="filenames[]" type="file" class="form-control relative flex-auto min-w-0 block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                    <button class="adicionar btn inline-block px-2 py-2 border-2 border-green-600 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded hover:bg-green-500" type="button" id="button-addon3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="press justify-center clone hidden">
                            <div class="mb-3 xl:w-96 xpress">
                                <div class="input-group relative flex flex-wrap items-stretch mb-4">
                                    <input name="filenames[]" type="file" class="form-control inline-block relative flex-auto min-w-0 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                    <button class="remover btn inline-block px-2 py-2 border-2 border-orange-600 bg-orange-600 text-white font-medium text-xs leading-tight uppercase rounded hover:bg-orange-500" type="button" id="button-addon3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <button type="submit" class="default-button absolute bottom-0 right-0 mt-2">Enviar</button>
                    </form>
                </div>
            
            @else
                <div class="flex justify-end relative">
                    <form action="{{route('atividades.editarEnvioAtividade',  $atv->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <ul class="w-full">
                                @foreach($files as $file)
                                    <li class="selectFile">
                                        <div class="border-2 border-orange-600 rounded-lg p-1 text-left inline">
                                            <input type="text" class="hidden" name="filenamesAnt[]" value={{$file['id']}} readonly>{{$file['arquivo_title']}}
                                        </div>
                                        
                                        <button class="removeFile" class="inline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                       
                                    </li> 
                                    <br>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <div class="press justify-center increment">
                                <div class="mb-3 xl:w-96">
                                    <div class="input-group relative flex flex-wrap items-stretch mb-4">
                                        <input name="filenames[]" type="file" class="form-control relative inline flex-auto min-w-0 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                        <button class="adicionar btn inline px-2 py-2 border-2 border-green-600 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded hover:bg-green-500" type="button" id="button-addon3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                             </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="press justify-center clone hidden">
                                <div class="mb-3 xl:w-96 xpress">
                                    <div class="input-group relative flex flex-wrap items-stretch mb-4">
                                        <input name="filenames[]" type="file" class="form-control relative inline flex-auto min-w-0 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                        <button class="remover btn inline px-2 py-2 border-2 border-orange-600 bg-orange-600 text-white font-medium text-xs leading-tight uppercase rounded hover:bg-orange-500" type="button" id="button-addon3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                             </svg>
                                        </button>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <br><br>
                        <button type="submit" class="default-button absolute bottom-0 right-0 mt-2">Enviar</button>
                    </form>
                </div>
                
            @endif 
        </div>
        {{-- <div class="">
            <p class="">Entrega Alunos</p>
            @foreach($alunos as $a)
                
            @endforeach
        </div> --}}
    </div>
    <script>
        $(document).ready(function (){
            //increment upload
            $('.adicionar').click(function(){
                var htmlData = $('.clone').html();
                $('.increment').after(htmlData);
            });

            //remove input
            $('body').on('click', '.remover', function() {
                $(this).parents('.xpress').remove();
            });

            //remove file - editpage
            $('body').on('click', '.removeFile', function() {
                $(this).parents('.selectFile').remove();
            });
        })
    </script>

@endsection
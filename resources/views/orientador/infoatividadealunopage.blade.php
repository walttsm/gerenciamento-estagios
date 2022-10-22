@extends('layouts.common')


@section('content')
    <div class="grid grid-cols-9 mt-5 mb-5">
        <div class="border-solid border-2 col-span-2 border-x-orange-400 border-y-white text-center">
            <span class="text-3xl font-bold m-1" href="" >Atividades</span>
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
            @if($entrega != null)
                <span class="justify-end flex">{{ date('d-m-Y', strtotime($entrega->created_at))}}</span>
            @endif
            <p class="whitespace-pre text-gray-700 text-base mb-4">{{$atv['descricao']}}</p>
        
            <div class="flex justify-end relative">
                
               @if($entrega != null)
                    <div class="mb-3">
                        <ul class="w-full">
                            @foreach($files as $i => $file)
                                <li class="selectFile">
                                    <div class="border-2 border-orange-600 rounded-lg p-1 text-left inline">
                                        <input type="text" class="hidden" name="filenamesAnt[]" value={{$file['id']}} readonly>{{$file['arquivo_title']}}
                                    </div>
                                    
                                    <a href="{{ route('orientador.downloadFile', $file->id) }}" class="inline">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                            <path d="M12 17v-6"></path>
                                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path>
                                         </svg>
                                    </a>
                                </li>
                                <br>
                            @endforeach
                        </ul>
                    </div>
                
                @endif  
            </div>
            
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
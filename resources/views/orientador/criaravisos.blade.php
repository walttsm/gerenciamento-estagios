@extends('layouts.common')


@section('content')
    
    <div class="flex justify-start p-5">
    </div>
    <hr> 
    <br>

    <div class="flex justify-center">
        <div class="rounded-lg shadow-lg bg-white text-center min-w-[50%] max-w-xl">
            <div class="flex justify-end pt-4 pr-4">
                <a href="/orientador/avisos">
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
                Aviso
            </h3>
            <form action="{{route('aviso.criarAvisos')}}" method="POST" enctype="multipart/form-data" class="p-9">
                @csrf
                
                    <div class="form-group mb-6">
                        <div x-data="{show: true}">
                            <a href="#" x-on:click.prevent="show = !show" class="relative z-10 border border-gray-600 rounded px-4 py-2 bg-white">
                                <span class="inline-block">Alunos</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current inline-block w-4 h-4 transform transition duration-150" x-bind:class="{ 'rotate-180': show }">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>
                            <div x-show.transition="show" class="relative z-20 mt-1 flex w-64 flex-col px-4 py-8 whitespace-nowrap border border-gray-600 rounded bg-white">
                                <div>
                                    <input type="checkbox" id="checkall" class="inline-block mr-2" />Todos
                                </div>
                                @foreach($alunos as $aluno)
                                    <div><input type="checkbox" name="alunos[]" value="{{$aluno->id}}" class="checkitem inline-block mr-2" />{{$aluno->nome_aluno}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-6">
                        <input type="text" class="form-control block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:outline-none" name="aviso_titulo"
                        placeholder="Título">
                    </div>
                    <div class="form-group mb-6">
                        <textarea
                        class="
                        form-control
                        block
                        w-full
                        px-3
                        h-64
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:outline-none"
                        name="aviso_conteudo"
                        rows="3"
                        placeholder="Assunto"
                    ></textarea>
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
    <script>
        $("#checkall").change(function(){
            $(".checkitem").prop("checked", $(this).prop("checked"))
        })
        $(".checkitem").change(function(){
            if($(this).prop("checked") == false){
                $("#checkall").prop("checked", false)
            }
            if($(".checkitem:checked").length == $(".checkitem").length){
                $("#checkall").prop("checked", true)
            }
        })
    </script>
@endsection
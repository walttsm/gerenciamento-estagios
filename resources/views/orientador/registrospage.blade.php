@extends('layouts.common')

@section('content')

    <h1>
        Registros
    </h1>
    
    <hr> 
            
    <br>
    <div class="flex justify-end">
        <a href="{{route('registro.create')}}" class="default-button">
            <button>+ Registro</button>
        </a>
    </div>
    
    @foreach($registros as $i => $r)
    <br><br>
        
        <div class="flex justify-center">
           
                <div
                @if($r['presenca'] == 1)
                    class="border-2 border-green-400 rounded-lg shadow-lg bg-white text-left w-5/6"
                @else
                    class="border-2 border-red-500 rounded-lg shadow-lg bg-white text-left w-5/6"
                @endif>
                    <div class="pr-2 pt-2 flex justify-end">
                        <a href="{{ route('registro.edit', $r->id) }}">
                            <button class="bg-orange-600 rounded-sm bg-silverblue text-white w-5 h-5 mr-3" data-modal-toggle="popup-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <desc>Download more icon variants from https://tabler-icons.io/i/pencil</desc>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                    <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                                </svg>
                            </button>
                        </a>
                        @include('orientador._partials.modalButtonRegistro')
                        {{-- <a href="{{ route('registro.delete', $r->id) }}">
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
                    <a href="{{route('orientador_inforegistro', $r->id)}}" class="">
                        @foreach ($alunos[$i] as $a)
                    
                        <div class="m-2">
                            <p class="p-2">
                                <h5><strong>Aluno: {{ $a['nome_aluno'] }}</strong> </h5>
                                <h5><strong>Estágio:</strong> {{$a['nome_trabalho']}}</h5>
                
                            </p>
                        </div>
                    
                        @endforeach
                    </a>
                    
                    
                </div>
            </a>
        </div>
    @endforeach
    <br><br>

    
    

@endsection
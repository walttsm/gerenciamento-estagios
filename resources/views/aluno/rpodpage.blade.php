@extends('layouts.common')

@section('content')

    <div class="grid grid-cols-9 mt-5 mb-5">
        <div class="border-solid border-2 col-span-2 border-y-white border-x-orange-400 text-center">
            <a class="text-3xl font-bold m-1" href="" >RPODs</a>
        </div>
        <div class="col-span-2 text-center">
            <a class="text-3xl font-bold m-1" href="{{route('aluno_atividades')}}" >Atividades</a>
        </div> 
         
        <div class="col-end-10 text-right">
            <h3 class="">{{ $rpod_h }}h</h3>
        </div>
    </div>
    
    <hr> 
            
    <br>
    <div class="flex justify-end">
        <a href="{{route('rpodpage.create')}}" class="default-button">
            <button>CRIAR RPOD</button>
        </a>
    </div>
    
    @foreach($rpods as $r)
        <br><br>
        <div class="flex justify-center">
             
            <div class="rounded-lg shadow-lg bg-white text-left w-5/6">
                <div class="pr-2 pt-2 flex justify-end">
                    <a href="{{ route('rpodpage.edit', $r->id) }}">
                        <button class="bg-orange-600 rounded-sm bg-silverblue text-white w-5 h-5 mr-3" data-modal-toggle="popup-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/pencil</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                            </svg>
                        </button>
                    </a>
                    @include('aluno._partials.modalButtonRPOD')
                    {{-- <a href="{{ route('rpodpage.delete', $r->id) }}">
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
                

                <div class="p-6 pt-0 ">
                    <h3 class="text-gray-900 text-xl leading-tight font-medium mb-2">Entrega do RPOD do mês {{$r['mes']}} - {{$r['horas_mes']}}h</h3>        
                </div>
                
                <div class="pb-3 pr-3 flex justify-end ">
                    <div class="text-gray-700 text-base mr-1.5 inline-block">
                        {{$r['rpod_title']}}
                    </div>  
                    <a href="{{ route('rpodpage.download', $r->id) }}">
                        <button class="inline-block rounded-full bg-orange-600 text-white hover:bg-orange-500 w-7 h-7">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="28" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/download</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                <polyline points="7 11 12 16 17 11"></polyline>
                                <line x1="12" y1="4" x2="12" y2="16"></line>
                             </svg>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    
    

@endsection
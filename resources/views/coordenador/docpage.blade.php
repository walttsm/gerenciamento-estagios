@extends('layouts.common')

@section('content')
    <div class="grid grid-cols-9 mt-5 mb-5">
        <div class="col-span-2 text-center">
            <a class="text-3xl font-bold m-1" href="" >Documentos</a>
        </div>
    </div>
    <hr>
    <br>

    
    <div class="flex justify-end">
        <a href="{{route('documentos.create')}}" class="default-button">
            <button>
                + Documentos
            </button>
        </a>
    </div>


    @foreach ($documents as $doc)
    <br>
    <div class="flex justify-center">
        <div class="grid grid-cols-10 p-6 rounded-lg shadow-lg bg-white w-5/6 relative">
            <div class="px-3 py-2.5 font-medium text-xs leading-tight uppercase text-orange-600 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                    <path d="M9 17h6"></path>
                    <path d="M9 13h6"></path>
                </svg>
            </div>
            <div class="col-span-8 flex items-center text-gray-900 text-xl font-medium mt-4">
                {{$doc['doc_nome']}}
            </div>

            <div class="top-0 right-1.5 absolute pr-7">
                <a href="{{ route('documentos.edit', $doc->id) }}">
                    <button class="bg-orange-600 rounded-sm bg-silverblue text-white w-5 h-5 mr-3" data-modal-toggle="popup-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/pencil</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                        </svg>
                    </button>
                </a>
                @include('coordenador._partials.modalButtonDocumentos')
                {{-- <a href="{{ route('documentos.delete', $doc->id) }}" class="">
                    <button class="bg-orange-600 rounded-sm bg-silverblue text-white w-5 h-5 mr-3" data-modal-toggle="popup-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/x</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg>
                    </button>
                </a> --}}
            </div>

            <div class="text-right col-end-11 mt-4">
                <a href="{{ route('documentos.download', $doc->id) }}">
                    <button type="button" class="px-6 py-2.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-800 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
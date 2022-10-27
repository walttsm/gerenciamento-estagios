@extends('layouts.common')

@section('content')
    <h1>Orientações</h1>
    <hr>
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
    
                        <table class=" table-bordered min-w-full text-center">
                            <thead class="border-b bg-gray-800 text-m font-medium text-white px-6 py-4 ">
                                <th class="p-5 w-40">Horário</th>
                                @foreach($weekDays as $day)
                                    <th class="p-5 w-40" >{{ $day }}</th>
                                @endforeach
                            </thead>
                            <tbody >
                                @foreach($calendarData as $h => $horario)
                                    <tr class="bg-white border-b p-3">
                                        <td>
                                            {{ $horario }}
                                        </td>
                                        @foreach($weekDays as $i)
                                        <td
                                            
                                            @if(date('H', strtotime($horario)) == date('H', strtotime($hora)) && $dia == $i)
                                                class="bg-orange-300 rounded-md">
                                                   {{date('H:i', strtotime($hora))}}: Prof. {{$nome_orientador}}
                                        
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

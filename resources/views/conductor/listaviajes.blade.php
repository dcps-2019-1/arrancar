@extends('layouts.app')
@section('content')

    <div class="container">
        <h3 class="list-group-item list-group-item-action color text-light">Viajes programados para {{$nombre}} :</h3>
        <br>
        <div class="row">
            <div class="col">
                <table class="table table-light">
                    <thead class="color text-light">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Placa del bus</th>
                        <th scope="col">Origen</th>
                        <th scope="col">Destino</th>


                    </tr>
                    </thead>
                    <tbody>
                    @for ($i = 0; $i <sizeof($viajes); $i++)
                        <tr>
                            <td> {{ $viajes[$i]->fecha }} </td>
                            <td> {{ $viajes[$i]->hora }} </td>
                            <td> {{ $viajes[$i]->bus_placa }} </td>
                            <td> {{ $rutas[$i][0] }} </td>
                            <td> {{ $rutas[$i][1]}} </td>

                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
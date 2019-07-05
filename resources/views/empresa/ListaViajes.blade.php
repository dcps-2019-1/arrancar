@extends('layouts.app')
@section('content')
    
    <div class="container">
        <table class="table table-light">
            <thead class="color text-light">
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Precio</th>
                    <th>Ruta</th>
                    <th>Conductor</th>
                    <th>Bus placa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viajes as $viaje)
                    <tr>
                        <td> {{ $viaje->fecha }} </td>
                        <td> {{ $viaje->hora }} </td>
                        <td> {{ $viaje->precio }} </td>
                        <td> {{ $viaje->ruta->codigo }} </td>
                        <td> {{ $viaje->conductor->cedula }} </td>
                        <td> {{ $viaje->bus_placa }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@extends('layouts.app')
@section('content')

    <div class="container">
        <table class="table table-light">
            <thead class="color text-light">
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Cancelar</th>

            </tr>
            </thead>
            <tbody>
            @if (count($posibles) == 0)

                <div class="container text-center font-weight-bold text-danger">No existen viajes que puedan ser cancelados</div>
                <br>

            @endif
            @foreach ($posibles as $viaje)
                <tr>
                    <td> {{ $viaje[1]->fecha }} </td>
                    <td> {{ $viaje[1]->hora }} </td>
                    <td> {{ $viaje[2]->municipio_origen }} </td>
                    <td> {{ $viaje[2]->municipio_destino }} </td>
                    <td><a class="text-danger font-weight-bold" href="cancelar/{{$viaje[0]->id}}">Cancelar viaje</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
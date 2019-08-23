@extends('layouts.app')
@section('content')

    <div class="container">
        <table class="table table-light">
            <thead class="color text-light">
            <tr>
                <th>Fecha</th>
                <th>Precio unitario</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Puestos comprados</th>

            </tr>
            </thead>
            <tbody>
            @if (count($detalle) == 0)

                <div class="container text-center font-weight-bold text-danger">No existen viajes del usuario</div>
                <br>

            @endif
            @foreach ($detalle as $viaje)
                <tr>
                    <td> {{ $viaje[0]->fecha }} </td>
                    <td> {{ $viaje[0]->precio }} </td>
                    <td> {{ $viaje[1]->municipio_origen }} </td>
                    <td> {{ $viaje[1]->municipio_destino }} </td>
                    <td> {{ $viaje[2]->cantidad_puestos }} </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
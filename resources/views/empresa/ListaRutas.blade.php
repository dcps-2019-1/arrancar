@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-light">
            <thead class="color text-light">
                <tr>
                    <th>Código</th>
                    <th>Municipio salida</th>
                    <th>Departamento salida</th>
                    <th>Municipio destino</th>
                    <th>Departamento destino</th>
                </tr>
            </thead>
            <tbody>
                @if (count($rutas) == 0)
                
                <div class="container text-center font-weight-bold text-danger">No existen rutas registrados</div>
                <br>
                
                @endif
                @foreach ($rutas as $ruta)
                    <tr>
                        <td> {{ $ruta->codigo }} </td>
                        <td> {{ $ruta->municipio_origen }} </td>
                        <td> {{ $ruta->departamento_origen }} </td>
                        <td> {{ $ruta->municipio_destino }} </td>
                        <td> {{ $ruta->departamento_destino }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
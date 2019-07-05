@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-light">
                <thead class="color text-light">
                    <tr>
                        <th scope="col">Placa</th>
                        <th scope="col">Fecha de entrada</th>
                        <th scope="col">Fecha de salida</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($mantenimientos) == 0)
                    
                    <div class="container text-center font-weight-bold text-danger">No existen mantenimientos registrados</div>
                    <br>
                    
                    @endif
                    @foreach ($mantenimientos as $mantenimiento)
                    <tr>
                        <td> {{ $mantenimiento->bus_id }} </td>
                        <td> {{ $mantenimiento->fecha_entrada }} </td>
                        <td> {{ $mantenimiento->fecha_salida }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

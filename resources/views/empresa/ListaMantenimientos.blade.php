@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Placa</th>
                        <th scope="col">Fecha de entrada</th>
                        <th scope="col">Fecha de salida</th>
                    </tr>
                </thead>
                <tbody>
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

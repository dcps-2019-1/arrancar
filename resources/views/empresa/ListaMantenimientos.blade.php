@extends('layouts.app')
@section('content')
    <div class="form-group">
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="form-group">
            <div class="row-">
                <div class="col-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Placa</th>
                            <th scope="col">Fecha de entrada</th>
                            <th scope="col">Fecha de salida</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mantenimientos as $mantenimiento)
                            <tr>
                                <td> {{ $mantenimiento->id }} </td>
                                <td> {{ $mantenimiento->bus_id }} </td>
                                <td> {{ $mantenimiento->fecha_entrada }} </td>
                                <td> {{ $mantenimiento->fecha_salida }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection

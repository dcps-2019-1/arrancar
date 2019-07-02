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
                            <th scope="col">Nombre</th>
                            <th scope="col">Cedula</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($empresa->conductores as $conductor)
                            <tr>
                                <td> {{ $conductor->nombre }} </td>
                                <td> {{ $conductor->cedula }} </td>
                                <td> {{ $conductor->user->username }} </td>
                                <td> {{ $conductor->user->email }} </td>
                                <td> {{ $conductor->user->telefono }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
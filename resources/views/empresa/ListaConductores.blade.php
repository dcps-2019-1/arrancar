@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-light">
                <thead class="color text-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($conductores) == 0)
                    
                    <div class="container text-center font-weight-bold text-danger">No existen conductores registrados</div>
                    <br>
                    
                    @endif
                    @foreach ($conductores as $conductor)
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
</div>
@endsection
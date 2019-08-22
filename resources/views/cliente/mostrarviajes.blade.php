@extends('layouts.app')

@section('content')
<div class="container">
    <form action={{route("comprar")}} method="POST">
    <table class="table table-light">
        <div class="container">
            <h2 class="display-5 texto-inside"> Viajes de ida</h2>
            
        </div>
        <thead class="color text-light">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Precio</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Disponibles</th>
             <th>Seleccionar</th>
        </tr>
        </thead>
        <tbody>
        @if (count($viajeida) == 0)

            <div class="container text-center font-weight-bold text-danger">No existen viajes de ida disponibles</div>
            <br>

        @endif
        @foreach ($viajeida as $ida)
            <tr>
                <td> {{ $ida[0][0]->fecha}} </td>
                <td> {{ $ida[0][0]->hora}} </td>
                <td> {{ $ida[0][0]->precio}} </td>
                <td> {{ $ida[1]->municipio_origen}} </td>
                <td> {{ $ida[1]->municipio_destino}} </td>
                <td> {{ $ida[0][0]->puestos_disponibles}} </td>
                <td> <input type="checkbox" name="ida" value={{$ida[0][0]->id}}></td>
            </tr>
        @endforeach
        </tbody>
    </table>


<br>

    <table class="table table-light">
        <h2 class="display-5 texto-inside"> Viajes de regreso</h2>
        <thead class="color text-light">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Precio</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Disponibles</th>
            <th>Seleccionar</th>
        </tr>
        </thead>
        <tbody>
        @if (count($viajeregreso) == 0)

            <div class="container text-center font-weight-bold text-danger">No existen viajes de regreso disponibles</div>
            <br>

        @endif

        @foreach ($viajeregreso as $ida)
            <tr>
                <td> {{ $ida[0][0]->fecha}} </td>
                <td> {{ $ida[0][0]->hora}} </td>
                <td> {{ $ida[0][0]->precio}} </td>
                <td> {{ $ida[1]->municipio_origen}} </td>
                <td> {{ $ida[1]->municipio_destino}} </td>
                <td> {{ $ida[0][0]->puestos_disponibles}} </td>

                <td> <input type="checkbox" name="regreso" value={{$ida[0][0]->id}}></td>

            </tr>
        @endforeach
        </tbody>
    </table>
        @csrf
    <input type="number" name="cantidad_viajeros" value={{$viajeros}} hidden>
    <br>
    <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Seleccionar viajes</button>

</form>

    </div>
</div>

@endsection
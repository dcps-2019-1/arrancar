@extends('layouts.app')

@section('content')

    <div class="container">
        <form action={{route("login")}} method="get">
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

                </tr>
                </thead>
                <tbody>
                <p hidden> {{$control=count(session("viajeida"))}}</p>

                @if ($control == 0)

                    <div class="container text-center font-weight-bold text-danger">No existen viajes de ida disponibles</div>
                    <br>

                @endif
                @foreach (session("viajeida") as $ida)
                    <tr>
                        <td> {{ $ida[0][0]->fecha}} </td>
                        <td> {{ $ida[0][0]->hora}} </td>
                        <td> {{ $ida[0][0]->precio}} </td>
                        <td> {{ $ida[1]->municipio_origen}} </td>
                        <td> {{ $ida[1]->municipio_destino}} </td>
                        <td> {{ $ida[0][0]->puestos_disponibles}} </td>


                    </tr>
                @endforeach
                @if ($errors->has('ida'))
                    <p class="text-danger">{{ $errors->first('ida') }}</p>
                @endif
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

                </tr>
                </thead>
                <tbody>
                <p hidden>{{$control2=count(session("viajeregreso"))}}</p>
                @if ($control2 == 0)

                    <div class="container text-center font-weight-bold text-danger">No existen viajes de regreso disponibles</div>
                    <br>

                @endif

                @foreach (session("viajeregreso") as $ida)
                    <tr>
                        <td> {{ $ida[0][0]->fecha}} </td>
                        <td> {{ $ida[0][0]->hora}} </td>
                        <td> {{ $ida[0][0]->precio}} </td>
                        <td> {{ $ida[1]->municipio_origen}} </td>
                        <td> {{ $ida[1]->municipio_destino}} </td>
                        <td> {{ $ida[0][0]->puestos_disponibles}} </td>




                    </tr>
                @endforeach
                @if ($errors->has('regreso'))
                    <p class="text-danger">{{ $errors->first('regreso') }}</p>
                @endif
                </tbody>
            </table>
            @csrf

            <br>
            <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Loggearse</button>

        </form>
        <br>

    </div>
    </div>

@endsection
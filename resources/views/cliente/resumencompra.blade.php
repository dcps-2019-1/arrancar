@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>RESUMEN DE SELECCIÓN</h1>
        <form action={{route("comprar_fin")}} method="POST">

                @if($ida!=0 and $regreso!=0)
                <table class="table table-light">

                <thead class="color text-light">
                <tr>
                    <th>Trayecto</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Precio</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Cantidad</th>


                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td> Ida</td>
                        <td> {{ $ida[0]->fecha}} </td>
                        <td> {{ $ida[0]->hora}} </td>
                        <td> {{ $ida[0]->precio}} </td>
                        <td> {{ $ida[1]->municipio_origen}} </td>
                        <td> {{ $ida[1]->municipio_destino}} </td>
                        <td> {{ $puestos}} </td>



                    </tr>
                    <tr>
                        <td> Regreso</td>
                        <td> {{ $regreso[0]->fecha}} </td>
                        <td> {{ $regreso[0]->hora}} </td>
                        <td> {{ $regreso[0]->precio}} </td>
                        <td> {{ $regreso[1]->municipio_origen}} </td>
                        <td> {{ $regreso[1]->municipio_destino}} </td>
                        <td> {{ $puestos}} </td>
                    </tr>
                </tbody>
            </table>
            <span> Precio total: {{($ida[0]->precio + $regreso[0]->precio)*$puestos }}</span>
                <input type="number" name="valor" value={{($ida[0]->precio + $regreso[0]->precio)*$puestos }} hidden>
                <input type="number" name="ida" value={{$ida[0]->id}} hidden>
                @if ($errors->has('ida'))
                    <p class="text-danger">{{ $errors->first('ida') }}</p>
                @endif
                <input type="number" name="regreso" value={{$regreso[0]->id}} hidden>
                @if ($errors->has('regreso'))
                    <p class="text-danger">{{ $errors->first('regreso') }}</p>
                @endif
                @elseif($regreso==0)
                <table class="table table-light">
                    <h2 class="display-5"> Viaje de ida</h2>
                    <thead class="color text-light">
                    <tr>
                        <th>Trayecto</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Precio</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Cantidad</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td> Ida</td>
                        <td> {{ $ida[0]->fecha}} </td>
                        <td> {{ $ida[0]->hora}} </td>
                        <td> {{ $ida[0]->precio}} </td>
                        <td> {{ $ida[1]->municipio_origen}} </td>
                        <td> {{ $ida[1]->municipio_destino}} </td>
                        <td> {{ $puestos}} </td>

                    </tr>
                    </tbody>
                </table>
                <span> Precio total: {{$ida[0]->precio*$puestos}}</span>
                <input type="number" name="ida" value={{$ida[0]->id}} hidden>
                @if ($errors->has('ida'))
                    <p class="text-danger">{{ $errors->first('ida') }}</p>
                @endif
                <input type="number" name="valor" value= {{$ida[0]->precio*$puestos}} hidden>
            @else
                <table class="table table-light">
                    <h2 class="display-5"> Viaje de ida</h2>
                    <thead class="color text-light">
                    <tr>
                        <th>Trayecto</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Precio</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Cantidad</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td> Regreso</td>
                        <td> {{ $regreso[0]->fecha}} </td>
                        <td> {{ $regreso[0]->hora}} </td>
                        <td> {{ $regreso[0]->precio}} </td>
                        <td> {{ $regreso[1]->municipio_origen}} </td>
                        <td> {{ $regreso[1]->municipio_destino}} </td>
                        <td> {{ $puestos}} </td>

                    </tr>
                    </tbody>
                </table>
                <span> Precio total: {{$regreso[0]->precio*$puestos}}</span>
                <input type="number" name="regreso" value={{$regreso[0]->id}} hidden>
                @if ($errors->has('regreso'))
                    <p class="text-danger">{{ $errors->first('regreso') }}</p>
                @endif
                <input type="number" name="valor" value={{$regreso[0]->precio*$puestos}} hidden>
            @endif
                    <input type="number" name="puestos" hidden value={{$puestos}}>
                    @if ($errors->has('puestos'))
                        <p class="text-danger">{{ $errors->first('puestos') }}</p>
                    @endif
                    @csrf




            <br>
                    <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Comprar</button>
        </form>

    </div>
    </div>

@endsection
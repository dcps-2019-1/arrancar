@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="texto-inside">Resumen de selección</h1>
        <form action={{route("comprar_fin")}} method="POST">

                @if(session("ida")!=0 and session("regreso")!=0)

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
                        <td> {{ session("ida")[0]->fecha}} </td>
                        <td> {{ session("ida")[0]->hora}} </td>
                        <td> {{ session("ida")[0]->precio}} </td>
                        <td> {{ session("ida")[1]->municipio_origen}} </td>
                        <td> {{ session("ida")[1]->municipio_destino}} </td>
                        <td> {{ session("viajeros")}} </td>



                    </tr>
                    <tr>
                        <td> Regreso</td>
                        <td> {{ session("regreso")[0]->fecha}} </td>
                        <td> {{ session("regreso")[0]->hora}} </td>
                        <td> {{ session("regreso")[0]->precio}} </td>
                        <td> {{ session("regreso")[1]->municipio_origen}} </td>
                        <td> {{ session("regreso")[1]->municipio_destino}} </td>
                        <td> {{ session("viajeros")}}</td>
                    </tr>
                </tbody>
            </table>
            <p hidden>
            {{$precio1=session("ida")[0]->precio}}
                {{$precio2=session("regreso")[0]->precio}}
            </p>
                <div class="row">
                    <div class="col">
                        
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="col">
                        <span class="font-weight-bold texto-inside"> <h4>Precio total: {{session("viajeros")*($precio1+$precio2) }}</h4></span>
                        
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="col">
                        
                    </div>
                    
                </div>


                @elseif(session("regreso")==0)
                {{request()->session()->forget(['regreso'])}}
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
                        <td> {{ session("ida")[0]->fecha}} </td>
                        <td> {{ session("ida")[0]->hora}} </td>
                        <td> {{ session("ida")[0]->precio}} </td>
                        <td> {{ session("ida")[1]->municipio_origen}} </td>
                        <td> {{ session("ida")[1]->municipio_destino}} </td>
                        <td> {{ session("viajeros")}} </td>

                    </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col">
                        <span class="font-weight-bold texto-inside"> Precio total: {{session("ida")[0]->precio*session("viajeros")}}</span>

                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>

            @else
                {{request()->session()->forget(['ida'])}}
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
                        <td> {{ session("regreso")[0]->fecha}} </td>
                        <td> {{ session("regreso")[0]->hora}} </td>
                        <td> {{ session("regreso")[0]->precio}} </td>
                        <td> {{ session("regreso")[1]->municipio_origen}} </td>
                        <td> {{ session("regreso")[1]->municipio_destino}} </td>
                        <td> {{ session("viajeros")}}</td>

                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col">
                        <span class="font-weight-bold texto-inside">Precio total: {{(session("regreso")[0]->precio)*session("viajeros")}}</span>

                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>

                @endif

                    @csrf
                    <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Comprar</button>
        </form>
        <br>
        <a href={{route("consultar_viaje")}}><button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Cancelar</button></a>

    </div>

@endsection
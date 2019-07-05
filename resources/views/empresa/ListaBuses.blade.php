@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-light">
                <thead class="color text-light">
                    <tr>
                        <th scope="col">Placa</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Numero de sillas</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($buses) == 0)
                        
                    <div class="container text-center font-weight-bold text-danger">No existen buses registrados</div>
                    <br>

                    @endif
                    @foreach ($buses as $bus)
                    <tr>
                        <td> {{ $bus->placa }} </td>
                        <td> {{ $bus->codigo }} </td>
                        <td> {{ $bus->numero_sillas }} </td>
                        <td> {{ $bus->estado }} </td>
                        <td> {{ $bus->categoria }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
</div>

@endsection
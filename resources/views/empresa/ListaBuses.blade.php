@extends('layouts.app')

@section('content')
<div class="row-">
    <div class="col-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Placa</th>
                <th scope="col">Codigo</th>
                <th scope="col">Numero de sillas</th>
                <th scope="col">Estado</th>
                <th scope="col">Categoría</th>
            </tr>
            </thead>
            <tbody>
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
@endsection
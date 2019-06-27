@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row-">
            <div class="col-12">
                <h1>{{$title}}</h1>
            </div>
        </div>
    
        <div class="row-">
            <div class="col-12">
                <form action={{route("registrar_buses")}} method="POST">
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" name="placa" value="{{ old('placa') }}" class="form-control">
                        @if ($errors->has('placa'))
                            <p>{{ $errors->first('placa') }}</p>
                        @endif

                    </div>
    
                    <div class="form-group">
                        <label for="codigo">Codigo</label>
                        <input type="number" name="codigo" value="{{ old('codigo') }}" class="form-control">
                        @if ($errors->has('codigo'))
                            <p>{{ $errors->first('codigo') }}</p>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="numero_sillas">Numero de sillas</label>
                        <input type="number" name="numero_sillas" value="{{ old('numero_sillas') }}" class="form-control">
                        @if ($errors->has('numero_sillas'))
                            <p>{{ $errors->first('numero_sillas') }}</p>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <input type="text" name="categoria" value="{{ old('categoria') }}" class="form-control">
                        @if ($errors->has('categoria'))
                            <p>{{ $errors->first('categoria') }}</p>
                        @endif

                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Bus</button>
    
                    @csrf
                </form>
            </div>
        </div>

        <hr>
        
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

    </div>
@endsection

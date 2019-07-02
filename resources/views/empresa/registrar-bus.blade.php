@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="texto-inside">{{$title}}</h1>
            </div>
        </div>
    
        <div class="row py-2">
            <div class="col">
                <form action={{route("registrar_buses")}} method="POST">
                    <div class="borde">
                        <div class="form-group">
                            <label for="placa" class="py-2 text-light">Placa *</label>
                            <input type="text" name="placa" value="{{ old('placa') }}" class="form-control">
                            @if ($errors->has('placa'))
                            <p class="text-danger">{{ $errors->first('placa') }}</p>
                            @endif
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="codigo" class="text-light">Codigo *</label>
                            <input type="number" name="codigo" value="{{ old('codigo') }}" class="form-control">
                            @if ($errors->has('codigo'))
                            <p class="text-danger">{{ $errors->first('codigo') }}</p>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="numero_sillas" class="text-light">Numero de sillas *</label>
                            <input type="number" name="numero_sillas" value="{{ old('numero_sillas') }}" class="form-control">
                            @if ($errors->has('numero_sillas'))
                            <p class="text-danger">{{ $errors->first('numero_sillas') }}</p>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="categoria" class="text-light">Categoria *</label>
                            <select type="select" name="categoria" value="{{ old('categoria') }}" class="form-control">
                                <option value="basico">Basico</option>
                                <option value="premium">Premium</option>
                                @if ($errors->has('categoria'))
                                <p class="text-danger">{{ $errors->first('categoria') }}</p>
                                @endif
                            </select>
                        </div>
                        <br>
                        <p class="text-light">* Campos obligatorios</p>
                        @csrf
                    </div>
                    <br>
                    <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Registrar Bus</button>
                </form>

            </div>
        </div>
    </div>
@endsection

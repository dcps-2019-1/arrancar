@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="texto-inside">Registrar ruta</h1>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-12">
                <form action= {{route("registrar_ruta")}} method="POST">
                    <div class="borde">
                        <div class="form-group">
                            <label class="py-2 text-center text-light">
                                Departamento de salida *
                            </label>
                            <select name="departamento_origen" id="departamento_origen" class="
                                                form-control input-group-lg dynamic">
                                <option value="">Departamento</option>
                                @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->departamento }}">
                                    {{ $departamento->departamento }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('departamento_origen'))
                            <p class="text-danger">{{ $errors->first('departamento_origen') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-center text-light">
                                Municipio de salida *
                            </label>
                            <select name="municipio_origen" id="municipio_origen" class="
                                                form-control input-group-lg">
                                <option value="">Municipio</option>
                            </select>
                            @if ($errors->has('municipio_origen'))
                            <p class="text-danger">{{ $errors->first('municipio_origen') }}</p>
                            @endif
                            {{ csrf_field() }}
                        </div>
                        <div class="form-group">
                            <label class="text-center text-light">
                                Departamento de llegada *
                            </label>
                            <select name="departamento_destino" id="departamento_destino" class="
                                                                                            form-control input-group-lg dynamic">
                                <option value="">Departamento</option>
                                @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->departamento }}">
                                    {{ $departamento->departamento }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('departamento_destino'))
                            <p class="text-danger">{{ $errors->first('departamento_destino') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-center text-light">
                                Municipio de llegada *
                            </label>
                            <select name="municipio_destino" id="municipio_destino" class="
                                                                                            form-control input-group-lg">
                                <option value="">Municipio</option>
                            </select>
                            {{ csrf_field() }}
                            @if ($errors->has('municipio_destino'))
                            <p class="text-danger">{{ $errors->first('municipio_destino') }}</p>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="codigo" class="text-center text-light">
                                Código *
                            </label>
                            <input id="codigo" class="form-control" type="number" name="codigo">
                            @if ($errors->has('codigo'))
                            <p class="text-danger">{{ $errors->first('codigo') }}</p>
                            @endif
                        </div>
                        <br>
                        <p class="text-light">* Campos obligatorios</p>
                    </div>
                    <br>
                    <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Registrar ruta</button>
                </form>
            </div>
        </div>
    </div>
@endsection
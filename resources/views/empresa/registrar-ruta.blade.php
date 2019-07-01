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
                        <h2 class="py-2 text-light">Lugar de salida</h2>
                        <div class="form-group">
                            <select name="departamento-origen" id="departamento-origen" class="
                                                form-control input-group-lg dynamic">
                                <option value="">Departamento</option>
                                @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->departamento }}">
                                    {{ $departamento->departamento }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="municipio-origen" id="municipio-origen" class="
                                                form-control input-group-lg">
                                <option value="">Municipio</option>
                            </select>
                            {{ csrf_field() }}
                        </div>
                        <br>
                        <h2 class="py-2 text-light">Lugar de llegada</h2>
                        <div class="form-group">
                            <select name="departamento-destino" id="departamento-destino" class="
                                                                                            form-control input-group-lg dynamic">
                                <option value="">Departamento</option>
                                @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->departamento }}">
                                    {{ $departamento->departamento }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="municipio_destino" id="municipio_destino" class="
                                                                                            form-control input-group-lg">
                                <option value="">Municipio</option>
                            </select>
                            {{ csrf_field() }}
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="codigo" class="text-center text-light">
                                <h2>Código</h2>
                            </label>
                            <input id="codigo" class="form-control" type="number" name="codigo">
                        </div>
                    </div>
                    <br>
                    <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Registrar ruta</button>
                </form>
            </div>
        </div>
    </div>
@endsection
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
                        <h2 class="py-2 text-center text-light">Lugar de salida</h2>
                        <div class="form-group">
                            <select name="departamento" id="departamento" class="
                                                form-control input-group-lg dynamic">
                                <option value="">Departamento</option>
                                @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->departamento }}">
                                    {{ $departamento->departamento }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="municipio" id="municipio" class="
                                                form-control input-group-lg">
                                <option value="">Municipio</option>
                            </select>
                            {{ csrf_field() }}
                        </div>
                        
                    </div>
                    <div class="borde">
                        <h2 class="py-2 text-center text-light">Lugar de llegada</h2>
                        <div class="form-group">
                            <select name="departamento2" id="departamento2" class="
                                                                    form-control input-group-lg dynamic">
                                <option value="">Departamento</option>
                                @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->departamento }}">
                                    {{ $departamento->departamento }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="municipio2" id="municipio2" class="
                                                                    form-control input-group-lg">
                                <option value="">Municipio</option>
                            </select>
                            {{ csrf_field() }}
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
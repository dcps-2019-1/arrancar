@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">



                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="texto-inside">Consultar viaje</h1>
                                </div>
                            </div>

                            <div class="row py-2">
                                <div class="col-12">
                                    <form action= {{route("consulta_invitado")}} method="POST">
                                        <div class="borde">
                                            <div class="row m-0">
                                                <div class="form-group col py-4">
                                                    <select name="departamento_origen" id="departamento_origen" class="
                                                    form-control input-group-lg dynamic">
                                                        <option value="">Departamento de salida</option>
                                                        @foreach ($departamentos as $departamento)
                                                            <option value="{{ $departamento->departamento }}">
                                                                {{ $departamento->departamento }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('departamento_origen'))
                                                        <p class="text-danger">{{ $errors->first('departamento_origen') }}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group col py-4">
                                                    <select name="municipio_origen" id="municipio_origen" class="
                                                    form-control input-group-lg">
                                                        <option value="">Municipio de salida</option>
                                                    </select>
                                                    @if ($errors->has('municipio_origen'))
                                                        <p class="text-danger">{{ $errors->first('municipio_origen') }}</p>
                                                    @endif
                                                    {{ csrf_field() }}
                                                </div>

                                            </div>
                                            <div class="row m-0">

                                                <div class="form-group col">
                                                    <select name="departamento_destino" id="departamento_destino" class="
                                                                                                form-control input-group-lg dynamic">
                                                        <option value="">Departamento de llegada</option>
                                                        @foreach ($departamentos as $departamento)
                                                            <option value="{{ $departamento->departamento }}">
                                                                {{ $departamento->departamento }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('departamento_destino'))
                                                        <p class="text-danger">{{ $errors->first('departamento_destino') }}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group col">
                                                    <select name="municipio_destino" id="municipio_destino" class="
                                                                                                form-control input-group-lg">
                                                        <option value="">Municipio de llegada</option>
                                                    </select>
                                                    {{ csrf_field() }}
                                                    @if ($errors->has('municipio_destino'))
                                                        <p class="text-danger">{{ $errors->first('municipio_destino') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row m-0">

                                                <div class="col form-group">
                                                    <label for="fecha_salida" class="text-light">Fecha de salida</label>
                                                    <input type="date" name="fecha_salida" value="{{ old('fecha_salida') }}" class="form-control">
                                                    @if ($errors->has('fecha_salida'))
                                                        <p class="text-danger">{{ $errors->first('fecha_salida') }}</p>
                                                    @endif
                                                </div>
                                                <div class="col form-group">
                                                    <label for="fecha_regreso" class="text-light">Fecha de regreso</label>
                                                    <input type="date" name="fecha_regreso" value="{{ old('fecha_regreso') }}" class="form-control">
                                                    @if ($errors->has('fecha_regreso'))
                                                        <p class="text-danger">{{ $errors->first('fecha_regreso') }}</p>
                                                    @endif
                                                </div>

                                                <div class="col form-group">
                                                    <label for="cantidad" class="text-light">Cantidad de viajeros</label>
                                                    <input type="number" name="cantidad" value="{{ old('cantidad') }}" class="form-control">
                                                    @if ($errors->has('cantidad'))
                                                        <p class="text-danger">{{ $errors->first('cantidad') }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <p class="texto-inside">Todos los campos son obligatorios</p>
                                        <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Consultar viaje</button>
                                    </form>
                                </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

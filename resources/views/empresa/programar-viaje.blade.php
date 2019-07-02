@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="texto-inside">Programar viaje</h1>
                </div>
            </div>

            <div class="row py-2">
                <div class="col">
                    <form action=" {{ route("registrar_viaje") }} " method="POST">
                        <div class="borde">
                            <div class="row py-2">
                                <div class="col form-group">
                                    <label for="ruta" class="text-light">Ruta *</label>
                                    <select id="ruta" class="form-control" name="ruta" value=" {{ old('ruta') }} ">
                                        @foreach ($empresa->rutas as $ruta)
                                        <option value="{{ $ruta->id }}"> {{ $ruta->codigo }} - ({{ $ruta->municipio_origen }},
                                            {{ $ruta->departamento_origen }} - {{ $ruta->municipio_destino }}, {{ $ruta->departamento_destino }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="conductor" class="text-light">Conductor *</label>
                                    <select id="conductor" class="form-control" name="conductor" value=" {{ old('conductor') }} ">
                                        @foreach ($empresa->conductores as $conductor)
                                        <option value="{{ $conductor->id }}"> {{ $conductor->nombre }} (<span>{{ $conductor->cedula }}</span>)
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="bus" class="text-light">Bus *</label>
                                    <select id="bus" class="form-control" name="bus" value=" {{ old('bus') }} ">
                                        @foreach ($empresa->buses as $bus)
                                        <option value="{{ $bus->id }}"> {{ $bus->codigo }} - {{ $bus->placa }} - {{ $bus->categoria }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="fecha" class="text-light">Fecha *</label>
                                    <input type="date" name="fecha" value="{{ old('fecha') }}" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="hora" class="text-light">Hora *</label>
                                    <input type="time" name="hora" value="{{ old('hora') }}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="precio" class="text-light">Precio *</label>
                                    <input type="number" name="precio" step="0.01" value=" {{ old('precio') }} " class="form-control">
                                </div>
                            </div>
                            <br>
                            <p class="text-light">* Campos obligatorios</p>
                        </div>
                        <br>
                        <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Programar viaje</button>
                    </form>
                </div>
            </div>

        </div>
@endsection
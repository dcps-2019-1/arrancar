@extends('layouts.app')
@section("content")

    <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="texto-inside">Programar Mantenimiento</h1>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-12">
                    <form action={{route("create_mantenimiento")}} method="POST">
                        <div class="borde">
                            <div class="form-group">
                                <label for="bus" class="py-2 text-center text-light">Placa del bus *</label>

                                <select type="text" name="placa" value="{{ old('placa') }}" class="form-control">
                                    @foreach($buses as $bus)
                                        <option value={{$bus->placa}}>{{$bus->placa}}</option>

                                    @endforeach
                                @if ($errors->has('placa'))
                                    <p class="text-danger">{{ $errors->first('placa') }}</p>
                                @endif

                                </select>

                            </div>

                            <div class="form-group">
                                <label for="fecha_entrada" class="text-center text-light">Fecha de entrada *</label>
                                <input type="date" name="fecha_entrada" value="{{ old('fecha_entrada') }}" class="form-control">
                                @if ($errors->has('fecha_entrada'))
                                    <p class="text-danger">{{ $errors->first('fecha_entrada') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="fecha_salida" class="text-center text-light">Fecha de salida *</label>
                                <input type="date" name="fecha_salida" value="{{ old('fecha_salida') }}" class="form-control">
                                @if ($errors->has('fecha_salida'))
                                    <p class="text-danger">{{ $errors->first('fecha_salida') }}</p>
                                @endif
                            </div>

                            <br>
                            <p class="text-light">* Campos obligatorios</p>
                            @csrf
                        </div>
                        <br>
                        <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Programar mantenimiento</button>
                    </form>
                </div>
            </div>
        </div>
@endsection







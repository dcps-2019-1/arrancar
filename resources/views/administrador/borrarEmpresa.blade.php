@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="texto-inside">Eliminar Empresa</h1>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-12">
                <form action={{route("borrado")}} method="POST">
                    <div class="borde">

                        <div class="form-group">
                            <label for="empresa" class="py-2 text-center text-light">Cuál empresa desea eliminar del sistema? *</label>
                            <select type="text" name="empresa" value="{{ old('empresa') }}" class="form-control">
                             @foreach($empresas as $empresa)
                                    <option value={{$empresa->id}}>{{$empresa->nombre}}</option>
                             @endforeach
                            @if ($errors->has('empresa'))
                                <p class="text-danger">{{ $errors->first('empresa') }}</p>
                            @endif
                            </select>
                        </div>

                        <br>
                        <p class="text-light">* Campos obligatorios</p>
                        @method('delete')
                        @csrf
                    </div>
                    <br>
                    <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Eliminar Empresa</button>
                </form>
            </div>
        </div>
    </div>
@endsection

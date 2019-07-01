@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="texto-inside">Registrar conductor</h1>
            </div>
        </div>
    
        <div class="row py-2">
            <div class="col-12">
                <form action={{route("registro_conductor")}} method="POST">
                    <div class="borde">
                        <div class="form-group">
                            <label for="nombre" class="py-2 text-center text-light">Nombre *</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control">
                            @if ($errors->has('nombre'))
                            <p class="text-danger">{{ $errors->first('nombre') }}</p>
                            @endif
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="cedula" class="text-center text-light">Cedula *</label>
                            <input type="text" name="cedula" value="{{ old('cedula') }}" class="form-control">
                            @if ($errors->has('cedula'))
                            <p class="text-danger">{{ $errors->first('cedula') }}</p>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="username" class="text-center text-light">Username *</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                            @if ($errors->has('username'))
                            <p class="text-danger">{{ $errors->first('username') }}</p>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="text-center text-light">E-mail *</label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                            @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="text-center text-light">Contraseña *</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                            @if ($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="telefono" class="text-center text-light">Telefono *</label>
                            <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control">
                            @if ($errors->has('telefono'))
                            <p class="text-danger">{{ $errors->first('telefono') }}</p>
                            @endif
                        </div>
                        <br>
                        <p class="text-light">* Campos obligatorios</p>
                        @csrf
                    </div>
                    <br>
                    <button id="btn-formulario" type="submit" class="btn btn-subir text-light font-weight-bold">Registrar conductor</button>
                </form>
            </div>
        </div>
    </div>
@endsection

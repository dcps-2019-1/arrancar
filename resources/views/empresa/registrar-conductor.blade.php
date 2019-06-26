@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row-">
            <div class="col-12">
                <h1>Conductores</h1>
            </div>
        </div>
    
        <div class="row-">
            <div class="col-12">
                <form action={{route("registro_conductor")}} method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control">
                        @if ($errors->has('nombre'))
                            <p>{{ $errors->first('nombre') }}</p>
                        @endif

                    </div>
    
                    <div class="form-group">
                        <label for="cedula">Cedula</label>
                        <input type="text" name="cedula" value="{{ old('cedula') }}" class="form-control">
                        @if ($errors->has('cedula'))
                            <p>{{ $errors->first('cedula') }}</p>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                        @if ($errors->has('username'))
                            <p>{{ $errors->first('username') }}</p>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                        @if ($errors->has('email'))
                            <p>{{ $errors->first('email') }}</p>
                        @endif

                    </div>
    
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                        @if ($errors->has('password'))
                            <p>{{ $errors->first('password') }}</p>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control">
                        @if ($errors->has('telefono'))
                            <p>{{ $errors->first('telefono') }}</p>
                        @endif
                    </div>
    
                    <button type="submit" class="btn btn-primary">Registrar</button>
    
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Cedula</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conductores as $conductor)
                            <tr>
                                <td> {{ $conductor->nombre }} </td>
                                <td> {{ $conductor->cedula }} </td>
                                <td> {{ $conductor->user->username }} </td>
                                <td> {{ $conductor->user->email }} </td>
                                <td> {{ $conductor->user->telefono }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

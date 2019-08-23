@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error!</strong> Debe seleccionar una imagen para subir<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="row justify-content-center">

            <div class="profile-header-container">
                <div class="profile-header-img">
                    <img class="rounded-circle" src="{{ $user->avatar }}" height="200" width="200"/>
                    <!-- badge -->
                    <br>
                    <br>
                    <div class="rank-label-container">
                        <span class="label label-default rank-label">{{$user->name}}</span>
                    </div>
                </div>
            </div>

        </div>




        <div class="row justify-content-center">
            <form action="/profile" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Seleccione un archivo de imagen válido. Tamaño máximo 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
@endsection
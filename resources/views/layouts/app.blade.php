<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Arrancar') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <style>
        body {
        font-family: 'Roboto', sans-serif;
        }
        
        a,
        a:hover,
        a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
        }
        
        
        #sidebar {
        width: 250px;
        position: fixed;
        top: 0;
        left: -250px;
        height: 100vh;
        z-index: 999;
        background: #3399f3;
        color: #fff;
        transition: all 0.3s;
        overflow-y: scroll;
        box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
        }
        
        #sidebar.active {
        left: 0;
        }
        
        #dismiss {
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        background: #3399f3;
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
        }
        
        #dismiss:hover {
        background: #fff;
        color: #7386D5;
        }
        
        .overlay {
        display: none;
        position: fixed;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.7);
        z-index: 998;
        opacity: 0;
        transition: all 0.5s ease-in-out;
        }
        .overlay.active {
        display: block;
        opacity: 1;
        }
        
        #sidebar .sidebar-header {
        padding: 20px;
        background: #0080ff;
        }

        #sidebar .sidebar-header2 {
            padding: 20px;
            background: #0080ff;
        }
        
        #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #47748b;
        }
        
        #sidebar ul p {
        color: #fff;
        padding: 10px;
        }
        
        #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
        }
        
        #sidebar ul li a:hover {
        color: #3399f3;
        background: #fff;
        }
        
        #navbar a {
            color: white;
            background: #3399f3;
        }

        #navbar ul li a:hover {
            color:#3399f3;
            background: white;
        }

        ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #6d7fcc;
        }

        .color {
            background: #3399f3;
        }

        .texto-inside {
            color: #3399f3;
        }
        .content {
        width: 100%;
        min-height: 100vh;
        transition: all 0.3s;
        position: absolute;
        }

        .borde{
            padding: 3px 10px;
            background: #3399f3;
        }

        .btn-subir {
            background: #3399f3;
            border-radius: 0px;;
        }

        .img1 {
            width: 50px;
            height: 50px;
            border: 1px solid white;
            border-radius: 50%;
        }

        .img2 {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            margin-left: 28px;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>
            @guest
                <div class="sidebar-header">
                    <h3><i class="fas fa-bus"></i> Arrancar</h3>
                </div>
            @else
            <div class="sidebar-header2">
                <img src="{{ auth::user()->avatar }}" class="img2">
            </div>
            @endguest

            @guest
                @include('layouts.sidebar')
            @else 
                @if (auth::user()->rol == 2)
                @include('empresa.sidebar')
                @elseif(auth::user()->rol == 3)
                @include('conductor.sidebar')
                @elseif(auth::user()->rol == 0)
                @include('cliente.sidebar')
                @else
                @include('administrador.sidebar')
                @endif
            @endguest
        </nav>
        <!-- Page Content  -->
            <div id="app" class="content">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm color">
                    <div class="container">
                        <a class="navbar-brand font-weight-bold text-light" href="{{ url('/') }}">
                            <h1 class="display-5"><i class="fas fa-bus"></i>{{ config(' Arrancar', ' Arrancar') }}</h1>
                        </a>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
            
                            </ul>
            
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto font-weight-bold">
                                <!-- Authentication Links -->
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}">Iniciar Sesión</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}">Registrate</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown">
                                        <img src="{{auth::user()->avatar}}" class="img1">
                                    </a>
                                
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item texto-inside" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar sesión') }}
                                        </a>
                                
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                            </ul>

                        </div>
                        <button type="button" id="sidebarCollapse" class="btn text-light">
                            <h4><i class="fas fa-align-justify"></i></h4>
                        </button>
                    </div>
                </nav>
                <nav class="navbar navbar-expand-md navbar-light color shadow-sm" id="navbar">
                    <div class="container">
                        @auth
                        @if (auth::user()->rol == 2)
                        @include('empresa.nav')
                        @elseif(auth::user()->rol == 3)
                        @include('conductor.nav')
                        @elseif(auth::user()->rol == 0)
                        @include('cliente.nav')
                        @elseif(auth::user()->rol == 1)
                        @include('administrador.nav')
                        @endif
                        @endauth
                    </div>
                </nav>
                <main class="py-5">
                    @yield('content')
                </main>

        </div>
    </div>
    <div class="overlay"></div>


    <!-- Popper.JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
    integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
</script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>


    <script type="text/javascript">
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
        alert(msg);
        }
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            $('.dynamic').change(function(e){
                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('rutacontroller.fetch') }}",
                        method:"POST",
                        data:{value:value, _token:_token},
                        success:function(result)
                        {
                            if (select == "departamento_origen") {
                                $('#municipio_origen').html(result);
                            }
                            else $('#municipio_destino').html(result);
                        }
                        
                    })
                }
            });
            
        });
    </script>

</body>

</html>

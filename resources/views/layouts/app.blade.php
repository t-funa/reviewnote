<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ReviewNote') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    @vite('resources/js/app.js')
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Styles -->
    @vite('resources/sass/app.scss')
    @yield('css')
</head>
<body>
    <div id="app">
    <div class="container-fluid bg-white shadow-sm" style="width:150vh; height:92vh; margin-top:3vh;">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'ReviewNote') }}
                    <br>
                    <p style="font-size:0.7em;">{{ $semester['name'] }}</p>
                </a>

                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

            </div>
        </nav>



        @yield('content')
    
    <footer class="footer navbar-expand-md navbar-light" style="position:sticky; top:100vh;">
        <div class="row justify-content-between">
            <div class="col-sm-3 navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-outline-danger" onclick="history.back()" style="margin-left:10px; width:88px;">戻る</a>
                    </li>
                </ul>
            </div>
        
            <div class="col-sm-4 navbar justify-content-end">
                <ul class="navbar-nav" style="margin-right:10px;">
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" href={{ route('show') }} style="margin-left:10px; width:88px;">教科一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger" href={{ route('deleteHome') }} style="margin-left:10px; width:88px;">削除</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    </div>
    </div>
</body>
</html>
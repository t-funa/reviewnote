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
        <div class="container-fluid bg-white shadow-sm" style="width:150vh; height:92vh; margin:auto; margin-top:3vh;">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'ReviewNote') }}
                        <br>
                        <p style="font-size:0.7em;">{{ $semester['name'] }}</p>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

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

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

            <main class="main">

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

                <div class="row overflow-auto" style='max-height:70vh; --bs-gutter-x: 0rem;'>
                    <div class="card h-100">
                        <div class="card-header d-flex">{{ $semester['name'] }} 成績表 / {{ $subject['name'] }}</div>
                        <div class="card-body p-2 overflow-auto">
                            <div class="container">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>出席番号</th>
                                            <th>名前</th>
                                            <th>合計点</th>
                                            <th>相対評価</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students->sortBy('number') as $student)
                                        <tr>
                                            <td>{{ $student['number'] }}</td>
                                            <td>{{ $student['first_name'] }} {{ $student['last_name'] }}</td>
                                            <td>{{ $student['point_sum'] }}</td>
                                            <td>{{ round($student['point_sum']/$max*100) }}%</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="footer navbar-expand-md navbar-light" style="position:sticky; top:100vh;">
                <div class="row justify-content-between">
                    <div class="col-sm-3 navbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="btn btn-outline-danger" onclick="history.back()" style="margin-left:10px; width:64px;">戻る</a>
                            </li>
                        </ul>
                    </div> 
                </div>    
            </footer>
        </div>
    </div>
</body>

</html>



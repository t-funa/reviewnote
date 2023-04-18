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
    <main class="main">
      <div class="container-fulid bg-white shadow-sm" style="width:150vh; height:92vh; margin:auto; margin-top:3vh;">
        
        <div class="row" style='height: 100%; --bs-gutter-x: 0rem;'>
          <div class = "col-md-6 p-0" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <a class="navbar-brand" href="{{ url('/') }}">
              <h1>{{ config('app.name', 'ReviewNote') }}</h1>
              <p>{{ $semester['name'] }}</p>
            </a>
          </div>

          <div class="col-md-6 p-0" style="display:flex; justify-content: center; align-items:center;">
            <div class="card-body" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
              <form method='POST' action="/store">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user->id }}">
                <input type='hidden' name='semester_id' value="{{ $semester['id'] }}">
                <div class="d-grid gap-2 d-md-block">
                <button name="su" type='submit' class="btn btn-outline-primary btn-lg" style="width:88px; margin:2px;">教科</button>
                <button name="re" type='submit' class="btn btn-outline-danger btn-lg" style="width:88px; margin:2px;">成績表</button>
                <button name="ex" type='submit' class="btn btn-outline-success btn-lg" style="width:88px; margin:2px;">体験</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
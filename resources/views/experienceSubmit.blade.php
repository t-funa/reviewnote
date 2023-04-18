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
        <div class=" row" style='height: 82vh; --bs-gutter-x: 0rem; margin-right:3vh;'>
        
          <div class = "col-md-4 p-0" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <h1>{{ config('app.name', 'ReviewNote') }}</h1>
            <p>{{ $semester['name'] }}</p>
            <p>{{ $first_name }}{{ $last_name }} 体験の記録</p>
          </div>

          <div class="col-md-4 p-0" style="margin-top:3vh;">
            <div class="card h-100">
              <div class="card-header" style="display: flex; flex-direction: column; justify-content: center; align-items: center;" >済</div>
              <div class="card-body overflow-auto" style="max-height:70vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
              @foreach($experienced as $e)
                <p class="btn btn-outline-secondary" style="width:32vh; margin:1vh 0;">{{ $e['name'] }}</p>
              @endforeach
              </div>
            </div>
          </div>

          <div class="col-md-4 p-0" style="margin-top:3vh;">
            <div class="card h-100">
              <div class="card-header" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">未</div>
              <div class="card-body overflow-auto" style="max-height:70vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <form method='POST' action="/store" id="form" autocomplete="off" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                  @csrf
                  <input type='hidden' name='user_id' value="{{ $semester->user['id'] }}">
                  <input type='hidden' name='semester_id' value="{{ $semester['id'] }}">
                  <input type="hidden" name="last_name" value="{{ $last_name }}">
                  <input type="hidden" name="first_name" value="{{ $first_name }}">
                  <input type="hidden" name="number" value="{{ $number }}">
                  @foreach($inexperienced as $i)
                  <input type="submit" name='experience_name' value="{{ $i['name'] }}" class="btn btn-outline-secondary" style="width:32vh; margin:1vh 0px;" onclick="return confirm('{{ $i['name'] }}を体験済みに変更しますか？')">
                  @endforeach
                </form>

              </div>
            </div>
          </div>

        </div>

        <footer class="footer navbar-expand-md navbar-light" style="position:sticky; top:100vh; margin:0vh 3vh;">
            <div class="row justify-content-between">
                <div class="col-sm-3 navbar"></div>
            
                <div class="col-sm-4 navbar justify-content-end">
                    <ul class="navbar-nav" style="margin-right:10px;">
                        <li class="nav-item">
                            <a class="btn btn-outline-primary" href={{ route('studentShow') }}>前時のふりかえり</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>


      </div>
    </main>
  </div>
</body>
</html>
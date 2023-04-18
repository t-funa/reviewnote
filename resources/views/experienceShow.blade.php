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

      <main class="main">
        <div class="container">
          <div class="row align-items-center">

            <div class = "col-md-4" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
              <a class="navbar-brand" href="{{ url('/') }}">
                <h1>{{ config('app.name', 'ReviewNote') }}</h1>
                <p>{{ $semester['name'] }} 体験の記録</p>
                <p>{{ $experience['name'] }}</p>
              </a>
            </div>


            <div class="col-md-8 row overflow-auto" style="margin:50px 0px; max-height:70vh;">
              <div class="col-6" style="padding:0px;">
                <div class="card h-100">
                  <div class="card-header" style="display: flex; flex-direction: column; justify-content: center; align-items: center;" >済</div>
                  <div class="card-body" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                  @foreach($experience_students as $experience_student)
                    <p>{{ $experience_student['first_name'] }}</p>
                  @endforeach
                  </div>
                </div>
              </div>

              <div class="col-6" style="padding:0px;">
                <div class="card h-100">
                  <div class="card-header" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">未</div>
                  <div class="card-body" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                  @foreach($inexperienced_students as $inexperienced_student)
                    <p>{{ $inexperienced_student['first_name'] }}</p>
                  @endforeach
                  </div>
                </div>
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
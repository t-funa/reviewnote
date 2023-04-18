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
      
        <div class="row" style='height:100%; --bs-gutter-x: 0rem;'>

        @if(session('success'))
          <div class="alert alert-success" role="alert" style="height:8vh;">
          {{ session('success') }}
          </div>
        @endif

          <div class = "col-md-6" style="width:75vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <a class="navbar-brand" href="{{ url('/') }}">
              <h1>{{ config('app.name', 'ReviewNote') }}</h1>
              <p>{{ $semester['name'] }} 体験の記録</p>
            </a>
          </div>

          <div class="col-md-6" style="display:flex; justify-content: center; align-items:center;">
            <div class="card" style="width:75vh; margin:0 9vh;">
              <div class="card-header" style="display:flex; justify-content: center; align-items:center;">体験</div>
              <div class="card-body overflow-auto" style="max-height:64vh; display: flex; flex-direction: column; justify-content: center; align-items: center; margin:3vh 0;">
              @foreach($experiences as $experience)
                <a href="/experience/{{ $experience->id }}" class='d-block'>{{ $experience['name'] }}</a>
              @endforeach
                <form method='POST' action="/store" style="display:flex; margin-top:3vh;" autocomplete="off">
                @csrf
                  <input type='hidden' name='user_id' value="{{ $user->id }}">
                  <input type='hidden' name='semester_id' value="{{ $semester->id }}">
                  <div class="form-group">
                    <input name='experience' type="text" class="form-control" placeholder="児童にさせたい体験" required>
                  </div>
                  <button name="experienceAdd" type='submit' class="btn btn-outline-secondary">追加</button>
                </form>
              </div>
            </div> 
            <footer class="footer navbar-expand-md navbar-light" style="position:sticky; top:100vh;">
              <div class="row justify-content-between">
                  <div class="col-sm-3 navbar"></div>
              
                  <div class="col-sm-4 navbar justify-content-end">
                      <ul class="navbar-nav" style="margin-right:3vh;">
                          <li class="nav-item">
                            <a class="btn btn-outline-danger" href={{ route('experienceDelete') }} style="width:56px;">削除</a>
                          </li>
                      </ul>
                  </div>
              </div>
            </footer>
          </div>

        </div>
      </div>
    </main>
  </div>
</body>
</html>
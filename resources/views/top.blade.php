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
    <link rel="stylesheet" href="css/book.css"/>
    <style>
.book-cover {
  width: 75vh;
  position: relative;
  box-shadow: 10px 15px 22px -5px rgba(0, 0, 0, 0.4),
    0 0 2px rgba(0, 0, 0, 0.15);
  border-radius: 4px;
}

.book-cover:after {    
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;

  background: linear-gradient(
    -90deg,
    rgba(255, 255, 255, 0) 0%,
    rgba(255, 255, 255, 0.1) 80%,
    rgba(255, 255, 255, 0.2) 94%,
    rgba(255, 255, 255, 0.3) 96%,
    rgba(255, 255, 255, 0) 100%
  );
}

.book-cover-image {
  display: block;
  width: 100%;
  border-radius: 5px;
}
    </style>
</head>
<body>
  <div id="app">
    <main class="main">
      
      <div class="cssbk">

        <label class="d-flex">
          <input type="checkbox">

          <span style="margin-top:3vh; z-index: 99;">
            <div class="book-cover" style="padding:0px; width:75vh;">
              <div class="row" style='height: 92vh; --bs-gutter-x: 0rem;'>
                <div class="book-cover-image" style="display: flex; justify-content: center; align-items: center; background-image:url({{ 'img/blackboard.jpg' }}); background-size:cover;">
                  <h1>{{ config('app.name', 'ReviewNote') }}</h1>
                </div>
              </div>
            </div>
          </span>

          <span class="dummy" style="margin-top:3vh;">
              <div class="bg-white" style="width:75vh; height:92vh; display:flex; justify-content: center; align-items:center;">
                <h1>{{ config('app.name', 'ReviewNote') }}</h1>
              </div>
          </span>

        </label>
        
        <label class="d-flex">
          <input type="#">

          <span style="margin-top:3vh; z-index: 98;">
            <div class="bg-white" style="width:75vh; height:92vh; display:flex; justify-content: center; align-items:center;">
              <div class="card w-100" style="margin:20px;">
                <div class="card-header" style="display:flex; justify-content: center; align-items:center;">年学期</div>
                <div class="card-body overflow-auto" style="max-height:64vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                  @foreach($semesters->sortByDesc('id') as $semester)
                    <a href="/semester/{{ $semester->id }}" class='d-block'>{{ $semester->name }}</a>
                  @endforeach
                  <form method='POST' action="/store" style="display:flex; height:37px; margin-top:24px;">
                  @csrf
                    <input type='hidden' name='user_id' value="{{ $user->id }}">
                    <div class="form-group">
                      <input name='semester' type="text" class="form-control d-flex"  placeholder="〇年〇学期" required>
                    </div>
                    <button name="semesterAdd" type='submit' class="btn btn-outline-secondary">追加</button>
                  </form>
                </div>
              </div>
              <footer class="footer navbar-expand-md navbar-light" style="position:sticky; top:100vh;">
                <div class="row justify-content-between">
                    <div class="col-sm-3 navbar"></div>
                
                    <div class="col-sm-4 navbar justify-content-end">
                        <ul class="navbar-nav" style="margin-right:3vh;">
                            <li class="nav-item">
                              <a class="btn btn-outline-danger" href={{ route('semesterDelete') }} style="width:64px;">削除</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
            </div>
          </span>

        </label>
      </div>
    </main>
  </div>
</body>
</html>
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
        <main class="main">
        @if(session('success'))
          <div class="alert alert-success" role="alert">
          {{ session('success') }}
          </div>
        @endif
          <div class="row" style="height:16vh;">
            <div class="col-3" style="margin:auto; text-align: center;">
              <h1 >{{ config('app.name', 'ReviewNote') }}</h1>
            </div>
            <div class="col-3" style="margin:auto; text-align: center;">
              <h2>前時のふりかえり</h2>
            </div>
            <div class="col-6" style="padding-top:2vh; margin:auto; text-align: center;">
              <p>授業のめあて:{{ $purpose['content'] }}</p>
            </div>
          </div>

          <div class="row overflow-auto" style='max-height:64vh; --bs-gutter-x: 0rem;'>
          <div class="col-md-12 p-0">
                <div class="card h-100">
                    <div class="card-header d-flex">自分のふりかえり</div>
                    <div class="card-body p-2">
                      @if(isset($my_review))
                      <p style="margin:2px;">{{ $my_review->number }}  {{ $my_review->first_name }}</p>
                      <em name='content' class="form-control">{!! $my_review['content'] !!}</em>
                      @endif
                    </div>
                </div>   
            </div>
          
            <div class="col-md-12 p-0">
                <div class="card h-100">
                    <div class="card-header d-flex">最高評価のふりかえり</div>
                    <div class="card-body p-2">
                    @foreach($reviews->sortBy('number') as $review)
                        <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
                        <em name='content' class="form-control">{!! $review['content'] !!}</em>
                    @endforeach
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
            
                <div class="col-sm-4 navbar justify-content-end"></div>
            </div>
        </footer>
    </div>
  </div>
</body>
</html>
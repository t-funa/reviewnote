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
        
      @if(session('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>
      @endif
      <div class="row" style='max-height: 100%; --bs-gutter-x: 0rem;'>
        <div class="col-3" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
          <h1>{{ config('app.name', 'ReviewNote') }}</h1>
        </div>  
        <div class="col-9">
          <p name='content' style="font-size:1.3rem; text-align:center; margin:20px;">授業のめあて： {{ $purpose['content'] }}</p>
        </div>

          <div class="container overflow-auto" style="height:80vh;">
            <div class="card">
              <div class="card-header" style="text-align:center;">ふりかえり登録</div>
              <div class="card-body">

                  <form method='POST' action="/store" id="form" autocomplete="off">
                    @csrf
                    <input type='hidden' name='user_id' value="{{ $user->id }}">
                    <input type='hidden' name='semester_id' value="{{ $purpose->semester['id'] }}">
                    <input type='hidden' name='subject_id' value="{{ $purpose->subject['id'] }}">
                    <input type='hidden' name='unit_id' value="{{ $purpose->unit['id'] }}">
                    <input type='hidden' name='purpose_id' value="{{ $purpose['id'] }}">
                    <input type='hidden' name='purpose_content' value="{{ $purpose['content'] }}">

                    <div class="container">
                    <div class="row">

                    <div class="col-sm-6 col-md-2 col-lg-3">出席番号</div>
                    <div class="col-sm-6 col-md-8 offset-md-2 col-lg-9 offset-lg-0"><input name='number' id="number" type="number" class="form-control" value="" required></div>
                    
                    <div class="col-sm-6 col-md-2 col-lg-3" style="margin-top:10px;">名前</div>
                    <div class="col-sm-6 col-md-8 offset-md-2 col-lg-9 offset-lg-0" style="margin-top:10px;">
                      <input name='first_name' id='first_name' type="text" class="form-control" style="width:50%; display:inline-block;" placeholder="苗字" required>
                      <input name='last_name' id='last_name' type="text" class="form-control" style="width:50%; display:inline-block;" placeholder="名前" required>
                    </div>

                    <div class="col-sm-6 col-md-2 col-lg-3" style="margin-top:10px;">ふりかえり</div>
                    <div class="col-sm-6 col-md-8 offset-md-2 col-lg-9 offset-lg-0" style="margin-top:10px;">
                      <textarea name='content' id="content" class="form-control overflow-auto" style="font-size:1.2rem;" rows="10" required></textarea>
                    </div>
                    
                    <div class="col-sm-6 col-md-2 col-lg-3"></div>
                    <div class="col-sm-6 col-md-8 offset-md-2 col-lg-9 offset-lg-0" style="margin-top:10px; display: flex; justify-content: flex-end;">
                      <button name="reviewAdd" id="button" type='submit' class="btn btn-outline-primary btn-lg" onclick="return confirm('以下の内容でよろしいですか？')">送信</button>
                    </div>
                  
                </div>
                </div>

                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
    </main>
  </div>
</body>
</html>
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
                <div class="row" style="width:150vh;">
                    <a class="navbar-brand col-md-2" href="{{ url('/') }}" style="font-size:1.8rem;">
                        {{ config('app.name', 'ReviewNote') }}
                    </a>

                    <div class="col-md-2">
                        <p style="font-size:1rem;">{{ $semester['name'] }}</p>
                    </div>

                    <div class="col-md-2">
                        <p style="font-size:1em;">ふりかえり一覧</p>
                    </div>
                    <div class="col-md-3">
                        <p>授業のめあて： {{ $purpose->content }}</p>
                    </div>


                    <div class="col-md-2">
                        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav">
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
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </nav>


    <main class="main">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
        {{ session('success') }}
        </div>
    @endif
        <div class="row">
            
            <div class="col-12">
                <form method='POST' action="/store">
                @csrf
                    <input type='hidden' name='user_id' value="{{ $user->id }}">
                    <input type='hidden' name='semester_id' value="{{ $purpose->semester['id'] }}">
                    <input type='hidden' name='subject_id' value="{{ $purpose->subject['id'] }}">
                    <input type='hidden' name='unit_id' value="{{ $purpose->unit['id'] }}">
                    <input type='hidden' name='purpose_id' value="{{ $purpose['id'] }}">
                    <input type='hidden' name='purpose_content' value="{{ $purpose['content'] }}">
                    <div class="form-group" style="display:flex; justify-content:flex-end;">
                        <textarea name='keywords' class="form-control overflow-auto" style="font-size:0.9rem; margin:10px; width:92%;" rows="2" placeholder="キーワード入力(複数の場合,で区切って下さい。英文字1字での入力はできません。)" value="<?php if(!empty($text_value)){ echo $text_value; } ?>"></textarea>
                        <div class="flex-column" style="margin:8px;">
                            <button name="search" type='submit' value='検索' class="btn btn-warning btn-sm btn-group-vertical" style="margin:2px; width:68px; align-items: center">マーカー</button>
                            <button name="evaluation" type='submit' value='評価' class="btn btn-danger btn-sm btn-group-vertical" style="margin:2px; width:68px; align-items: center" onclick="return confirm('以下の内容で評価しますか？')">評価</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row overflow-auto" style='max-height:60vh; --bs-gutter-x: 0rem;'>
            <div class="col-md-3 p-0">
                <div class="card h-100">
                    <div class="card-header d-flex">1~10</div>
                    <div class="card-body p-2">
                    @foreach($reviews->sortBy('number') as $review)
                    @if($review->number <11)
                        <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
                        <em name='content' class="form-control">{!! $review['content'] !!}</em>
                    @endif
                    @endforeach
                    </div>
                </div>   
            </div>

            <div class="col-md-3 p-0">
                <div class="card h-100">
                    <div class="card-header d-flex">11~20</div>
                    <div class="card-body p-2">
                    @foreach($reviews->sortBy('number') as $review)
                    @if($review->number >10 && $review->number<21)
                        <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
                        <em name='content' class="form-control">{!! $review['content'] !!}</em>
                    @endif
                    @endforeach
                    </div>
                </div>   
            </div>

            <div class="col-md-3 p-0">
                <div class="card h-100">
                    <div class="card-header d-flex">21~30</div>
                    <div class="card-body p-2">
                    @foreach($reviews->sortBy('number') as $review)
                    @if($review->number >20 && $review->number<31)
                        <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
                        <em name='content' class="form-control">{!! $review['content'] !!}</em>
                    @endif
                    @endforeach
                    </div>
                </div>   
            </div>

            <div class="col-md-3 p-0">
                <div class="card h-100">
                    <div class="card-header d-flex">31~40</div>
                    <div class="card-body p-2">
                    @foreach($reviews->sortBy('number') as $review)
                    @if($review->number >30 && $review->number<41)
                        <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
                        <em name='content' class="form-control">{!! $review['content'] !!}</em>
                    @endif
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
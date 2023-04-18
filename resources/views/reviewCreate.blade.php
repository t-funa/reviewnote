@extends('layouts.app')

@section('content')
<main class="main">
@if(session('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
@endif
    <div class="row overflow-auto" style='max-height:70vh; --bs-gutter-x: 0rem;'>
        <div class="col-md-3 p-0">
            <div class="card h-100">
                <div class="card-header">教科</div>
                <div class="card-body py-2 px-4">
                    <p class='d-block'>{{ $purpose->subject['name'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-0">
            <div class="card h-100">
                <div class="card-header d-flex">単元</div>
                <div class="card-body py-2 px-4">
                    <p class='d-block'>{{ $purpose->unit['name'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-0">
            <div class="card h-100" style="border-width: 3px;">
                <div class="card-header d-flex">授業のめあて</div>
                <div class="card-body p-2">
                    <p class='d-block'>{{ $purpose->content }}</p>
                    <form method='POST' action="/store">
                    @csrf
                        <button name="reviewSubmit" type='submit' value="{{ $purpose['content'] }}" class="btn btn-outline-secondary" style="margin-top:2px;">「{{ $purpose['content'] }}」の<br>ふりかえり入力ページを送信</button>
                    </form>
                </div>
            </div>    
        </div>

        <div class="col-md-2 p-0">
            <div class="card h-100" style="border-width: 3px;">
                <div class="card-header d-flex">ふりかえり</div>
                <div class="card-body p-2">
                    <form method='POST' action="/store">
                    @csrf
                        <button class="btn btn-outline-secondary" name="reviewShow" type='submit' value="{{ $purpose['content'] }}">一覧</button>
                    </form>
                </div>
            </div>   
        </div>
    </div>
</main>
@endsection   
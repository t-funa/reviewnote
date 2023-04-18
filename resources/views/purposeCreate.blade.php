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
                    <p class='d-block'>{{ $unit->subject['name'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-0">
            <div class="card h-100">
                <div class="card-header d-flex">単元</div>
                <div class="card-body py-2 px-4">
                    <p class='d-block'>{{ $unit['name'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-0">
            <div class="card h-100" style="border-width: 3px;">
                <div class="card-header d-flex">授業のめあて</div>
                <div class="card-body p-2">
                @foreach($unit->purposes as $purpose)
                    <a href="/purpose/{{ $purpose->id }}" class='d-block'>{{ $purpose->content }}</a>
                @endforeach
                    <form method='POST' action="/store">
                    @csrf
                        <div class="form-group">
                            <input type='hidden' name='user_id' value="{{ $user->id }}">
                            <input type='hidden' name='subject_id' value="{{ $unit->subject['id'] }}">
                            <input type='hidden' name='unit_id' value="{{ $unit['id'] }}">
                            <textarea name='content' class="form-control" rows="3" style="margin-top:24px;" placeholder="(例)1/11 めあて：分数の役割を考えよう" required></textarea>
                        </div>
                        <button name="purposeAdd" type='submit' class="btn btn-outline-secondary btn-sm" style="margin-top:2px;">追加</button>
                    </form>
                </div>
            </div>    
        </div>

        <div class="col-md-2 p-0">
            <div class="card h-100">
                <div class="card-header d-flex">ふりかえり</div>
                <div class="card-body p-2">
                @foreach($unit->reviews->sortBy('number') as $review)
                    <p class='d-block'>{{ $review->number }}  {{ $review->first_name }}</p>
                    @if($loop->iteration == 10)
                    @break
                    @endif
                @endforeach
                </div>
            </div>   
        </div>
    </div>
</main>
@endsection                   